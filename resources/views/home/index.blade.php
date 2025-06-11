<x-layouts.home>
    <section
        class=" xl:min-h-screen bg-[url('{{ asset('front/assets/images/banner/3.png') }}')]  bg-no-repeat bg-center overflow-hidden">
        <div class="container relative">
            <div class="xl:max-w-[570px] lg:max-w-[770px] xl:py-[174px] lg:py-28 md:py-20 py-14">
                <h1>
                    Classical
                    <span
                        class=" text-secondary inline-block bg-[url('{{ asset('front/assets/images/banner/shape.svg') }}')]  bg-no-repeat bg-bottom">
                        Education</span>
                    For The Future
                </h1>
                <div class=" plain-text text-gray leading-[30px] mt-8 mb-14">
                    Take our courses taught by industry experts, apply your skills in real world projects, and develop a
                    portfolio designed to enhance your professional goals, whether you're just starting out or scaling
                    new heights.
                </div>
                <div class="md:flex  md:space-x-4 space-y-3 md:space-y-0">
                    <a href="{{ route('home.courses') }}" class="btn btn-primary">Get Started Today &rarr;</a>
                </div>
            </div>
            <div class="imge-box absolute right-[-60px] top-1/2  -translate-y-1/2 hidden xl:block   ">
                <img src="{{ asset('front/assets/images/banner/man3.png') }}" alt="">
            </div>
        </div>
    </section>
    <!-- bradns section start -->
    {{-- <iframe src="https://drive.google.com/file/d/1vv7Qxvx1CA8nAGyB_NzOZvzCT7zr_eKc/preview" frameborder="0"
        class="w-full aspect-video"></iframe> --}}
    <div class="brands-area pt-20 pb-14 bg-black ">
        <div class="container">

            <ul class="flex flex-wrap items-center lg:justify-between justify-center  ">

                <li class=" mb-6 last:mb-0 mr-6 last:mr-0  transition duration-150  ">
                    <a href="#" class=" block">
                        <img src="{{ asset('front/assets/images/all-img/brands/b1.svg') }}" alt=""></a>
                </li>

                <li class=" mb-6 last:mb-0 mr-6 last:mr-0  transition duration-150  ">
                    <a href="#" class=" block">
                        <img src="{{ asset('front/assets/images/all-img/brands/b2.svg') }}" alt=""></a>
                </li>

                <li class=" mb-6 last:mb-0 mr-6 last:mr-0  transition duration-150  ">
                    <a href="#" class=" block">
                        <img src="{{ asset('front/assets/images/all-img/brands/b3.svg') }}" alt=""></a>
                </li>

                <li class=" mb-6 last:mb-0 mr-6 last:mr-0  transition duration-150  ">
                    <a href="#" class=" block">
                        <img src="{{ asset('front/assets/images/all-img/brands/b4.svg') }}" alt=""></a>
                </li>

                <li class=" mb-6 last:mb-0 mr-6 last:mr-0  transition duration-150  ">
                    <a href="#" class=" block">
                        <img src="{{ asset('front/assets/images/all-img/brands/b5.svg') }}" alt=""></a>
                </li>

            </ul>
        </div>
    </div>
    <!-- about area start -->
    <div class="about-area  section-padding-top pb-16 relative z-[1]">
        <div class=" absolute right-[7%] top-[20%] z-[-1] hidden xl:block"><img src="assets/images/icon/h.svg"
                alt="">
        </div>
        <div class="container">
            <div class="grid grid-cols-12 xl:gap-[70px] lg:gap-10 gap-6">
                <div class="xl:col-span-6 lg:col-span-6 col-span-12">
                    <img src="{{ asset('front/assets/images/all-img/about5.png') }}" alt="" />
                </div>
                <div class="xl:col-span-6 lg:col-span-6 col-span-12 ">
                    <div class="mini-title">About Royal Educity</div>
                    <h4 class="column-title ">
                        You Can Learn Anything, Anytime From
                        <span class="shape-bg">
                            Anywhere</span>
                    </h4>
                    <div>
                        Royal Educity offers accessible, high-quality online education to anyone, anywhere, connecting
                        learners with expert instructors globally.
                    </div>
                    <ul class=" list-item space-y-6 pt-8">
                        <li class="flex">
                            <div class="flex-none mr-6">
                                <div
                                    class="h-20 w-20 rounded-full bg-white  shadow-box10 flex flex-col justify-center items-center">
                                    <img src="{{ asset('front/assets/images/icon/video.svg') }}" alt=""
                                        class="" />
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class=" text-xl mb-1">All Classes Video Provided</h4>
                                <div>
                                    Royal Educity provides 24/7 access to high-definition video lessons for all courses,
                                    allowing learners to control their pace, review content, and even download lessons
                                    for offline viewing.
                                </div>
                            </div>
                        </li>
                        <li class="flex">
                            <div class="flex-none mr-6">
                                <div
                                    class="h-20 w-20 rounded-full bg-white  shadow-box10 flex flex-col justify-center items-center">
                                    <img src="{{ asset('front/assets/images/icon/web-white.svg') }}" alt=""
                                        class=" " />
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class=" text-xl mb-1">Online Class From Expert Teachers</h4>
                                <div>
                                    Royal Educity ensures top-tier education by featuring lessons directly from industry
                                    professionals and certified educators who are passionate about sharing their
                                    real-world expertise.
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- course section start -->
    <div
        class=" section-padding bg-[url('{{ asset('front/assets/images/all-img/section-bg-11.png') }}')] bg-cover bg-no-repeat">
        <div class="container">
            <div class="flex items-center flex-wrap flex-y-4">
                <div class="flex-1">
                    <div class="mini-title">Popular Courses</div>
                    <div class="column-title ">
                        Choose From Our Recent
                        <span class="shape-bg">Courses</span>
                    </div>
                </div>
                <div class="flex-none">

                </div>
            </div>
            <div class="flex flex-wrap pt-10 grids justify-center">

                @forelse ($courses as $course)
                    {{-- @dd() --}}
                    @php
                        $lessons = 0;
                        $sections = $course->sections;
                        if (isset($course->sections)) {
                            foreach ($sections as $section) {
                                $lessons += $section->courseContent->count();
                            }
                        }

                        $rating = 0;
                        $count_review = 0;
                        if (isset($course->reviews)) {
                            $count_review = $course->reviews->count();
                        }
                        if ($count_review > 0) {
                            foreach ($course->reviews as $review) {
                                $rating += $review->rating;
                            }
                            $rating = $rating / $count_review;
                        } else {
                            $rating = 0;
                        }
                        $rating = number_format($rating, 1);

                        $category = \App\Models\Category::where('id', '=', $course->category_id)->get();
                    @endphp
                    <div class="cat-2 cat-3 grid-item xl:w-1/3 lg:w-1/2 w-full px-[15px] mb-[15px]">
                        <a class=" bg-white shadow-box2 rounded-[8px] transition duration-100 hover:shadow-sm block   mb-5 "
                            href="{{ route('home.course.details', $course) }}">
                            <div class="course-thumb h-[248px] rounded-t-[8px]  relative">
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt=""
                                    class=" w-full h-full object-cover rounded-t-[8px]">
                                <span
                                    class="bg-secondary py-1 px-3 text-lg font-semibold rounded text-white absolute left-6 top-6">{{ $category->first()->category_name }}</span>
                            </div>
                            <div class="course-content p-8">
                                <div class="text-secondary font-bold text-2xl mb-3">
                                    ₦{{ number_format($course->price) }}</div>
                                <h4 class=" text-xl mb-3 font-bold">
                                    {{ $course->course_name }}
                                </h4>
                                <div class="flex justify-between  space-x-3">
                                    <span class=" flex items-center space-x-2">
                                        <img src="{{ asset('front/assets/images/svg/file.svg') }}" alt="">
                                        <span>{{ $lessons }} Lessons</span>
                                    </span>
                                    <span class=" flex items-center space-x-2">
                                        <img src="{{ asset('front/assets/images/svg/clock.svg') }}" alt="">
                                        <span>{{ $course->duration }}</span>
                                    </span>
                                    <span class=" flex items-center space-x-2">
                                        <img src="{{ asset('front/assets/images/svg/star.svg') }}" alt="">
                                        <span>{{ $rating }}</span>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="py-6 text-center">No courses found</p>
                @endforelse

            </div>
            <div class="text-center lg:pt-16 pt-10">
                <a href="{{ route('home.courses') }}" class=" btn btn-primary">View All Courses</a>
            </div>
        </div>
    </div>


    <!-- Team start -->
    {{-- <div class=" section-padding">
        <div class="container">
            <div class="text-center">
                <div class="mini-title">Team Member</div>
                <div class="column-title ">
                    Our Expert
                    <span class="shape-bg">Instructors</span>
                </div>
            </div>
            <div class="grid xl:grid-cols-4 lg:grid-cols-3  md:grid-cols-2 grid-cols-1 gap-7 pt-10">


                <div
                    class=" bg-white shadow-box3 rounded-md transition-all duration-100 text-center hover:shadow-box4   ">
                    <div class=" h-[270px] rounded-t-md  relative mx-auto  overflow-hidden">
                        <img src="{{ asset('front/assets/images/all-img/team5.png') }}" alt=""
                            class=" w-full h-full object-cover rounded-t-md ">
                        <div class=" absolute left-0 top-0 w-full h-full flex flex-col justify-end items-end">
                            <button type="button"
                                class="h-12 w-12 bg-secondary text-white rounded-tl-md flex flex-col items-center justify-center explore-button">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.01" width="18" height="18" fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.25C9.62132 2.25 10.125 2.75368 10.125 3.375V7.875H14.625C15.2463 7.875 15.75 8.37868 15.75 9C15.75 9.62132
                                    15.2463 10.125 14.625 10.125H10.125V14.625C10.125 15.2463 9.62132 15.75 9 15.75C8.37868 15.75 7.875 15.2463 7.875
                                    14.625V10.125H3.375C2.75368 10.125 2.25 9.62132 2.25 9C2.25 8.37868 2.75368 7.875 3.375 7.875H7.875V3.375C7.875 2.75368
                                    8.37868 2.25 9 2.25Z" fill="white" />
                                </svg>
                            </button>
                            <ul
                                class=" justify-center bg-primary rounded-tl-md transition-all duration-100 social-explore ">
                                <li>
                                    <a href="#"
                                        class=" text-xl leading-[1] text-white  flex h-12 w-12 items-center justify-center">
                                        <iconify-icon icon="bxl:facebook"></iconify-icon>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class=" text-xl leading-[1] text-white flex h-12 w-12 items-center justify-center">
                                        <iconify-icon icon="bxl:twitter"></iconify-icon>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="  text-xl leading-[1]  flex h-12 w-12 items-center justify-center text-white ">
                                        <iconify-icon icon="bxl:linkedin"></iconify-icon>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="course-content p-6">
                        <h4 class=" lg:text-2xl text-1xl mb-1 font-bold">Erics Widget</h4>
                        <div>UI/UX Designer</div>
                    </div>
                </div>

                <div
                    class=" bg-white shadow-box3 rounded-md transition-all duration-100 text-center hover:shadow-box4   ">
                    <div class=" h-[270px] rounded-t-md  relative mx-auto  overflow-hidden">
                        <img src="{{ asset('front/assets/images/all-img/team6.png') }}" alt=""
                            class=" w-full h-full object-cover rounded-t-md ">
                        <div class=" absolute left-0 top-0 w-full h-full flex flex-col justify-end items-end">
                            <button type="button"
                                class="h-12 w-12 bg-secondary text-white rounded-tl-md flex flex-col items-center justify-center explore-button">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.01" width="18" height="18" fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.25C9.62132 2.25 10.125 2.75368 10.125 3.375V7.875H14.625C15.2463 7.875 15.75 8.37868 15.75 9C15.75 9.62132
                                    15.2463 10.125 14.625 10.125H10.125V14.625C10.125 15.2463 9.62132 15.75 9 15.75C8.37868 15.75 7.875 15.2463 7.875
                                    14.625V10.125H3.375C2.75368 10.125 2.25 9.62132 2.25 9C2.25 8.37868 2.75368 7.875 3.375 7.875H7.875V3.375C7.875 2.75368
                                    8.37868 2.25 9 2.25Z" fill="white" />
                                </svg>
                            </button>
                            <ul
                                class=" justify-center bg-primary rounded-tl-md transition-all duration-100 social-explore ">
                                <li>
                                    <a href="#"
                                        class=" text-xl leading-[1] text-white  flex h-12 w-12 items-center justify-center">
                                        <iconify-icon icon="bxl:facebook"></iconify-icon>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class=" text-xl leading-[1] text-white flex h-12 w-12 items-center justify-center">
                                        <iconify-icon icon="bxl:twitter"></iconify-icon>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="  text-xl leading-[1]  flex h-12 w-12 items-center justify-center text-white ">
                                        <iconify-icon icon="bxl:linkedin"></iconify-icon>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="course-content p-6">
                        <h4 class=" lg:text-2xl text-1xl mb-1 font-bold">Daniel Steven</h4>
                        <div>UI/UX Designer</div>
                    </div>
                </div>

                <div
                    class=" bg-white shadow-box3 rounded-md transition-all duration-100 text-center hover:shadow-box4   ">
                    <div class=" h-[270px] rounded-t-md  relative mx-auto  overflow-hidden">
                        <img src="{{ asset('front/assets/images/all-img/team7.png') }}" alt=""
                            class=" w-full h-full object-cover rounded-t-md ">
                        <div class=" absolute left-0 top-0 w-full h-full flex flex-col justify-end items-end">
                            <button type="button"
                                class="h-12 w-12 bg-secondary text-white rounded-tl-md flex flex-col items-center justify-center explore-button">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.01" width="18" height="18" fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.25C9.62132 2.25 10.125 2.75368 10.125 3.375V7.875H14.625C15.2463 7.875 15.75 8.37868 15.75 9C15.75 9.62132
                                    15.2463 10.125 14.625 10.125H10.125V14.625C10.125 15.2463 9.62132 15.75 9 15.75C8.37868 15.75 7.875 15.2463 7.875
                                    14.625V10.125H3.375C2.75368 10.125 2.25 9.62132 2.25 9C2.25 8.37868 2.75368 7.875 3.375 7.875H7.875V3.375C7.875 2.75368
                                    8.37868 2.25 9 2.25Z" fill="white" />
                                </svg>
                            </button>
                            <ul
                                class=" justify-center bg-primary rounded-tl-md transition-all duration-100 social-explore ">
                                <li>
                                    <a href="#"
                                        class=" text-xl leading-[1] text-white  flex h-12 w-12 items-center justify-center">
                                        <iconify-icon icon="bxl:facebook"></iconify-icon>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class=" text-xl leading-[1] text-white flex h-12 w-12 items-center justify-center">
                                        <iconify-icon icon="bxl:twitter"></iconify-icon>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="  text-xl leading-[1]  flex h-12 w-12 items-center justify-center text-white ">
                                        <iconify-icon icon="bxl:linkedin"></iconify-icon>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="course-content p-6">
                        <h4 class=" lg:text-2xl text-1xl mb-1 font-bold">Nelson Decosta</h4>
                        <div>UI/UX Designer</div>
                    </div>
                </div>

                <div
                    class=" bg-white shadow-box3 rounded-md transition-all duration-100 text-center hover:shadow-box4   ">
                    <div class=" h-[270px] rounded-t-md  relative mx-auto  overflow-hidden">
                        <img src="{{ asset('front/assets/images/all-img/team8.png') }}" alt=""
                            class=" w-full h-full object-cover rounded-t-md ">
                        <div class=" absolute left-0 top-0 w-full h-full flex flex-col justify-end items-end">
                            <button type="button"
                                class="h-12 w-12 bg-secondary text-white rounded-tl-md flex flex-col items-center justify-center explore-button">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.01" width="18" height="18" fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.25C9.62132 2.25 10.125 2.75368 10.125 3.375V7.875H14.625C15.2463 7.875 15.75 8.37868 15.75 9C15.75 9.62132
                                    15.2463 10.125 14.625 10.125H10.125V14.625C10.125 15.2463 9.62132 15.75 9 15.75C8.37868 15.75 7.875 15.2463 7.875
                                    14.625V10.125H3.375C2.75368 10.125 2.25 9.62132 2.25 9C2.25 8.37868 2.75368 7.875 3.375 7.875H7.875V3.375C7.875 2.75368
                                    8.37868 2.25 9 2.25Z" fill="white" />
                                </svg>
                            </button>
                            <ul
                                class=" justify-center bg-primary rounded-tl-md transition-all duration-100 social-explore ">
                                <li>
                                    <a href="#"
                                        class=" text-xl leading-[1] text-white  flex h-12 w-12 items-center justify-center">
                                        <iconify-icon icon="bxl:facebook"></iconify-icon>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class=" text-xl leading-[1] text-white flex h-12 w-12 items-center justify-center">
                                        <iconify-icon icon="bxl:twitter"></iconify-icon>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="  text-xl leading-[1]  flex h-12 w-12 items-center justify-center text-white ">
                                        <iconify-icon icon="bxl:linkedin"></iconify-icon>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="course-content p-6">
                        <h4 class=" lg:text-2xl text-1xl mb-1 font-bold">Selina Gomez</h4>
                        <div>UI/UX Designer</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- testtimonal start -->
    <div class=" section-padding bg-[url('../images/all-img/section-bg-12.html')]  bg-no-repeat bg-cover">
        <div class="container">
            <div class="grid  lg:grid-cols-2 grid-cols-1  xl:gap-[60px] gap-6">
                <div>
                    <div class="slider-nav">
                        <div class="single-item">
                            <div class="xl:h-[593px] lg:h-[400px] h-[150px] lg:w-full w-[150px] rounded-md">
                                <img src="{{ asset('front/assets/images/all-img/t1.png') }}" alt=""
                                    class=" object-cover w-full h-full rounded-md" />
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="xl:h-[593px] lg:h-[400px] h-[150px] lg:w-full w-[150px]  rounded-md">
                                <img src="{{ asset('front/assets/images/all-img/t1.png') }}" alt=""
                                    class=" object-cover w-full h-full rounded-md" />
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="xl:h-[593px] lg:h-[400px] h-[150px] lg:w-full w-[150px]  rounded-md">
                                <img src="{{ asset('front/assets/images/all-img/t1.png') }}" alt=""
                                    class=" object-cover w-full h-full rounded-md" />
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mini-title">Testimonial</div>
                    <h4 class="column-title ">
                        Our Tallented Students Valuable
                        <span class="shape-bg text-black">
                            Feedback</span>
                    </h4>
                    <div class="slider-for mt-10">
                        <div class="single-item">
                            <div>
                                <h3 class=" text-2xl font-bold text-black mb-8">“It’s Truly The Best Solution For Me”
                                </h3>
                                <div class="mb-8">
                                    There are many variations of passages of Lorem Ipsum available, but the majority
                                    have suffered. There are many
                                    variations of passages of Lorem Ipsum available, but the majority have suffered
                                    alteration.
                                </div>
                                <div>
                                    <span class=" block  font-semibold text-black mb-1">Alfred Helmerich</span>
                                    <span class=" block  font-semibold text-primary">Executive Training Manager</span>
                                </div>
                            </div>
                        </div>
                        <div class="single-item">
                            <div>
                                <h3 class=" text-2xl font-bold text-black mb-8">“It’s Truly The Best Solution For Me”
                                </h3>
                                <div class="mb-8">
                                    There are many variations of passages of Lorem Ipsum available,
                                </div>
                                <div>
                                    <span class=" block  font-semibold text-black mb-1">Alfred Helmerich</span>
                                    <span class=" block  font-semibold text-primary">Executive Training Manager</span>
                                </div>
                            </div>
                        </div>
                        <div class="single-item">
                            <div>
                                <h3 class=" text-2xl font-bold text-black mb-8">“It’s Truly The Best Solution For Me”
                                </h3>
                                <div class="mb-8">
                                    There are many variations of passages of Lorem Ipsum available, but the majority
                                    have suffered.
                                </div>
                                <div>
                                    <span class=" block  font-semibold text-black mb-1">Alfred Helmerich</span>
                                    <span class=" block  font-semibold text-primary">Executive Training Manager</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-x-5 flex lg:mt-10 mt-8">
                        <button
                            class="lg:h-[64px] lg:w-[64px] h-12 w-12 flex flex-col items-center justify-center rounded-md bg-white hover:bg-primary
                    hover:text-white shadow-box slickprev text-3xl text-primary">
                            <iconify-icon icon="heroicons:arrow-left-20-solid"></iconify-icon>
                        </button>
                        <button
                            class="lg:h-[64px] lg:w-[64px] h-12 w-12 flex flex-col items-center justify-center rounded-md bg-white hover:bg-primary
                    hover:text-white shadow-box slickprev text-3xl text-primary">
                            <iconify-icon icon="heroicons:arrow-right-20-solid"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- accrodain start -->
    <div
        class="section-padding  bg-white bg-[url('../images/all-img/section-bg-15.html')] bg-bottom  bg-cover bg-no-repeat">
        <div class="container">
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-[30px]">
                <div>
                    <div class="mini-title">Frequently Asked Question</div>
                    <div class="column-title ">
                        General
                        <span class="shape-bg">Questions</span>
                    </div>
                    <ul class="list accrodains space-y-[30px] lg:max-w-[470px]">
                        <li>
                            <button type="button" class="accrodain-button">
                                <span>1. What is Royal Educity?</span>
                                <span class="icon-pm"></span>
                            </button>
                            <div class="content hidden">
                                Royal Educity is your premier online education platform dedicated to providing
                                world-class learning experiences. We connect ambitious learners with expert instructors
                                globally, offering a wide range of courses accessible anytime, anywhere.
                            </div>
                        </li>
                        <li>
                            <button type="button" class="accrodain-button">
                                <span>2. How do Royal Educity courses work?
                                </span>
                                <span class="icon-pm"></span>
                            </button>
                            <div class="content hidden">
                                Our courses are delivered through high-definition video lessons that you can access
                                24/7. You can pause, rewind, and review concepts at your own pace. Many lessons are also
                                downloadable for offline viewing, so you can learn even without an internet connection.
                            </div>
                        </li>
                        <li>
                            <button type="button" class="accrodain-button">
                                <span>3. Can I learn at my own pace?
                                </span>
                                <span class="icon-pm"></span>
                            </button>
                            <div class="content hidden">
                                Absolutely! All our courses are designed for self-paced learning. You have unlimited
                                access to video lessons, allowing you to study when it's most convenient for you and
                                review material as often as needed.
                            </div>
                        </li>
                        <li>
                            <button type="button" class="accrodain-button">
                                <span>4. What are the technical requirements to take a course?</span>
                                <span class="icon-pm"></span>
                            </button>
                            <div class="content hidden">
                                You will need a stable internet connection, a computer or mobile device (tablet or
                                smartphone), and a modern web browser. For an optimal experience, we recommend a
                                high-definition screen. Some courses may have specific software requirements, which will
                                be clearly outlined in the course description.
                            </div>
                        </li>
                        <li>
                            <button type="button" class="accrodain-button">
                                <span>5. How do I enroll in a course?</span>
                                <span class="icon-pm"></span>
                            </button>
                            <div class="content hidden">
                                Enrolling is simple! Browse our course catalog, select the course you're interested in,
                                and follow the easy steps to register and make payment. You'll gain immediate access to
                                your course materials once enrolled.
                            </div>
                        </li>
                        <li>
                            <button type="button" class="accrodain-button">
                                <span>6. What if I have questions during a course?</span>
                                <span class="icon-pm"></span>
                            </button>
                            <div class="content hidden">
                                Our instructors are available to provide support and answer your questions. You can
                                typically engage with them by dropping your question in the comment section or
                                contacting your instructor via email.
                            </div>
                        </li>
                    </ul>
                </div>
                <div>
                    <img src="{{ asset('front/assets/images/all-img/faq.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

</x-layouts.home>
