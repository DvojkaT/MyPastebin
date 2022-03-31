@extends('layouts.main')

@section('title')
    MyPastebin
@endsection

@section('content')
<h1>Создать пасту</h1>

<form action="{{ route('submitpasta') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="pasta">Новая паста</label>
        <textarea rows="10" name="pasta" placeholder="Введите пасту" id="pasta" class="form-control"></textarea>
    </div>
    <div>
    <label for="empty"></label>
    </div>
    <div class ="form-group row">
        <label for="pastaName" class="col-md-1 col-form-label">Имя: </label>
        <div class="col-sm-5">
            <input type="text" placeholder="Введите имя пасты" id="pastaName" class="form-control"></input>
        </div>
    </div>
    <div>
    <label for="empty"></label>
    </div>
    <div class="form-group>
        <label for="button"></label>
        <button type="submit" class="btn btn-primary">Создать пасту</button>
    </div>
</form>

@endsection