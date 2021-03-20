<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <title>CryptoData</title>
  </head>
  <body>
    <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/{{App::getLocale()}}"><img src="{{ asset('/images/LogoCrypto.png') }}" class="main-icon"/></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/{{App::getLocale()}}/market">{{ __('Market Cap') }}</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/{{App::getLocale()}}/list">{{__('All')}}</a>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                <?php 
                      $value = Request::path();
                      $path = strstr($value,'/');
                      //dd($path);
                      ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (App::getLocale() != 'en' && App::getLocale() != 'es' && App::getLocale() != 'cat' )
                      EN 
                    @else
                      {{strtoupper(App::getLocale())}}
                    @endif
                  </a>
                  
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li class="dropdown-item">{{ __('Language') }}</li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="/es{{$path}}">{{ __('Spanish') }}</a></li>
                      <li><a class="dropdown-item" href="/en{{$path}}">{{ __('English') }}</a></li>
                      <li><a class="dropdown-item" href="/cat{{$path}}">{{ __('Catalan') }}</a></li>
                  </ul>
                </li>
                <!--<li class="nav-item">
                    <a href="/es{{$path}}" class="nav-link">ES {{$path}}</a> 
                </li>-->
                
            </ul>
            
            
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="{{ __('Search') }}" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">{{ __('Search') }}</button>
            </form>
            </div>
        </div>
        </nav>
    </div>
    @yield('mainContent')

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>
