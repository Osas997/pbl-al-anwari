<div class="mx-auto max-w-270">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Profile Page
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="index.html">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Profile</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- ====== Settings Section Start -->
    <div class="px-2 md:px-8">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-7 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">
                    Profile
                </h3>
            </div>
            <div class="p-7">
                <form wire:submit='edit'>
                    <div class="mb-5.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                            for="currentPassword">Nama</label>
                        <div class="relative">

                            <input wire:model='nama_santri'
                                class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                name="currentPassword" id="currentPassword" />

                        </div>
                        @error('nama_santri')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                    <div class="mb-5.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                            for="currentPassword">No. HP</label>
                        <div class="relative">
                            <input wire:model='no_hp'
                                class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                name="currentPassword" id="currentPassword" />


                        </div>
                        @error('no_hp')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                    <div class="mb-5.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                            for="currentPassword">Tempat Lahir</label>
                        <div class="relative">

                            <input wire:model='tempat_lahir'
                                class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                name="currentPassword" id="currentPassword" />

                        </div>
                        @error('tempat_lahir')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                    <div class="mb-5.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                            for="currentPassword">Tanggal Lahir</label>
                        <div class="relative">

                            <input wire:model='tgl_lahir'
                                class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                name="currentPassword" id="currentPassword" />

                        </div>
                        @error('tgl_lahir')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                    <div class="mb-5.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                            for="currentPassword">Alamat</label>
                        <div class="relative">

                            <input wire:model='alamat'
                                class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                name="currentPassword" id="currentPassword" />

                        </div>
                        @error('alamat')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-4.5">

                        <button
                            class="flex justify-center rounded bg-primary px-6 py-2 font-medium text-gray hover:bg-opacity-90 text-white"
                            type="submit">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ====== Settings Section End -->
</div>
