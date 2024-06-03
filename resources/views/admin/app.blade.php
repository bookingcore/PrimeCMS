<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $page_title ?? 'Dashboard'}} - {{setting_item('site_title') ?? 'PriceCMS'}}</title>
    @php
        $favicon = setting_item('site_favicon');
    @endphp
    @if($favicon)
        @php
            $file = (new \Modules\Media\Models\MediaFile())->findById($favicon);
        @endphp
        @if(!empty($file))
            <link rel="icon" type="{{$file['file_type']}}" href="{{asset('uploads/'.$file['file_path'])}}" />
        @else
            <link rel="icon" type="image/png" href="{{url('images/favicon.png')}}" />
        @endif
    @endif
    <meta name="robots" content="noindex, nofollow" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('admin/libs/bootstrap-5.3.3/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    @include('admin.parts.global-script')
    <script src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    @stack('css')
</head>
<body class="{{$body_class ?? ''}} {{($enable_multi_lang ?? '') ? 'enable_multi_lang' : '' }} @if(setting_item('site_enable_multi_lang')) site_enable_multi_lang @endif">
<div id="app">
    <div class="main-header d-flex">
        @include('admin.parts.header')
    </div>
    <div class="main-sidebar">
        @include('admin.parts.sidebar')
    </div>
    <div class="main-content">
        @include('admin.parts.bc')
        @yield('content')
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 copy-right">
                        {{date('Y')}} &copy; {{__('PrimeCMS by')}}
                        <a
                            href="{{__('https://www.bookingcore.co')}}" target="_blank"
                        >{{__('BC Team')}}</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="{{__('https://www.bookingcore.co')}}" target="_blank">{{__('About Us')}}</a>
                            <a href="{{__('https://t.me/dannie_bcvn')}}" target="_blank">{{__('Contact Us')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="backdrop-sidebar-mobile"></div>
</div>
@include('Media::browser')

<!-- Styles -->
<link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('libs/flags/css/flag-icon.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{url('libs/daterange/daterangepicker.css')}}" />
<link href="{{ asset('admin/libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- Scripts -->
<script src="{{ asset('libs/pusher.min.js') }}"></script>
<script src="{{ asset('admin/libs/bootstrap-5.3.3/js/bootstrap.bundle.min.js?_ver='.config('app.asset_version')) }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{url('libs/daterange/moment.min.js')}}"></script>
<script src="{{url('libs/daterange/daterangepicker.min.js?_ver='.config('app.asset_version'))}}"></script>
@stack('js')
</body>
</html>
