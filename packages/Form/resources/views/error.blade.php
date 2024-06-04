@if($errors && $errors->has($name))
    <div class="invalid-feedback">
        @foreach($errors->get($name) as $message)
            {{$message}}
        @endforeach
    </div>
@endif
