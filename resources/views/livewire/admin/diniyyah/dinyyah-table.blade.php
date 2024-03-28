<div class="py-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        @if ($diniyyah->isNotEmpty())
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-white">
                <thead class="text-xs text-gray-700 uppercase bg-whiten dark:bg-gray-700 dark:text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Tingkatan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diniyyah as $item)
                        <tr wire:key="{{ $item->id }}"
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration + $diniyyah->firstItem() - 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->nama_tingkatan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->kelas }}
                            </td>
                            <td class="px-6 py-4">
                                <a x-on:click="$dispatch('update-diniyyah', { diniyyah_id: {{ $item->id }} })"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Edit</a>
                                |
                                <a x-on:click="$dispatch('delete-diniyyah-modal', { diniyyah_id: {{ $item->id }} })"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="my-3">
                <h1 class="font-semibold text-center text-red-500 text-2xl"> Belum Ada Diniyyah </h1>
            </div>
        @endif


        <div class="py-4 px-4">
            {{ $diniyyah->links('vendor.livewire.tailwind') }}
        </div>
    </div>
</div>
