<div>
    <x-modals name="create-santri-modal" header="Tambah Data Santri" width="max-w-3xl" margin="my-4">
        <form class="space-y-4" wire:submit='store'>
            <div class="flex justify-center gap-4 flex-wrap">
                <div class="grow">
                    <label for="nama_santri" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Santri</label>
                    <input type="text" id="nama_santri" wire:model="nama_santri"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Masukkan Nama Santri" required />
                    @error('nama_santri')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>
                <div class="grow">
                    <label for="nis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        NIS</label>
                    <input type="text" id="nis" wire:model="nis"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Masukkan NIS ( Nomor Induk Siswa )" required />
                    @error('nis')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>

            </div>
            <div class="flex justify-center gap-4 flex-wrap">
                <div class="grow">
                    <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        No Handphone / WA</label>
                    <input type="text" id="no_hp" wire:model="no_hp"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Masukkan No Handphone / WA" required />
                    @error('no_hp')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>
                <div class="grow">
                    <label for="no_nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                        NIK</label>
                    <input type="text" id="no_nik" wire:model="no_nik"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Masukkan Nomor Induk Kependudukan" required />
                    @error('no_nik')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>
            </div>


            <div class="flex justify-center gap-4 flex-wrap">
                <div class="grow">
                    <label for="nama_ayah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Ayah</label>
                    <input type="text" id="nama_ayah" wire:model="nama_ayah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Masukkan Nama Ayah" required />
                    @error('nama_ayah')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>
                <div class="grow">
                    <label for="nama_ibu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Ibu</label>
                    <input type="text" id="nama_ibu" wire:model="nama_ibu"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Masukkan Nama Ibu" required />
                    @error('nama_ibu')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-4 flex-wrap justify-center">
                <div class="grow">
                    <label for="tempat_lahir"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" wire:model="tempat_lahir"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Masukkan Nama Tempat Lahir" required />
                    @error('tempat_lahir')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>

                <div class="grow md:grow-0">
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <div class="mt-1 relative">
                        <input type="text" id="tanggal_lahir"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="01/03/2004" wire:model="tgl_lahir">

                        <!-- Icon untuk kalender -->
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a1 1 0 0 1 2 0v2h2V4a1 1 0 0 1 2 0v2h1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V4zm5 3H7v2h6V7zM6 14v2h8v-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    @error('tgl_lahir')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>

                <div class="grow">
                    <label for="alamat"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input type="text" id="alamat" wire:model="alamat"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Masukkan Alamat" required />
                    @error('alamat')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-center gap-4 flex-wrap">
                <div class="grow">
                    <label for="jenis_kelamin"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                    <select id="jenis_kelamin" wire:model="jenis_kelamin"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Jenis Kelamin</option>
                        <option value="L">Laki Laki</option>
                        <option value="P">Perempuan</option>
                    </select>

                    @error('jenis_kelamin')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>
                <div class="grow">
                    <div class="flex justify-center gap-4 flex-wrap">
                        <div class="grow">
                            <label for="diniyyah"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diniyyah</label>
                            <select id="diniyyah" wire:model="id_diniyyah"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pilih Diniyyah</option>
                                @if ($dataDiniyyah->isNotEmpty())
                                @foreach ($dataDiniyyah as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_tingkatan }} | {{ $item->kelas }}
                                </option>
                                @endforeach
                                @else
                                <option value="" disabled>Tidak ada diniyyah</option>
                                @endif
                            </select>
                            @error('id_diniyyah')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                                    }}</span>
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="grow">
                    <div class="flex justify-center gap-4 flex-wrap">
                        <div class="grow">
                            <label for="angkatan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Angkatan</label>
                            <select id="angkatan" wire:model="tahun_angkatan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pilih Angkatan</option>
                                @foreach ($dataTahun as $tahun)
                                <option value="{{ $tahun }}">{{ $tahun }}
                                </option>
                                @endforeach
                            </select>
                            @error('tahun_angkatan')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{
                                    $message
                                    }}</span>
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-4 flex-wrap">
                <div class="grow">
                    <label for="syahriyyah"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Syahriyyah</label>
                    <select id="syahriyyah" wire:model="id_syahriyyah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Syahriyyah</option>

                        @if ($dataSyahriyyah->isNotEmpty())
                        @foreach ($dataSyahriyyah as $item)
                        <option value="{{ $item->id }}">{{ $item->jenis_domisili }}
                        </option>
                        @endforeach
                        @else
                        <option value="" disabled>Tidak ada syahriyyah</option>
                        @endif
                    </select>

                    @error('id_syahriyyah')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>
                <div class="grow">
                    <div class="flex justify-center gap-4 flex-wrap">
                        <div class="grow">
                            <label for="catering"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catering</label>
                            <select id="catering" wire:model="id_catering"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pilih Catering</option>
                                @if ($dataCatering->isNotEmpty())
                                @foreach ($dataCatering as $item)
                                <option value="{{ $item->id }}">{{ $item->jumlah_catering }} Kali Makan
                                </option>
                                @endforeach
                                @else
                                <option value="" disabled>Tidak ada catering</option>
                                @endif
                            </select>

                            @error('id_catering')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                                    }}</span>
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>

            <button type="submit"
                class="w-full mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </x-modals>
</div>