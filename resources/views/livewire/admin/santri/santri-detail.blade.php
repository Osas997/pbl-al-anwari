<div class="px-2 md:px-4">
    <!-- Breadcrumb Start -->

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Detail Data Santri
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('santri') }}">Santri /</a>
                </li>
                <li class="text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <section class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600 font-poppins">
        <div class="w-full flex justify-center">
            <img src="{{ asset('images/no_profile.png') }}" alt="" class="w-1/4 md:w-2/12 rounded-md">
        </div>
        <div class="w-full mt-8 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Nama Santri</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->nama_santri }}</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Status Santri</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md"> <span
                        class="bg-blue-100 text-blue-800 text-md font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-white">
                        {{ strtoupper($santri->status) }}
                    </span></p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Jenis Kelamin</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md"> {{ $santri->jenisKelamin($santri->jenis_kelamin) }}
                </p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">NIS</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->nis }}</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">NO NIK</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->no_nik }}</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">NO HP</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->no_hp }}</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Tempat Lahir</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->tempat_lahir }}</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Tanggal Lahir</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ \Carbon\Carbon::parse($santri->tanggal_lahir)->format('d F
                    Y')}}</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Alamat</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->alamat }}</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Nama Ibu</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->nama_ibu }}</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Nama Ayah</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->nama_ayah }}</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Angkatan</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->angkatan->tahun_angkatan }}</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Diniyyah</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->diniyyah->nama_tingkatan }}</p>
            </div>
        </div>
        <h1 class="font-semibold text-md text-black py-6">Biaya</h1>
        <div class="w-full text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Biaya Syahriyyah</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">{{ $santri->syahriyyah->jenis_domisili }} (
                    {{ $santri->syahriyyah->formatToRupiah($santri->syahriyyah->biaya) }} )</p>
            </div>
            <div class="flex px-2 py-2 gap-4 items-center">
                <div class="flex w-1/3 justify-between me-2">
                    <p class="text-sm md:text-md">Biaya Catering</p>
                    <p>:</p>
                </div>
                <p class="w-2/3 mx-4 text-sm md:text-md">
                    {{ $santri->catering->jumlah_catering }} Kali Makan ( {{
                    $santri->catering->formatToRupiah($santri->catering->biaya) }} )
                </p>
            </div>
        </div>
    </section>

</div>

{{-- @push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('delete-santri-modal', event => {
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

                    Livewire.dispatch('delete-santri', {
                        santri_id: event.detail.santri_id
                    });
                }
            });
        });
</script>
@endpush --}}