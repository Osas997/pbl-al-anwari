<div class="py-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        @if ($tagihan->isNotEmpty())
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Tagihan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Semester
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bulan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tahun
                    </th>
                    <th scope="col" class="px-8 py-3 text-center">
                        Nominal
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tagihan as $item)
                <tr wire:key="{{ $item->id }}"
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4 uppercase font-medium">
                        {{ $item->jenis_tagihan }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $item->semester ? $item->semester : '-' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $item->bulan ? $item->bulan : '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->tahun_ajaran }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->formatToRupiah('nominal') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="py-2 px-3 rounded-xl bg-green-600 text-white ">
                            {{ ucwords($item->status) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a wire:navigate href="{{ route('tagihan-detail-santri', $item->id) }}"
                            class="italic font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p
            class="text-center text-emerald-400 dark:text-gray-300 font-semibold text-lg md:text-2xl py-6 overflow-y-hidden">
            Tidak Ada Riwayat Pembayaran</p>
        @endif
    </div>
</div>