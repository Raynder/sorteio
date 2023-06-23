<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="horizontal-menu-template-starter">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome.css') }}" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('css/theme-default.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('css/pages/page-help-center.css') }}" class="template-customizer-core-css" />

    <!-- Vendors CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('vendor/libs/select2/select2.min.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('vendor/libs/datatables/datatables.min.css') }}" /> --}}

    @stack('page_styles')

    <!-- Scripts -->
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/libs/bootstrap.js') }}"></script>
    {{-- <script src="{{ asset('vendor/libs/hammer.js') }}"></script> --}}
    <script src="{{ asset('vendor/libs/dropdown-hover.js') }}"></script>
    {{-- <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script> --}}
    <script src="{{ asset('vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('vendor/libs/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
    <script src="{{ asset('vendor/libs/jquery/jquery.maskedinput-1.3.1.js') }}"></script>
    <script src="{{ asset('vendor/libs/jquery/jquery.maskMoney.js') }}"></script>
    <script src="{{ asset('vendor/libs/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/moment.business.js') }}"></script>
    <script src="{{ asset('vendor/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/select2/select2.pt-BR.js') }}"></script>
    {{-- <script src="{{ asset('vendor/libs/datatables/datatables.min.js') }}"></script> --}}

    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <!-- endbuild -->

</head>

<body>
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            @include('layouts.header')
            <div class="layout-page">
                <div class="content-wrapper">
                    @include('layouts.navigation')

                    <!-- Page Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            <!-- Overlay -->
            @include('layouts.footer')
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div>

    <div class="modal fade show" id="modalBasic" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Título</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="modalSub" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true"
        aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document"
            style="box-shadow: 0 5px 15px rgba(0,0,0,.5); top: 10px; left: 10px;">
            <div class="modal-content">
                <div class="modal-header modal-header-sub">
                    <h5 class="modal-title">Título</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="modalDelete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-modal="true" role="dialog" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="headerModal">Exclusão de registro</h4>

                    <div class="loader-modal spinner" style="display:none">Loading...</div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body" id="bodyModalDelete">
                    Tem certeza que deseja excluir este registro?
                    <input type="hidden" id="modalDelete_urlExcluir">
                    <input type="hidden" id="modalDelete_callback">
                    <input type="hidden" id="modalDelete_id">
                </div>

                <div class="modal-footer" id="modalDelete_footerDeletar"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        function registerTooltip() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        };
    </script>

    @stack('page_scripts')
</body>

</html>
