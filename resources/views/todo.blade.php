@extends('layout')

@section('Qq')
{{-- @dd(Session::all()) --}}
    
    <div class="wrapper shadow" style="background-color: rgba(0, 0, 0, 0.615)">
        @if ($errors->any())
    <div class="alert alert-success">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
    @if (Session::get
    ('notAllowed'))
        <div class="alert alert-success">
            {{ Session::get('notAllowed')}}
        </div>
    @endif
    @if (Session::get('add'))
        <div class="alert alert-success">
            {{ Session::get('add')}}
        </div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-success">
            {{ Session::get('deleted')}}
        </div>
    @endif
    @if (Session::get('done'))
        <div class="alert alert-success">
            {{ Session::get('done')}}
        </div>
    @endif
    @endif
    @if (session('successUpdate'))
        <div class="alert alert-success">
            {{ Session('successUpdate')}}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ Session('success')}}
        </div>
    @endif

    
        <div class="d-flex align-items-start justify-content-between" style="color: aliceblue">
            <div class="d-flex flex-column" >
                <div class="h5">My Todo's</div>
                <p class="text-white text-justify" >
                    Here's a list of activities you have to do
                </p>
                <br>
                <span>
                    <a href="{{route('create')}}" class="text-success">Create</a> | <a href="">Complated</a>
                </span>
            </div>
            <div class="info btn ml-md-4 ml-0">
                <span class="fas fa-info" title="Info"></span>
            </div>
        </div>
        <div class="work border-bottom pt-3">
            <div class="d-flex align-items-center py-2 mt-1">
                <div>
                    <span class="text-light fas fa-comment btn"></span>
                </div>
                <div class="text-light"> Ada {{ $todos-> count() }} tugas yang harus kamu kerjakan</div>
                {{-- <button class="ml-auto btn bg-white text-light fas fa-angle-down" type="button" data-toggle="collapse"
                    data-target="#comments" aria-expanded="false" aria-controls="comments"></button> --}}
            </div>
        </div>
        <div id="comments" class="mt-1 text-white" >
            {{-- looping data -data dari compact 'todos' dapat ditampilkan per baris datanya --}}
            @foreach ($todos as $todo)
            <div class="comment d-flex align-items-start justify-content-between">
                <div class="mr-2">
                    @if ($todo['status'] == 1)
                        <span class="fa-solid fa-bookmark text-secondary btn">
                            {{-- kalau statusnya selain dari 1, baru muncul icon checklist yang bisa di click buat update ke complated --}}
                        </span>
                    @else
                        <form action="{{ route ('update-complated', $todo['id']) }}"method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="sybmit" class="fas fa-circle-check text-success btn"></button>
                        </form>
                    @endif
                </div>
                <div class="d-flex flex-column">
                    {{--menampilkan data dinamis / data yang diambil dari db pada blade harus menggunakan {{}} --}}
                    {{-- path yang {id} dikirim data dinamis (data dari db) makanya disitu pake {{}} --}}
                    <a href="/edit/{{$todo['id']}}" class="text-justify">
                        {{ $todo['title']}}
                    </a>
                    <p>{{ $todo['description']}}</p>
                    {{-- konsep ternary : if column status baris ini isinya 1 bakal munculin teks 'Complated' selain  dari itu akan menampilkan teks 'On-Process' --}}
                    <p class="text-green">
                        {{ $todo['status'] == 1 ? 'Complated' : 'On-Process'}}
                        {{-- Carbon itu package laravel untuk mengelola yang berhubungan dengan date. Tadinya value column date di db kan bentuknya format 2022-11-22 nah kita pengen ubah bentuk formatnya jadi 22 November, 2022--}}
                        <span class="date">
                            {{-- kalau statusnya 1 (complated), yang ditampilin itu tanggal kapan dia selesainya yang diambil dari column done_date yang diisi pas update status nya ke complated --}}
                            @if ($todo['status'] == 1)
                            Selesai pada : {{\Carbon\Carbon::parse($todo['done_date'])->format('j F,Y')}}
                            {{-- kalau statusnya masih 0 (on progress), yang ditampilin tanggal dia dibuat (data dari date yang diisi dari input pilih tanggal di fitur create) --}}
                            @else
                            Target selesai : {{\Carbon\Carbon::parse($todo['date'])->format('j F,Y')}}
                            @endif
                        </span>
                </div>
                <div class="d-flex">
                    {{-- apabila fitur nya berhibingan dengan modifikasi databse, maka harus menggunakan form --}}
                    <form action="{{ route('delete', $todo['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="fa-solid fa-trash-can text-primary btn "></button>
                    </form>
                    
                    {{-- <span class="fas fa-trash text-danger btn"></span> --}}
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection