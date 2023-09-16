{{-- Style Footer --}}
<link rel="stylesheet" href="{{ url('css&js/footerStyle.css') }}">
{{-- End Style Footer --}}

<footer class="position-relative mt-5">
    @isset($computers)
        <div style="top: -27px !important;" class="mt-2 position-absolute top-0 start-50 translate-middle">
            {{ $computers->links() }}
        </div>
    @endisset

    <div class="footer-content">
        <h3>Skaydi</h3>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo iste corrupti doloribus odio sed!</p>
        <ul class="socials">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
        </ul>
    </div>
    <div class="footer-bottom">
        <p>copyright &copy;2023 SkaydiX.</p>
    </div>
</footer>
