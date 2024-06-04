<div class="mb-3">
    @include("primecms/form::label")
    <select class="form-select" @if($isMultiple) multiple @endif name="{{$name.($isMultiple ? '[]' : '')}}" {{$attrs}}>
        @if($placeholder)
            <option value="">{{$placeholder}}</option>
        @endif
        @foreach($options as $item)
            <option
                @if(($isMultiple and is_array($value) and in_array($item['id'],$value)) || (!$isMultiple and $value == $item['id'])) selected
                @endif value="{{$item['id']}}"
            >
                {{$item['text']}}
            </option>
        @endforeach
    </select>
    @include("primecms/form::error")
</div>
