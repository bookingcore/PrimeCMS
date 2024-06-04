<div class="mb-3">
    @include("primecms/form::label")
    @foreach($options as $k=>$item)
        <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox"
                name="{{$name}}[]"
                value="{{$item['id']}}"
                @if(is_array($value) and in_array($item['id'],$value)) checked
                @endif id="{{$id}}_{{$k}}"
            >
            <label class="form-check-label" for="{{$id}}_{{$k}}">
                {{$item['text']}}
            </label>
        </div>
    @endforeach
    @include("primecms/form::error")
</div>
