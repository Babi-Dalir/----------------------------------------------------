@extends('admin.layouts.master')

@section('content')
<main class="main-content">
    @include('admin.layouts.errors')
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h6 class="card-title">ویرایش بنر</h6>
                <form method="POST" action="{{route('banners.update',$banner->id)}}" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                    <div class="row mb-4">
                        <img style="height:200px; width:200px;" src="{{ url('images/banners/big/'.$banner->image) }}" alt="{{ $banner->image }}">
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">نوع بنر  </label>
                        <select name="type" class="col-sm-3">
                            <option @if($banner->type == \App\Enums\BannerType::TopBanner->value) selected @endif value="{{ \App\Enums\BannerType::TopBanner->value }}">بنر بالا</option>
                            <option @if($banner->type == \App\Enums\BannerType::SideBanner->value) selected @endif value="{{ \App\Enums\BannerType::SideBanner->value }}">بنر کناری</option>
                            <option @if($banner->type == \App\Enums\BannerType::LargeBanner->value) selected @endif value="{{ \App\Enums\BannerType::LargeBanner->value }}">بنر بزرگ</option>
                            <option @if($banner->type == \App\Enums\BannerType::MediumBanner->value) selected @endif value="{{ \App\Enums\BannerType::MediumBanner->value }}">بنر متوسط</option>
                            <option @if($banner->type == \App\Enums\BannerType::SmallBanner->value) selected @endif value="{{ \App\Enums\BannerType::SmallBanner->value }}">بنر کوچک</option>
                        </select>
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
