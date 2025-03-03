<x-layout>
    @slot('title', 'Details Article')

    <section class="mt-4 mb-8 flex justify-center">
        <div class="border border-gray-600 w-[45%] bg-gray-800 rounded-md overflow-hidden">
            <img src="{{ asset('storage/posts/'.($post->image == 'blank.jpg' ? 'default.jpg' : $post->image)) }}" alt="">
            <div class="p-4">
            <div class="">
                <h5 class="text-3xl font-semibold">{{ $post->title }}</h5>
                <span class="text-sm text-gray-300">By {{ $post->author }}  &nbsp;|&nbsp;  {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
                <p class="text-gray-200 my-6 indent-8">{{ $post->description }}</p>
            </div>
            <a href="{{ route('posts.index') }}" class="text-blue-400 hover:text-blue-500 hover:underline">← Back to posts</a>
        </div>
        @if(session('user')['id'] == $post->user_id)
            <div class="border-t border-gray-600 p-4 flex justify-end gap-3">
                <a href="{{ route('posts.edit', $post->slug) }}" class="flex justify-center items-center hover:bg-blue-600 bg-blue-500 focus:ring-4 focus:ring-blue-700 rounded-lg text-sm px-5 py-1.5 font-semibold text-end">Edit</a>
                <button @click="modal = !modal; modalHeader = `Delete Article {{$post->title}}`; modalBody = 'Are you sure you want to delete this article?'; modalAction = '{{ route('posts.destroy', $post->slug) }}'" class="flex justify-center items-center hover:bg-red-700 bg-red-600 focus:ring-4 focus:ring-red-800 rounded-lg text-sm px-5 py-1.5 font-semibold text-end">Delete</button>
            </div>
        @endif
        </div>
    </section>
</x-layout>