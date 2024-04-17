<div class="px-2 md:px-4">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Data Santri
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a wire:navigate class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                </li>
                <li class="text-primary">Santri</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <section class="py-8 px-10 bg-white rounded-lg dark:bg-slate-600">
        <div class="my-3 flex justify-between items-center">
            <button type="button" x-on:click="$dispatch('open-modal', 'create-santri-modal')"
                class="inline-block rounded-full bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong dark:bg-gray-300 dark:text-slate-800 dark:font-bold">
                Tambah Data Santri
            </button>
            <div>
                <a href="{{ route('deleted-santri') }}" wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" :fill="darkMode ? 'white' : 'black'"
                        class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                        <path
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                    </svg>
                </a>
            </div>
        </div>


    </section>

    <section class="mt-6 px-10 py-8 bg-white rounded-lg dark:bg-slate-600">
        <livewire:admin.santri.santri-table lazy />
    </section>

    {{-- Modal Create --}}
    <livewire:admin.santri.santri-create />

    {{-- Modal Edit --}}
    <livewire:admin.santri.santri-edit />

    {{-- Toast --}}
    <x-toast />
</div>

@push('script')
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
@endpush