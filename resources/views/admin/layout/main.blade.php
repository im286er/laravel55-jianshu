@include('admin.layout._head')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    
    @include('admin.layout._header')
    @include('admin.layout._sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>

    <div class="control-sidebar-bg"></div>
</div>

@include('admin.layout._footer')
