<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Http\Reuquest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function register()
    {
    return view('register');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('login');
    }

    public function create(){
        return view('create');
    }

    public function registerAccount(Request $request)   
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|:dns',
            'username' => 'required|min:4|max:8',
            'password' => 'required|min:4',
            'name' => 'required|min:3',

        ]);
        //input ke db
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/')->with('success', 'berhasil menambahkan akun! silahkan login');

    }

    public function auth(Request $request){
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ],[
            'username.exist' => 'username ini belum diisi',
            'username.required' => 'username harus diisi',
            'password.required' => 'password harus diisi',
        ]);
// 
        // dd($request->all());

        $user = $request->only('username', 'password');
        // dd(Auth::attempt($user));
        if (Auth::attempt($user)) {
            return redirect()->route('todo.io');
        }else {
            return redirect()->back()->with('error', 'Gagal login, silahkan cek dan coba lagi!');
        }
    }

    public function home()
    {
        // ambil data dari table todos dengan model Todo
        // filter data di database -> where('column', 'perbandingan', 'value')
        // get() -> ambil data
        // filter data di table todos yang isi column user_id nya sama dengan data history login bagian id
        $todos = Todo::where('user_id', '=', Auth::user()->id)->get();
        // kirim data yang sudah diambil ke file blade / ke file yang menampilkan halaman
        // kirim melalui compact()
        // isi compact sesuaikan dengan nama
        return view('todo', compact('todos'));
    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
            $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ],[
            'title.required' => 'judul ini harus diisi',
            'date.required' => 'tanggal harus diisi',
            'description.required' => 'deskripsi ini harus diisi'
        ]
    );

        // mengirim data ke database table todos dengan model Todo 
        // ''  = nama column di table db
        // $request-> = value attribute name pada input
        // kenapa yang dikirim 5 data? karena table pada db todos membutuhkan 6 column input
        // salah satunya column 'done_time' yang tipenya nullable, karena nullable jadi ga perlu dikirim nilai
        // 'user_id' untuk memberi tahu data todo ini milik siapa, diambil melalui fitur Auth
        // 'status' tipenya boolean, 0 = belum dikerjakan, 1 = sudah dikerjakan (todonya)
        Todo::create([
            'title' =>$request->title,
            'date' =>$request->date,
            'description' =>$request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);

        //kalau berhasil diarahin ke halaman todo awal dengan pemberitahuan 
        return redirect()->route('todo.io')->with('add', 'berhasil menambahkan data Todo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    public function complated()
    {
        return view('todo.complated');
    }

    public function updateComplated($id)
    {
        // cari data yang mau di ubah statusnya jadi 'complated' dan column 'done_time' yang tadinya null, diisi dengan tanggal sekarang (tanggal ketika data todo di ubah statusnya)
        // karena status boolean, dan 0 itu untuk kondisi todo on-progres, jadi 1 nya untuk kondisi todo complated
        Todo::where('id', '=', $id)->update([
            'status' => 1,
            'done_date' => \Carbon\carbon::now(),
        ]);
        //apabila berhasil, akan dikembalikan ke halaman awal dengan pemberitahuan 
        return redirect()->back()->withErrors([ 'ToDo telah selesai dikerjakan!']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan halaman input form edit
        //mengambil data satu baris ketika column id pada baris tersebut sama dengan id dari paramater route
        $todo = Todo::where('id', $id)->first();
        //kirim data yang diambil ke file blade dengan compact 
        return view('edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //mengubah data di database
        //validasi
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ]);
        //cari baris data yang punya id sama dengan data id yang dikirim ke parameter route
        //kalau uda ketemu, update column-column datanya
        Todo::where('id', $id)->update([
            'title' =>$request->title,
            'date' =>$request->date,
            'description' =>$request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        //kalau berhasil, halaman bakal di redirect ulang ke halaman awal todo dengan pesan pemberitahuan 
        return redirect('/todo/')->with('successUpdate', 'Data todo berhasil diperbarui!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::where('id', '=', $id)->delete();
        return redirect()->back()->withErrors(['Berhasil menghapus data ToDo!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect ('/');
    }
}
