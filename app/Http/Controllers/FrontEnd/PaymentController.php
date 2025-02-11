<?php

namespace App\Http\Controllers\FrontEnd;

use App\Enums\CartType;
use App\Enums\OrderDetailStatus;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\GiftCart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductGuaranty;
use App\Models\UserTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{

    public function payment()
    {

        $shop_data = Session::get('shop_data');
        $user = auth()->user();
        $total_price = 0;
        $gift_cart_price = 0;
        $discount_code_price = 0;
        $order_details = [];

        $address = Address::getUserAdderss($user);

        $carts = Cart::getUserCart($user);


        $total_price = ProductGuaranty::calculateTotalPriceInCart($carts, $total_price);

        //محاسبه ی کارت هدیه
        if ($shop_data['gift_cart_code']) {
            $result = GiftCart::calculateGiftCart($shop_data, $total_price, $gift_cart_price);
            $total_price = $result['total_price'];
            $gift_cart_price = $result['gift_cart_price'];
        }

        //محاسبه تخفیف
        if ($shop_data['discount_code']) {
            $result = Discount::calculateDiscount($shop_data, $total_price, $discount_code_price);

            $total_price = $result['total_price'];
            $discount_code_price = $result['discount_code_price'];
        }

        $order = Order::createOrder($user, $address, $total_price, $shop_data, $discount_code_price, $gift_cart_price);

        foreach ($carts as $cart) {
            $product = ProductGuaranty::getProductInCart($cart);

            $order_details = OrderDetail::createOrderDetails($order, $cart, $product);
        }
        if ($shop_data['payment_type'] == 'offline') {

            DB::beginTransaction();
            try {
                Order::successfulPayment($order, $order_details,$shop_data['discount_code'],$shop_data['gift_cart_code']);

                $result = "successful";
                DB::commit();
                return view('frontend.shopping_result', compact('result', 'order'));
            } catch (\Exception $exception) {

                DB::rollBack();
                $result = "failed";

                return view('frontend.shopping_result', compact('result', 'order'));
            }
        } else {
            return Payment::via($shop_data['payment_type'])->purchase(
                (new Invoice)->amount($total_price),
                function ($driver, $transactionId) use ($order) {
                    $order->update(['transaction_id' => $transactionId]);

                })->pay()->render();
        }
    }

    public function callback(Request $request)
    {
        $authority = $request->Authority;
        $order = Order::query()->where('transaction_id', $authority)->first();
        $order_details = OrderDetail::query()->where('order_id', $order->id)->get();

        if ($request->Status == "OK") {
            DB::beginTransaction();
            try {
                Order::successfulPayment($order, $order_details,$order->discount_code,$order->gift_cart_code);
                UserTransaction::sellerSoldProduct($order_details);
                $result = "successful";
                DB::commit();
                return view('frontend.shopping_result', compact('result', 'order'));
            } catch (\Exception $exception) {

                DB::rollBack();
                $result = "failed";

                return view('frontend.shopping_result', compact('result', 'order'));
            }
        } else {

            $result = "failed";
            return view('frontend.shopping_result', compact('result', 'order'));
        }
    }
}
