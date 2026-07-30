<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="nofollow, noindex"/>
    <title>IW Portfolio</title>
    <link rel="icon" type="image/x-icon" href="https://intelliworkz.tech/images/Intelliworks_fav.png">
    <!-- bootstrap css cdn -->
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- bootstrap -->
    <!-- poppins font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- poppins font -->
    <!-- slick slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- slick slider -->
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('public/front/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/css/projectdetail.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/css/contact.css') }}">

    <link rel="stylesheet" href="{{ asset('public/front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/css/responsive.css') }}">

     @stack('styles')
</head>

<body>

    <header>
        <div class="container">
            <div class="header_wrapper">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('public/front/images/iw_logo.svg') }}" alt="intelliworkz">
                    </a>
                </div>
                <div class="portfolio-text">
                    <p class="title_30 mb-0"><span class="title-highlight">Our </span> <span>Portfolio</span></p>
                </div>
                <a href="{{ route('contact') }}" class="head_btn" alt="Start a Project">
                    <span class="btn-text">Start a Project</span>
                    <span class="btn-icon"><svg width="18" height="18" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.75 11.1346V17.3654C18.75 17.7326 18.6041 18.0848 18.3445 18.3445C18.0848 18.6041 17.7326 18.75 17.3654 18.75H2.13462C1.76739 18.75 1.41521 18.6041 1.15554 18.3445C0.895879 18.0848 0.75 17.7326 0.75 17.3654V2.13462C0.75 1.76739 0.895879 1.41521 1.15554 1.15554C1.41521 0.895879 1.76739 0.75 2.13462 0.75H8.36538"
                                stroke="#0A101C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.9039 0.750034H18.7501V5.59619" stroke="#0A101C" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M18.7499 0.750034L9.74988 9.75003" stroke="#0A101C" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>

                <button class="hamburger" aria-label="Menu" data-bs-toggle="offcanvas" data-bs-target="#mobileOffcanvas"
                    aria-controls="mobileOffcanvas">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
        <!-- Mobile offcanvas menu -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileOffcanvas" aria-labelledby="mobileOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="mobileOffcanvasLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <nav>
                    <ul class="mobile-menu list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="projectlisting.php">Projects</a></li>
                        <li><a href="projectdetail.php">Project Detail</a></li>
                        <li><a href="metal.php">Metal</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
