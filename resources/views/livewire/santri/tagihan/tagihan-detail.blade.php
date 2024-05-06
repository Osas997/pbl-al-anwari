<div class="px-2 md:px-4 font-poppins text-black">
    <!-- Breadcrumb Start -->

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Detail Data Tagihan
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('tagihan-santri') }}">Tagihan /</a>
                </li>
                <li class="text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <section>

        <div class="py-4 mt-2 w-full">
            <div class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600 ">
                <p class="text-xl font-semibold">
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

        </div>

        <div class="py-2 mb-2 w-full">
            <div class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600 ">
                <div>
                    <ul class="flex flex-col">
                        <li class="bg-white my-2 rounded-md shadow-lg" x-data="accordion(1)">
                            <h2 @click="handleClick()"
                                class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                                <span> Informasi Penting !
                                </span>
                                <svg :class="handleRotate()"
                                    class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                    </path>
                                </svg>
                            </h2>
                            <div x-ref="tab" :style="handleToggle()"
                                class="overflow-hidden max-h-0 duration-500 transition-all px-4">
                                <x-alert-info>Pembayaran dapat dilakukan melalui Bendahara
                                    atau dapat
                                    transfer melalui rekening di bawah ini.</x-alert-info>
                                <x-alert-info class="italic underline">Jangan Melakukan Transfer ke
                                    Rekening
                                    Selain
                                    Dari
                                    rekening dibawah.</x-alert-info>
                                <x-alert-info>Setelah melakukan transfer, harap upload
                                    bukti
                                    pembayaran melalui form berikut.</x-alert-info>
                            </div>
                        </li>
                        <li class="bg-white my-2 rounded-md shadow-lg" x-data="accordion(2)">
                            <h2 @click="handleClick()"
                                class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                                <span> Cara Pembayaran Melalui ATM
                                </span>
                                <svg :class="handleRotate()"
                                    class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                    </path>
                                </svg>
                            </h2>
                            <div x-ref="tab" :style="handleToggle()"
                                class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all">
                                <p class="p-3 text-gray-900">
                                    Shipping time is set by our delivery partners, according to the delivery method
                                    chosen by you. Additional details can be found in the order confirmation
                                </p>
                            </div>
                        </li>
                        <li class="bg-white my-2 rounded-md shadow-lg" x-data="accordion(3)">
                            <h2 @click="handleClick()"
                                class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                                <span>Cara Pembayaran Melalui Internet Banking</span>
                                <svg :class="handleRotate()"
                                    class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                    </path>
                                </svg>
                            </h2>
                            <div class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                                x-ref="tab" :style="handleToggle()">
                                <p class="p-3 text-gray-900">
                                    Once shipped, you’ll get a confirmation email that includes a tracking number and
                                    additional information regarding tracking your order.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="py-2 mb-2 w-full">
            <div class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600 ">
                <p class="text-xl font-semibold mb-5">
                    Konfirmasi Pembayaran
                </p>
                <div>
                    <x-divider-info>INFORMASI REKENING PENGIRIM</x-divider-info>

                    <div class="my-2 py-2">
                        <button x-on:click="$dispatch('open-modal', 'create-rekening-modal')"
                            class="underline flex gap-1 text-blue-700 text-sm md:text-base items-center">Tambah
                            Rekening Pengirim
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-plus-circle w-4 h-4 md:w-4 md:h-4" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                            </svg>
                        </button>


                        <livewire:santri.pembayaran.pembayaran-create />
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- Toast --}}
    <x-toast />

    {{-- tambah rekening modal --}}
    <livewire:santri.pembayaran.rekening-create />

</div>

@script
<script>
    $(document).ready(function() {
        $('.bank-select-create').select2({
            placeholder: 'Pilih Bank',
        });
    });
    Alpine.store('accordion', {
        tab: 0
        });

    Alpine.data('accordion', (idx) => ({
        init() {
            this.idx = idx;
        },
        
        idx: -1,
        handleClick() {
            this.$store.accordion.tab = this.$store.accordion.tab === this.idx ? 0 : this.idx;
        },
        handleRotate() {
            return this.$store.accordion.tab === this.idx ? 'rotate-180' : '';
        },
        handleToggle() {
            return this.$store.accordion.tab === this.idx ? `max-height: ${this.$refs.tab.scrollHeight}px` : '';
        }
    }));
</script>
@endscript

@assets
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endassets