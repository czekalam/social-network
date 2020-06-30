@if ($errors->any())
<div class="mc-infobox">
        @foreach ($errors->all() as $error)
            <p class="mc-no-margin">{{ $error }}</p>
        @endforeach
</div>
@endif
@if (Session::has('message'))
    <div class="mc-infobox">
        {{Session::get('message')}}
    </div>
@endif