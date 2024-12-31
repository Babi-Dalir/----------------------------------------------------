@extends('admin.layouts.master')

@section('content')
<main class="main-content">
    <div class="row">
        @if (Session::has('message'))
        <div class="alert alert-info">
            <div>{{ session('message') }}</div>
        </div>
        @endif
    </div>
    <div class="card">
        <div class="card-body">
            <livewire:admin.product.products/>
        </div>
    </div>
</main>



@endsection
