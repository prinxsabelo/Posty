@props(['post' => $post])
<div class="mb-4">
    <div class="mb-4 border-2 p-2">
        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">
            <!-- {{$post->user}} -->
            {{$post->user->name}}
            <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans()}} </span>
        </a>
        <p class="mb-2">
            {{$post->body}}
        </p>
        @can('delete',$post)
            <div>
                <form action="{{ route('posts.delete-post' ,$post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button> 
                </form>
            </div>
        @endcan
        <div class="flex items-center"> 
            @auth
                @if (!$post->likedBy(auth()->user()))
            
                    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                        @csrf
                            <button type="submit" class="text-blue-500">
                                Like 
                            </button>
                    </form>
                @else
                    <form  action="{{ route('posts.unlike', $post) }}" method="post" class="mr-1">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="text-blue-500">
                                UnLike
                            </button>
                        </form> 
                @endif
                
            @endauth
            <span> {{ $post->likes->count() }} {{ Str::plural('like',$post->likes->count()) }}</span>
        </div>
    </div>
</div>