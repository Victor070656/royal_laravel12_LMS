<x-layouts.home>
    <div class="breadcrumbs section-padding bg-[url('../images/all-img/bred.html')] bg-cover bg-center bg-no-repeat">
        <div class="container text-center">
            <h2>Courses</h2>
            <nav>
                <ol class="flex items-center justify-center space-x-3">
                    <li class="breadcrumb-item"><a href="index-2.html">Pages </a></li>
                    <li class="breadcrumb-item">-</li>
                    <li class="text-primary">Courses </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="nav-tab-wrapper tabs pt-10 section-padding-bottom">
        <div class="container">

            <div id="tabs-content">
                {{-- grid --}}
                <div id="tab1" class="tab-content">
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
                                if (isset($course->review)) {
                                    $count_review = $course->review->count();
                                }
                                if ($count_review > 0) {
                                    foreach ($course->review as $review) {
                                        $rating += $review->star;
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
                                                <img src="{{ asset('front/assets/images/svg/file.svg') }}"
                                                    alt="">
                                                <span>{{ $lessons }} Lessons</span>
                                            </span>
                                            <span class=" flex items-center space-x-2">
                                                <img src="{{ asset('front/assets/images/svg/clock.svg') }}"
                                                    alt="">
                                                <span>{{ $course->duration }}</span>
                                            </span>
                                            <span class=" flex items-center space-x-2">
                                                <img src="{{ asset('front/assets/images/svg/star.svg') }}"
                                                    alt="">
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
                    <div class=" lg:pt-16 pt-10">
                        {{-- <a href="#" class=" btn btn-primary">View All Courses</a> --}}
                        {{ $courses->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.home>
