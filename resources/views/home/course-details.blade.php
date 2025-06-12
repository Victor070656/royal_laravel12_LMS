<x-layouts.home>
    <div class="breadcrumbs section-padding bg-[url('../images/all-img/bred.html')] bg-cover bg-center bg-no-repeat">
        <div class="container text-center">
            <h2>Course Details</h2>
            <nav>
                <ol class="flex items-center justify-center space-x-3">
                    <li class="breadcrumb-item"><a href="/">Home </a></li>
                    <li class="breadcrumb-item">-</li>
                    <li class="text-primary">Course Details </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="nav-tab-wrapper tabs  section-padding">
        @session('error')
            <p class="my-4 text-red-500 text-center">{{ session('error') }}</p>
        @endsession
        @session('success')
            <p class="my-4 text-green-500 text-center">{{ session('success') }}</p>
        @endsession
        {{-- @dd($course->user->initials()) --}}
        <div class="container">
            <div class="grid grid-cols-12 gap-[30px]">
                <div class="lg:col-span-8 col-span-12">
                    <div class="single-course-details">
                        <div class="xl:h-[470px] h-[350px] mb-10 course-main-thumb">
                            <img src="{{ asset($course->thumbnail) }}" alt=""
                                class=" rounded-md object-cover w-full h-full block">
                        </div>
                        <div class=" mb-6">
                            <span
                                class="bg-secondary py-1 px-3 text-lg font-semibold rounded text-white ">{{ $category[0]->category_name }}</span>
                        </div>
                        <h2>{{ $course->course_name }}</h2>
                        <div
                            class="author-meta mt-6 sm:flex  lg:space-x-16 sm:space-x-5 space-y-5 sm:space-y-0 items-center">
                            <div class="flex space-x-4 items-center group">
                                <div class="flex-none">
                                    @if ($course->user->photo)
                                        <div class="h-12 w-12 rounded">
                                            <img src="{{ asset($course->user->photo) }}" alt=""
                                                class=" object-cover w-full h-full rounded">
                                        </div>
                                    @else
                                        <div class="h-12 w-12 rounded bg-secondary flex justify-center items-center">
                                            <span class="text-white">{{ $course->user->initials() }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <span class=" text-secondary  ">Trainer
                                        <a href="#" class=" text-black">
                                            : {{ $course->user->first_name . ' ' . $course->user->last_name }}</a>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <span class=" text-secondary  ">Last Update:
                                    <a href="#" class=" text-black">
                                        {{ date('d M, Y', strtotime($course->updated_at)) }}</a>
                                </span>
                            </div>
                        </div>
                        <div class="nav-tab-wrapper mt-12">
                            <ul id="tabs-nav" class=" course-tab mb-8">
                                <li>
                                    <a href="#tab1">
                                        Overview
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2">
                                        Curriculum
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3">
                                        Instructor
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab4">
                                        Reviews
                                    </a>
                                </li>
                            </ul>
                            <div id="tabs-content">
                                {{-- course overview --}}
                                <div id="tab1" class="tab-content">

                                    <div>
                                        <h3 class=" text-2xl">Course Description</h3>
                                        <p class="mt-4">
                                            {{ $course->short_desc }}
                                            <br /> <br />
                                            {{ $course->long_desc }}
                                        </p>
                                        <div class="bg-[#F8F8F8] space-y-6 p-8 rounded-md my-8">
                                            <h4 class=" text-2xl">Requirements</h4>
                                            <ul class=" grid sm:grid-cols-2 grid-cols-1 gap-6">
                                                @foreach ($requirements as $requirement)
                                                    <li class=" flex space-x-3">
                                                        <div class="flex-none  relative top-1 ">
                                                            <img src="{{ asset('front/assets/images/icon/ck.svg') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="flex-1">
                                                            {{ $requirement }}
                                                        </div>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <div>
                                            <h4 class=" text-2xl">What You will Learn?</h4>
                                            <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5 mt-5">
                                                @foreach ($schemes as $scheme)
                                                    <div
                                                        class=" bg-white  rounded px-5 py-[18px] flex  shadow-box2 space-x-[10px] items-center">
                                                        <span class="flex-none">
                                                            <img src="{{ asset('front/assets/images/icon/pencil.svg') }}"
                                                                alt="">
                                                        </span>
                                                        <span class="flex-1 text-black">
                                                            {{ $scheme }}
                                                        </span>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- curriculum --}}
                                <div id="tab2" class="tab-content">
                                    <div>
                                        <h3 class=" text-2xl">Course Modules</h3>
                                        <div class="md:flex md:space-x-10  space-x-3 flex-wrap mt-4 mb-6">

                                            <span>{{ $lessons }} Lectures</span>
                                            <span>Total: {{ $course->duration }}</span>
                                        </div>
                                        <ul class="list  course-accrodain space-y-6">
                                            @forelse ($course->sections as $section)
                                                <li>
                                                    <button type="button" class="accrodain-button">
                                                        <span class="icon-pm fle x-none"></span>
                                                        <span class=" flex-1">{{ $section->section_name }}</span>

                                                    </button>
                                                    <div class="content hidden">

                                                        <div class=" mt-2 ">
                                                            @forelse ($section->courseContent as $content)
                                                                <a href="#"
                                                                    class="flex items-start pb-4 mb-4 last:mb-0 last:pb-0 border-b border-[#ECECEC] last:border-0">
                                                                    <div class="flex-1 flex">
                                                                        <span class="flex-none  mr-2">
                                                                            @if ($content->type == 'video')
                                                                                <img src="{{ asset('front/assets/images/icon/camera.svg') }}"
                                                                                    alt="">
                                                                            @else
                                                                                <img src="{{ asset('front/assets/images/icon/file.svg') }}"
                                                                                    alt="">
                                                                            @endif
                                                                        </span>
                                                                        <span
                                                                            class="flex-1">{{ $content->type == 'video' ? 'Video' : 'Material' }}:
                                                                            {{ $content->title }}
                                                                        </span>
                                                                    </div>

                                                                </a>
                                                            @empty
                                                                <p class="p-4">No course content added!</p>
                                                            @endforelse


                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <p class="text-center">No Course Modules Yet</p>
                                            @endforelse

                                        </ul>
                                    </div>
                                </div>
                                {{-- instructor --}}
                                <div id="tab3" class="tab-content">


                                    <div class=" bg-[#F8F8F8] rounded-md p-8">
                                        <div class="md:flex space-x-5 mb-8">
                                            <div class="h-[310px] w-[270px] flex-none rounded mb-5 md:mb-0">

                                                @if ($course->user->photo)
                                                    <img src="{{ asset($course->user->photo) }}" alt=""
                                                        class=" object-cover w-full h-full rounded">
                                                @else
                                                    <div
                                                        class="h-full w-full rounded bg-secondary flex justify-center items-center">
                                                        <h2 class="text-white">{{ $course->user->initials() }}</h2>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <div class="max-w-[300px]">
                                                    <h4 class=" text-[34px] font-bold leading-[51px]">
                                                        {{ $course->user->first_name . ' ' . $course->user->last_name }}
                                                    </h4>
                                                    {{-- <div class=" text-primary mb-6">
                                                        User Experience Designer
                                                    </div> --}}
                                                    <ul class=" list space-y-4 mt-4">

                                                        <li class=" flex space-x-3">
                                                            <img src="{{ asset('front/assets/images/icon/file2.svg') }}"
                                                                alt="" />
                                                            <div>
                                                                {{ $course->user->courses->count() }} Courses
                                                            </div>
                                                        </li>

                                                        <li class=" flex space-x-3">
                                                            <img src="{{ asset('front/assets/images/icon/user2.svg') }}"
                                                                alt="" />
                                                            <div>
                                                                {{ $learned }} Student Learned
                                                            </div>
                                                        </li>

                                                        <li class=" flex space-x-3">
                                                            <img src="{{ asset('front/assets/images/icon/star.svg') }}"
                                                                alt="" />
                                                            <div>
                                                                {{ $course->review->count() }} Reviews
                                                            </div>
                                                        </li>

                                                        <li class=" flex space-x-3">
                                                            <img src="{{ asset('front/assets/images/icon/like.svg') }}"
                                                                alt="" />
                                                            <div>
                                                                {{ round($rating, 1) }} Average Rating
                                                            </div>
                                                        </li>

                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                        <p>
                                            {{ $course->user->bio }}
                                        </p>
                                    </div>
                                </div>
                                {{-- review --}}
                                <div id="tab4" class="tab-content">

                                    <div>
                                        <div class="grid grid-cols-12 gap-5">
                                            <div class="md:col-span-8 col-span-12">

                                                <div class="flex items-center space-x-4  mb-5 last:mb-0 ">
                                                    <div class="flex-none">
                                                        <div class="flex space-x-1 text-xl  ">

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>


                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="progressbar-group flex items-center space-x-4">
                                                            <div
                                                                class="rounded-[2px] overflow-hidden bg-opacity-10 bg-black h-[6px] relative flex-1">
                                                                <div class="ani  h-[6px] bg-secondary block absolute left-0 top-1/2 -translate-y-1/2 "
                                                                    data-progress="{{ $perc5 }}"></div>
                                                            </div>
                                                            <div class="flex-none">
                                                                <span
                                                                    class=" block mb-2  font-semibold">{{ $perc5 }}%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center space-x-4  mb-5 last:mb-0 ">
                                                    <div class="flex-none">
                                                        <div class="flex space-x-1 text-xl  ">

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-[#E6E6E6]"></iconify-icon>


                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="progressbar-group flex items-center space-x-4">
                                                            <div
                                                                class="rounded-[2px] overflow-hidden bg-opacity-10 bg-black h-[6px] relative flex-1">
                                                                <div class="ani  h-[6px] bg-secondary block absolute left-0 top-1/2 -translate-y-1/2 "
                                                                    data-progress="{{ $perc4 }}"></div>
                                                            </div>
                                                            <div class="flex-none">
                                                                <span
                                                                    class=" block mb-2  font-semibold">{{ $perc4 }}%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center space-x-4  mb-5 last:mb-0 ">
                                                    <div class="flex-none">
                                                        <div class="flex space-x-1 text-xl  ">

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-[#E6E6E6]"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-[#E6E6E6]"></iconify-icon>


                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="progressbar-group flex items-center space-x-4">
                                                            <div
                                                                class="rounded-[2px] overflow-hidden bg-opacity-10 bg-black h-[6px] relative flex-1">
                                                                <div class="ani  h-[6px] bg-secondary block absolute left-0 top-1/2 -translate-y-1/2 "
                                                                    data-progress="{{ $perc3 }}"></div>
                                                            </div>
                                                            <div class="flex-none">
                                                                <span
                                                                    class=" block mb-2  font-semibold">{{ $perc3 }}%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center space-x-4  mb-5 last:mb-0 ">
                                                    <div class="flex-none">
                                                        <div class="flex space-x-1 text-xl  ">

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-[#E6E6E6]"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-[#E6E6E6]"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-[#E6E6E6]"></iconify-icon>


                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="progressbar-group flex items-center space-x-4">
                                                            <div
                                                                class="rounded-[2px] overflow-hidden bg-opacity-10 bg-black h-[6px] relative flex-1">
                                                                <div class="ani  h-[6px] bg-secondary block absolute left-0 top-1/2 -translate-y-1/2 "
                                                                    data-progress="{{ $perc2 }}"></div>
                                                            </div>
                                                            <div class="flex-none">
                                                                <span
                                                                    class=" block mb-2  font-semibold">{{ $perc2 }}%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center space-x-4  mb-5 last:mb-0 ">
                                                    <div class="flex-none">
                                                        <div class="flex space-x-1 text-xl  ">

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-tertiary"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-[#E6E6E6]"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-[#E6E6E6]"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-[#E6E6E6]"></iconify-icon>

                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class="text-[#E6E6E6]"></iconify-icon>


                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="progressbar-group flex items-center space-x-4">
                                                            <div
                                                                class="rounded-[2px] overflow-hidden bg-opacity-10 bg-black h-[6px] relative flex-1">
                                                                <div class="ani  h-[6px] bg-secondary block absolute left-0 top-1/2 -translate-y-1/2 "
                                                                    data-progress="{{ $perc1 }}"></div>
                                                            </div>
                                                            <div class="flex-none">
                                                                <span
                                                                    class=" block mb-2  font-semibold">{{ $perc1 }}%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="md:col-span-4 col-span-12">
                                                <div
                                                    class="bg-white min-h-[219px] p-6 flex flex-col justify-center items-center shadow-box7 rounded space-y-3">
                                                    <h2>
                                                        {{ $rating }}
                                                    </h2>
                                                    <div class="flex space-x-3">
                                                        <iconify-icon icon="heroicons:star-20-solid"
                                                            class=" text-tertiary"></iconify-icon>
                                                        <iconify-icon icon="heroicons:star-20-solid"
                                                            class=" text-tertiary"></iconify-icon>
                                                        <iconify-icon icon="heroicons:star-20-solid"
                                                            class=" text-tertiary"></iconify-icon>
                                                        <iconify-icon icon="heroicons:star-20-solid"
                                                            class=" text-tertiary"></iconify-icon>
                                                        <iconify-icon icon="heroicons:star-20-solid"
                                                            class=" text-tertiary"></iconify-icon>
                                                    </div>
                                                    <span class=" block">({{ $count_review }} Review)</span>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- review comments -->
                                        <div class=" mt-8">
                                            <h4 class=" text-xl font-bold text-black">Reviews</h4>
                                            <ul class=" list space-y-6 mt-6">
                                                @forelse ($course->review()->latest()->limit(5)->get() as $review)
                                                    <li class=" flex space-x-6 ">
                                                        <div class="flex-none">
                                                            <div class="h-[72px] w-[72px] rounded-full">
                                                                @if ($review->user->photo)
                                                                    <img src="{{ asset($review->user->photo) }}"
                                                                        alt=""
                                                                        class=" object-cover w-full h-full rounded">
                                                                @else
                                                                    <div
                                                                        class="h-full w-full rounded bg-secondary flex justify-center items-center">
                                                                        <span
                                                                            class="text-white">{{ $review->user->initials() }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="flex space-x-3 mb-4">
                                                                @for ($i = 0; $i < $review->star; $i++)
                                                                    <iconify-icon icon="heroicons:star-20-solid"
                                                                        class=" text-tertiary"></iconify-icon>
                                                                @endfor
                                                                @for ($i = $review->star; $i < 5; $i++)
                                                                    <iconify-icon icon="heroicons:star-20-solid"
                                                                        class=" text-[#E6E6E6]"></iconify-icon>
                                                                @endfor
                                                            </div>
                                                            <p>
                                                                {{ $review->review }}
                                                            </p>
                                                            <div class="author mt-4">
                                                                <span
                                                                    class="block text-sm font-bold text-black">{{ $review->user->first_name . ' ' . $review->user->last_name }}</span>
                                                                <span
                                                                    class="block text-xs">{{ $review->created_at->format('M d, Y') }}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <p class="text-center">No reviews yet!</p>
                                                @endforelse
                                                {{-- <li class=" flex space-x-6 ">
                                                    <div class="flex-none">
                                                        <div class="h-[72px] w-[72px] rounded-full">
                                                            <img src="assets/images/all-img/cmnt-1.png" alt=""
                                                                class=" object-cover w-full h-full">
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="flex space-x-3 mb-4">
                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class=" text-tertiary"></iconify-icon>
                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class=" text-tertiary"></iconify-icon>
                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class=" text-tertiary"></iconify-icon>
                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class=" text-tertiary"></iconify-icon>
                                                            <iconify-icon icon="heroicons:star-20-solid"
                                                                class=" text-tertiary"></iconify-icon>
                                                        </div>
                                                        <p>
                                                            There are many variations of passages of Lorem Ipsum
                                                            available, but the
                                                            majority have suffered alteration.
                                                        </p>
                                                        <div class="author mt-4">
                                                            <span class="block text-xl font-bold text-black">Daniel
                                                                Smith</span>
                                                            <span class="block">Jan 24, 2022</span>
                                                        </div>
                                                    </div>
                                                </li> --}}

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 col-span-12">

                    <div class="sidebarWrapper space-y-[30px] lg:sticky lg:top-[60px]">
                        <div class="wdiget custom-text space-y-5 ">
                            @if ($course->sections->first()?->courseContent->first())
                                <a class="h-[220px]  rounded relative block"
                                    href="{{ $course->sections->first()?->courseContent->first()->link }}">
                                    <img src="{{ asset($course->thumbnail) }}" alt=""
                                        class=" block w-full h-full object-cover rounded " />
                                    <div class=" absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                                        <img src="{{ asset('front/assets/images/svg/play.svg') }}" alt="">
                                    </div>
                                </a>
                            @endif
                            <h3>₦ {{ number_format($course->price) }}</h3>
                            @if ($check)
                                <a href="{{route('student.courses')}}" class="btn btn-primary w-full text-center">Take Course</a>
                            @else
                                <form action="{{ route('home.course.buy', $course) }}" method="post">
                                    @csrf
                                    <button class="btn btn-primary w-full text-center ">
                                        Enroll Now
                                    </button>
                                </form>
                            @endif
                            <ul class="list  ">

                                <li
                                    class=" flex space-x-3 border-b border-[#ECECEC] mb-4 pb-4 last:pb-0 past:mb-0 last:border-0">
                                    <div class="flex-1 space-x-3 flex">
                                        <img src="{{ asset('front/assets/images/icon/user.svg') }}" alt="" />
                                        <div class=" text-black font-semibold">Instructor</div>
                                    </div>
                                    <div class="flex-none">
                                        {{ $course->user->first_name . ' ' . $course->user->last_name }}
                                    </div>
                                </li>

                                <li
                                    class=" flex space-x-3 border-b border-[#ECECEC] mb-4 pb-4 last:pb-0 past:mb-0 last:border-0">
                                    <div class="flex-1 space-x-3 flex">
                                        <img src="{{ asset('front/assets/images/icon/file2.svg') }}"
                                            alt="" />
                                        <div class=" text-black font-semibold">Lectures</div>
                                    </div>
                                    <div class="flex-none">
                                        {{ $lessons }}
                                    </div>
                                </li>

                                <li
                                    class=" flex space-x-3 border-b border-[#ECECEC] mb-4 pb-4 last:pb-0 past:mb-0 last:border-0">
                                    <div class="flex-1 space-x-3 flex">
                                        <img src="{{ asset('front/assets/images/icon/clock.svg') }}"
                                            alt="" />
                                        <div class=" text-black font-semibold">Duration</div>
                                    </div>
                                    <div class="flex-none">
                                        {{ $course->duration }}
                                    </div>
                                </li>

                                <li
                                    class=" flex space-x-3 border-b border-[#ECECEC] mb-4 pb-4 last:pb-0 past:mb-0 last:border-0">
                                    <div class="flex-1 space-x-3 flex">
                                        <img src="{{ asset('front/assets/images/icon/star.svg') }}" alt="" />
                                        <div class=" text-black font-semibold">Enrolled</div>
                                    </div>
                                    <div class="flex-none">
                                        {{ $learned }} Students
                                    </div>
                                </li>

                                <li
                                    class=" flex space-x-3 border-b border-[#ECECEC] mb-4 pb-4 last:pb-0 past:mb-0 last:border-0">
                                    <div class="flex-1 space-x-3 flex">
                                        <img src="{{ asset('front/assets/images/icon/web.svg') }}" alt="" />
                                        <div class=" text-black font-semibold">Language</div>
                                    </div>
                                    <div class="flex-none">
                                        English
                                    </div>
                                </li>

                            </ul>

                        </div>

                        {{-- <div class="wdiget">
                            <h4 class=" widget-title">Related Courses</h4>
                            <ul class="list">
                                <li
                                    class=" flex space-x-4 border-[#ECECEC] pb-6 mb-6 last:pb-0 last:mb-0 last:border-0 border-b">
                                    <div class="flex-none ">
                                        <div class="h-20 w-20  rounded">
                                            <img src="assets/images/all-img/rc-1.png" alt=""
                                                class=" w-full h-full object-cover rounded">
                                        </div>
                                    </div>
                                    <div class="flex-1 ">
                                        <div class="flex space-x-3 mb-2">
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                        </div>
                                        <div class="mb-1 font-semibold text-black">
                                            Greatest Passion In...
                                        </div>
                                        <span class=" text-secondary font-semibold">$38.00</span>
                                    </div>
                                </li>
                                <li
                                    class=" flex space-x-4 border-[#ECECEC] pb-6 mb-6 last:pb-0 last:mb-0 last:border-0 border-b">
                                    <div class="flex-none ">
                                        <div class="h-20 w-20  rounded">
                                            <img src="assets/images/all-img/rc-2.png" alt=""
                                                class=" w-full h-full object-cover rounded">
                                        </div>
                                    </div>
                                    <div class="flex-1 ">
                                        <div class="flex space-x-3 mb-2">
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                        </div>
                                        <div class="mb-1 font-semibold text-black">
                                            Greatest Passion In...
                                        </div>
                                        <span class=" text-secondary font-semibold">$38.00</span>
                                    </div>
                                </li>
                                <li
                                    class=" flex space-x-4 border-[#ECECEC] pb-6 mb-6 last:pb-0 last:mb-0 last:border-0 border-b">
                                    <div class="flex-none ">
                                        <div class="h-20 w-20  rounded">
                                            <img src="assets/images/all-img/rc-3.png" alt=""
                                                class=" w-full h-full object-cover rounded">
                                        </div>
                                    </div>
                                    <div class="flex-1 ">
                                        <div class="flex space-x-3 mb-2">
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                            <iconify-icon icon="heroicons:star-20-solid"
                                                class=" text-tertiary"></iconify-icon>
                                        </div>
                                        <div class="mb-1 font-semibold text-black">
                                            Greatest Passion In...
                                        </div>
                                        <span class=" text-secondary font-semibold">$38.00</span>
                                    </div>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.home>
