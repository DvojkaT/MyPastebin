<div class="aside">
    <h4>Публичные пасты</h4>
    @foreach($publicPaste as $data)
            <div class="alert alert-primary">
                <h5><a href="{{route('show', $data->hash)}}">{{ $data->name }}</a></h5>
                <p>{{ $data->created_at }}</p>
            </div>
        @endforeach
    @show
</div>