<div>
    <div class="pb-4 px-2 border-b pt-6">
        <p class="text-black font-semibold">Form Pembayaran </p>
    </div>
    <div class="w-full py-2 my-2">
        <form>
            <div>
                <div class="relative">
                    <x-input wire:model='tanggal_bayar' label="  Tanggal Pembayaran" placeholder="mm/dd/yyyy"
                        type="date" />
                    @error('tanggal_bayar')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                            }}</span>
                    </p>
                    @enderror
                </div>
            </div>
            <div class="my-4">
                <x-input wire:model='jumlah_bayar' label="Jumlah Yang Dibayarkan" type="number" min="0" />
                @error('jumlah_bayar')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message
                        }}</span>
                </p>
                @enderror
            </div>
            <div class="mt-6">
                <x-button type="button" class="w-full" x-on:click="$dispatch('confirm-pembayaran-modal')">
                    <span class="w-full">Bayar</span>
                </x-button>
            </div>
        </form>
    </div>
</div>


@assets
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endassets
@script
<script>
    // Confirm Modal pembayraran
window.addEventListener('confirm-pembayaran-modal', () => {
    Swal.fire({
    title: "Konfirmasi Pembayaran ?",
    showCancelButton: true,
    confirmButtonText: "Bayar",
    }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
        Livewire.dispatch('bayar-tagihan')
    } else if (result.isDenied) {
    }
    });
});
</script>
@endscript