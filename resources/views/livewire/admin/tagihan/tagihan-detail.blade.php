<div class="px-2 md:px-4">
    <!-- Breadcrumb Start -->

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Detail Data Santri
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('tagihan') }}">Tagihan /</a>
                </li>
                <li class="text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <section class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600 font-poppins">
        Tagihan Detail Santri ID {{ $tagihan->id }}
    </section>

</div>