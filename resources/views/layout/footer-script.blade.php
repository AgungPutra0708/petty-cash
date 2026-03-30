<!-- Jquery JS-->
<script src="{{ asset('assets/vendor/jquery-3.2.1.min.js') }}"></script>
<!-- DataTables core -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- (Optional) DataTables Bootstrap -->
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<!-- Bootstrap JS-->
<script src="{{ asset('assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
<!-- Vendor JS       -->
<script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/vendor/counter-up/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>

<!-- Main JS-->
<script src="{{ asset('assets/js/main.js') }}"></script>

@stack('scripts')

<script>
    $(document).ready(function() {
        $('#logoutButton').on('click', function (e) {
            console.log('clicked');
            
            $('#logoutModal').modal('show');
        });
        $('#logoutButtonMobile').on('click', function (e) {
            console.log('clicked');
            
            $('#logoutModal').modal('show');
        });
    });

    $(document).on('submit', 'form', function () {

        var $form = $(this);

        if ($form.hasClass('submitted')) {
            return false;
        }

        $form.addClass('submitted');

        $form.find('button[type=submit], input[type=submit]')
            .prop('disabled', true)
            .html('<i class="fa fa-spinner fa-spin"></i> Processing...');

    });
</script>