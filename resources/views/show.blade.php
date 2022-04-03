@extends('layouts.mainForLogged')

@section('title')
show
@endsection

@section('content')
<h3>{{$data->name}}</h3>
<div class="form-group">
        <textarea rows="10" name="code" id="code" class="form-control">{{ $data->code }}</textarea>
    </div>
@endsection