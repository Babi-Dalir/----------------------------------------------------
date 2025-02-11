@extends('admin.layouts.master')

@section('content')
<main class="main-content">
    @include('admin.layouts.errors')
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h6 class="card-title">ویرایش کمیسیون ها</h6>
                <form method="POST" action="{{route('commissions.update',$commission->id)}}" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">درصد کمیسیون</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-left" dir="rtl" name="percentage" value="{{ $commission->percentage }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">  دسته بندی </label>
                        <div class="col-sm-10">
                            <select name="category_id" class="form-select">

                                @foreach ($categories as $key => $value)
                                    @if ($commission->category_id == $key)
                                        <option selected value="{{ $key }}">{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
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
    <script>
        $('.form-select').select2();
    </script>

@endsection
