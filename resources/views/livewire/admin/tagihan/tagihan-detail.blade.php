<div class="px-2 md:px-4 font-poppins text-black">
    <!-- Breadcrumb Start -->

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Detail Data Santri
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('tagihan') }}">Tagihan /</a>
                </li>
                <li class="text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <section>
        <div class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600 w-full">
            Tagihan Detail Santri ID {{ $tagihan->id }}
            <div class="py-2 mt-8 flex flex-col md:flex-row md:gap-12 gap-4">
                <div class="w-full md:w-1/6 flex justify-center">
                    <img src="{{ asset('images/no_profile.png') }}" alt="profile.png"
                        class="w-1/2 md:w-full rounded-md">
                </div>
                <div
                    class="md:w-1/2 w-full mt-4 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">Nama Santri</p>
                            <p>:</p>
                        </div>
                        <a wire:navigate href="{{ route('santri-detail', $tagihan->santri->id) }}"
                            class="w-2/3 mx-4 text-sm md:text-md hover:underline cursor-pointer hover:text-blue-600">{{
                            $tagihan->santri->nama_santri }}</a>
                    </div>
                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">NIS</p>
                            <p>:</p>
                        </div>
                        <p class="w-2/3 mx-4 text-sm md:text-md">{{ $tagihan->santri->nis }}</p>
                    </div>
                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">No Handphone</p>
                            <p>:</p>
                        </div>
                        <p class="w-2/3 mx-4 text-sm md:text-md">{{ $tagihan->santri->no_hp }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row py-4 my-2 gap-6">
            <div class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600 md:w-1/2 w-full">
                <p class="text-md font-semibold">
                    Detail Tagihan
                </p>
                <div class="w-full mt-2 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">Jenis Tagihan</p>
                            <p>:</p>
                        </div>
                        <p class="w-2/3 mx-4 text-sm md:text-md">
                            {{ $tagihan->jenis_tagihan == "syahriyyah" ? "Syahriyyah " .
                            $tagihan->santri->syahriyyah->jenis_domisili : "Catering " .
                            $tagihan->santri->catering->jumlah_catering . " Kali Makan"}}
                        </p>
                    </div>
                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">Nominal</p>
                            <p>:</p>
                        </div>
                        <p class="w-2/3 mx-4 text-sm md:text-md">{{ $tagihan->formatToRupiah('nominal') }}</p>
                    </div>

                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">Tahun Ajaran</p>
                            <p>:</p>
                        </div>
                        <p class="w-2/3 mx-4 text-sm md:text-md">{{ $tagihan->tahun_ajaran }}</p>
                    </div>
                    @if ($tagihan->jenis_tagihan == 'syahriyyah')
                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">Semester</p>
                            <p>:</p>
                        </div>
                        <p class="w-2/3 mx-4 text-sm md:text-md">{{ $tagihan->semester }}
                        </p>
                    </div>
                    @else
                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">Bulan Tagihan</p>
                            <p>:</p>
                        </div>
                        <p class="w-2/3 mx-4 text-sm md:text-md">{{ $tagihan->bulan }}
                        </p>
                    </div>
                    @endif
                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">Tanggal Tagihan</p>
                            <p>:</p>
                        </div>
                        <p class="w-2/3 mx-4 text-sm md:text-md">{{ $tagihan->tgl_tagihan->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600 md:w-1/2 w-full">
                <livewire:admin.tagihan.pembayaran-tunai :tagihanId="$tagihan->id" />
            </div>
        </div>
    </section>
    {{-- Toast --}}
    <x-toast />
</div>