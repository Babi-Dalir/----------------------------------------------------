@extends('admin.layouts.master')

@section('content')
<main class="main-content">
    @include('admin.layouts.errors')

    <div class="card">
        <div class="card-body">
            <div class="container">
                <h6 class="card-title">ایجاد محصول </h6>
                <form method="POST" action="{{route('seller.store.product')}}" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">نام محصول  </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-left" dir="rtl" name="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">نام انگلیسی  </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-left" dir="rtl" name="etitle">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">  دسته بندی </label>
                        <div class="col-sm-10">
                            <select name="category_id" class="form-select">

                                @foreach ($categories as $key => $value)

                                    <option value="{{ $key }}">{{ $value }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">برند</label>
                        <div class="col-sm-10">
                            <select name="brand_id" class="form-select">
                                @foreach ($brands as $key => $value)

                                    <option value="{{ $key }}">{{ $value }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">انتخاب تگ:</label>
                        <div class="col-sm-10">
                            <select name="tags[]" id="tags"
                                    class="form-control js-example-basic-single select2-hidden-accessible" multiple>
                                @foreach($tags as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">قیمت اصلی</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-left" dir="rtl" name="main_price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">درصد تخفیف محصول</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-left" dir="rtl" name="discount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">تعداد محصول</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-left" dir="rtl" name="count">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">تعداد مجاز فروش</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-left" dir="rtl" name="max_sell">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">رنگ</label>
                        <div class="col-sm-10">
                            <select name="color_id" class="form-select">
                                @foreach ($colors as $key => $value)

                                    <option value="{{ $key }}">{{ $value }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">گارانتی</label>
                        <div class="col-sm-10">
                            <select name="guaranty_id" class="form-select">
                                @foreach ($guaranties as $key => $value)

                                    <option value="{{ $key }}">{{ $value }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> تاریخ شروع شگفت انگیز</label>
                        <div class="col-sm-10">
                            <input type="text" id="spacial_start" class="text-left form-control" dir="rtl"
                                   name="spacial_start">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> تاریخ انقضای شگفت انگیز</label>
                        <div class="col-sm-10">
                            <input type="text" id="special_expiration" class="text-left form-control" dir="rtl"
                                   name="spacial_expiration">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">توضیحات محصول</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control text-left" id="editor" dir="rtl"
                                      name="description" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="file"> آپلود عکس </label>
                        <input  class="col-sm-10 form-control-file" type="file" name="image" id="file">
                    </div>
                    <div class="form-group row">
                        <button name="submit" type="submit" class="btn btn-success btn-uppercase">
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
            dir: "rtl",
            dropdownAutoWidth: true,
            $dropdownParent: $('#parent')
        })
        $('.form-select').select2();
        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: false
            , closeAfterSelect: true
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "#5867dd"
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
            , gotoToday: true
        }
        kamaDatepicker('spacial_start', customOptions);
        kamaDatepicker('special_expiration', customOptions);
    </script>
@endsection

