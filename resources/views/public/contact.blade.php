<x-guest-layout>
    <div class="bg-gray-100 min-h-screen py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto lg:min-w-[500px]">
            <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                <div class="max-w-md mx-auto">
                    <div class="flex items-center space-x-5">
                        <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                            <h2 class="leading-relaxed">{{__('Contact me')}}</h2>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <form action="{{ route('contact') }}" method="POST">
                                @if(auth()->guest())
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="name">
                                            {{__('Name')}}
                                        </label>
                                        <input type="text" name="name" id="name" class="form-input w-full"
                                               placeholder="John Doe">
                                        @error('name')
                                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="email">
                                            {{__('Email')}}
                                        </label>
                                        <input type="email" name="email" id="email" class="form-input w-full"
                                               placeholder="john@example.com">
                                        @error('email')
                                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif

                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2" for="message">
                                        {{__('Message')}}
                                    </label>
                                    <textarea name="message" id="message" rows="5"
                                              class="form-textarea w-full"></textarea>
                                    @error('message')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mt-6">
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        {{__('Send')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
