<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('home')}}">nCord</a>
      <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('home')}}">Explore</a>
          </li>
          @auth 
          <li class="nav-item">
            <a class="nav-link" href="{{ route('torrent.upload') }}">Upload</a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.details', Auth::user())}}">MyProfile</a>
            </li>
          @endauth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown01">
                @foreach ($main_categories as $cat)
                <li><a class="dropdown-item" href="{{route('category.details', $cat)}}">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
          </li>
        </ul>
        <div class="d-flex mb-2 mb-lg-0 badge">
        @auth
        <span class="me-3">
          <p class="fs-5">
            {{ Auth::user()->name }}
          </p>
        </span>
        <form action="{{ route('auth.logout') }}" method="POST">
          @csrf
          <button class="btn btn-sm btn-secondary" type="submit">
            {{ __('Sign out') }}
          </button>
        </form>
          @else
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('auth.login') }}">
            {{ __('Sign in') }}
        </a>
        <a class="btn btn-sm btn-success ms-2" href="{{ route('auth.register') }}">
            {{ __('Sign up') }}
        </a>
          @endauth
        </div>
        <form class="d-flex" action="{{ route('torrent.search')}}" method="GET">
            @csrf
          <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  

  
  <main class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white bg-secondary rounded shadow-sm">
      <img class="me-3" src="{{ asset('assets/brand/letter-n.png')}}" alt="" width="48" height="48">
      <div class="lh-1">
        <h1 class="h6 mb-0 text-white lh-1">nCord</h1>
        <small>Unlimited source of fun</small>
      </div>
    </div>
  </main>