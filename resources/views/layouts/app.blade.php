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
                                    <a class="dropdown-item" href="{{ route('user.show', Auth::user()->uuid) }}"><i class="fas fa-user"></i> {{ __('user.profile') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('account.members') }}"><i class="fas fa-users"></i> {{ __('account.members.title') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('account.profile.change') }}"><i class="fas fa-user-edit"></i> {{ __('account.profile.change.title') }}</a>
                                    <a class="dropdown-item" href="{{ route('account.password.change') }}"><i class="fas fa-asterisk"></i> {{ __('account.password.change.title') }}</a>
                                    <div class="dropdown-divider"></div>
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
    <main role="main" class="flex-shrink-0 pt-3">
        <div class="container">
            {{ Breadcrumbs::render() }}
            @if (session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-frown mr-2" aria-hidden="true"></i> {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle mr-2" aria-hidden="true"></i> {{ session('success') }}
                </div>
            @endif
            @if (session('info'))
                <div class="alert alert-info">
                    <i class="fas fa-info mr-2" aria-hidden="true"></i> {{ session('info') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation mr-2" aria-hidden="true"></i> {{ session('warning') }}
                </div>
            @endif
            @yield('content')
        </div>
    </main>
    <footer class="footer mt-auto py-3 text-light bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <p>&copy; 2020-{{ \Carbon\Carbon::now()->year }} Infihex &middot; <i class="fas fa-coffee"></i> {{ round((microtime(true) - LARAVEL_START), 3) }}s</small> &middot; <i class="fas fa-language"></i> {{ mb_strtoupper(App::getLocale()) }}</small> &middot; <a href="javascript:;" onclick="$('#feedback').modal('show', {backdrop: 'static'})" class="text-info"><i class="far fa-comment-dots mr-1"></i>{{ __('footer.feedback.title') }}</a></p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <p>
                        <a href="javascript:;" onclick="$('#changelog').modal('show', {backdrop: 'static'})" class="text-white">{{ Setting::get('APP_VERSION') }}</a> &middot; {!! __('footer.developedwith') !!} <a href="https://infihex.com/" target="_blank" class="text-info">Infihex</a>
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
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ env('GOOGLE_ANALYTICS') }}');
        </script>
    @endif
    <script type="text/javascript">
        @if($errors->has('feedback_name') || $errors->has('feedback_email') || $errors->has('feedback_message') || $errors->has('g-recaptcha-response'))
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
                        <label for="feedback_name" class="col-3 col-form-label text-right">{{ __('global.name') }}</label>
                        <div class="col-9">
                            @if(Auth::check())
                                <input id="feedback_name" class="form-control{{ $errors->has('feedback_name') ? ' is-invalid' : '' }}" name="feedback_name" value="{{ Auth::user()->name }}" readonly="">
                            @else
                                <input id="feedback_name" class="form-control{{ $errors->has('feedback_name') ? ' is-invalid' : '' }}" name="feedback_name" value="{{ old('feedback_name') }}">
                            @endif
                            @if ($errors->has('feedback_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('feedback_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="feedback_email" class="col-3 col-form-label text-right">{{ __('global.email') }}</label>
                        <div class="col-9">
                            @if(Auth::check())
                                <input id="feedback_email" class="form-control{{ $errors->has('feedback_email') ? ' is-invalid' : '' }}" name="feedback_email" value="{{ Auth::user()->email }}" readonly="">
                            @else
                                <input id="feedback_email" class="form-control{{ $errors->has('feedback_email') ? ' is-invalid' : '' }}" name="feedback_email" value="{{ old('feedback_email') }}">
                            @endif
                            @if ($errors->has('feedback_email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('feedback_email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="feedback_message" class="col-3 col-form-label text-right">{{ __('global.message') }}</label>
                        <div class="col-9">
                            <textarea id="feedback_message" class="form-control{{ $errors->has('feedback_message') ? ' is-invalid' : '' }}" name="feedback_message">{{ old('feedback_message') }}</textarea> 
                            @if ($errors->has('feedback_message'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('feedback_message') }}</strong>
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

    <div class="modal fade" id="changelog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>{{ __('footer.changelog') }}</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body footer-changelog">
                    @include('layouts.changelog')
                </div>
            </div>
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
            "message": "{{ __('global.cookie.message') }}",
            "dismiss": "{{ __('global.cookie.dissmiss') }}",
            "link": "{{ __('global.cookie.link') }}",
            "href": "{{ request()->getSchemeAndHttpHost() }}/info/privacypolicy"
          }
        });
    </script>

</body>
</html>
