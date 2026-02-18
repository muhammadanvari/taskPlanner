@extends('admin.layout.app')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 md:p-8">
        <div class="w-full max-w-2xl mx-auto">
            <div class="flex items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 ml-4">پاسخ به تیکت</h2>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                <form action="{{ route('admin.ticket.update', $ticket) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @if ($errors->any())
                        <div class="bg-red-100 border-r-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle ml-2"></i>
                                <span class="font-bold">خطا:</span>
                            </div>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="title" class="block text-gray-700 text-sm font-semibold mb-2">موضوع تیکت</label>
                        <input type="text" id="title" value="{{ $ticket->subject }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-600 cursor-not-allowed focus:outline-none"
                               readonly>
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 text-sm font-semibold mb-2">متن پیام کاربر</label>
                        <textarea id="message" rows="4"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-600 cursor-not-allowed focus:outline-none"
                                  readonly>{{ $ticket->message }}</textarea>
                    </div>

                    <hr class="my-6 border-gray-200">
                    @if($ticket->replies())
                        @foreach($ticket->replies as $reply)
                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 text-sm font-semibold mb-2">پاسخ</label>
                                <textarea id="message" rows="4"
                                          class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-600 cursor-not-allowed focus:outline-none"
                                          readonly>{{ $reply->message }}</textarea>
                            </div>
                        @endforeach
                    @else
                        <div class="mb-6">
                            <label for="reply" class="block text-gray-900 text-sm font-bold mb-2">پاسخ شما <span class="text-red-500">*</span></label>
                            <textarea id="reply" name="reply" rows="6"
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200"
                                      placeholder="متن پاسخ خود را اینجا بنویسید..." required></textarea>
                        </div>

                        <div class="flex justify-between space-x-4 space-x-reverse mt-8">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg transition-colors duration-200 flex items-center">
                                <i class="fas fa-reply ml-2"></i> ارسال پاسخ
                            </button>

                            <a href="{{ route('admin.ticket.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-3 px-8 rounded-full transition-colors duration-200 flex items-center">
                                <i class="fas fa-arrow-right ml-2"></i> بازگشت
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </main>
@endsection
