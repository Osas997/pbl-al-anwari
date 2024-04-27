<div class="py-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        @if ($rekening->isNotEmpty())
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-whiten dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Bank
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Rekening
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nomor Rekening
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekening as $item)
                <tr wire:key="{{ $item->id }}"
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->nama_bank }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->nama_rekening }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->nomor_rekening }}
                    </td>
                    <td class="px-6 py-4">
                        <a x-on:click="$dispatch('update-rekening', { rekening_id: {{ $item->id }} })"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Edit</a>
                        |
                        <a x-on:click="$dispatch('delete-rekening-modal', { rekening_id: {{ $item->id }} })"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @else
        <p class="text-center text-red-400 dark:text-gray-300 font-semibold text-xl md:text-2xl py-6 px-4">Belum Ada
            rekening</p>
        @endif
    </div>
</div>