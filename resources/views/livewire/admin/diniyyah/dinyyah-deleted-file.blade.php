<div>
    <div class="pt-2 pb-6">
        <a wire:navigate href="{{ route('diniyyah') }}">Back</a>
    </div>

    <div class="py-4 bg-white rounded-lg p-8">
        <div class="pb-4">
            <h1 class="font-semibold text-2xl text-black">Diniyyah</h1>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if ($diniyyah->isNotEmpty())
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-whiten dark:bg-gray-700 dark:text-gray-400">
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
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->nama_tingkatan }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->kelas }}
                        </td>
                        <td class="px-6 py-4">
                            <a wire:click="restore({{ $item->id }})"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Restore</a>
                            |
                            <a x-on:click="$dispatch('delete-diniyyah-modal', { diniyyah_id: {{ $item->id }} })"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="my-6">
                <h1 class="font-semibold text-center text-red-500 text-2xl"> Belum Ada Data</h1>
            </div>
            @endif
        </div>
    </div>

    {{-- Toast --}}
    <x-toast />
</div>


@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('delete-diniyyah-modal', event => {
        Swal.fire({
        title: "Apakah anda yakin Ingin Menghapus diniyyah?",
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
            
            Livewire.dispatch('force-delete-diniyyah', {
                diniyyah_id: event.detail.diniyyah_id
            });
        }
        });
    });
</script>
@endpush