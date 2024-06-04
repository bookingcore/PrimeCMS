<div class="mb-3">
    @include("primecms/form::label")
    <input type="{{$inputType}}" value="{{$value}}" class="form-control" name="{{$name}}" placeholder="{{$placeholder}}" {{$attrs}}>
    @include("primecms/form::error")
</div>
