@php
function getMonthName($monthNumber) {
return \Carbon\Carbon::createFromDate(null, $monthNumber, null,
'UTC')->locale('id_ID')->translatedFormat('F');
}
@endphp
<div class="font-poppins">
    <x-modals name="create-tagihan-modal" header="Generate Tagihan">
        <form class="space-y-4" wire:submit='generate'>
            <div>
                <label class="mb-3 block font-medium text-md font-poppins text-black dark:text-white">
                    Pilih Jenis Tagihan
                </label>
                <div class="relative z-20 bg-white dark:bg-form-input">
                    <select wire:model.live='jenis_tagihan'
                        class="relative z-20 text-black dark:text-white w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="">Pilih</option>
                        <option value="syahriyyah" class="text-black">Syahriyyah</option>
                        <option value="catering" class="text-black">Catering</option>
                    </select>
                    @error('jenis_tagihan')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                    <span class="absolute right-4 top-1/2 z-20 -translate-y-1/2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    :fill="darkMode ? 'white' : 'black'"></path>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>

            <div>
                <label class="mb-3 block font-medium text-md font-poppins text-black dark:text-white">
                    Pilih Tahun Ajaran
                </label>
                <div class="relative z-20 bg-white dark:bg-form-input">
                    <select wire:model='tahun_ajaran'
                        class="relative z-20 text-black dark:text-white w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="">Pilih</option>
                        @foreach ($dataTahun as $tahun)
                        <option value="{{ $tahun }}" class="text-black">{{ $tahun }}
                        </option>
                        @endforeach
                    </select>
                    @error('tahun_ajaran')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                    <span class="absolute right-4 top-1/2 z-20 -translate-y-1/2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    :fill="darkMode ? 'white' : 'black'"></path>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>

            @if ($jenis_tagihan == 'syahriyyah')
            <div>
                <label class="mb-3 block font-medium text-md font-poppins text-black dark:text-white">
                    Pilih Semester
                </label>
                <div class="relative z-20 bg-white dark:bg-form-input">
                    <select wire:model='semester'
                        class="relative z-20 text-black dark:text-white w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="">Pilih</option>
                        <option value="1" class="text-black">1 (Ganjil)</option>
                        <option value="2" class="text-black">2 (Genap)</option>
                    </select>
                    @error('semester')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                    <span class="absolute right-4 top-1/2 z-20 -translate-y-1/2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    :fill="darkMode ? 'white' : 'black'"></path>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>

            @elseif ($jenis_tagihan == 'catering')

            <div>
                <label class="mb-3 block font-medium text-md font-poppins text-black dark:text-white">
                    Pilih Bulan
                </label>
                <div class="relative z-20 bg-white dark:bg-form-input">
                    <select wire:model='bulan'
                        class="relative z-20 text-black dark:text-white w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
                        <option value="">Pilih</option>
                        @foreach (range(1, 12) as $monthNumber)
                        <option value="{{ getMonthName($monthNumber) }}" class="text-black">
                            {{ getMonthName($monthNumber) }}
                        </option>
                        @endforeach

                    </select>
                    @error('bulan')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                    <span class="absolute right-4 top-1/2 z-20 -translate-y-1/2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                    :fill="darkMode ? 'white' : 'black'"></path>
                            </g>
                        </svg>
                    </span>
                </div>
            </div>
            @endif

            <div>
                <p class="text-md font-medium text-black dark:text-white pb-2">Nominal</p>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700 p-2">
                    @if ($jenis_tagihan == 'syahriyyah')
                    @foreach ($dataSyahriyyah as $item)
                    <li class="pb-3 sm:pb-4">
                        <div class="flex items-center justify-between">
                            <div class="p-2">
                                <p class="text-md font-medium text-black dark:text-white">{{ $item->jenis_domisili }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $item->formatToRupiah('biaya') }}
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @elseif ($jenis_tagihan == 'catering')
                    @foreach ($dataCatering as $item)
                    <li class="pb-3 sm:pb-4">
                        <div class="flex items-center justify-between">
                            <div class="p-2">
                                <p class="text-md font-medium text-black dark:text-white">{{ $item->jumlah_catering }}
                                    Kali Makan
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $item->formatToRupiah('biaya') }}
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @else
                    <p class="text-md font-medium text-black dark:text-white text-center">Pilih Jenis Tagihan</p>
                    @endif
                </ul>
            </div>

            <button wire:loading.remove wire:target="generate" type="submit"
                onclick="return confirm('Generate Tagihan Ke {{ $totalSantri }} Santri?')"
                class="w-full mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

            <div class="text-center font-semibold" wire:loading wire:target="generate">
                Loading ...
            </div>
        </form>
    </x-modals>
</div>