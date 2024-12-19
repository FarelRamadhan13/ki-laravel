<x-layout>
    @slot('title', $title)

    <div class="h-[100vh] grid place-items-center">
        <div>

            <div class="mb-6">
                <h3 class="text-3xl font-bold">{{$title}}</h3>
                <p class="text-gray-400">{{$nama}}</p>
            </div>

            <div class="overflow-hidden rounded-md bg-slate-800 inline-flex w-[38rem]">
                <img src="{{asset('img/' . $foto)}}" class="w-48 rounded-md object-cover" alt="">
                <div class="pl-5 py-6 pr-12">
                    <h4 class="text-xl font-bold">{{$nama}}</h4>
                    <p class="text-gray-400 mb-4 text-lg">{{$asalSekolah}}</p>
                    <p class="text-gray-400 mb-4">{{$alamat}}</p>
                    <p class="text-center"><i>- {{$bio}} -</i></p>
                </div>
            </div>

        </div>
    </div>

</x-layout>