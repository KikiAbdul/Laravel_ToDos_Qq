@extends('layout')

@section('Qq')

<form method="POST" action="{{route('login.auth')}}">
    @csrf
    @if (session('success'))
        <div class="alert alert-danger">
            {{ session('success') }}
        </div>
    @endif
    <div class="container" style="margin-top: 150px">
        <div class="row justify-content-center" style="color:aliceblue">
            <div class="col-3">
                <div class="card shadow" style="background-color: hsla(0, 0%, 0%, 0.615)">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                           <li>
                                @foreach ($errors->all() as $error)
                                {{ $error }}
                                @endforeach
                           </li>
                        </ul>
                    </div>
                    @endif
                    <div class="card-header bg-success text-white">
                        <div class="login text-center">
                           <h3>Login</h3>
                           @if (Session::get('errorLogin'))
                            <div class="alert alert-danger">
                                {{ Session::get('errorLogin') }}
                            </div>
                            @endif
                            @if (Session::get('notAllowed'))
                            <div class="alert alert-danger">
                                {{ Session::get('notAllowed') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label" name="password">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                         <button type="submit" class="btn btn-success mt-3" style="width: 300px" >Submit</button>
                         <div class="sigUp justify-content-center">
                            <p class="text-center mt-3">Belum memiliki akun?<a href="{{route('register-page')}}" style="color :rgb(255, 255, 255)">register</a></p>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</form>
@endsection