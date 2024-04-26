<div class="px-2 md:px-4">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Data Tagihan Selesai
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                </li>
                <li class="text-primary">Tagihan Selesai</li>
            </ol>
        </nav>
    </div>

    <section class="mt-6 px-10 py-8 bg-white rounded-lg dark:bg-slate-600">
        <livewire:admin.tagihan.tagihan-selesai-table lazy />
    </section>

</div>