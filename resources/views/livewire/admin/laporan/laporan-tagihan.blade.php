<div class="font-poppins">
    <h1 class="text-slate-800 font-semibold text-lg">Laporan Tagihan</h1>
    <form wire:submit='cetakPdf'>
        <div class="flex gap-4 mt-4 w-full flex-wrap">

            <div class="md:flex-1 w-1/2">
                <label class="mb-3 block text-base text-black dark:text-white">
                    Jenis Tagihan
                </label>
                <div x-data="{ isOptionSelected: false }" class="relative bg-white dark:bg-form-input">
                    <select wire:model.live='jenis_tagihan'
                        class="relative w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                        :class="isOptionSelected &amp;&amp; 'text-black dark:text-white'"
                        @change="isOptionSelected = true">
                        <option value="syahriyyah" class="text-body">Syahriyyah</option>
                        <option value="catering" class="text-body">Catering</option>
                    </select>
                    <span class="absolute right-4 top-1/2 -translate-y-1/2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    fill="#637381"></path>
                            </g>
                        </svg>
                    </span>
                </div>
                @error('jenis_tagihan')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:flex-1 w-2/5">
                <label class="mb-3 block text-base text-black dark:text-white">
                    Status
                </label>
                <div x-data="{ isOptionSelected: false }" class="relative bg-white dark:bg-form-input">
                    <select wire:model='status'
                        class="relative w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                        :class="isOptionSelected &amp;&amp; 'text-black dark:text-white'"
                        @change="isOptionSelected = true">
                        <option value="lunas" class="text-body">Lunas</option>
                        <option value="belum lunas" class="text-body">Belum Lunas</option>
                    </select>
                    <span class="absolute right-4 top-1/2 -translate-y-1/2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    fill="#637381"></path>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="md:flex-1 w-1/2">
                <label class="mb-3 block text-base text-black dark:text-white">
                    Tahun Ajaran
                </label>
                <div x-data="{ isOptionSelected: false }" class="relative bg-white dark:bg-form-input">
                    <select wire:model='tahun_ajaran'
                        class="relative w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                        :class="isOptionSelected &amp;&amp; 'text-black dark:text-white'"
                        @change="isOptionSelected = true">
                        <option value="">Tahun Ajaran</option>
                        @foreach ($tahunAjaran as $item)
                        <option value="{{ $item }}" class="text-body">{{ $item }}</option>
                        @endforeach
                    </select>
                    <span class="absolute right-4 top-1/2 -translate-y-1/2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    fill="#637381"></path>
                            </g>
                        </svg>
                    </span>
                </div>
                @error('tahun_ajaran')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            @if ($jenis_tagihan == "syahriyyah")
            <div class="md:flex-1 w-2/5">
                <label class="mb-3 block text-base text-black dark:text-white">
                    Semester
                </label>
                <div x-data="{ isOptionSelected: false }" class="relative bg-white dark:bg-form-input">
                    <select wire:model='semester'
                        class="relative w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                        :class="isOptionSelected &amp;&amp; 'text-black dark:text-white'"
                        @change="isOptionSelected = true">
                        <option value="">Semester</option>
                        <option value="1" class="text-body">Ganjil (1)</option>
                        <option value="2" class="text-body">Genap (2)</option>
                    </select>
                    <span class="absolute right-4 top-1/2 -translate-y-1/2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    fill="#637381"></path>
                            </g>
                        </svg>
                    </span>
                </div>
                @error('semester')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            @else
            <div class="md:flex-1 w-2/5">
                <label class="mb-3 block text-base text-black dark:text-white">
                    Bulan
                </label>
                <div x-data="{ isOptionSelected: false }" class="relative bg-white dark:bg-form-input">
                    <select wire:model='bulan'
                        class="relative w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                        :class="isOptionSelected &amp;&amp; 'text-black dark:text-white'"
                        @change="isOptionSelected = true">
                        <option value="">Bulan</option>
                        @foreach (range(1, 12) as $monthNumber)
                        <option value="{{ getMonthName($monthNumber) }}" class="text-black">
                            {{ getMonthName($monthNumber) }}
                        </option>
                        @endforeach
                    </select>
                    <span class="absolute right-4 top-1/2 -translate-y-1/2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    fill="#637381"></path>
                            </g>
                        </svg>
                    </span>
                </div>
                @error('bulan')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            @endif
        </div>
        <div class="pb-1 w-full md:w-1/4 mt-4">
            <x-button class="flex gap-2 items-center justify-center w-full" type="submit"
                wire:loading.remove='cetakPdf'>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                    <path
                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0" />
                </svg>
                Cetak PDF
            </x-button>
            <x-button class="flex items-center justify-center w-full md:w-fit" wire:loading='cetakPdf' disabled
                type="button">
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
            </x-button>

        </div>
    </form>
</div>