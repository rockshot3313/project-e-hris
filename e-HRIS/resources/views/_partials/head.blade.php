<meta charset="utf-8">


@if (system_settings())
@php
    $system_title = system_settings()->where('key','system_title')->first();
    $system_logo = system_settings()->where('key','agency_logo')->first();
@endphp

@if ($system_logo)

<link style="border-radius: 50%" href="{{ asset('uploads/settings/'.$system_logo->image.'') }}" class=" rounded-full overflow-hidden shadow-lg image-fit zoom-in ml-5" rel="shortcut icon">

@else
<link href="" rel="shortcut icon">
@endif

@if ($system_title)
    <title>{{ $system_title->value }}</title>
@else
<title>{{ $system_title->value }}</title>
@endif

@else
<link href="" rel="shortcut icon">
<title>N/A</title>
@endif




@if (system_settings()->where('key','system_title')->first())
@php
    $system_setting = system_settings()->where('key','system_title')->first();
@endphp

@if ($system_setting->value)
    <title>{{ $system_setting->value }}</title>
@else
    <title>N/A</title>
@endif

@else
<title>N/A</title>
@endif

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="e-HRIS">
<meta name="keywords" content="e-HRIS">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="basepath" content="{{BASEPATH()}}">


{{-- selec2 cdn --}}
<link href="{{BASEPATH()}}/vendor/select2/css/select2.min.css{{GET_RES_TIMESTAMP()}}" rel="stylesheet" />
<link href="{{BASEPATH()}}/vendor/select2/css/select2.custom.css{{GET_RES_TIMESTAMP()}}" rel="stylesheet" />
<link href="{{BASEPATH()}}/vendor/select2/css/select2.single-error.css{{GET_RES_TIMESTAMP()}}" rel="stylesheet" />
<link href="{{BASEPATH()}}/vendor/select2/css/select2.multiple-error.css{{GET_RES_TIMESTAMP()}}" rel="stylesheet" />

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/brands.min.css" integrity="sha512-G/T7HQJXSeNV7mKMXeJKlYNJ0jrs8RsWzYG7rVACye+qrcUhEAYKYzaa+VFy6eFzM2+/JT1Q+eqBbZFSHmJQew==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" integrity="sha512-giQeaPns4lQTBMRpOOHsYnGw1tGVzbAIHUyHRgn7+6FmiEgGGjaG0T2LZJmAPMzRCl+Cug0ItQ2xDZpTmEc+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/regular.min.css" integrity="sha512-k2UAKyvfA7Xd/6FrOv5SG4Qr9h4p2oaeshXF99WO3zIpCsgTJ3YZELDK0gHdlJE5ls+Mbd5HL50b458z3meB/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/fontawesome.min.js" integrity="sha512-nKvEIGRKw2OQCR34yLfnWnvrOBxidLG9aK+vzsBxCZ/9ZxgcS4FrYcN+auWUTkCitTVZAt82InDKJ7x+QtKu6g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="{{url('')}}/vendor/icofont/icofont.min.css">


<!-- BEGIN: CSS Assets-->
<link rel="stylesheet" href="{{url('')}}/assets/datatable/datatables_1.13.1/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="{{url('')}}/dist/css/app.css" />

<link rel="stylesheet" href="{{url('')}}/assets/fa.5.15.4/css/all.min.css" />
<link rel="stylesheet" href="{{url('')}}/assets/uniupload/uniupload.css{{GET_RES_TIMESTAMP()}}" />
<!-- END: CSS Assets-->

<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

<!-- For File Size Validation  -->
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<!-- For Image Preview  -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<!-- For File Type Validation  -->
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>


<!-- plugin css file  -->
<link rel="stylesheet" href="{{url('')}}/assets/plugin/datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="{{url('')}}/assets/plugin/datatables/dataTables.bootstrap5.min.css">
<link href="{{url('')}}/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>


<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{url('')}}/vendor/tooltipster/css/tooltipster.bundle.css{{GET_RES_TIMESTAMP()}}" />

<link rel="stylesheet" href="{{url('')}}/css/custom.css{{GET_RES_TIMESTAMP()}}" />

<!-- chart plugs  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>


