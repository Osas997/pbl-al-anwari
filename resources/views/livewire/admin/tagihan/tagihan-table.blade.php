<div class="py-4 font-poppins scroll-smooth" id="tagihan-table">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-6 py-4">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
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

            <button type="button" wire:click="cetakPdf" wire:loading.remove wire:target='cetakPdf'
                class="flex gap-2 rounded-full bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong dark:bg-gray-300 dark:text-slate-800 dark:font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                    <path
                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0" />
                </svg>
                Cetak PDF
            </button>

            <button wire:loading wire:target='cetakPdf' disabled type="button"
                class="text-white rounded-full bg-primary px-6 pb-2 pt-2.5 text-xs focus:ring-4 focus:ring-blue-300 font-medium py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
                <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor" />
                </svg>
                Downloading...
            </button>
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
                                <a x-on:click="$dispatch('delete-tagihan-modal', { tagihan_id: {{ $item->id }} })"
                                    class="cursor-pointer px-3 py-2 text-blue-600 transition-all ease-in-out duration-300 hover:bg-blue-600 hover:text-white rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
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