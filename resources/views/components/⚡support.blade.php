<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>
<div class="flex-1 overflow-y-auto bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="container mx-auto p-4 lg:p-8 max-w-6xl">
        <!-- هدر صفحه -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-3">📚 مرکز آموزش و پشتیبانی</h1>
            <p class="text-slate-600 max-w-2xl mx-auto">مقالات آموزشی، راهنمای استفاده و سیستم تیکت پشتیبانی</p>
        </div>

        <!-- جستجو -->
{{--        <div class="max-w-2xl mx-auto mb-10">--}}
{{--            <div class="relative">--}}
{{--                <input type="text"--}}
{{--                       placeholder="جستجو در مقالات آموزشی، سوالات متداول..."--}}
{{--                       class="w-full px-5 py-4 pr-12 rounded-2xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm text-slate-700">--}}
{{--                <i class="fas fa-search absolute left-4 top-4 text-slate-400"></i>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- ویجت‌های آموزشی -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <!-- ویجت شروع سریع -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30 ml-4">
                        <i class="fas fa-rocket text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">شروع سریع</h3>
                </div>
                <p class="text-slate-600 mb-5 text-sm">آموزش‌های اولیه برای شروع کار با تسک پلنر</p>
                <div class="space-y-3">
                    <a href="#" class="flex items-center justify-between p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition group">
                        <span class="text-slate-700 group-hover:text-indigo-600">آموزش ایجاد تسک جدید</span>
                        <i class="fas fa-arrow-left text-slate-400 group-hover:text-indigo-500"></i>
                    </a>
                    <a href="#" class="flex items-center justify-between p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition group">
                        <span class="text-slate-700 group-hover:text-indigo-600">مدیریت تقویم ماهانه</span>
                        <i class="fas fa-arrow-left text-slate-400 group-hover:text-indigo-500"></i>
                    </a>
                    <a href="#" class="flex items-center justify-between p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition group">
                        <span class="text-slate-700 group-hover:text-indigo-600">نحوه استفاده از نمودارها</span>
                        <i class="fas fa-arrow-left text-slate-400 group-hover:text-indigo-500"></i>
                    </a>
                </div>
            </div>

            <!-- ویجت نکات حرفه‌ای -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 ml-4">
                        <i class="fas fa-lightbulb text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">نکات حرفه‌ای</h3>
                </div>
                <p class="text-slate-600 mb-5 text-sm">راهکارهای پیشرفته برای استفاده بهینه</p>
                <div class="space-y-3">
                    <a href="#" class="flex items-center justify-between p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition group">
                        <span class="text-slate-700 group-hover:text-indigo-600">بهبود بهره‌وری با تسک پلنر</span>
                        <i class="fas fa-arrow-left text-slate-400 group-hover:text-indigo-500"></i>
                    </a>
                    <a href="#" class="flex items-center justify-between p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition group">
                        <span class="text-slate-700 group-hover:text-indigo-600">مدیریت زمان با تکنیک پومودورو</span>
                        <i class="fas fa-arrow-left text-slate-400 group-hover:text-indigo-500"></i>
                    </a>
                    <a href="#" class="flex items-center justify-between p-3 bg-slate-50 hover:bg-slate-100 rounded-lg transition group">
                        <span class="text-slate-700 group-hover:text-indigo-600">گزارش‌گیری حرفه‌ای</span>
                        <i class="fas fa-arrow-left text-slate-400 group-hover:text-indigo-500"></i>
                    </a>
                </div>
            </div>

            <!-- ویجت ویدیو آموزشی -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30 ml-4">
                        <i class="fas fa-video text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">آموزش ویدیویی</h3>
                </div>
                <p class="text-slate-600 mb-5 text-sm">آموزش‌های تصویری برای درک بهتر</p>
                <div class="space-y-4">
                    <div class="relative rounded-lg overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800 aspect-video flex items-center justify-center">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <button class="relative z-10 w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition">
                            <i class="fas fa-play text-white text-2xl"></i>
                        </button>
                        <div class="absolute bottom-4 right-4 z-10 text-white">
                            <span class="text-sm">آموزش مقدماتی - ۱۵ دقیقه</span>
                        </div>
                    </div>
                    <a href="#" class="block text-center text-indigo-600 font-medium hover:text-indigo-700">
                        مشاهده همه ویدیوها
                    </a>
                </div>
            </div>
        </div>

        <!-- سوالات متداول -->
{{--        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 mb-10">--}}
{{--            <div class="flex items-center justify-between mb-6">--}}
{{--                <h2 class="text-xl font-bold text-slate-800">❓ سوالات متداول</h2>--}}
{{--                <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium">--}}
{{--                    مشاهده همه--}}
{{--                    <i class="fas fa-arrow-left mr-2"></i>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">--}}
{{--                <div class="space-y-4">--}}
{{--                    <div class="border border-slate-200 rounded-xl p-4 hover:border-indigo-300 hover:shadow-sm transition">--}}
{{--                        <h4 class="font-medium text-slate-800 mb-2">چگونه تسک‌هایم را دسته‌بندی کنم؟</h4>--}}
{{--                        <p class="text-slate-600 text-sm">با استفاده از برچسب‌ها و پروژه‌ها می‌توانید تسک‌های خود را سازماندهی کنید.</p>--}}
{{--                    </div>--}}
{{--                    <div class="border border-slate-200 rounded-xl p-4 hover:border-indigo-300 hover:shadow-sm transition">--}}
{{--                        <h4 class="font-medium text-slate-800 mb-2">آیا امکان همکاری تیمی وجود دارد؟</h4>--}}
{{--                        <p class="text-slate-600 text-sm">بله، در نسخه حرفه‌ای امکان اشتراک‌گذاری پروژه با تیم وجود دارد.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="space-y-4">--}}
{{--                    <div class="border border-slate-200 rounded-xl p-4 hover:border-indigo-300 hover:shadow-sm transition">--}}
{{--                        <h4 class="font-medium text-slate-800 mb-2">چگونه گزارش عملکرد تهیه کنم؟</h4>--}}
{{--                        <p class="text-slate-600 text-sm">از بخش گزارش‌ها می‌توانید گزارش‌های هفتگی و ماهانه دریافت کنید.</p>--}}
{{--                    </div>--}}
{{--                    <div class="border border-slate-200 rounded-xl p-4 hover:border-indigo-300 hover:shadow-sm transition">--}}
{{--                        <h4 class="font-medium text-slate-800 mb-2">آیا اپلیکیشن موبایل دارید؟</h4>--}}
{{--                        <p class="text-slate-600 text-sm">در حال حاضر نسخه وب موبایل وجود دارد و نسخه اندروید در دست توسعه است.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- بخش تیکت‌های پشتیبانی -->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-6 text-white">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">🎫 سیستم تیکت پشتیبانی</h2>
                        <p class="text-indigo-100">تیکت‌های خود را مدیریت و پیگیری کنید</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2">
{{--                        <span class="font-bold">{{ auth()->user()->tickets()->count() ?? 0 }}</span>--}}
                        <span class="text-sm mr-2">تیکت فعال</span>
                    </div>
                </div>

                <!-- دکمه ایجاد تیکت جدید -->
                <button class="w-full mb-6 bg-white text-indigo-600 hover:bg-slate-100 font-bold py-3 px-4 rounded-xl transition duration-300 flex items-center justify-center group">
                    <i class="fas fa-plus-circle ml-2 group-hover:scale-110 transition-transform"></i>
                    ایجاد تیکت پشتیبانی جدید
                </button>

                <!-- لیست تیکت‌ها -->
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full text-white">
                            <thead>
                            <tr class="border-b border-white/20">
                                <th class="py-3 text-right font-medium">شماره تیکت</th>
                                <th class="py-3 text-right font-medium">موضوع</th>
                                <th class="py-3 text-right font-medium">وضعیت</th>
                                <th class="py-3 text-right font-medium">تاریخ</th>
                                <th class="py-3 text-right font-medium">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- تیکت نمونه 1 -->
                            <tr class="border-b border-white/10 hover:bg-white/5 transition">
                                <td class="py-3">#T-7842</td>
                                <td class="py-3">مشکل در ثبت تسک جدید</td>
                                <td class="py-3">
                                    <span class="px-3 py-1 bg-green-500/30 text-green-300 rounded-full text-xs">پاسخ داده شده</span>
                                </td>
                                <td class="py-3 text-sm">۱۴۰۲/۱۱/۲۰</td>
                                <td class="py-3">
                                    <button class="text-indigo-200 hover:text-white transition">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- تیکت نمونه 2 -->
                            <tr class="border-b border-white/10 hover:bg-white/5 transition">
                                <td class="py-3">#T-7841</td>
                                <td class="py-3">پیشنهاد ویژگی جدید</td>
                                <td class="py-3">
                                    <span class="px-3 py-1 bg-blue-500/30 text-blue-300 rounded-full text-xs">در حال بررسی</span>
                                </td>
                                <td class="py-3 text-sm">۱۴۰۲/۱۱/۱۸</td>
                                <td class="py-3">
                                    <button class="text-indigo-200 hover:text-white transition">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- تیکت نمونه 3 -->
                            <tr class="hover:bg-white/5 transition">
                                <td class="py-3">#T-7839</td>
                                <td class="py-3">مشکل در گزارش‌گیری</td>
                                <td class="py-3">
                                    <span class="px-3 py-1 bg-yellow-500/30 text-yellow-300 rounded-full text-xs">در انتظار پاسخ</span>
                                </td>
                                <td class="py-3 text-sm">۱۴۰۲/۱۱/۱۵</td>
                                <td class="py-3">
                                    <button class="text-indigo-200 hover:text-white transition">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- اگر تیکتی وجود نداشته باشد -->
{{--                    @if(auth()->user()->tickets()->count() === 0)--}}
                        <div class="text-center py-8">
                            <i class="fas fa-ticket-alt text-4xl text-white/30 mb-4"></i>
                            <p class="text-white/70">هنوز تیکتی ثبت نکرده‌اید</p>
                            <p class="text-white/50 text-sm mt-2">برای ایجاد تیکت جدید روی دکمه بالا کلیک کنید</p>
                        </div>
{{--                    @endif--}}
                </div>
            </div>
        </div>

        <!-- تماس با پشتیبانی -->
{{--        <div class="mt-8 bg-white rounded-2xl shadow-lg border border-slate-200 p-6">--}}
{{--            <div class="flex flex-col md:flex-row items-center justify-between">--}}
{{--                <div class="mb-6 md:mb-0 md:ml-8">--}}
{{--                    <h3 class="text-lg font-bold text-slate-800 mb-2">📞 نیاز به کمک فوری دارید؟</h3>--}}
{{--                    <p class="text-slate-600">با پشتیبانی تلفنی ما تماس بگیرید</p>--}}
{{--                </div>--}}
{{--                <div class="flex gap-4">--}}
{{--                    <a href="tel:02112345678"--}}
{{--                       class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-shadow flex items-center">--}}
{{--                        <i class="fas fa-phone ml-2"></i>--}}
{{--                        ۰۲۱-۱۲۳۴۵۶۷۸--}}
{{--                    </a>--}}
{{--                    <a href="mailto:support@taskplanner.ir"--}}
{{--                       class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-shadow flex items-center">--}}
{{--                        <i class="fas fa-envelope ml-2"></i>--}}
{{--                        ایمیل پشتیبانی--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>

<style>
    .hover\:shadow-xl {
        transition: box-shadow 0.3s ease;
    }

    .aspect-video {
        aspect-ratio: 16 / 9;
    }

    table {
        border-collapse: separate;
        border-spacing: 0;
    }

    th, td {
        padding: 12px 16px;
    }
</style>
