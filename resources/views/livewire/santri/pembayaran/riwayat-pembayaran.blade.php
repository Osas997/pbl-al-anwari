<div class="px-2 md:px-4 font-poppins">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="font-bold text-black dark:text-white text-xl md:text-2xl">
            Riwayat Pembayaran {{ auth()->user()->nama_santri }}
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                </li>
                <li class="text-primary">Riwayat Pembayaran</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <section class="py-8 px-10 bg-white rounded-lg">
        <livewire:santri.pembayaran.riwayat-pembayaran-table lazy />
    </section>
</div>