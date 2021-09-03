@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-4/12 bg-white p-6 rounded-lg ">
        <script>
            $("document").ready(function(){
            setTimeout(function(){
                $("div.alert-success").fadeOut();
            }, 3000 ); 
        }); 
        </script>

        @if (session('status'))
        <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center alert-success">
            <p class="msg"> {{ session('status') }}</p>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="sr-only">Email</label>
                <input type="text" name="email" id="email" placeholder="Your Email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email')
                border-red-500
                    @enderror" value="{{ old('email') }}">
            </div>

            @error('email')
            <div class="text-red-500 mb-3 text-sm">
                {{ $message}}
            </div>
            @enderror

            <div class="mb-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="choose a Password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password')
                        border-red-500
                    @enderror" value="">
            </div>

            @error('password')
            <div class="text-red-500 mb-3 text-sm">
                {{ $message}}
            </div>
            @enderror

            <div class="mb-4">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remeber">Remember me</label>

            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Login</button>
            </div>
            <div>
                <p class="mb-3">Not registered yet?</p>
                <a href="{{ route('register') }}"
                    class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Register</a>
            </div>
        </form>
    </div>
</div>
@endsection