<div class="py-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        @if ($catering->isNotEmpty())
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-whiten dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Catering
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Biaya catering
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($catering as $item)
                <tr wire:key="{{ $item->id }}"
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->jumlah_catering }} Kali Makan
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->formatToRupiah($item->biaya) }}
                    </td>
                    <td class="px-6 py-4">
                        <a x-on:click="$dispatch('update-catering', { catering_id: {{ $item->id }} })"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @else
        <p class="text-center text-red-400 dark:text-gray-300 font-semibold text-2xl">Belum Ada Data Catering</p>
        @endif
    </div>
</div>