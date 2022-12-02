<!doctype html>
<html lang="en">
  <head>
      <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="gue.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href={{ asset('assets/css/style.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/login.css') }}>
    <title>Todos</title>
  </head>
  <body>
    @if (Auth::check())
    <nav class="navbar bg-light">
      <div class="container-fluid">
        <a class="navbar-brand">Todo App</a>
        {{-- <ul class="navbar-nav">
          <li>
            <a href="" class="nav-link">Create Todo</a>
          </li>
        </ul> --}}
          <a class="btn btn-outline-success" type="submit" href="/logout">Logout</a>
        </form>
      </div>
    </nav>
   @endauth
    @yield('Qq')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/jxs/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>