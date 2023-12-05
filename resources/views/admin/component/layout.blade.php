<!DOCTYPE html>
<html>

<head>
    @include('admin.component.head')
    @stack('customCSS')

</head>

<body>
    <div id="wrapper">
        @include('admin.component.sidebar')

        <div id="page-wrapper" class="gray-bg">
            
            @include('admin.component.nav')

            {{-- <div class="wrapper wrapper-content"> --}}

                @yield('content')
            
            {{-- </div> --}}

            @include('admin.component.footer')
            
            @include('admin.component.rightsidebar')
        </div>
    </div>

    @include('admin.component.script')
    @stack('customJS')
</body>
</html>
