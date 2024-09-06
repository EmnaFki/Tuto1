<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>

    @layer demo{
        button{
            all:unset;
        }
    }
</style>

</head>
<body>

    @php
        // récupérer le nom de la route de la requete
        $routeNom=request()->route()->getName()
    @endphp

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Blog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a @class(["nav-link", "active"=>$routeNom =='blog.index' ]) aria-current="page" href="{{ route('blog.index') }}">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">link</a>
          </li>
          
        </ul>
        
      </div>
    </div>
  </nav>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ 
                    session('success')
                     }}
            </div>
        @endif
        @yield('content')
    </div>
</body>
</html>