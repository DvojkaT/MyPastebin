@extends('layouts.main')

@section('title')
    MyPastebin
@endsection

@section('content')
<h1>Создать пасту</h1>

<form action="{{ route('home') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="code">Новая паста</label>
        <textarea rows="10" name="code" placeholder="Введите пасту" id="code" class="form-control">{{ optional($paste ?? null)->code }}</textarea>
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