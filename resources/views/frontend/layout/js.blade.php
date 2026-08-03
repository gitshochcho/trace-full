
<script src="{{asset('frontend/js/bootstrap.min.js')}}" defer></script>

    <!-- Scripts -->
    <script src="{{asset('frontend/js/purecounter.min.js')}}" defer></script>

    <script src="{{asset('frontend/js/swiper.min.js')}}" defer></script>
    <script src="{{asset('frontend/js/aos.js')}}" defer></script><!-- AOS on Animation Scroll -->
    @php $scriptAsset = file_exists(public_path('frontend/js/script.min.js')) ? 'frontend/js/script.min.js' : 'frontend/js/script.js'; @endphp
    <script src="{{asset($scriptAsset)}}" defer></script>  <!-- Custom scripts -->

