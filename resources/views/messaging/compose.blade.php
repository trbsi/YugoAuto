<div class="bg-gray-100 min-h-screen py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
            <div class="max-w-md mx-auto">
                <div class="flex items-center space-x-5">
                    <div
                        class="h-14 w-14 bg-indigo-200 rounded-full flex flex-shrink-0 justify-center items-center text-indigo-500 text-2xl font-mono">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                        <h2 class="leading-relaxed">Compose New Message</h2>
                        <p class="text-sm text-gray-500 font-normal leading-relaxed">Send a message to one of your
                            contacts.</p>
                    </div>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <form action="{{ route('messages.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="recipient_id">
                                    To:
                                </label>
                                <select name="recipient_id" id="recipient_id" class="form-select block w-full mt-1">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('recipient_id')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="content">
                                    Message:
                                </label>
                                <textarea name="content" id="content" rows="5" class="form-textarea w-full"></textarea>
                                @error('content')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mt-6">
                                <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Send
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
