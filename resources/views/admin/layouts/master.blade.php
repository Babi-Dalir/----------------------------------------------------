<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('admin.layouts.head')

<body class="small-navigation">
	@include('admin.layouts.navigation')
    @include('admin.layouts.header',['title'=>$title ?? ''])
    @yield('content')

    @include('admin.layouts.js')
    
</body>
</html>
