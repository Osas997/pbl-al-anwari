<div class="py-4">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">



        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

            <div class="sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="w-full">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth('admin')->user()->username]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-4">
                            <h1>kontol</h1>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search" wire:model.live='search'
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari Data Santri">
            </div>
        </div>
        @if ($santri->isNotEmpty())
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Santri
                    </th>
                    <th scope="col" class="px-6 py-3">
                        NIS
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jenis Kelamin
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
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
                    <td class="px-6 py-4">
                        {{ $item->nis }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->jenisKelamin($item->jenis_kelamin) }}
                    </td>
                    <td class="px-6 py-4 font-bold">
                        {{ strtoupper($item->status) }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('santri-detail', $item->id) }}" wire:navigate
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat
                            Detail</a>
                        |
                        <a x-on:click="$dispatch('update-santri', { santri_id: {{ $item->id }} })"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Edit</a>
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

        <div class="py-4 px-4">
            {{ $santri->links('vendor.livewire.tailwind') }}
        </div>
    </div>

</div>