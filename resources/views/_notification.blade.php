@if(Session::get($session_name) ===true)
    <div class="alert dark alert-primary alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        {{$text}}
    </div>
@endif