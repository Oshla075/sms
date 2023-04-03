<script src="{{ url('/') }}/assets/js/oneui.app.min.js"></script>


@yield('custom-js-code')


<!-- jQuery (required for Select2 + jQuery Validation plugins) -->
<script src="{{ url('/') }}/assets/js/lib/jquery.min.js"></script>
<!-- Page JS Plugins -->
<script src="{{ url('/') }}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ url('/') }}/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/') }}/assets/js/plugins/jquery-validation/additional-methods.js"></script>
<!-- Page JS Helpers (Select2 plugin) -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('/') }}/assets/js/sweetalert_2.js"></script>
<script>One.helpersOnLoad(['js-flatpickr', 'jq-datepicker', 'jq-maxlength', 'jq-select2', 'jq-masked-inputs', 'jq-rangeslider']);</script>
{{-- <script>One.helpersOnLoad(['jq-select2']);</script> --}}
<!-- Page JS Code -->
<script src="{{ url('/') }}/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/datatables-buttons/buttons.print.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/datatables-buttons/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/flatpickr/flatpickr.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="{{ url('/') }}/assets/js/plugins/dropzone/min/dropzone.min.js"></script>
    <!-- Page JS Code -->
    <script src="{{ url('/') }}/assets/js/pages/be_tables_datatables.min.js"></script>
<script src="{{ url('/') }}/assets/js/pages/be_forms_validation.min.js"></script>
<script>
      function limitKeypress(event, value, maxLength) {
        if (value != undefined && value.toString().length >= maxLength) {
        event.preventDefault();
        }
        }
</script>


