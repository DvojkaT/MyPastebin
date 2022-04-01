<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">abobus pastebin</span>
      </a>

      <ul class="nav nav-pills">
        @if(Auth::check())
        <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Вход</a></li>
        <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Регистрация</a></li>
        @else
        <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Выход</a></li>
        @endif
        <li class="nav-item"><a href="{{route('home')}}" class="nav-link active" aria-current="page">Создать пасту</a></li>
      </ul>
    </header>