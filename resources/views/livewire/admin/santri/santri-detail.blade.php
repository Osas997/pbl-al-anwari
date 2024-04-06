<div class="px-2 md:px-4">
    <!-- Breadcrumb Start -->

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Detail Data Santri
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('santri') }}">Santri /</a>
                </li>
                <li class="text-primary">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <section class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600">
        <h1 class="uppercase text-xl font-semibold">{{ $santri->nama_santri }}</h1>
    </section>

    {{-- Toast --}}
    <x-toast />
</div>

{{-- @push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('delete-santri-modal', event => {
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

                    Livewire.dispatch('delete-santri', {
                        santri_id: event.detail.santri_id
                    });
                }
            });
        });
</script>
@endpush --}}