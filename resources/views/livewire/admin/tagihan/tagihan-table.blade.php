<div class="font-poppins scroll-smooth" id="tagihan-table">
    <div class="relative overflow-x-auto sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <label for="table-search" class="sr-only">Search</label>
            <div class="flex gap-4 flex-wrap items-center">
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

                <div x-data="{ open: false }" @click.away="open = false" class="relative h-fit">
                    <button @click="open = !open"
                        class="flex items-center bg-white border border-zinc-300 text-zinc-700 py-2 px-4 rounded-lg focus:outline-none focus:border-blue-500">
                        <span>{{ ucwords($status) }}</span>
                        {{-- <span x-text=""></span> --}}
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open"
                        class="absolute mt-1 bg-white border border-zinc-300 rounded-lg shadow-lg z-10 w-48 py-1"
                        @click.away="open = false">
                        <p @click="open = false" wire:click='changeStatus("belum lunas")'
                            class="cursor-pointer px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100">Belum Lunas /
                            Angsur
                        </p>
                        <p @click="open = false" wire:click='changeStatus("lunas")'
                            class="cursor-pointer px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100">Lunas</p>
                    </div>
                </div>

            </div>
        </div>
        @if ($tagihan->isNotEmpty())
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4">
            <thead class="text-xs text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 border border-slate-300">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-300">
                        Nama Santri
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-300 text-center">
                        Jenis Tagihan
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-300 text-center">
                        Nominal
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-300 text-center">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-300 text-center">
                        Tanggal Tagihan
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-300 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tagihan as $index => $item)
                <tr class="bg-white dark:bg-gray-800" wire:key="{{ $item->id }}">
                    <th scope="row"
                        class="px-6 py-4 border border-slate-300 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $tagihan->firstItem() + $index }}
                    </th>
                    <th scope="row"
                        class="px-6 py-4 border border-slate-300 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->santri->nama_santri }}
                    </th>
                    <td
                        class="px-2 text-center py-4 border border-slate-300 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->jenis_tagihan }}
                    </td>
                    <td
                        class="px-2 py-4 border text-center border-slate-300 text-gray-900 whitespace-nowrap dark:text-white font-bold">
                        {{ $item->formatToRupiah('nominal') }}
                    </td>
                    <td
                        class="px-2 text-center uppercase py-4 border border-slate-300 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->status }}
                    </td>
                    <td
                        class="px-2 text-center py-4 border border-slate-300 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->tgl_tagihan->translatedFormat('d F Y') }}
                    </td>
                    <td
                        class="px-2 py-4 border border-slate-300 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex justify-center">
                            <div class="flex">
                                <a href="{{ route('tagihan-detail', $item->id) }}" wire:navigate
                                    class="px-3 py-2 text-blue-600 transition-all ease-in-out duration-300 hover:bg-blue-600 hover:text-white rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </a>
                                @if ($item->status == 'belum lunas')
                                <a x-on:click="$dispatch('delete-tagihan-modal', { tagihan_id: {{ $item->id }} })"
                                    class="cursor-pointer px-3 py-2 text-blue-600 transition-all ease-in-out duration-300 hover:bg-blue-600 hover:text-white rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        @else

        <div class="my-3 py-4">
            <h1 class="font-semibold text-center text-red-500 text-xl"> Tidak Ada Data Tagihan </h1>
        </div>

        @endif
    </div>

    <div class="py-4 px-4 mt-4">
        {{ $tagihan->links("vendor.livewire.tailwind", data: ['scrollTo' => '#tagihan-table']) }}
    </div>

</div>