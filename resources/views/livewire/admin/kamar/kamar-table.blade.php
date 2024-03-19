<div class="py-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-whiten dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Kamar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ketua Kamar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kamar as $item)
                <tr wire:key="{{ $item->id }}"
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration + $kamar->firstItem() - 1 }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->nama_kamar }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->ketua_kamar }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="py-4 px-4">
            {{ $kamar->links('vendor.livewire.tailwind') }}
        </div>
    </div>
</div>