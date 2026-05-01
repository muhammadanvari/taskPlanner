@extends('blog.layout')
@section('main')
<!-- Blog Header & Categories -->
<header class="pt-18 relative">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-indigo-100/50 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-6">مجله تخصصی بهره‌وری</h1>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto mb-10">جدیدترین مقالات آموزشی، اخبار بروزرسانی‌ها و ترفندهای مدیریت زمان برای تیم‌های موفق.</p>

        <!-- Categories Filter -->
{{--        <div class="flex flex-wrap justify-center gap-3">--}}
{{--            <a href="#" class="px-5 py-2 rounded-full bg-indigo-600 text-white text-sm font-bold shadow-md shadow-indigo-200">همه مقالات</a>--}}
{{--            <a href="#" class="px-5 py-2 rounded-full bg-white text-slate-600 hover:bg-slate-100 text-sm font-medium border border-slate-200 transition-colors">مدیریت زمان</a>--}}
{{--            <a href="#" class="px-5 py-2 rounded-full bg-white text-slate-600 hover:bg-slate-100 text-sm font-medium border border-slate-200 transition-colors">دورکاری</a>--}}
{{--            <a href="#" class="px-5 py-2 rounded-full bg-white text-slate-600 hover:bg-slate-100 text-sm font-medium border border-slate-200 transition-colors">بروزرسانی‌ها</a>--}}
{{--        </div>--}}
    </div>
</header>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24 relative z-10">

    <!-- Featured Post -->
    <section class="mb-16">
            @foreach($blogs->take(1) as $blog )
                <a href="{{route('blog.single',$blog->id)}}">
        <div class="bg-white rounded-3xl overflow-hidden shadow-xl shadow-slate-200/50 flex flex-col md:flex-row group cursor-pointer border border-slate-100 hover:border-indigo-100 transition-colors">
            <!-- Abstract Gradient Image -->
                <div class="md:w-1/2 h-64 md:h-auto bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 relative overflow-hidden">
                    <img src="{{ asset($blog->image) }}" alt="" class="w-full h-full object-cover">
                </div>
                <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-indigo-100 text-indigo-600 text-xs font-bold px-3 py-1 rounded-full">پیشنهاد سردبیر</span>
                        <span class="text-slate-400 text-sm">{{\Morilog\Jalali\Jalalian::fromCarbon($blog->created_at)->format('%d %B %Y')}}</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-4 group-hover:text-indigo-600 transition-colors">{{$blog->title}}</h2>
                    <p class="text-slate-600 mb-6 leading-relaxed">{{$blog->summary}}</p>
                    <div class="flex items-center gap-3 mt-auto">
                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold text-sm">س م</div>
                        <div>
                            <p class="text-sm font-bold text-slate-900">سیدمحمد محمدی</p>
                            <p class="text-xs text-slate-500">مدیر سایت</p>
                        </div>
                    </div>
                </div>
        </div>
                </a>
            @endforeach
    </section>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($blogs as $blog)
            <article class="bg-white rounded-3xl overflow-hidden shadow-lg shadow-slate-200/40 border border-slate-100 group hover:-translate-y-1.5 hover:shadow-xl hover:shadow-indigo-100 transition-all duration-300">
                <div class="h-48 bg-gradient-to-tr from-emerald-400 to-teal-500 relative">
{{--                    <span class="absolute top-4 right-4 bg-white/90 backdrop-blur text-emerald-600 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">--}}
{{--                        مدیریت زمان--}}
{{--                    </span>--}}
                    <img src="{{ asset($blog->image) }}" alt="" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <div class="text-sm text-slate-400 mb-3">{{\Morilog\Jalali\Jalalian::fromCarbon($blog->created_at)->format('%d %B %Y')}}</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors line-clamp-2">{{$blog->title}}</h3>
                    <p class="text-slate-600 text-sm mb-5 line-clamp-3 leading-relaxed">{{$blog->summary}}</p>
                    <a href="{{route('blog.single',$blog->id)}}" class="text-indigo-600 font-bold text-sm flex items-center gap-1 group/link">
                        مطالعه مقاله
                        <svg class="w-4 h-4 transform group-hover/link:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($blogs->hasPages())
        <div class="mt-16 flex justify-center gap-2">
            @if(!$blogs->onFirstPage())
            <a href="{{ $blogs->previousPageUrl() }}">
                <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </a>
            @endif
            @foreach($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                    @if($page == $blogs->currentPage())
                        <button class="w-10 h-10 rounded-xl bg-indigo-600 text-white font-bold shadow-md shadow-indigo-200">{{ $page }}</button>
                    @else
                        <a href="{{$url}}">
                            <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-colors">{{ $page }}</button>
                        </a>
                    @endif
            @endforeach
            @if($blogs->hasMorePages())
            <a href="{{ $blogs->nextPageUrl() }}">
                <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
            </a>
            @endif
        </div>
    @endif
</main>
@endsection
