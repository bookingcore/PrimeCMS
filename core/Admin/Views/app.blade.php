<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$page_title ?? ''}}</title>
    <link
        href="/admin/libs/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet"
    >
    <link
        href="/admin/dist/css/app.css" rel="stylesheet"
    >
    @include('CoreAdmin::parts.global-script')
    @stack('css')
</head>
<body>
@include('CoreAdmin::parts.header')
@include('CoreAdmin::parts.sidebar')
<div class="main-content">
    @include('CoreAdmin::parts.bc')
    {{$slot}}
</div>
<script
    src="/admin/libs/bootstrap-5.3.3/js/bootstrap.bundle.min.js"
></script>
@stack('js')
</body>
</html>
