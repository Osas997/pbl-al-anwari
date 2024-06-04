<div class="py-4 font-poppins">
    <div class="bg-white dark:bg-form-input mb-8">
        <label class="mb-2 block font-medium text-md font-poppins text-black dark:text-white">
            Pilih Bank Pengirim
        </label>
        <select wire:model.live='idBankSantri' id="idBankSantri"
            class="cursor-pointer text-black dark:text-white w-full rounded border border-stroke bg-transparent py-1 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
            @if ($rekeningSantri->isNotEmpty())
            <option value="">Pilih</option>
            @foreach ($rekeningSantri as $item)
            <option value="{{ $item->id }}">{{ $item->nama_bank }} | {{ $item->nomor_rekening }}</option>
            @endforeach
            @else
            <option value="" disabled>Belum Ada Rekening Silahkan Tambah Rekening Terlebih Dahulu</option>
            @endif
        </select>
        @error('idBankSantri')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{
                $message
                }}</span>
        </p>
        @enderror
    </div>

    <x-divider-info>INFORMASI REKENING TUJUAN / PONDOK</x-divider-info>

    <div class="bg-white dark:bg-form-input mb-4">
        <label for="idBankPondok" class="mb-2 block font-medium text-md font-poppins text-black dark:text-white">
            Pilih Bank Tujuan Pembayaran
        </label>
        <select wire:model.live='idBankPondok' id="idBankPondok"
            class="cursor-pointer text-black dark:text-white w-full rounded border border-stroke bg-transparent py-1 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input">
            @foreach ($AllRekeningPondok as $item)
            <option value="{{ $item->id }}">{{ $item->nama_bank }}</option>
            @endforeach
        </select>
        @error('idBankPondok')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{
                $message
                }}</span>
        </p>
        @enderror
    </div>

    <div class="py-2">

        <x-alert-biasa>
            @if ($rekeningPondok)
            <h2 class="text-center pb-2">Transfer Ke Rekening Berikut</h2>
            <p>Nama Bank : {{ $rekeningPondok->nama_bank }}</p>
            <p>Nomor Rekening : {{ $rekeningPondok->nomor_rekening }}</p>
            <p>Nama Rekening : {{ $rekeningPondok->nama_rekening }}</p>
            @else
            <p>Bank Tujuan Harus Valid</p>
            @endif
        </x-alert-biasa>
    </div>

    <x-divider-info>INFORMASI PEMBAYARAN</x-divider-info>

    <div class="py-2">
        <span class="py-3 text-md block font-medium font-poppins">
            Upload Bukti Pembayaran
        </span>
        <livewire:dropzone wire:model="buktiPembayaran" :rules="['required','image','mimes:png,jpeg,jpg','max:1024']"
            :multiple="false" />
        @error('buktiPembayaran')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{
                $message
                }}</span>
        </p>
        @enderror
    </div>

    <div class="mt-6 w-full flex justify-center">
        <div class="w-full md:w-72">
            <x-button type="button" class="w-full" x-on:click="$dispatch('confirm-pembayaran-modal')">
                <span class="w-full">Konfirmasi Pembayaran</span>
            </x-button>
        </div>
    </div>

</div>