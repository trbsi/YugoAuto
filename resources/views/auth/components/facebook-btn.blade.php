@if(env('FACEBOOK_APP_ID'))
    <div class="mt-4 w-full">
        <a href="{{route('social_login.redirect', ['driver' => 'facebook'])}}" title="Facebook"
           class="block w-full text-center bg-blue-700 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
            {{__('Login or Register with')}} Facebook
        </a>
    </div>
@endif
