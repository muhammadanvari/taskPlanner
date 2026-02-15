<div
    x-data="{
        show: false,
        message: '',
        type: 'success', // success, error, info
        init() {
            // ۱. بررسی پیام سشن (برای وقتی که صفحه رفرش یا ریدایرکت شده)
            @if(session()->has('message'))
                this.message = '{{ session('message') }}';
                this.show = true;
                this.hideAfterTimeout();
            @endif
        },
        hideAfterTimeout() {
            setTimeout(() => {
                this.show = false;
            }, 3000);
        }
    }"

// ۲. گوش دادن به ایونت لایو وایر (برای وقتی که صفحه رفرش نمی‌شود)
x-on:flash.window="
message = $event.detail.message;
show = true;
hideAfterTimeout();
"

x-show="show"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 translate-y-full"
x-transition:enter-end="opacity-100 translate-y-0"
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100 translate-y-0"
x-transition:leave-end="opacity-0 translate-y-full"

class="fixed top-8 left-1/2 -translate-x-1/2 z-50 flex items-center gap-3 bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-2xl shadow-slate-900/30 min-w-[300px]"
style="display: none;"
>
<div class="flex items-center justify-center w-8 h-8 rounded-full bg-green-500/20 text-green-400">
    <i class="fas fa-check"></i>
</div>

<div class="flex flex-col">
    <span class="font-bold text-sm">عملیات موفق</span>
    <span class="text-xs text-slate-300" x-text="message"></span>
</div>

<button @click="show = false" class="mr-auto text-slate-500 hover:text-white transition-colors">
    <i class="fas fa-times"></i>
</button>
</div>
