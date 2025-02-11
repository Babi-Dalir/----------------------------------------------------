<div class="table overflow-auto" tabindex="8">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">عنوان جستجو</label>
        <div class="col-sm-8">
            <input type="text" class="form-control text-left" dir="rtl" wire:model="search">
        </div>
        <div class="col-sm-2">
            <a href="{{ route('products.index') }}" class="btn btn-outline-warning">
                <i class="ti-trash"> بازگشت به محصولات</i>
            </a>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">ردیف</th>
            <th class="text-center align-middle text-primary">عکس</th>
            <th class="text-center align-middle text-primary">نام محصول  </th>
            <th class="text-center align-middle text-primary">دسته بندی</th>
            <th class="text-center align-middle text-primary">برند</th>
            <th class="text-center align-middle text-primary">ویرایش</th>
            <th class="text-center align-middle text-primary">حذف</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($products as $index=>$product )

            <tr>
                <td class="text-center align-middle">{{$products->firstItem()+$index}}</td>
                <td class="text-center align-middle">
                    <figure class="avatar avatar">
                        <img src="{{ url('images/products/small/'.$product->image) }}" class="rounded-circle" alt="image">
                    </figure>
                </td>
                <td class="text-center align-middle">{{$product->title}}</td>
                <td class="text-center align-middle">{{$product->category->title}}</td>
                <td class="text-center align-middle">{{$product->brand->title}}</td>

                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" wire:click='restoreProduct({{ $product->id }})'>
                        بازگردانی
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-danger" wire:click='forceDeleteProduct({{ $product->id }})'>
                        حذف
                    </a>
                </td>
                <td class="text-center align-middle">{{Hekmatinasser\Verta\Verta::instance($product->created_at)->format(' %d,%B %Y')}}</td>
            </tr>
            @endforeach

    </table>
    <div style="margin: 40px !important;"
         class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
         {{$products->appends(Request::except('page'))->links()}}
    </div>
</div>
@section('scripts')
    <script>
        window.addEventListener('forceDeleteProduct',event=>{
            Swal.fire({
                title: "آیا از حذف مطمئن هستید؟",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "بله",
                cancelButtonText:"خیر"
            }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('forceDestroyProduct',event.detail.id)

                    Swal.fire(
                        "حذف با موفقیت انجام شد",
                    )
                }
            })
        })
    </script>
@endsection




