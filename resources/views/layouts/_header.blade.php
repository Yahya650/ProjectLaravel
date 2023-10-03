<style>
    /* Styles for the suggestion dropdown */
    #suggestions {
        /* display: none; */
        position: absolute;
        width: 100%;
        top: 40px;
        background-color: #f1f1f1;
        max-height: 150px;
        overflow-y: auto;
        border: 1px solid #ccc;
    }

    #suggestions ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #suggestions li {
        padding: 8px;
        cursor: pointer;
    }

    #suggestions li:hover {
        background-color: #ddd;
    }

    #formSearch {
        position: relative;
    }

    #suggestions{
        
    }

    /* start style input search */
</style>
<nav style="backdrop-filter: blur(30px) !important;" class="navbar navbar-expand-lg shadow py-3 mb-3 sticky-top">
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
                    <a id="" class="nav-link" href="{{ route('user.profile') }}" role="button"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{ Storage::url(Auth::user()->profileImg) }}" alt="" width="25px"
                            srcset="" class="me-1 rounded-pill border border-black">
                        {{ Auth::user()->name }}
                    </a>


                @endguest
            </ul>


        </div>
        <form class="d-flex" role="search" method="get" action="{{ url('computers/search') }}" id="formSearch">
            <input autocomplete="off" name="q" id="s" value="{{ isset($search) ? $search : null }}"
                class="form-control me-2" type="search" placeholder="Search by Title" aria-label="Search">
            <div id="suggestions" class="d-none">
                {{-- loading page --}}
                <main id="loadingCircl" style="display: none">
                    <svg class="sp" viewBox="0 0 128 128" width="128px" height="128px"
                        xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="grad1" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#000" />
                                <stop offset="40%" stop-color="#fff" />
                                <stop offset="100%" stop-color="#fff" />
                            </linearGradient>
                            <linearGradient id="grad2" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#000" />
                                <stop offset="60%" stop-color="#000" />
                                <stop offset="100%" stop-color="#fff" />
                            </linearGradient>
                            <mask id="mask1">
                                <rect x="0" y="0" width="128" height="128" fill="url(#grad1)" />
                            </mask>
                            <mask id="mask2">
                                <rect x="0" y="0" width="128" height="128"
                                    fill="url(#grad2)" />
                            </mask>
                        </defs>
                        <g fill="none" stroke-linecap="round" stroke-width="16">
                            <circle class="sp__ring" r="56" cx="64" cy="64" stroke="#ddd" />
                            <g stroke="hsl(223,90%,50%)">
                                <path class="sp__worm1" d="M120,64c0,30.928-25.072,56-56,56S8,94.928,8,64"
                                    stroke="hsl(343,90%,50%)" stroke-dasharray="43.98 307.87" />
                                <g transform="translate(42,42)">
                                    <g class="sp__worm2" transform="translate(-42,0)">
                                        <path class="sp__worm2-1" d="M8,22c0-7.732,6.268-14,14-14s14,6.268,14,14"
                                            stroke-dasharray="43.98 175.92" />
                                    </g>
                                </g>
                            </g>
                            <g stroke="hsl(283,90%,50%)" mask="url(#mask1)">
                                <path class="sp__worm1" d="M120,64c0,30.928-25.072,56-56,56S8,94.928,8,64"
                                    stroke-dasharray="43.98 307.87" />
                                <g transform="translate(42,42)">
                                    <g class="sp__worm2" transform="translate(-42,0)">
                                        <path class="sp__worm2-1" d="M8,22c0-7.732,6.268-14,14-14s14,6.268,14,14"
                                            stroke-dasharray="43.98 175.92" />
                                    </g>
                                </g>
                            </g>
                            <g stroke="hsl(343,90%,50%)" mask="url(#mask2)">
                                <path class="sp__worm1" d="M120,64c0,30.928-25.072,56-56,56S8,94.928,8,64"
                                    stroke-dasharray="43.98 307.87" />
                                <g transform="translate(42,42)">
                                    <g class="sp__worm2" transform="translate(-42,0)">
                                        <path class="sp__worm2-1" d="M8,22c0-7.732,6.268-14,14-14s14,6.268,14,14"
                                            stroke-dasharray="43.98 175.92" />
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </main>

                <ul>
                    
                </ul>
            </div>

            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
    </div>
</nav>
