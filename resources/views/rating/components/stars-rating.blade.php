<div>
    {{__('Rating')}}
</div>
<div class="rating">
    <label>
        @for($i = 1; $i <= $rating; $i++)
            <span class="icon rating-rated">★</span>
        @endfor

        @for($i = 5; $i > $rating; $i--)
            <span class="icon">★</span>
        @endfor
    </label>
</div>
@if($comment)
    <div>
        <i>"{{$comment}}"</i>
    </div>
@endif
