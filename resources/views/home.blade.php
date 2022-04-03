@extends('layouts.mainForLogged')

@section('title')
    MyPastebin
@endsection


@section('content')
<h1>Создать пасту</h1>
<form action="{{ route('home') }}" method="post">
    @csrf
    <div class="form-group"> <!--Поле для создания пасты-->
        <label for="code">Новая паста</label>
        <textarea rows="10" name="code" placeholder="Введите пасту" id="code" class="form-control"></textarea>
    </div>
    <div>
    <label for="empty"></label>
    </div>
    <div class ="form-group row"> <!--Поле для ввода имени-->
        <label for="pastename" class="col-md-1 col-form-label">Имя: </label>
        <div class="col-sm-5">
            <input type="text" name="pastename" placeholder="Введите имя пасты" id="pastename" class="form-control"></input>
        </div>
    </div>
    <!--Поле для выбора приватности пасты в случае если пользователь
    зарегестрирован или нет-->
    <div class="col-auto my-1">
      <label class="mr-sm-2" for="">Приватность пасты: </label>
      <select name="permission" class="form-control" id="permission">
        <option value="public" selected>Публичная</option>
        <option value="unlisted">Только по ссылке</option>
        @if(Auth::check())
        <option value="private">Приватная</option>
        @else
        <option value="private" disabled>Приватная</option>
        @endif
      </select>
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