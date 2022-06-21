<!-- Footer -->
<footer class="footer text-center">
    <div class="content">
        <p>تــــــــــــــــابع كاب | Follow Caberz</p>
        <p>على وسائل التواصل الاجتماعي</p>

        <ul class="socials">
            <li>
                <a href="{{ setting('youtube') }}">
                    <img src="{{ asset('landingAssets') }}/assets/social_1.png">
                </a>
            </li>
            <li>
                <a href="{{ setting('instagram') }}">
                    <img src="{{ asset('landingAssets') }}/assets/social_2.png">
                </a>
            </li>
            <li>
                <a href="{{ setting('twitter') }}">
                    <img src="{{ asset('landingAssets') }}/assets/social_3.png">
                </a>
            </li>
            <li>
                <a href="{{ setting('tiktok') }}">
                    <img src="{{ asset('landingAssets') }}/assets/social_4.png">
                </a>
            </li>
            <li>
                <a href="{{ setting('snapchat') }}">
                    <img src="{{ asset('landingAssets') }}/assets/social_5.png">
                </a>
            </li>
        </ul>

        <div class="logo">
            <p>{!! trans('land.footer.copyright') !!} &copy; </p>
            <img src="{{ asset('landingAssets') }}/assets/logo.png">
        </div>
    </div>
</footer>
