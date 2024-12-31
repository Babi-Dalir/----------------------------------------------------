@extends('admin.layouts.master')

@section('content')
<main class="main-content">
    @include('admin.layouts.errors')
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h6 class="card-title">ویرایش نقدو بررسی</h6>
                <form method="POST" action="{{route('update.product.discussions',[$discussion->id,$product_id])}}">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">عنوان نقدو بررسی </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-left" dir="rtl" name="title" value="{{ $discussion->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">توضیحات نقدو بررسی</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control text-left" id="editor" dir="rtl"
                                      name="description" cols="30" rows="10">{{ $discussion->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-success btn-uppercase">
                            <i class="ti-check-box m-r-5"></i> ذخیره
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
@include('admin.layouts.ckeditorConfig')
    <script>
          $('select').select2({
            dir:'rtl',
            dropdownAutoWidth:true,
            $dropdoenParent:$('#parent')
        })

        $('.form-select').select2();
    </script>

@endsection
