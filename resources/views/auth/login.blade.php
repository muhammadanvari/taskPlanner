@extends('auth.layout')
@section('main')
    <form action="{{ route('login.post') }}" method="post" class="space-y-6">
        @csrf

        {{-- فیلد ایمیل --}}
        <div>
            <label for="email" class="sr-only">ایمیل</label>
            <div class="relative group">
                <i class="fas fa-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="w-full px-5 py-3 pr-12 rounded-xl border border-gray-300 text-base focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-300 placeholder-gray-500"
                       placeholder="آدرس ایمیل" required>
            </div>
        </div>

        {{-- فیلد رمز عبور --}}
        <div>
            <label for="password" class="sr-only">رمز عبور</label>
            <div class="relative group">
                <i class="fas fa-lock absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                <input type="password" id="password" name="password"
                       class="w-full px-5 py-3 pr-12 rounded-xl border border-gray-300 text-base focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition duration-300 placeholder-gray-500"
                       placeholder="رمز عبور" required>
            </div>
        </div>

        {{-- دکمه ورود --}}
        <div class="pt-2">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-500/50 transition duration-300 transform hover:scale-[1.01] flex items-center justify-center gap-2">
                <i class="fas fa-sign-in-alt"></i>
                ورود به سیستم
            </button>
        </div>

        {{-- لینک فراموشی رمز عبور --}}
        {{--        <div class="text-center text-sm pt-2">--}}
        {{--            <a href="{{ route('password.request') }}" class="text-gray-500 hover:text-blue-600 hover:underline transition-colors duration-200 font-medium">--}}
        {{--                رمز عبور خود را فراموش کرده‌اید؟--}}
        {{--            </a>--}}
        {{--        </div>--}}

    </form>
@endsection
