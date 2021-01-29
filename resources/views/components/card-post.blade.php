@props(['post'])
<article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">
    <img class="w-full h-72 object-cover object-center" src="{{ Storage::url($post->image->url) }}" alt="">
    <div class="px-6 py-4">
        <h1 class="font-bold text-x1 mb-2">
            <a href="{{ route('post.show', $post) }}">{{ $post->name }}</a>
        </h1>
        <div class="text-gray-700 text-base">
            {{ $post->extract }}
        </div>
    </div>
    <div class="px-6 pt-4 pb-2">
        @foreach ($post->tags as $tag)
            <a class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray-700 mr-2"
                href="{{route('post.tag',$tag)}}">{{ $tag->name }}</a>
        @endforeach
    </div>
</article>