<script>
    var hostUrl = "assets/";
    // var $eui = $.noConflict(true);
</script>
<script src="{{ asset('ww.css/css.admin/dist/js/jquery-3.6.1.min.js') }}"></script>
{{-- <script src="{{ asset('ww.css/css.admin/assets/plugins/custom/jquery/jquery.min.js') }}"></script> --}}
<script src="{{ asset('ww.css/css.admin/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('ww.css/css.admin/assets/js/scripts.bundle.js') }}"></script>
{{-- <script src="{{ asset('ww.css/css.admin/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script> --}}
<script src="{{ asset('ww.css/css.admin/assets/plugins/custom/jquery/jquery.easyui.min.js') }}"></script>
<script src="{{ asset('ww.css/css.admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script
    src="{{ asset('ww.css/css.admin/assets/plugins/global/datetimepicker/bootstrap4/js/bootstrap-datetimepicker.js') }}">
</script>

<script src="{{ asset('ww.css/css.admin/assets/js/datatables-serverside.min.js') }}"></script>
<script src="{{ asset('ww.css/css.admin/assets/plugins/global/formjs/formToJson.min.js') }}"></script>
<script src="{{ asset('ww.css/css.admin/assets/plugins/global/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset('ww.css/css.admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

<script src="{{ asset('ww.css/css.admin/assets/plugins/custom/pdf-view/pdf.min.js') }}"></script>
<script src="{{ asset('ww.css/css.admin/dist/js/preloader.js') }}"></script>
<script src="{{ asset('ww.css/css.admin/dist/js/jquery-config.min.js') }}"></script>
<script src="{{ asset('ww.css/css.admin/dist/js/jquery-attr-num.min.js') }}"></script>
<script src="{{ asset('ww.css/css.admin/dist/js/jquery.capitalize.js') }}"></script>

<script>
    $('.menu-title').capitalize();
    $('.slugs').capitalize();
    window.onbeforeunload = function() {
        window.scrollTo(0, 0);
    };
</script>
