<?php

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

new class extends Component {

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|min:3',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'name.required' => 'لطفا نام خود را وارد کنید.',
            'password.confirmed' => 'رمز عبور با تکرار آن مطابقت ندارد.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
        ]);

        $data = ['name' => $this->name];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        auth()->user()->update($data);

        $this->reset(['password', 'password_confirmation']);

        session()->flash('message', 'تغییرات با موفقیت ذخیره شد .');

        return redirect(request()->header('Referer'));
    }
};
?>

<div class="w-full p-4 md:p-6 flex flex-col gap-6 bg-[#f8fafc] lg:h-full lg:overflow-hidden">

{{--    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 shrink-0">--}}
{{--        <div>--}}
{{--            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">تنظیمات حساب کاربری</h1>--}}
{{--            <p class="text-sm text-slate-500 mt-1">مدیریت اطلاعات شخصی و امنیتی</p>--}}
{{--        </div>--}}
{{--        <div class="self-start md:self-center flex items-center gap-2 bg-white text-indigo-700 px-4 py-2 rounded-full border border-indigo-100 shadow-sm">--}}
{{--            <i class="fas fa-crown text-yellow-500 animate-pulse"></i>--}}
{{--            <span class="font-bold text-xs md:text-sm">پلن: رایگان</span>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="flex-1 grid grid-cols-1 lg:grid-cols-12 gap-6 lg:min-h-0 relative pb-20 lg:pb-0">

        <div class="lg:col-span-8 bg-white rounded-[2rem] border border-slate-100 shadow-sm p-5 md:p-8 flex flex-col lg:h-full">

            <form wire:submit.prevent="updateProfile" class="flex-1 flex flex-col h-full">

                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3 pb-3 border-b border-slate-50">
                        <span class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-sm">
                            <i class="fas fa-user-cog"></i>
                        </span>
                        اطلاعات پایه
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-600">نام کامل</label>
                            <div class="relative flex items-center">
                                <i class="fas fa-user absolute right-4 text-slate-400"></i>
                                <input type="text" wire:model="name"
                                       class="w-full pr-12 pl-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none font-medium text-slate-700">
                            </div>
                            @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-600">آدرس ایمیل (غیرقابل تغییر)</label>
                            <div class="relative flex items-center">
                                <i class="fas fa-envelope absolute right-4 text-slate-400 opacity-50"></i>
                                <input type="email" disabled value="{{$email}}"
                                       class="w-full pr-12 pl-4 py-3.5 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 font-medium cursor-not-allowed select-none">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-1">
                    <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3 pb-3 border-b border-slate-50">
                        <span class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-sm">
                            <i class="fas fa-shield-alt"></i>
                        </span>
                        امنیت و رمز عبور
                    </h2>
                    <div class="bg-indigo-50/50 rounded-2xl p-5 border border-indigo-100/50">
                        <p class="text-sm text-indigo-700 mb-4 flex items-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            فقط در صورتی که قصد تغییر رمز عبور را دارید، فیلدهای زیر را پر کنید.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <input type="password" wire:model="password"
                                       class="w-full px-4 py-3.5 bg-white border border-slate-200 focus:border-indigo-500 rounded-xl focus:ring-2 focus:ring-indigo-500/20 transition-all outline-none text-sm placeholder:text-slate-400"
                                       placeholder="رمز عبور جدید...">
                            </div>
                            <div>
                                <input type="password" wire:model="password_confirmation"
                                       class="w-full px-4 py-3.5 bg-white border border-slate-200 focus:border-indigo-500 rounded-xl focus:ring-2 focus:ring-indigo-500/20 transition-all outline-none text-sm placeholder:text-slate-400"
                                       placeholder="تکرار رمز عبور جدید...">
                            </div>
                        </div>
                        @error('password') <span class="text-red-500 text-xs mt-2 block bg-red-50 p-2 rounded">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="pt-6 mt-8 shrink-0 border-t border-slate-50 flex justify-end">
                    <button type="submit" wire:loading.attr="disabled"
                            class="w-full md:w-auto flex items-center justify-center gap-3 bg-slate-900 hover:bg-indigo-700 text-white px-8 py-4 md:py-3 rounded-xl font-bold transition-all duration-300 shadow-md hover:shadow-indigo-600/20 active:scale-95 disabled:opacity-70 text-sm md:text-base">
                        <span wire:loading.remove class="flex items-center gap-2">
                             <i class="fas fa-save"></i>
                             ذخیره تغییرات
                        </span>
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                             در حال پردازش...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-4 relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-slate-900 to-indigo-900 text-white shadow-xl p-6 md:p-8 flex flex-col justify-between min-h-[300px] lg:h-full">

            <div class="absolute top-0 right-0 w-full h-full overflow-hidden pointer-events-none opacity-50">
                <div class="absolute -top-1/2 -right-1/2 w-full h-full bg-gradient-to-br from-indigo-500/30 to-purple-500/30 blur-3xl rounded-full mix-blend-overlay animate-pulse-slow"></div>
                <i class="fas fa-rocket absolute top-10 left-10 text-white/5 text-8xl transform -rotate-12"></i>
            </div>

            <div class="relative z-10 flex flex-col h-full justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 bg-indigo-500/20 px-3 py-1.5 rounded-lg text-indigo-200 text-sm font-medium mb-4 border border-indigo-500/30">
                        <i class="fas fa-star text-yellow-400"></i> پیشنهاد ویژه
                    </div>
                    <h2 class="text-2xl md:text-3xl font-black mb-3 tracking-tight leading-tight">
                        ارتقا به <span class="text-indigo-300">نسخه حرفه‌ای</span>
                    </h2>
                    <p class="text-indigo-100 text-sm leading-relaxed opacity-90 mb-6">
                        با حذف محدودیت‌ها، پتانسیل واقعی خود را آزاد کنید و بهره‌وری را به حداکثر برسانید.
                    </p>

                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center gap-3 text-sm font-medium text-indigo-50 bg-white/5 p-2 rounded-lg">
                            <i class="fas fa-check-circle text-green-400"></i>
                            <span>تسک و پروژه‌های نامحدود</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm font-medium text-indigo-50 bg-white/5 p-2 rounded-lg">
                            <i class="fas fa-check-circle text-green-400"></i>
                            <span>یادآور پیامکی و ایمیلی</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-md border border-white/10 group hover:bg-white/15 transition-all cursor-pointer">
                    <div class="flex items-end gap-2 mb-4">
                        <span class="text-3xl md:text-4xl font-black text-white">۴۹,۰۰۰</span>
                        <span class="text-indigo-200 text-xs md:text-sm mb-1.5 opacity-80">تومان / ماهانه</span>
                    </div>
                    <button class="w-full py-3.5 bg-white text-slate-900 rounded-xl font-black text-base hover:bg-indigo-50 transition-all duration-300 shadow-xl flex items-center justify-center gap-2 active:scale-95">
                        ارتقا حساب کاربری <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
