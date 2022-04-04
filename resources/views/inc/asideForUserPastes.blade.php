<div class="aside">
    <h4>Ваши пасты</h4>
    @foreach($privatePaste as $datapaste)
            <div class="alert alert-primary">
                <h5><a href="{{route('show', $datapaste->hash)}}">{{ $datapaste->name }}</a></h5>
                <p>{{ $datapaste->created_at }}</p>
            </div>
        @endforeach
</div>