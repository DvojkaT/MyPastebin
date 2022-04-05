@extends('layouts.mainForMyPastes')

@section('title')
Мои пасты
@endsection

@section('content')
<h4>Мои пасты:</h4>
         @foreach($paste as $data)
            <div class="alert alert-info">
                <h3><a href="{{route('show', $data->hash)}}">{{ $data->name }}</a></h3>
                <p>{{ $data->created_at }}</p>
            </div>
        @endforeach
    {{$paste->links()}}
@endsection