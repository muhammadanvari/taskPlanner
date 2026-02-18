<?php

use App\Models\Ticket;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    #[Computed]
    public function tickets()
    {
        return Ticket::where('user_id', auth()->id() )->where('parent_id',null)->get();
    }

    #[Computed]
    public function ticketCount()
    {
        return Ticket::where('user_id', auth()->id())->where('parent_id',null)->count();
    }
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
        <x-support.widgets/>

        <!-- سوالات متداول -->
{{--        <x-support.fqa/>--}}

        <!-- بخش تیکت ها !-->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-6 text-white">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">🎫 سیستم تیکت پشتیبانی</h2>
                        <p class="text-indigo-100">تیکت‌های خود را مدیریت و پیگیری کنید</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2">
                        <span class="font-bold">{{ $this->ticketCount ?? 0 }}</span>
                        <span class="text-sm mr-2">تیکت </span>
                    </div>
                </div>

                <!-- دکمه ایجاد تیکت جدید -->
                <button
                    class="w-full mb-6 bg-white text-indigo-600 hover:bg-slate-100 font-bold py-3 px-4 rounded-xl transition duration-300 flex items-center justify-center group">
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
                            @foreach($this->tickets as $ticket)
                                <tr class="border-b border-white/10 hover:bg-white/5 transition">
                                    <td class="py-3">{{$ticket->id}}#</td>
                                    <td class="py-3">{{$ticket->subject}}</td>
                                    <td class="py-3">
                                        @if($ticket->status == 'closed')
                                        <span class="px-3 py-1 bg-green-500/30 text-green-300 rounded-full text-xs">پاسخ داده شده</span>
                                        @elseif($ticket->status == 'in_progress')
                                        <span class="px-3 py-1 bg-blue-500/30 text-blue-300 rounded-full text-xs">در حال بررسی</span>
                                        @elseif($ticket->status == 'open')
                                        <span class="px-3 py-1 bg-yellow-500/30 text-yellow-300 rounded-full text-xs">در انتظار پاسخ</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-sm">{{\Morilog\Jalali\Jalalian::fromCarbon($ticket->created_at)->format('Y/m/d')}}</td>
                                    <td class="py-3">
                                        <button class="text-indigo-200 hover:text-white transition">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- اگر تیکتی وجود نداشته باشد -->
                    @if($this->ticketCount === 0)
                        <div class="text-center py-8">
                            <i class="fas fa-ticket-alt text-4xl text-white/30 mb-4"></i>
                            <p class="text-white/70">هنوز تیکتی ثبت نکرده‌اید</p>
                            <p class="text-white/50 text-sm mt-2">برای ایجاد تیکت جدید روی دکمه بالا کلیک کنید</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- تماس با پشتیبانی -->
{{--        <x-support.contact/>--}}
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
