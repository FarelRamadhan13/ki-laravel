
<div x-show="modal" x-cloak x-transition.origin.top.duration.500ms :class="modal ? 'block' : 'hidden'" class="fixed top-0 left-0 w-full h-[100vh] bg-black/50 z-50" tabindex="-1">
    <div @click.outside="modal = false" class="bg-gray-800 w-[25rem] m-auto rounded-lg mt-8 border border-gray-600">
        <div class="px-4 py-2.5 border-b border-gray-600 flex justify-between items-center">
            <h3 class="text-2xl font-semibold" x-text="modalHeader"></h3>
            <button class="hover:bg-gray-700 px-1.5 rounded-md pb-1" @click="modal = false">×</button>
        </div>
        <div class="p-4">
            <p class="bg-gray-700 p-2 rounded-md text-sm" x-text="modalBody"></p>
        </div>
        <div class="px-4 py-3 border-t border-gray-600 flex items-center justify-end gap-2">
            <button @click="modal = false" class="flex justify-center items-center hover:bg-blue-600 bg-blue-500 focus:ring-4 focus:ring-blue-700 rounded-lg text-sm px-5 py-1.5 font-semibold text-end">Cancel</button>
            <form :action="modalAction" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="flex justify-center items-center hover:bg-red-700 bg-red-600 focus:ring-4 focus:ring-red-800 rounded-lg text-sm px-5 py-1.5 font-semibold text-end">Delete</button>
            </form>
        </div>
    </div>
</div>

