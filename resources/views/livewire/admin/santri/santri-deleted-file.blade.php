<div class="bg-slate-50 rounded-lg p-8">
    <div class="pt-2 pb-6">
        <a wire:navigate href="{{ route('santri') }}">Back</a>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="p-3 pb-4">
            <div>
                <h1 class="text-xl font-semibold text-black">Tong Sampah Data Santri</h1>
            </div>
        </div>
        @if ($santri->isNotEmpty())
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Santri
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        NIS
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        NIK
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Jenis Kelamin
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
                @foreach ($santri as $item)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->nama_santri }}
                    </th>
                    <td class="px-6 py-4 text-center">
                        {{ $item->nis }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $item->no_nik }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $item->jenisKelamin($item->jenis_kelamin) }}
                    </td>
                    <td class="px-6 py-4 text-center font-bold">
                        {{ strtoupper($item->status) }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a wire:click="restore({{ $item->id }})"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Restore</a>
                        |
                        <a x-on:click="$dispatch('delete-santri-modal', { santri_id: {{ $item->id }} })"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @else

        <div class="my-3">
            <h1 class="font-semibold text-center text-red-500 text-2xl"> Data Santri Tidak Ditemukan </h1>
        </div>

        @endif
    </div>

    {{-- Toast --}}
    <x-toast />
</div>


@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('delete-santri-modal', event => {
        Swal.fire({
        title: "Apakah anda yakin Ingin Menghapus Santri?",
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
            
            Livewire.dispatch('force-delete-santri', {
                santri_id: event.detail.santri_id
            });
        }
        });
    });
</script>
@endpush