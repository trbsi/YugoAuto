<div>
    {{__('Leave rating')}}
</div>
<form class="rating" method="POST" action="{{route('rating.save')}}">
    @csrf
    <input type="hidden" name="ride_id" value="{{$rideId}}">
    <div>
        <label>
            <input type="radio" name="stars" value="1"/>
            <span class="icon">★</span>
        </label>
        <label>
            <input type="radio" name="stars" value="2"/>
            <span class="icon">★</span>
            <span class="icon">★</span>
        </label>
        <label>
            <input type="radio" name="stars" value="3"/>
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
        </label>
        <label>
            <input type="radio" name="stars" value="4"/>
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
        </label>
        <label>
            <input type="radio" name="stars" value="5"/>
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
        </label>
    </div>
    <div>
        <label for="comment">
        <textarea
            name="comment"
            class="resize-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
            rows="3" placeholder="{{__('Rating comment (not required)...')}}"></textarea>
        </label>
    </div>
    <div>
        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            {{__('Send')}}
        </button>
    </div>

</form>
