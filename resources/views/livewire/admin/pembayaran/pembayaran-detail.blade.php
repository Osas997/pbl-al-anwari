<div class="px-2 md:px-4 font-poppins text-black">
    <!-- Breadcrumb Start -->

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Detail Data Pembayaran
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('pembayaran') }}">Pembayaran /</a>
                </li>
                <li class="text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <section>
        <div class="mb-4 py-6 px-10 bg-white rounded-lg dark:bg-slate-600 w-full">
            <div class="flex gap-2 justify-start items-center">
                <p class="font-semibold text-xl py-2">Informasi Santri</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                </svg>
            </div>
            <div class="py-2 mt-1 flex flex-col md:flex-row md:gap-8 gap-4">
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
                        <a wire:navigate href="{{ route('santri-detail', $pembayaran->tagihan->santri->id) }}"
                            class="w-2/3 mx-4 text-sm md:text-md hover:underline cursor-pointer hover:text-blue-600">{{
                            $pembayaran->tagihan->santri->nama_santri }}</a>
                    </div>
                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">NIS</p>
                            <p>:</p>
                        </div>
                        <p class="w-2/3 mx-4 text-sm md:text-md">{{ $pembayaran->tagihan->santri->nis }}</p>
                    </div>
                    <div class="flex px-2 py-2 gap-4 items-center">
                        <div class="flex w-1/3 justify-between me-2 items-center">
                            <p class="text-sm md:text-md">No Handphone</p>
                            <p>:</p>
                        </div>
                        <p class="w-2/3 mx-4 text-sm md:text-md">{{ $pembayaran->tagihan->santri->no_hp }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 py-6 px-10 bg-white rounded-lg dark:bg-slate-600 w-full">
            <div class="flex gap-2 justify-start items-center">
                <p class="font-semibold text-xl py-2">Informasi Tagihan</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                </svg>
            </div>
            <div class="w-full mt-2 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Jenis Tagihan</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md">
                        {{ $pembayaran->tagihan->jenis_tagihan == "syahriyyah" ? "Syahriyyah " .
                        $pembayaran->tagihan->santri->syahriyyah->jenis_domisili : "Catering " .
                        $pembayaran->tagihan->santri->catering->jumlah_catering . " Kali Makan"}}
                    </p>
                </div>
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Nominal</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md">{{ $pembayaran->tagihan->formatToRupiah('nominal') }}</p>
                </div>

                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Tahun Ajaran</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md">{{ $pembayaran->tagihan->tahun_ajaran }}</p>
                </div>
                @if ($pembayaran->tagihan->jenis_tagihan == 'syahriyyah')
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Semester</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md">{{ $pembayaran->tagihan->semester }}
                    </p>
                </div>
                @else
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Bulan pembayaran->Tagihan</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md">{{ $pembayaran->tagihan->bulan }}
                    </p>
                </div>
                @endif
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Tanggal pembayaran->Tagihan</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md">{{ $pembayaran->tagihan->tgl_tagihan->translatedFormat('d F
                        Y') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-4 py-6 px-10 bg-white rounded-lg dark:bg-slate-600 w-full">
            <div class="flex gap-2 justify-start items-center">
                <p class="font-semibold text-xl py-2">Informasi Bank Penerima</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                </svg>
            </div>
            <div class="w-full mt-2 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Nama Bank</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md">
                        {{ $pembayaran->pembayaranBank->bankPondok->nama_bank }}
                    </p>
                </div>
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Nomor Rekening</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md"> {{ $pembayaran->pembayaranBank->bankPondok->nomor_rekening
                        }}</p>
                </div>

                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Nama Rekening</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md"> {{ $pembayaran->pembayaranBank->bankPondok->nama_rekening
                        }}</p>
                </div>
            </div>
        </div>

        <div class="mb-4 py-6 px-10 bg-white rounded-lg dark:bg-slate-600 w-full">
            <div class="flex gap-2 justify-start items-center">
                <p class="font-semibold text-xl py-2">Informasi Bank Pengirim</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                </svg>
            </div>
            <div class="w-full mt-2 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Nama Bank</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md">
                        {{ $pembayaran->pembayaranBank->bankSantri->nama_bank }}
                    </p>
                </div>
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Nomor Rekening</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md"> {{ $pembayaran->pembayaranBank->bankSantri->nomor_rekening
                        }}</p>
                </div>

                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Nama Rekening</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md"> {{ $pembayaran->pembayaranBank->bankSantri->nama_rekening
                        }}</p>
                </div>
            </div>
        </div>

        <div class="mb-4 py-6 px-10 bg-white rounded-lg dark:bg-slate-600 w-full">
            <div class="flex gap-2 justify-start items-center">
                <p class="font-semibold text-xl py-2">Informasi Pembayaran</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                </svg>
            </div>
            <div class="w-full mt-2 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Tanggal Pembayaran</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md">
                        {{ $pembayaran->tanggal_bayar->translatedFormat('d F Y') }}
                    </p>
                </div>
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Metode Pembayaran</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md uppercase">
                        {{ $pembayaran->metode_pembayaran }}
                    </p>
                </div>
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Jumlah Bayar</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md"> {{ $pembayaran->formatToRupiah('jumlah_bayar') }}</p>
                </div>

                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Status Pembayaran</p>
                        <p>:</p>
                    </div>
                    <p class="w-2/3 mx-4 text-sm md:text-md"> {{ $pembayaran->status == 'pending' ? 'Belum
                        Dikonfirmasi'
                        : 'Dikonfirmasi'
                        }}</p>
                </div>
                <div class="flex px-2 py-2 gap-4 items-center">
                    <div class="flex w-1/3 justify-between me-2 items-center">
                        <p class="text-sm md:text-md">Bukti Transfer</p>
                        <p>:</p>
                    </div>
                    <div class="w-2/3 mx-4 text-sm flex justify-start items-center gap-2">
                        <x-button
                            x-on:click="$dispatch('img-modal', { imgModalSrc: '{{ Storage::url($pembayaran->pembayaranBank->bukti_transfer) }}' })"
                            class="md:w-1/3 w-full bg-emerald-600">Lihat Gambar</x-button>
                        <x-button wire:click='unduhGambar' class="md:w-1/3 w-full max-w-sm bg-emerald-600">Unduh Gambar
                        </x-button>
                    </div>
                </div>

                @if ($pembayaran->status == 'pending')
                <div class="pt-6 flex justify-start gap-4 flex-wrap">
                    <x-button x-on:click="$dispatch('konfirmasi-pembayaran-modal')"
                        class="w-full md:w-fit flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path
                                d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                        </svg>
                        <span>Konfirmasi Pembayaran</span>
                    </x-button>
                    <x-button x-on:click="$dispatch('delete-pembayaran-modal')"
                        class="w-full md:w-fit bg-red-500 flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                            <path
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                        </svg>
                        <span>Hapus Data Pembayaran</span>
                    </x-button>
                </div>
                @else
                <div class="pt-6">
                    <p class="text-xl font-medium font-poppins text-green-400">Pembayaran Sudah Dikonfirmasi</p>
                </div>
                @endif
            </div>
        </div>

    </section>

    {{-- Modal Image --}}
    <div x-data="{ imgModal : false, imgModalSrc : '' }">
        <div @img-modal.window="imgModal = true; imgModalSrc = $event.detail.imgModalSrc; imgModalDesc = $event.detail.imgModalDesc;"
            x-show="imgModal" x-cloak>
            <div x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="imgModalSrc = ''"
                class="p-2 fixed w-full h-screen inset-0 z-999999 overflow-hidden flex justify-center items-center bg-black bg-opacity-85">
                <div @click.away="imgModal = ''" class="flex flex-col max-w-3xl max-h-full overflow-auto">
                    <div class="z-999999">
                        <button @click="imgModal = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                            <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-2">
                        <img :src="imgModalSrc" :alt="imgModalSrc" class="object-contain h-1/2-screen">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@script

<script>
    window.addEventListener('delete-pembayaran-modal', () => {
            Swal.fire({
                title: "Apakah anda yakin?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });

                    Livewire.dispatch('delete-pembayaran');
            }
        });
    });

    window.addEventListener('konfirmasi-pembayaran-modal', () => {
        Swal.fire({
        title: "Konfirmasi Pembayaran ?",
        showCancelButton: true,
        confirmButtonText: "Bayar",
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            
            Livewire.dispatch('konfirmasi-pembayaran')
        } else if (result.isDenied) {
        }
    });
});
            
</script>

@endscript
@assets
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endassets