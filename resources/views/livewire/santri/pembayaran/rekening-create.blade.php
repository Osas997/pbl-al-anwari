<div>
    <x-modals name="create-rekening-modal" header="Tambah Rekening Pengirim">
        <form class="space-y-4" wire:submit='store'>
            <div class="w-full">
                <label class="mb-3 block font-medium text-md font-poppins text-black dark:text-white">
                    Pilih Bank
                </label>
                <div wire:ignore>
                    <select class="bank-select-create w-full" style="width: 100%">
                        <option value=""></option>
                        @foreach ($dataBank as $bankId => $namaBank)
                        <option value="{{ $bankId }}">{{ $namaBank }}</option>
                        @endforeach
                    </select>
                </div>
                @error('id_bank')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                        }}</span></p>
                @enderror
            </div>
            <div>
                <label for="nama_rekening" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Nama Pemilik Rekening </label>
                <input type="text" id="nama_rekening" wire:model="nama_rekening"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Masukkan Nama Pemilik Rekening" />
                @error('nama_rekening')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                        }}</span></p>
                @enderror
            </div>
            <div>
                <label for="nomor_rekening" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Nomor Rekening </label>
                <input type="number" id="nomor_rekening" wire:model="nomor_rekening"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Masukkan Nomor Rekening" />
                @error('nomor_rekening')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                        }}</span></p>
                @enderror
            </div>
            <button type="submit"
                class="w-full mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </x-modals>
</div>

@script
<script>
    $(document).ready(function() {
    $('.bank-select-create').on('change', function (e) {
        const data = $('.bank-select-create').select2("val");
        @this.id_bank = data;
        });

    window.addEventListener('create-rekening', () => {
        $('.bank-select-create').val("").trigger('change');
    })
    });
    
</script>
@endscript