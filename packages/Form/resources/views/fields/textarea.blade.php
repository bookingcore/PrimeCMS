<div class="mb-3">
    @include("primecms/form::label")
    <textarea class="form-control" name="{{$name}}" placeholder="{{$placeholder}}" {{$attrs}}>{{$value}}</textarea>
    @include("primecms/form::error")
</div>
