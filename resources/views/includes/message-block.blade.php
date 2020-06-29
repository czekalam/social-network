@if ($errors->any())
<div class="mc-infobox">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (Session::has('message'))
    <div class="mc-infobox">
        {{Session::get('message')}}
    </div>
@endif