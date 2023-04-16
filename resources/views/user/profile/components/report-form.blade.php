@if (auth()->id() !== $user->getId())
    <div class="m-3">
        <div class="mt-3">
            <form id="reportForm" class="hidden" method="POST" action="{{route('report.user')}}">
                @csrf
                <input type="hidden" name="reported_user_id" value="{{$user->getId()}}">
                <textarea required
                          rows="5"
                          class="form-textarea w-full"
                          name="report_content"
                          placeholder="{{__('Report reason')}}"></textarea>
                <button type="submit"
                        class="w-full block text-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    {{__('Report user')}}
                </button>
            </form>
        </div>
    </div>
@endif

@push('javascript')
    <script>
        $('#showReportForm').click(function () {
            $('#reportForm').toggle();
        });
    </script>
@endpush
