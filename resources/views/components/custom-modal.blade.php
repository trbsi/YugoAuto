<div class="hidden fixed z-10 inset-0 overflow-y-auto custom-modal-{{$modalClass}}">
    <div class="flex items-center justify-center min-h-screen px-4 pt-6 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
        <!-- Modal content -->
        <div
            class="inline-block overflow-hidden text-left align-bottom bg-white rounded-lg shadow-xl transform transition-all sm:my-8 sm:align-middle w-full sm:max-w-xl lg:max-w-3xl md:max-w-xl">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal header -->
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h1 class="mb-5 text-3xl leading-6 font-medium text-gray-900">{{$title}}</h1>
                    <hr>
                    <div class="mt-2">
                        <p class="text-sm leading-5 text-gray-500">{{$content}}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full gap-4 rounded-md shadow-sm">
                    @if(isset($link))
                        <a href="{{$link->attributes['url']}}"
                           class="custom-modal-button-{{$modalClass}} inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            {{$link->attributes['linkText']}}
                        </a>
                    @endif
                    <button type="button"
                            class="custom-modal-button-{{$modalClass}} inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        {{__($buttonText ?? 'OK')}}
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>
