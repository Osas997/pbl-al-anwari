<div class="px-2 md:px-4">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Syahriyyah
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                </li>
                <li class="text-primary">Syahriyyah</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <section class="py-8 px-10 bg-white rounded-lg">
        <div class="my-3 flex justify-between items-center">
            <button type="button" x-on:click="$dispatch('open-modal', 'create-syahriyyah-modal')"
                class="inline-block rounded-full bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
                Tambah Syahriyyah
            </button>
        </div>
        <livewire:admin.syahriyyah.syahriyyah-table />
    </section>

    {{-- Modal Create --}}
    <livewire:admin.syahriyyah.syahriyyah-create />

    {{-- Modal Edit --}}
    <livewire:admin.syahriyyah.syahriyyah-edit />

    {{-- Toast --}}
    <x-toast />
</div>