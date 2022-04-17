@extends('Layouts.mainForLoginAndRegister')

@section('title')
    Регистрация
@endsection

@section('content')
<h1>Регистрация</h1>

@if($errors->any())
<div class="aler alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form action="{{ route('submitregister') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Введите ваше имя</label>
        <input type="name" name="name" placeholder="Имя" id="name" class="form-control" value={{old('name')}}></input>
    <div class="form-group">
        <label for="email">Введите почту</label>
        <input type="email" name="email" placeholder="email" id="email" class="form-control" value={{old('email')}}></input>
    </div>
    <div class ="form-group row">
        <label for="password">Введите пароль: </label>
        <div class="col-sm-5">
            <input type="password" name="password" placeholder="Пароль" id="password" class="form-control"></input>
        </div>
    </div>
    <div>
    <label for="empty"></label>
    </div>
    <div class="form-group>
        <label for="button"></label>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </div>
</form>
@endsection