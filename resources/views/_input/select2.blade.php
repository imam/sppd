<select name="{{$name or null}}" class="form-control" data-placeholder="{{$placeholder or null}}" data-plugin="select2">
    <option value=""></option>
    @if(isset($data))
        @foreach($data as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
        @endforeach
    @endif
</select>