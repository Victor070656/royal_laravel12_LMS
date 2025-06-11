<x-layouts.home>
    <div class="breadcrumbs section-padding bg-[url('../images/all-img/bred.html')] bg-cover bg-center bg-no-repeat">
        <div class="container text-center">
            <h2>Contact Us</h2>
            <nav>
                <ol class="flex items-center justify-center space-x-3">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home </a></li>
                    <li class="breadcrumb-item">-</li>
                    <li class="text-primary">Contact</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="nav-tab-wrapper tabs  section-padding">
        <div class="container">
            <div class=" grid grid-cols-12 gap-[30px]">
                <div class="xl:col-span-5 lg:col-span-6 col-span-12 ">
                    <div class="mini-title">Contact Us</div>
                    <h4 class="column-title ">
                        Get In Touch
                        <span class="shape-bg">
                            Today</span>
                    </h4>
                    <div>
                        Send us a message for more information
                    </div>
                    <ul class=" list-item space-y-6 pt-8">
                        <li class="flex">
                            <div class="flex-none mr-6">
                                <div class="">
                                    <img src="{{ asset('front/assets/images/svg/mail.svg') }}" alt=""
                                        class="">
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class=" lg:text-xl text-lg mb-1">Email-Us :</h4>
                                <div><a href="mailto:support@royalsolutions.com.ng" 
                                        >support@royalsolutions.com.ng</a>
                                </div>
                            </div>
                        </li>
                        <li class="flex">
                            <div class="flex-none mr-6">
                                <div class="">
                                    <img src="{{asset('front/assets/images/svg/call.svg')}}" alt="" class="">
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class=" lg:text-xl text-lg mb-1">Call Us:</h4>
                                <div>+234 818 2891 846, +234 904 3815 475</div>
                            </div>
                        </li>
                        <li class="flex">
                            <div class="flex-none mr-6">
                                <div class="">
                                    <img src="{{ asset('front/assets/images/svg/map.svg') }}" alt="" class="">
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="lg:text-xl text-lg mb-1">Office :</h4>
                                <div>Suite C20 & C11 woji estate shopping plaza by alcon road,
                            Woji Port Harcourt, Rivers State Nigeria.</div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="xl:col-span-7 lg:col-span-6 col-span-12">
                    <div class="bg-white shadow-box7 p-8 rounded-md">
                        <form class="form" method="post" action="https://formsubmit.co/support@royalsolutions.com.ng"
                            >
                            <div class=" md:grid-cols-2 grid grid-cols-1 gap-[30px] mt-6 ">
                                <div>
                                    <input type="text" name="name" class=" from-control" placeholder="Name*" required>
                                </div>
                                <div>
                                    <input type="email" name="email" class=" from-control" placeholder="Email*" required>
                                </div>
                                <div class="md:col-span-2 col-span-1">
                                    <input type="text" name="subject" class=" from-control" placeholder="Subject *" required>
                                </div>
                                
                                <div class="md:col-span-2 col-span-1">
                                    <textarea class=" from-control" name="message" placeholder="Your Message*" required rows="5"></textarea>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-[30px]" type="submit" name="submit">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.home>
