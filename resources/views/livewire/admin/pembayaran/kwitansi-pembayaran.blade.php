<div class="print-container bg-white border rounded-lg shadow-md px-6 py-8 max-w-lg mx-auto my-8">
    <h1 class="font-bold text-2xl my-4 text-center">KWITANSI PEMBAYARAN</h1>
    <hr class="mb-2">
    <div class="flex justify-between mb-6">
        <h1 class="text-lg font-bold text-blue-600">Ponpes Al Anwari</h1>
        <div class="text-gray-700">
            <div>Tanggal: {{ $pembayaran->tanggal_bayar->format('d/m/Y') }}</div>
            <div>id pembayaran: {{ $pembayaran->id }}</div>
        </div>
    </div>
    <div class="mb-8">
        <h2 class="text-lg font-bold mb-2">Kepada Santri:</h2>
        <div class="w-full text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
            <div class="flex px-2 py-1 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2 items-center">
                    <p class="text-sm md:text-md">Nama</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $pembayaran->tagihan->santri->nama_santri }}</p>
            </div>

            <div class="flex px-2 py-1 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2 items-center">
                    <p class="text-sm md:text-md">NIS</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $pembayaran->tagihan->santri->nis }}</p>
            </div>
        </div>
    </div>
    <table class="w-full mb-4">
        <thead>
            <tr>
                <th class="text-left font-bold text-gray-700">Deskripsi</th>
                <th class="text-right font-bold text-gray-700">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-left text-gray-700"> {{ $pembayaran->tagihan->jenis_tagihan == "syahriyyah" ?
                    "Syahriyyah " .
                    $pembayaran->tagihan->santri->syahriyyah->jenis_domisili : "Catering " .
                    $pembayaran->tagihan->santri->catering->jumlah_catering . " Kali Makan"}}

                    <p class="text-gray-700">Tanggal Tagihan : {{
                        $pembayaran->tagihan->tgl_tagihan->format('d/m/Y')}}
                    </p>
                    <p class="text-gray-700">Bulan : {{ $pembayaran->tagihan->bulan}} {{
                        $pembayaran->tagihan->tahun_ajaran }}
                    </p>
                </td>
                <td class="text-right text-gray-700">{{ $pembayaran->tagihan->formatToRupiah('nominal') }}</td>
            </tr>
        </tbody>
    </table>
    <div class="text-gray-700 mb-12 italic">Terbilang : {{ ucwords(formatTerbilang($pembayaran->tagihan->nominal)) }}
    </div>
    <div class="text-gray-700 text-base">{{ $pembayaran->admin->username }}</div>
</div>

@push('script')
<script>
    window.onload = function() {
        window.print();
    }
</script>
@endpush