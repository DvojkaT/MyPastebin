@extends('layouts.mainForLogged')

@section('title')
    MyPastebin
@endsection


@section('content')
<h1>Создать пасту</h1>

@if($errors->any())
<div class="aler alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

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
    <div class="col-auto my-1">
      <label class="mr-sm-2" for="">Срок жизни пасты: </label>
      <select name="expiration_date" class="form-control" id="expiration_date">
        <option value="10" selected>10 минут</option>
        <option value="1">1 минута</option>
        <option value="60">1 час</option>
        <option value="180">3 часа</option>
        <option value="1440">1 день</option>
        <option value="10080">1 неделя</option>
        <option value="43200">1 месяц</option>
        <option value="">Без ограничения</option>
      </select>
    </div>
    <div class="col-auto my-1">
      <label class="mr-sm-2" for="">Язык пасты: </label>
      <select name="language" class="form-control" id="language">
        <option value="" selected>(необязательно)</option>
        <option value="php">PHP</option>
        <option value="python">Python</option>
        <option value="java">Java</option>
        <option value="c++">C++</option>
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