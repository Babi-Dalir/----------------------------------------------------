<?php

namespace App\Http\Livewire\Frontend\Order;

use App\Enums\CartType;
use App\Models\Address;
use App\Models\Cart;
use App\Models\ProductGuaranty;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Shopping extends Component
{

    public $receive_time;
    public $send_type;
    public $request_factor=false;
    public $receive_day;
    public $send_price;
    public $send_day;
    public $selected_address;
    public $selected_day_index=0;
    public $carts;
    public $total_price;
    public $discount_price;

    protected $listeners = [
        'refreshCart' => '$refresh'
    ];
    protected $rules=[
        'receive_time'=>'required|sometimes',
        'send_type'=>'required',
    ];
    public function mount(){

        $this->selected_day_index =0;
        $this->send_type="usual";
        $this->receive_time="9-12";

        $this->carts=Cart::query()
        ->where('user_id',auth()->user()->id)
        ->where('type',CartType::Main->value)->get();

        $total_price= 0 ;
        $discount_price= 0 ;

        foreach($this->carts as $cart){
            $product=ProductGuaranty::query()->where([
                'product_id'=>$cart->product_id,
                'color_id'=>$cart->color_id,
                'guaranty_id'=>$cart->guaranty_id
            ])->first();

            $this->total_price += ($product->price) * $cart->count;
            $this->discount_price += ($product->main_price - $product->price) * $cart->count;
        }
    }

    public function submitOrderInfo(){
        $this->validate();
        $shop_data=[];
        $shop_data['receive_time']=$this->receive_time;
        $shop_data['receive_day']=$this->receive_day;
        $shop_data['send_type']=$this->send_type;
        $shop_data['request_factor']=$this->request_factor;

        Session::put('shop_data',$shop_data);
        return redirect()->route('user.shopping.payment');
    }

    public function receiveDay($i){
        $this->selected_day_index = $i;
        $this->receive_day=Carbon::now()->addDays($i+$this->send_day);
    }

    public function render()
    {
        $addresses=Address::query()->where('user_id',auth()->user()->id)
        ->orderByDesc('is_default')->get();

        $address = Address::query()->where('user_id',auth()->user()->id)
            ->where('is_default',true)->first();

        if ($address){
            $this->selected_address = $address;
            $this->send_price= $this->selected_address->city->send_price;
            $this->send_day= $this->selected_address->city->send_day;

            if(Carbon::now()->addDays($this->send_day)->dayOfWeek != CarbonInterface::FRIDAY){
                $this->receive_day=Carbon::now()->addDays($this->send_day +1);
                $this->selected_day_index =0;
            }
        }
//        $this->receive_day=Carbon::now()->addDays($this->send_day);

        return view('livewire.frontend.order.shopping',
        compact('addresses'


    ));
    }
}
