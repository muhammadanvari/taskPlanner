@extends('auth.layout')
@section('main')
    <form action="{{ route('register.post') }}" method="post" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="sr-only">نام کاربری</label>
            <div class="relative">
                <i class="fas fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200"
                       placeholder="نام ">
            </div>
        </div>

        <div>
            <label for="email" class="sr-only">ایمیل</label>
            <div class="relative">
                <i class="fas fa-envelope absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200"
                       placeholder="ایمیل">
            </div>
        </div>

        <div>
            <label for="password" class="sr-only">رمز عبور</label>
            <div class="relative">
                <i class="fas fa-lock absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="password" id="password" name="password"
                       class="w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200"
                       placeholder="رمز عبور">
            </div>
        </div>

        <div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-colors duration-200">
                ثبت‌نام
            </button>
        </div>
    </form>

    <div class="text-center mt-4 text-sm">
        <p>
            حساب کاربری دارید؟
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline transition-colors duration-200">
                ورود
            </a>
        </p>
    </div>
@endsection
