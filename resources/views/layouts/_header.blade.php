<nav class="navbar navbar-expand-lg bg-body-tertiary shadow py-3 mb-3 sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">SkaydiLaravel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('about') }}">about</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('contact') }}">contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('computers.index') }}">Blogs</a>
                </li>

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                        <a id="" class="nav-link" href="{{route('user.profile')}}" role="button"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ Storage::url(Auth::user()->profileImg) }}" alt="" width="25px"
                                srcset="" class="me-1 rounded-pill border border-black">
                            {{ Auth::user()->name }}
                        </a>

                        
                @endguest
            </ul>
            <form class="d-flex" role="search" method="get" action="{{ url('computers/search') }}">
                <input name="q" id="s" value="{{ isset($search) ? $search : null }}"
                    class="form-control me-2" type="search" placeholder="Search by Name or Origin" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
