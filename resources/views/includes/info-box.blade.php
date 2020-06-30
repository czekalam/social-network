@if (Session::has('info'))
    <div class="info-box">
        User what to be your friend. Do you want it too?
        {{Session::get('info')}}
    </div>
@endif