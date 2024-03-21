<div>
    <x-modals name="create-angkatan-modal" header="Tambah Angkatan">
        <form class="space-y-4" wire:submit='store'>
            <div>
                <label for="tahun_angkatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Tahun Angkatan </label>
                <input type="text" id="tahun_angkatan" wire:model="tahun_angkatan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Masukkan Nama Kamar" required />
                @error('tahun_angkatan')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                        }}</span></p>
                @enderror
            </div>
            <button type="submit"
                class="w-full mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </x-modals>
</div>