<div class="px-2 md:px-4 font-poppins">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="font-bold text-black dark:text-white text-2xl md:text-title-md2 ">
            Data Tagihan {{ auth()->user()->nama_santri }}
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                </li>
                <li class="text-primary">Angkatan</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <section class="py-8 px-10 bg-white rounded-lg">
        <livewire:santri.tagihan.tagihan-table lazy />
    </section>
</div>
{{--
<div>
    <div x-data="{ open: false }" class="inline-flex relative">
        <button @click="open = ! open" class="px-4 pe-10 py-2 border border-gray-200 rounded-lg shadow-sm">
            <span class="select-none absolute inset-y-0 right-0 flex items-center cursor-pointer pr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </span>
            Toggle Content
        </button>
        <div x-cloak x-show="open" @click.away="open = false"
            class="w-full absolute top-12 left-0 p-2 bg-white border border-gray-200 rounded-lg shadow">
            <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200">
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="filter-radio-example-1" type="radio" value="" name="filter-radio"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="filter-radio-example-1"
                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                            day</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input checked="" id="filter-radio-example-2" type="radio" value="" name="filter-radio"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="filter-radio-example-2"
                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                            7 days</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="filter-radio-example-3" type="radio" value="" name="filter-radio"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="filter-radio-example-3"
                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                            30 days</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="filter-radio-example-4" type="radio" value="" name="filter-radio"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="filter-radio-example-4"
                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                            month</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="filter-radio-example-5" type="radio" value="" name="filter-radio"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="filter-radio-example-5"
                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                            year</label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div> --}}