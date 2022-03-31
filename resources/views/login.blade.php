@extends('layouts.main')

@section('title')
    Вход
@endsection

@section('content')
<h1>Вход</h1>

<form action="{{ route('submitlogin') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="email">Введите почту</label>
        <input type="email" placeholder="email" id="email" class="form-control"></input>
    </div>
    <div class ="form-group row">
        <label for="password">Введите пароль: </label>
        <div class="col-sm-5">
            <input type="password" placeholder="Пароль" id="password" class="form-control"></input>
        </div>
    </div>
    <div>
    <label for="empty"></label>
    </div>
    <div class="form-group>
        <label for="button"></label>
        <button type="submit" class="btn btn-primary">Войти</button>
    </div>
</form>

@endsection