<x-layout>
    @slot('title', 'Data Agents')

    <section class="mt-4 mb-8">
        <div class="bg-gray-800 p-4 rounded-lg border border-gray-600 mb-4">
            <h3 class="text-2xl font-semibold">Data Agents</h3>
        </div>
        <div class="overflow-hidden bg-gray-800 rounded-lg">
            <div class="flex justify-between p-4">
                <form action="" method="GET" class="w-1/4">
                    <input type="search" name="q" value="{{ request()->q }}" placeholder="🔎 Search" class="w-full block bg-gray-700 border border-gray-600 text-sm rounded-lg focus:ring focus:ring-blue-500 focus:border-blue-400 p-2 pl-3 focus:outline-0">
                </form>
                <a href="{{ route('tugas.agents.create') }}" class=" flex justify-center items-center hover:bg-blue-600 bg-blue-500 focus:ring-4 focus:ring-blue-700 rounded-lg text-sm px-4 py-2">+ Add Agents</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center">No</th>
                            <th scope="col" class="px-4 py-3 text-start">Name</th>
                            <th scope="col" class="px-4 py-3 text-start">Description</th>
                            <th scope="col" class="px-4 py-3 text-start">Release Date</th>
                            <th scope="col" class="px-4 py-3 text-center">Image</th>
                            <th scope="col" class="py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $agents as $agent )
                        <tr class="border-b border-gray-700">
                            <th scope="row" class="px-1 py-3">{{ ((request()->page ?? 1) - 1) * 10 + $loop->iteration }}</th>
                            <td class="px-4 py-3">{{ $agent->name }}</td>
                            <td class="px-4 py-3 max-w-[2rem]" x-data="{ open: false }">
                                <span x-show="!open" x-cloak>{{ Str::limit($agent->description, 75) }}</span>
                                <span x-show="open" x-cloak>{{ $agent->description }}</span> 
                                @if(Str::length($agent->description) > 120)
                                    <span class="text-blue-400 cursor-pointer hover:text-blue-500" @click="open = !open" x-text="open ? 'see less.' : 'see more.' "></span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $agent->release_date->format('d-M-Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="m-auto w-40">
                                    <img src="{{ asset('storage/'.$agent->image) }}" class="rounded-md border border-gray-700" alt="">
                                </div>
                            </td>
                            <td class="py-3 text-center">
                                <div class=""  x-data="{ open: false }">
                                    <span class="cursor-pointer" @click="open = !open" @click.outside="open = false">● ● ●</span>

                                    <div x-cloak x-show="open" class="z-99 border border-gray-600 bg-gray-700 rounded-lg absolute py-1 text-start w-32 font-medium text-sm translate-x-[-4rem]">
                                        <ul>
                                            <li>
                                                <a href="{{ route('tugas.agents.edit', $agent->id) }}" class="block hover:bg-gray-600 px-3 py-2 hover:text-white">Edit</a>
                                            </li>
                                            <li>
                                                <button @click="modal = !modal; modalHeader = 'Delete Agent {{$agent->name}}'; modalBody = 'Are you sure you want to delete this agent?'; modalAction = '{{ route('tugas.agents.destroy', $agent) }}'" class="w-full text-start hover:bg-gray-600 px-3 py-2 hover:text-white">Delete</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-4 py-2">
                    {{ $agents->links() }}
                </div>
            </div>
        </div>
    </section>

</x-layout>

