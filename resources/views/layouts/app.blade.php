<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Breadcrumbs::pageTitle() }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Mapbox -->
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js"></script>
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css" rel="stylesheet" />

    <!-- Lightbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">

    <!-- Cookie Consent -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

    <!-- Styles -->
    <link href="{{ asset('css/flag-icon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    @yield('css')

    <!-- ReCaptcha -->
    {!! htmlScriptTagJsApi() !!}
</head>
<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-primary border-bottom shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ request()->getHttpHost() }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link @if(Request::is('parkering')){{'active'}} @endif" href="{{ route('parking.index') }}"><i class="fas fa-parking mr-1"></i>{{ __('parking.title') }}</a>
                        </li>
                        @if(DPSEI\Page::all()->count()>0)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-info-circle mr-1"></i>{{ __('global.information') }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @foreach(DPSEI\Page::all() as $page)
                                        <a class="dropdown-item" href="{{ route('page.show', $page->slug) }}">{{ $page->title }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link @if(Request::is('parkering/create')){{'active'}} @endif" href="{{ route('parking.create') }}"><i class="fas fa-plus mr-1"></i>{{ __('global.submit') }}</a>
                        </li>
                        <form class="form-inline ml-3 my-2 my-lg-0" method="post" action="{{ route('search.store') }}">
                            <input class="form-control mr-sm-2{{ $errors->has('search') ? ' is-invalid' : '' }}" type="search" placeholder="{{ $errors->first('search') ?? __('global.search') }}" aria-label="{{ __('global.search') }}" name="search">
                            @csrf
                            <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fas fa-search mr-1"></i>{{ __('global.search') }}</button>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt mr-1"></i>{{ __('auth.signin.title') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus mr-1"></i>{{ __('auth.signup.title') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.show', Auth::user()->username) }}"><i class="fas fa-user"></i> {{ __('user.profile') }}</a>
                                    @if(Auth::user()->hasRole('write'))
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('page.create') }}"><i class="fas fa-plus"></i> {{ __('Create Page') }}</a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('auth.signout.title') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-{{ session('messagetype') ?? 'info' }}">
                    @if(session('messagetype') == 'info')
                        <i class="fas fa-info mr-2" aria-hidden="true"></i>
                    @elseif(session('messagetype') == 'warning')
                        <i class="fas fa-exclamation mr-2" aria-hidden="true"></i>
                    @elseif(session('messagetype') == 'danger')
                        <i class="fas fa-frown mr-2" aria-hidden="true"></i>
                    @elseif(session('messagetype') == 'success')
                        <i class="fas fa-check-circle mr-2" aria-hidden="true"></i>
                    @endif
                    {{ session('message') }}
                </div>
            @endif
            {{ Breadcrumbs::render() }}
            @yield('content')
        </div>
    </main>
    <footer class="footer mt-auto py-3 text-light bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <p>&copy; 2019-{{ \Carbon\Carbon::now()->year }} Infihex &middot; <i class="fas fa-coffee"></i> {{ round((microtime(true) - LARAVEL_START), 3) }}s</small> &middot; <i class="fas fa-language"></i> {{ mb_strtoupper(App::getLocale()) }}</small> &middot; <a href="javascript:;" onclick="$('#feedback').modal('show', {backdrop: 'static'})" class="text-info"><i class="far fa-comment-dots mr-1"></i>{{ __('footer.feedback.title') }}</a></p>
                </div>
                <div class="col-6 text-right">
                    <p>
                        {{ Setting::get('APP_VERSION') }} &middot; {!! __('footer.developedwith') !!} <a href="https://infihex.com/" target="_blank" class="text-info">Infihex</a>
                        @if(Config::get('app.debug'))
                            <p>
                                <b><span class="text-danger">{{ mb_strtoupper(__('footer.debugmode')) }}</span></b>
                                @if(Setting::get('APP_SHOW_RESETDB'))
                                    <b>&middot; <a href="/resetdb" class="text-danger">{{ mb_strtoupper(__('footer.resetdbandsettings')) }}</a></b>
                                @endif
                            </p>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </footer>

    @yield('javascript')

    @if(env('GOOGLE_ANALYTICS'))
        <script async="" src="https://www.google-analytics.com/analytics.js"></script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            ga('create', '{{ env('GOOGLE_ANALYTICS') }}', 'auto');
            ga('send', 'pageview');
        </script>
    @endif
<script type="text/javascript">
    @if($errors->has('name') || $errors->has('email') || $errors->has('message') || $errors->has('g-recaptcha-response'))
        $( document ).ready(function() {
            $('#feedback').modal('show', {backdrop: 'static'});
        });
    @endif
</script>
<div class="modal fade" id="feedback" data-backdrop="static">
    <div class="modal-dialog">
        <form method="post" action="{{ route('feedback') }}" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>{{ __('footer.feedback.title') }}</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('footer.feedback.description') }}</p>
                <div class="form-group row">
                    <label for="name" class="col-3 col-form-label text-right">{{ __('global.name') }}</label>
                    <div class="col-9">
                        @if(Auth::check())
                            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" readonly="">
                        @else
                            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">
                        @endif
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-3 col-form-label text-right">{{ __('global.email') }}</label>
                    <div class="col-9">
                        @if(Auth::check())
                            <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" readonly="">
                        @else
                            <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                        @endif
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="message" class="col-3 col-form-label text-right">{{ __('global.message') }}</label>
                    <div class="col-9">
                        <textarea id="message" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message">{{ old('message') }}</textarea> 
                        @if ($errors->has('message'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3"></div>
                    <div class="col-9">
                        <input id="g-recaptcha-response" type="hidden" class="form-control{{ $errors->has('g-recaptcha-response') ? ' is-invalid' : '' }}">
                        {!! htmlFormSnippet() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @csrf
                <button type="submit" class="btn btn-info"><i class="fas fa-paper-plane mr-2"></i>{{ __('global.sendemail') }}</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "#237afc"
        },
        "button": {
          "background": "#fff",
          "text": "#237afc"
        }
      },
      "theme": "classic",
      "position": "bottom-right",
      "content": {
        "message": "Denne nettsiden bruker informasjonskapsler for å sikre at du får den beste opplevelsen på vår hjemmeside.",
        "dismiss": "Skjønner!",
        "link": "Mer info",
        "href": "{{ env('APP_URL') }}/privacypolicy"
      }
    });
</script>

</body>
</html>
