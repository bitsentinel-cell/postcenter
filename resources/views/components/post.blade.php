@props(['post' => $post])

<div class="mb-4">
    <a href="{{ route('users.posts', $post->user)  }}" class="font-bold">{{ $post->user->username }}</a><span
        class="text-gray-600 text-sm ml-2">{{ $post->created_at->diffForHumans() }}</span>
    <p class="mb-2">{{ $post->body }}</p>


    @can('delete' , $post)
    <form action="{{ route('posts.destroy',$post) }}" , method="POST">
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
</div>