<script src="{{ asset('assets/frontend') }}/js/jquery.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery-migrate-3.0.1.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/popper.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.easing.1.3.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.waypoints.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.stellar.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/aos.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.animateNumber.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/bootstrap-datepicker.js"></script>
{{-- <script src="{{ asset('assets/frontend') }}/js/jquery.timepicker.min.js"></script> --}}
<script src="{{ asset('assets/frontend') }}/js/scrollax.min.js"></script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> --}}
{{-- <script src="{{ asset('assets/frontend') }}/js/google-map.js"></script> --}}
<script src="{{ asset('assets/frontend') }}/js/main.js"></script>
@stack('scripts')
<script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
@if (session('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            timer: 1500
        })
    </script>
@elseif(session('error'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: true,
            timer: 1500
        })
    </script>
@endif
