<x-layout>
    @slot('title', 'Data Posts')

    <section class="mt-4 mb-8">
        <div class="bg-gray-800 p-3 px-4 rounded-lg border border-gray-600 mb-4 flex justify-between items-center">
            <h3 class="text-2xl font-semibold">Welcome {{ session('user')['name'] ?? 'None' }} _</h3>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="flex justify-center items-center hover:bg-blue-600 bg-blue-500 focus:ring-4 focus:ring-blue-700 rounded-lg text-sm px-5 py-1.5 font-semibold text-end">Logout</button>
            </form>
        </div>
        <div class="overflow-hidden bg-gray-800 rounded-lg border border-gray-600 mb-4">
            <div class="flex justify-between p-3 px-4">
                <h3 class="text-2xl font-semibold">Articles</h3>
                <a href="{{ route('posts.create') }}" class=" flex justify-center items-center hover:bg-blue-600 bg-blue-500 focus:ring-4 focus:ring-blue-700 rounded-lg text-sm px-4 py-2">+ Add posts</a>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4">

            @foreach ($posts as $post)    
                <div class="bg-gray-800 border border-gray-600 rounded-md overflow-hidden">
                    <div class="h-[10.5rem] overflow-hidden"><img src="{{ asset('storage/posts/'.($post['image'] == 'blank.jpg' ? 'default.jpg' : $post['image'])) }}" alt=""></div>
                    <div class="p-4 text-sm flex flex-col justify-between h-[13rem]">
                        <div class="">
                            <h5 class="text-xl font-semibold">{{ $post['title'] }}</h5>
                            <span class="text-xs text-gray-300">By {{ $post['author'] }}  &nbsp;|&nbsp;  {{ Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}</span>
                            <p class="text-gray-200 my-3">{{Str::limit($post['description'], 130)}}</p>
                        </div>
                        <a href="{{ route('posts.show', $post['slug']) }}" class="text-blue-400 hover:text-blue-500 hover:underline">View Details →</a>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

</x-layout>

