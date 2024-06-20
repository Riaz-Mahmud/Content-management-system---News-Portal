<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/backend/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/backend/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/backend/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/backend/vendor/libs/hammer/hammer.js')) }}"></script>
<script src="{{ asset(mix('assets/backend/vendor/libs/i18n/i18n.js')) }}"></script>
<script src="{{ asset(mix('assets/backend/vendor/libs/typeahead-js/typeahead.js')) }}"></script>
<script src="{{ asset(mix('assets/backend/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/backend/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
