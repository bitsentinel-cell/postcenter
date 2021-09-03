@extends('layouts.app')
@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg ">

        <script>
            $("document").ready(function(){
            setTimeout(function(){
                $("div.alert-success").fadeOut();
            }, 3000 ); 
        }); 
        </script>

        @if (session('status'))
        <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center alert-success">
            <p class="msg"> {{ session('status') }}</p>
        </div>
        @endif

        <form class="mb-4 " action="{{ route('posts') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full rounded-lg p-4 @error('body')
                    border-red-500
                @enderror" placeholder="Post somthing"></textarea>

                @error('body')
                <div class="text-red-500 border-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
            </div>
        </form>
        @if ($posts->count())

        @foreach ($posts as $post )

        <x-post :post="$post" />

        @endforeach

        {{ $posts->links('pagination::tailwind') }}



        @else
        <p>there is no posts</p>
        @endif

    </div>
</div>


@endsection


{{-- <div class="mb-4">
            <a href="{{ route('users.posts', $posts->user)  }}" class="font-bold">{{ $post->user->username }}</a><span
    class="text-gray-600 text-sm ml-2">{{ $post->created_at->diffForHumans() }}</span>
<p class="mb-2">{{ $post->body }}</p>


@can('delete' , $post)
<form action="{{ route('posts.destroy') }}" , method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-500">Delete</button>
</form>
@endcan


<div class="flex items-center">
    @auth
    @if (!$post->likedBy(auth()->user()))

    <form action="{{ route('posts.likes' , $post->id) }}" method="POST" class="mr-1">
        @csrf
        <button type="submit" class="text-green-500">like</button>
    </form>
    @else
    <form action="{{ route('posts.unlike' , $post->id) }}" method="POST" class="mr-1">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500">Unlike</button>
    </form>
    @endif

    @endauth
    <span>{{ $post->likes->count() }} {{ Str::plural('likes', $post->likes->count()) }}</span>
</div>
</div> --}}