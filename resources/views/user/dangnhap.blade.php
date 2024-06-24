@extends('layouts.main')

@section('content')
<div class="flex justify-center ">
    <div class="container w-60 md:w-96">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mt-4">Đăng nhập</h2>
        </header>

        <form method="POST" action="/user/authenticate">
            @csrf
            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input 
                    type="email" 
                    class="border border-gray-500 rounded p-2 w-full bg-transparent"
                    autocomplete="off"
                    name="email"
                    value="{{old('email')}}"
                >
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>


            <div class="mb-6">
                <label for="password" class="inline-block text-lg mb-2">Mật khẩu</label>
                <input 
                    type="password" 
                    class="border border-gray-500 rounded p-2 w-full bg-transparent"
                    autocomplete="off"
                    name="password"
                    value="{{old('password')}}"
                >
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6 flex justify-center">
                <button type="submit" class="bg-orange-500 rounded py-2 px-4 hover:bg-orange-600">
                    Đăng nhập
                </button>
            </div>

            <div class="mt-8 flex justify-center">
                <a href="{{route('user.dangky')}}" class="text-laravel"
                    >Chưa có tài khoản? Đăng ký ngay</a
                >
            </div>
        </form>
    </div>
</div>
@endsection