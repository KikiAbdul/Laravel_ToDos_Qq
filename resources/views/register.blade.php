@extends('layout')

@section('Qq')
<form method="POST" action="{{route('register.input')}}">
    <div class="container mt-5 ">

        <div class="row justify-content-center" >
            <div class="col-3">
            <div class="card shadow" style="background-color: rgba(0, 0, 0, 0.615)">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-success">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                <div>
                    <h3 class="text-center" style="color: aliceblue">Register</h3>
                </div>
                <div class="card-body" style="color: aliceblue">
                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="username" name="name">
                  </div>
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Email</label>
                    <input type="Email" class="form-control" id="username" name="email">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputText" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                  </div>
                  <button type="submit" class="btn btn-success mt-2" style="width: 300px" >Submit</button>
                  <div class="sigUp justify-content-center">
                    <p class="text-center mt-3"><a href="{{route('index')}}" style="color :rgb(255, 255, 255)">Login</a></p>
                </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    </div>
@endsection