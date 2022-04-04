@extends('layouts.mainForLogged')

@section('title')
{{$data->name}}
@endsection

@section('content')
<h3>{{$data->name}}</h3>
<div class="form-group">
        <pre><code class="hljs {{ $hcode->language }}">{!! $hcode->value !!}{{ $data->code }}</code></pre>
    </div>
@endsection