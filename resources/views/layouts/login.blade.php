<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    
    
    <link rel="stylesheet" href="{{asset('assets/login/css/reset.css')}}">

    
        <link rel="stylesheet" href="{{asset('assets/login/css/style.css')}}">

    
    
    
    
  </head>

  <body>

    <section>
  <span></span>
  <h1>@yield('action')</h1>

  @yield('content')
  

    
    </section>
    
    
  </body>
</html>
