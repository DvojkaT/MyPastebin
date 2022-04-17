@extends('Layouts.mainForLogged')

@section('title')
    MyPastebin
@endsection


@section('content')
<h1>Создать пасту</h1>
{{-- Блок с ошибками --}}
@if($errors->any())
<div class="aler alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{{-- Блок для сообщений --}}
@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<form action="{{ route('home') }}" method="post">
    @csrf
    <div class="form-group"> <!--Поле для создания пасты-->
        <label for="code">Новая паста</label>
        <textarea rows="10" name="code" placeholder="Введите пасту" id="code" class="form-control">{{old('code')}}</textarea>
    </div>
    <div>
    <label for="empty"></label>
    </div>
    <div class ="form-group row"> <!--Поле для ввода имени-->
        <label for="pastename" class="col-md-1 col-form-label">Имя: </label>
        <div class="col-sm-5">
            <input type="text" name="pastename" placeholder="Введите имя пасты" id="pastename" class="form-control" value={{old('pastename')}}></input>
        </div>
    </div>
    {{-- Поле для выбора приватности пасты в случае если пользователь
    зарегестрирован или нет --}}
    <div class="col-auto my-1">
      <label class="mr-sm-2" for="">Приватность пасты: </label>
      <select name="permission" class="form-control" id="permission">
        <option value="public" {{ old('permission') == 'public' ? 'selected' : '' }}>Публичная</option>
        <option value="unlisted" {{ old('permission') == 'unlisted' ? 'selected' : '' }}>Только по ссылке</option>
        @if(Auth::check())
        <option value="private" {{ old('permission') == 'private' ? 'selected' : '' }}>Приватная</option>
        @else
        <option value="private" disabled>Приватная</option>
        @endif
      </select>
    </div>
    <div class="col-auto my-1">
      <label class="mr-sm-2" for="">Срок жизни пасты: </label>
      <select name="expiration_date" class="form-control" id="expiration_date">
        <option value="1" {{ old('expiration_date') == '1' ? 'selected' : '' }}>1 минута</option>
        <option value="10" {{ old('expiration_date') == '10' ? 'selected' : '' }}>10 минут</option>
        <option value="60" {{ old('expiration_date') == '60' ? 'selected' : '' }}>1 час</option>
        <option value="180" {{ old('expiration_date') == '180' ? 'selected' : '' }}>3 часа</option>
        <option value="1440" {{ old('expiration_date') == '1440' ? 'selected' : '' }}>1 день</option>
        <option value="10080" {{ old('expiration_date') == '10080' ? 'selected' : '' }}>1 неделя</option>
        <option value="43200" {{ old('expiration_date') == '43200' ? 'selected' : '' }}>1 месяц</option>
        <option value="" {{ old('expiration_date') == '' ? 'selected' : '' }}>Без ограничения</option>
      </select>
    </div>
    <div class="col-auto my-1">
      <label class="mr-sm-2" for="">Язык пасты: </label>
      <select name="language" class="form-control" id="language">
        <option value="" {{ old('language') == '' ? 'selected' : '' }}>(необязательно)</option>
        <option value="php" {{ old('language') == 'php' ? 'selected' : '' }}>PHP</option>
        <option value="python" {{ old('language') == 'python' ? 'selected' : '' }}>Python</option>
        <option value="java" {{ old('language') == 'java' ? 'selected' : '' }}>Java</option>
        <option value="c++" {{ old('language') == 'c++' ? 'selected' : '' }}>C++</option>
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