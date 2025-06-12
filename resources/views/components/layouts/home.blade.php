<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wphtml.com/html/tf/edumim/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Feb 2025 14:00:48 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Royal Educity</title>
    <link rel="icon" type="image/png" href="{{ asset('front/assets/images/logo/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/rt-plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/app.css') }}">

    <meta name="apple-mobile-web-app-status-bar" content="#364153">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#364153">
    <link rel="manifest" href="/manifest.json">

    <link rel="apple-touch-icon" href="/front/assets/images/logo/logo.png">
    <link rel="apple-touch-startup-image" href="/front/assets/images/logo/logo.png">
</head>

<body class=" font-gilroy font-medium text-gray text-lg leading-[27px]">


    <header class="site-header  header-normal top-0 bg-white z-[9] rt-sticky">
        <div class="main-header py-8">
            <div class="container">
                <div class=" flex items-center justify-between flex-wrap">
                    <a href="/" class="brand-logo flex-none lg:mr-10 md:w-auto max-w-[120px] ">
                        {{-- <img src="{{ asset('front/assets/images/logo/logo.svg') }}" alt=""> --}}
                        <h5 class="fw-bold fs-4"><b>Royal Educity</b></h5>
                    </a>
                    <div class="flex items-center flex-1">
                        <div class="flex-1 main-menu  lg:relative   xl:mr-[74px] mr-6">
                            <ul class="menu-active-classes">
                                <li class=" ">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="">
                                    <a href="{{ route('home.courses') }}">Courses</a>
                                </li>
                                <li>
                                    <a href="{{ route('home.contact') }}">Contacts</a>
                                </li>
                            </ul>
                            <div class="lg:block hidden">
                                <form action="{{ route('home.courses') }}" method="get">

                                    <div class="border border-gray rounded-md  h-[46px] modal-search">
                                        <input type="search" name="search"
                                            class=" block w-full rounded-md  h-full border-none ring-0 focus:outline-none  focus:ring-0"
                                            placeholder="Search..">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="flex-none flex space-x-[18px]">
                            <button type="button"
                                class=" md:w-[56px] md:h-[56px] h-10 w-10 rounded bg-[#F8F8F8] flex flex-col items-center justify-center modal-trigger">
                                <img src="{{ asset('front/assets/images/svg/search.svg') }}" alt=""></button>
                            <div class=" block   lg:hidden">
                                <button type="button"
                                    class=" text-3xl md:w-[56px] h-10 w-10 md:h-[56px] rounded bg-[#F8F8F8] flex flex-col items-center justify-center
                                                menu-click">
                                    <iconify-icon icon="cil:hamburger-menu" rotate="180deg"></iconify-icon>
                                </button>
                            </div>
                            <div class=" hidden lg:block">
                                @if (auth()->check())
                                    <a href="{{ route('dashboard') }}" class="btn btn-link">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary py-[15px] px-8 ">Login</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:hidden block mt-4">
                    <div class="border border-gray rounded-md  h-[46px] modal-search">
                        <input type="text"
                            class=" block w-full rounded-md  h-full border-none ring-0 focus:outline-none  focus:ring-0"
                            placeholder="Search..">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div
        class="openmobile-menu fixed top-0 h-screen pt-10 pb-6 bg-white shadow-box2 w-[320px] overflow-y-auto flex flex-col
        z-[999]">
        <div class="flex justify-between px-6 flex-none">
            <a href="index-2.html" class="brand-logo flex-none mr-10 ">
                <img src="{{ asset('front/assets/images/logo/logo.svg') }}" alt="">
            </a>
            <span class=" text-3xl text-black cursor-pointer rt-mobile-menu-close">
                <iconify-icon icon="fe:close"></iconify-icon>
            </span>
        </div>
        <div class="mobile-menu mt-6 flex-1 ">
            <ul class="menu-active-classes">
                <li class=" ">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="">
                    <a href="{{ route('home.courses') }}">Courses</a>
                </li>
                <li>
                    <a href="{{ route('home.contact') }}">Contacts</a>
                </li>
            </ul>
        </div>
        <div class=" flex-none pb-4">
            <div class="">
                @if (auth()->check())
                    <a href="{{ route('dashboard') }}" class="btn btn-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary py-[15px] px-8 ">Login</a>
                @endif
            </div>
            <div class=" text-center text-black font-semibold mb-2">Follow Us</div>
            <ul class="flex space-x-4 justify-center ">
                <li>
                    <a href="#" class="flex h-10 w-10">
                        <img src="{{ asset('front/assets/images/icon/fb.svg') }}" alt="">
                    </a>
                </li>
                <li>
                    <a href="#" class="flex h-10 w-10">
                        <img src="{{ asset('front/assets/images/icon/ins.svg') }}" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>


    {{ $slot }}


    <footer
        class="bg-black bg-[url({{ asset('front/assets/images/all-img/footer-bg-1.html') }})] bg-cover bg-center bg-no-repeat">
        <div class="section-padding container">
            <div class="grid grid-cols-1 gap-7 md:grid-cols-2 lg:grid-cols-3">
                <div class="">
                    <div class="">
                        <a href="#" class="mb-10 block">
                            <img src="{{ asset('front/assets/images/logo/logo.png') }}" class="w-[46px] h-[46px] "
                                alt="">
                        </a>
                        <p style="text-align: justify !important;">
                            Royal Educity is your premier online education platform dedicated to providing
                            world-class learning experiences. We connect ambitious learners with expert instructors
                            globally, offering a wide range of courses accessible anytime, anywhere.
                        </p>
                        <ul class="flex space-x-4 pt-8">
                            <li>
                                <a href="#"
                                    class="flex h-12 w-12 flex-col items-center justify-center rounded bg-white bg-opacity-[0.08] text-2xl text-white
                  transition hover:bg-primary hover:text-white">
                                    <iconify-icon icon="bxl:facebook"></iconify-icon>
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="flex h-12 w-12 flex-col items-center justify-center rounded bg-white bg-opacity-[0.08] text-2xl text-white
                  transition hover:bg-primary hover:text-white">
                                    <iconify-icon icon="bxl:instagram"></iconify-icon>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class="mx-auto lg:text-center ps-6 lg:ps-0">
                            <h4 class="mb-8 text-2xl font-bold text-white">Links</h4>
                            <ul class="list-item space-y-5">
                                <li>
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('home.courses') }}">Courses</a>
                                </li>
                                <li>
                                    <a href="{{ route('home.contact') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h4 class="mb-8 text-2xl font-bold text-white">Contact Info</h4>
                    <div class="mb-8">
                        Get in touch with us
                    </div>
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-white">Location</h4>
                        <p class="mb-2 text-gray-200 text-xs">Suite C20 & C11 woji estate shopping plaza by alcon road,
                            Woji Port Harcourt, Rivers State.</p>
                        <h4 class="text-lg font-semibold text-white">Call Us</h4>
                        <p class="mb-2 text-gray-200 text-xs">+234 818 2891 846, +234 904 3815 475</p>
                        <h4 class="text-lg font-semibold text-white">Email</h4>
                        <p class="mb-2 text-gray-200 text-xs">support@royalsolutions.com.ng</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container border-t border-white border-opacity-[0.1] py-8 text-center text-base">
            &copy; Copyright @php echo date("Y"); @endphp | Royal Educity | All Rights Reserved
        </div>
    </footer>

    <div class="rt-mobile-menu-overlay"></div>
    <!-- scripts -->
    
    <script src="{{ asset('build/assets/app-ACD0L-kl.js') }}"></script>
    <script src="{{ asset('front/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/rt-plugins.js') }}"></script>
    <script src="{{ asset('front/assets/js/app.js') }}"></script>

    <script src="https://unpkg.com/phosphor-icons"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0/iconify-icon.min.js"></script>
</body>

<!-- Mirrored from wphtml.com/html/tf/edumim/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Feb 2025 14:01:21 GMT -->

</html>
