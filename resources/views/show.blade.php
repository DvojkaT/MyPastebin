@extends('layouts.main')

@section('title')
show
@endsection

@section('content')
<div class="form-group">
        <textarea rows="10" name="code" id="code" class="form-control">{{ $data->code }}</textarea>
    </div>
@endsection