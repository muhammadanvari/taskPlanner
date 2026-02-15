@props(['activeTab', 'activeCategoryId', 'counts', 'categories', 'innerSidebarOpen'])
<aside

    class="bg-slate-50 border-l border-slate-200 flex flex-col transition-all duration-300 ease-in-out flex-shrink-0"
    :class="innerSidebarOpen ? 'w-64' : 'w-0 overflow-hidden opacity-0'">

    <div class="p-4 flex items-center justify-between">
        <h2 class="font-bold text-slate-700 text-sm">فیلترها</h2>
        <button @click="innerSidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="px-3 space-y-1 overflow-y-auto flex-1 custom-scrollbar">
        <div wire:click="setTab('all')"
             class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition cursor-pointer select-none
                 {{ $activeTab === 'all' ? 'bg-indigo-100 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">
            <i class="fas fa-inbox w-5 text-center"></i>
            <span class="flex-1">همه تسک‌ها</span>
            <span
                class="text-xs font-bold px-2 py-0.5 rounded {{ $activeTab === 'all' ? 'bg-white/60 text-indigo-600' : 'text-slate-400' }}">
                    {{ $this->counts['all'] }}
                </span>
        </div>

        <div wire:click="setTab('today')"
             class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition cursor-pointer select-none
                 {{ $activeTab === 'today' ? 'bg-indigo-100 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">
            <i class="fas fa-sun w-5 text-center text-amber-500"></i>
            <span class="flex-1">امروز</span>
            <span
                class="text-xs px-2 py-0.5 rounded {{ $activeTab === 'today' ? 'text-indigo-600' : 'text-slate-400' }}">
                    {{ $this->counts['today'] }}
                </span>
        </div>

        <div wire:click="setTab('week')"
             class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition cursor-pointer select-none
                 {{ $activeTab === 'week' ? 'bg-indigo-100 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">
            <i class="fas fa-calendar-week w-5 text-center text-purple-500"></i>
            <span class="flex-1">هفته جاری</span>
            <span
                class="text-xs px-2 py-0.5 rounded {{ $activeTab === 'week' ? 'text-indigo-600' : 'text-slate-400' }}">
                    {{ $this->counts['week'] }}
                </span>
        </div>

        <div class="border-t border-slate-200 my-4 mx-2"></div>

        <div class="flex justify-between items-center px-3 mb-2 group">
            <span class="text-xs font-bold text-slate-400 uppercase">دسته‌بندی‌های من</span>

            <button
                wire:click="$dispatchTo('category-modal', 'open-modal')"
                class="text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 w-6 h-6 flex items-center justify-center rounded transition-all cursor-pointer"
                title="افزودن دسته‌بندی جدید">
                <i class="fas fa-plus text-xs"></i>
            </button>
        </div>

        @foreach($this->categories as $category)
            <div wire:click="setTab('category', {{ $category->id }})"
                 class="group relative flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all cursor-pointer select-none
     {{ $activeTab === 'category' && $activeCategoryId === $category->id ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}">

    <span class="w-2.5 h-2.5 rounded-full shadow-sm shrink-0"
          style="background-color: {{ $colorsMap[$category->color] ?? '#cbd5e1' }}">
    </span>

                <span class="flex-1 truncate pl-14">{{-- پدینگ چپ برای اینکه متن زیر دکمه‌ها نرود --}} {{$category->name}}</span>

                <div class="absolute left-2 flex items-center gap-1 transition-opacity duration-200 pl-1 bg-inherit
                opacity-100 md:opacity-0 md:group-hover:opacity-100">

                    <button wire:click="$dispatchTo('category-modal','open-modal', { category: {{ $category->id }} })"
                            class="p-1 text-slate-400 hover:text-indigo-600 hover:bg-indigo-100 rounded-md transition-colors"
                            title="ویرایش">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>

                    <button wire:click.stop="deleteCategory({{ $category->id }})"
                            wire:confirm="آیا از حذف این دسته‌بندی مطمئن هستید؟"
                            class="p-1 text-slate-400 hover:text-red-600 hover:bg-red-100 rounded-md transition-colors"
                            title="حذف">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </nav>
</aside>
