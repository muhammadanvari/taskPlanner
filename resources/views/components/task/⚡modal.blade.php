<?php

use App\Models\Category;
use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Morilog\Jalali\Jalalian;

new class extends Component {
    public $showModal = false;
    public $id ;
    public $title;
    public $category_id;
    public $description;
    public $date;
    public $time;

    #[On('show')]
    public function show(Task $task)
    {
        $this->showModal = true;
        $this->title = $task->title;
        $this->id = $task->id;
        $this->category_id = $task->category_id;
        $this->description = $task->description;
        $this->date = Jalalian::fromDateTime($task->due_date)->format('Y/m/d');
        $this->time = $task->time;
    }

    #[Computed]
    public function category()
    {
        if (!$this->category_id) {
            return null;
        }
        return Category::find($this->category_id);
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function deleteTask($taskId)
    {
        Task::where('id', $taskId)->where('user_id', auth()->id())->delete();
        $this->close();
        $this->dispatch('refresh');
    }
};
?>

<div wire:cloak wire:show="showModal" wire:click.self="close"
     class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center backdrop-blur-sm transition-opacity"
>
    <div
        class="bg-white w-full max-w-lg rounded-[2rem] shadow-2xl shadow-indigo-200/50 overflow-visible border border-slate-100 relative font-sans transform transition-all"
    >
        {{-- Header --}}
        <div class="bg-slate-800 px-6 py-5 text-white flex justify-between items-center rounded-t-[2rem]">
            <div>
                <h2 class="text-lg font-bold">{{ $this->title }}</h2>
                <p class="text-indigo-100 text-xs mt-0.5">{{ $this->category?->name ?? '' }}</p>
            </div>
            <button wire:click="close"
                class="bg-white/20 hover:bg-white/30 w-8 h-8 rounded-full flex items-center justify-center transition cursor-pointer text-sm">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form>
            <div class="p-6 space-y-5">
                {{-- Title Input --}}
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-400 mr-2 uppercase">توضیحات </label>
                    <textarea type="text" readonly
                              placeholder="بدون توضیحات"
                              class="w-full bg-slate-50 border border-slate-100 focus:border-indigo-500 focus:bg-white
                           focus:ring-1 focus:ring-indigo-500 rounded-xl px-4 py-3 outline-none transition text-sm font-medium
                           shadow-sm placeholder-slate-400">{{ $this->description }}</textarea>
                    <span class="text-red-500 text-[10px] mr-2"></span>
                </div>

                {{-- Category & Date Row --}}
                <div class="grid grid-cols-2 gap-3">
                    {{-- Date Picker --}}
                    <div class="space-y-1.5 relative">
                        <label class="text-[10px] font-bold text-slate-400 mr-2 uppercase">تاریخ</label>
                        <div class="relative cursor-pointer">
                            <div
                                class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fas fa-calendar-day text-xs"></i>
                            </div>
                            <input type="text" readonly value="{{ $this->date }}"
                                   class="w-full bg-slate-50 border border-slate-100 hover:border-indigo-300 focus:border-indigo-500 cursor-pointer rounded-xl pr-9 pl-3 py-3 text-sm text-slate-700 font-bold outline-none transition shadow-sm placeholder-slate-400">
                        </div>
                    </div>
                    <div class="space-y-1.5 relative">
                        <label class="text-[10px] font-bold text-slate-400 mr-2 uppercase">ساعت</label>
                        <div class="relative">
                            <input type="time" readonly value="{{ $this->time ?? '' }}"
                                   class="w-full bg-slate-50 border border-slate-100 hover:border-indigo-300 focus:border-indigo-500 focus:bg-white rounded-xl px-3 py-3 text-sm text-slate-700 font-medium outline-none transition shadow-sm placeholder-slate-400 ltr-input">
                            <div
                                class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <i class="far fa-clock text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Buttons --}}
            <div class="px-6 pb-6 bg-slate-50 flex gap-3 rounded-b-[2rem] pt-4 border-t border-slate-100">
                <button type="button"
                        wire:click="deleteTask({{$this->id}})"
                        wire:confirm="آیا از حذف این تسک اطمینان دارید؟"
                        class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-2xl transition-all
                        active:scale-95 text-sm flex items-center justify-center gap-2 shadow-md shadow-red-200 cursor-pointer">
                    <i class="fas fa-trash-alt text-xs"></i>
                    حذف
                </button>
                <a href="{{ route('task.form',['id'=>$this->id]) }}" wire:navigate
                   class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-2xl transition-all text-sm text-center">
                        ویرایش
                </a>
            </div>
        </form>
    </div>

    <style>
        input[type="time"]::-webkit-calendar-picker-indicator {
            background: transparent;
            bottom: 0;
            color: transparent;
            cursor: pointer;
            height: auto;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: auto;
        }

        .ltr-input {
            direction: ltr;
            text-align: right;
        }
    </style>
</div>

