<x-layout>
    @slot('title', 'Dashboard')

    <h1 class="text-2xl font-medium" >User : {{ $username }}</h1>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="p-1 px-4 text-center bg-blue-500 rounded-md p-1.5 mt-4 focus:ring focus:ring-blue-700">Logout</button>
    </form>
    
</x-layout>
