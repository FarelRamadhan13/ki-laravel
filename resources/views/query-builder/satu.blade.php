<x-layout>
@slot('title', 'satu')
    <a href="{{ config('app.url') }}/query-builder/create">ADD</a>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Wallet</td>
                <td>Phone</td>
            </tr>
        </thead>

        <tbody>
            @foreach ($members as $m)    
                <tr>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->wallet }}</td>
                    <td>{{ $m->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $members->links('pagination::tailwind') }}
</x-layout>
