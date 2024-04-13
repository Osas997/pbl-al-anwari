<div class="px-2 md:px-4">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Data Tagihan
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                </li>
                <li class="text-primary">Tagihan</li>
            </ol>
        </nav>
    </div>

    <!-- Breadcrumb End -->
    <section class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600">
        @if ($totalSantri > 0)
        <div class="my-3">
            <button type="button" x-on:click="$dispatch('open-modal', 'create-tagihan-modal')"
                class="inline-block rounded-full bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong dark:bg-gray-300 dark:text-slate-800 dark:font-bold">
                Generate Tagihan
            </button>
        </div>
        @else
        <div class="my-3">
            <h1 class="font-semibold text-center text-red-500 text-2xl"> Santri Tidak Ditemukan </h1>
        </div>
        @endif
    </section>


    {{-- Modal Create --}}
    <livewire:admin.tagihan.tagihan-create />

    {{-- Toast --}}
    <x-toast />
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('delete-diniyyah-modal', event => {
            Swal.fire({
                title: "Apakah anda yakin?",
                icon: "warning",    
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });

                    Livewire.dispatch('delete-diniyyah', {
                        diniyyah_id: event.detail.diniyyah_id
                    });
                }
            });
        });
</script>
@endpush