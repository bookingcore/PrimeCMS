<div class="mb-3">
    @include("primecms/form::label")
    <div class="form-check">
        <input
            class="form-check-input" type="checkbox" name="{{$name}}" value="1" @if($value == 1) checked @endif id="{{$id}}"
        >
        <label class="form-check-label" for="{{$id}}">
            {{$label}}
        </label>
    </div>
    @include("primecms/form::error")
</div>
