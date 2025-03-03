<x-layout>
@slot('title', 'Create New Post')

<div class="border border-gray-600 p-4 rounded-lg my-4 bg-gray-800 w-1/2 m-auto">
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <h3 class="text-2xl font-semibold mb-4">Create New Post</h3>

        <div class="mb-3">
            <label for="title" class="block mb-2">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Hello World" class="w-full block bg-gray-700 border border-gray-600 text-sm rounded-lg focus:ring focus:ring-blue-500 focus:border-blue-400 p-2 pl-3 focus:outline-0 @error('title') border-red-600 focus:ring-red-600 focus:border-red-600 @enderror">
            @error('title')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="block mb-2">Description</label>
            <textarea name="description" id="description" rows="5" class="w-full block bg-gray-700 border border-gray-600 text-sm rounded-lg focus:ring focus:ring-blue-500 focus:border-blue-400 p-2 pl-3 focus:outline-0 @error('description') border-red-600 focus:ring-red-600 focus:border-red-600 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="image" class="block mb-2">Image</label>
            <input type="file" name="image" id="image" value="{{ old('image') }}" placeholder="Image" class="w-full block bg-gray-700 border border-gray-600 text-sm rounded-lg focus:ring focus:ring-blue-500 focus:border-blue-400 p-2 pl-3 focus:outline-0 @error('image') border-red-600 focus:ring-red-600 focus:border-red-600 @enderror">
            @error('image')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('posts.index') }}" class="flex justify-center items-center hover:bg-red-700 bg-red-600 focus:ring-4 focus:ring-red-800 rounded-lg text-sm px-6 py-2 font-semibold text-end   ">Back</a>
            <button type="submit" class="flex justify-center items-center hover:bg-blue-600 bg-blue-500 focus:ring-4 focus:ring-blue-700 rounded-lg text-sm px-6 py-2 font-semibold text-end">Save</button>
        </div>
    </form>
</div>
</x-layout>