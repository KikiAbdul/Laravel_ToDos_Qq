@extends('layout')

@section('Qq')
    
<div class="container content" style="color:aliceblue">  
    <form id="create-form" action="/update/{{$todo['id']}}" method="POST"
     method="POST" style="background-color: hsla(0, 0%, 0%, 0.615)">
     {{-- mengambil dan mengirim data input ke controller yang nantinya di ambil oleh Request $request --}}
        @csrf
        {{-- karena di routh nya pake method patch sedangkan attribute method di form cuman bisa post/get. Jadi yang post nya ditimpa --}}
        @method('PATCH')
        @if ($errors->any())
        <div class="alert alert-success">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
         </div>
        @endif
      <h3>Edit Todo</h3>
      
      <fieldset>
          <label for="">Title</label>
          {{-- attribute value fungsinya untuk memasukan data ke input --}}
          {{-- kenapa datanya harus disimpen diinput? karena ini kan fitur edit. Kalau fitur edit belum tentu semua data column diubah. Jadi untuk mengantisipasi hal itu, tampilin dulu semua data di inputnya baru nantinya pengguna yang menentukan data input mana yang mau diubah--}}
          <input placeholder="title of todo" type="text" name="title" value="{{ $todo['title'] }}">
      </fieldset>
      <fieldset>
          <label for="">Target Date</label>
          <input placeholder="Target Date" type="date" name="date" value="{{ $todo['date'] }}">
      </fieldset>
      <fieldset>
          <label for="">Description</label>
          <textarea name="description"placeholder="Type your descriptions here..." tabindex="5">{{ $todo['description'] }}</textarea>
      </fieldset>
      <fieldset>
          <button type="submit" id="contactus-submit">Submit</button>
      </fieldset>
      <fieldset>
          <a href="/todo/" class="btn-cancel btn-lg btn">Cancel</a>
      </fieldset>
    
    </form>
  </div>

  @endsection
