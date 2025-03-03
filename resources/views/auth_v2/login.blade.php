<x-layout>
    @slot('title', 'Login')
    <div class="h-[100vh] grid place-items-center">
        <div class="w-[18rem] border border-gray-500 p-6 rounded-md">
            <form action="{{ route('login') }}" method="post" class="flex flex-col gap-3">
                @csrf
                <h2 class="text-3xl font-semibold text-center mb-3">Login</h2>

                <div>
                    <label for="email" class="block font-medium mb-2 capitalize">email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full rounded-md px-2 py-1.5 bg-transparent outline outline-1 outline-gray-500 focus:outline-none focus:ring focus:ring-blue-500">
                    @error('email')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block font-medium mb-2 capitalize">password</label>
                    <input type="password" name="password" id="password" value="{{ old('password') }}" class="w-full rounded-md px-2 py-1.5 bg-transparent outline outline-1 outline-gray-500 focus:outline-none focus:ring focus:ring-blue-500">
                    @error('password')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full text-center bg-blue-500 rounded-md p-1.5 mt-4 focus:ring focus:ring-blue-700">Login</button>

            </form>
        </div>
    </div>
</x-layout>
