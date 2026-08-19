<footer class="footer_wrapper">

    <div class="footer_wrapper_top">
        <h2 class="title_40">We revolutionize businesses through innovative design.</h2>
        <hr class="line_ft">
        <div class="con_ft">
            <div>
                <ul>
                    <li class="title_24">Email:</li>
                    <li><a href="mailto:hello@intelliworkz.tech" aria-label="Email hello at intelliworkz">hello@intelliworkz.tech</a></li>
                </ul>
            </div>

            <div>
                <ul>
                    <li class="title_24">Toll Free:</li>
                    <li><a href="tel:+18008907123" aria-label="Call toll free number">1800 8907 123</a></li>
                </ul>
            </div>

            <div>
                <ul>
                    <li class="title_24">India:</li>
                    <li><a href="tel:+917600013134" aria-label="Call India number">+91 76000 13134</a></li>
                </ul>
            </div>

            <div>
                <ul>
                    <li class="title_24">USA:</li>
                    <li><a href="tel:+16149992286" aria-label="Call USA number">+1 614-999-2286</a></li>
                </ul>
            </div>

            <div>
                <ul>
                    <li class="title_24">Dubai:</li>
                    <li><a href="tel:+971566506550" aria-label="Call Dubai number">+971 56 650 6550</a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="footer_wrapper_bot">

            <div class="footer_wrapper_bot_lt">
                <!-- Logo -->
                <div class="logo_favicon_ft">
                    <img src="{{ asset('public/front/images/footer-fabe-icon.svg') }}" alt="logo-favicon">
                </div>

                <!-- Copyright -->
                <p class="copy_ft">
                    Copyright © <?php echo date('Y'); ?>
                    Intelliworkz Business Solutions Pvt. Ltd. All Rights Reserved.
                </p>
            </div>

            <div class="footer_wrapper_bot_rt">
                <!-- Products -->
                <div class="products_ft">
                   <p class="text-center"> <span>Our Products</span> <br></p>
                    <a href="https://www.datanote.in/" target="_blank"><img src="{{ asset('public/front/images/ourproducts1.svg') }}" alt="logo"></a>
                    <a href="https://tasknote.in/" target="_blank"><img src="{{ asset('public/front/images/ourproducts2.svg') }}" alt="logo"></a>
                    <a href="https://formezy.com/" target="_blank"><img src="{{ asset('public/front/images/ourproducts3.svg') }}" alt="logo"></a>
                </div>

                <!-- Contact -->
                <a href="{{ route('contact')}}" class="contact_btn_ft">
                    <p>Contact Us</p>
                    <span class="contact_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path
                                d="M19 11.3846V17.6154C19 17.9826 18.8541 18.3348 18.5945 18.5945C18.3348 18.8541 17.9826 19 17.6154 19H2.38462C2.01739 19 1.66521 18.8541 1.40554 18.5945C1.14588 18.3348 1 17.9826 1 17.6154V2.38462C1 2.01739 1.14588 1.66521 1.40554 1.40554C1.66521 1.14588 2.01739 1 2.38462 1H8.61538"
                                stroke="#C52030" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.1562 1H19.0024V5.84615" stroke="#C52030" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M18.9999 1L9.99988 10" stroke="#C52030" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
            </div>

        </div>
    </div>

</footer>

<!-- jquery MUST come first -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
<!-- Your custom script LAST -->
<!-- slick js  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
    integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('public/front/js/script.js') }}"></script>

@stack('scripts')

</body>

</html>