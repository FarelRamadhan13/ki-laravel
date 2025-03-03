<x-layout>
    @slot('title', 'Daftar Karakter Naruto')

    <div class="">
        @foreach($data as $d)
        <div class="border border-gray-700 p-4 rounded-md inline-flex flex-col" style="width: 14rem">
            <h3 class="text-xl">{{ $d['name']}}</h3>
            <img src="{{ @$d['images'][0] }}" alt="">
        </div>
        @endforeach
    </div>
</x-layout>