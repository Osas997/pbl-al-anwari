<div class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 relative h-[400px] md:h-auto">
            <img 
                src="{{ asset('images/background.jpg') }}" 
                alt="Login Background" 
                class="absolute inset-0 w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center p-6">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Selamat Datang!</h2>
                <p class="text-sm hidden md:block">
                    Website Pembayaran Pondok Pesantren Al-Anwari
                </p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-6 md:p-12 flex flex-col justify-center">
            <h1 class="text-2xl md:text-3xl font-bold mb-6 text-center text-gray-800">Sign in</h1>

            @if (session()->has('error'))
            <div class="flex w-full justify-center mb-4">
                <x-alert-error message="{{ session('error') }}" />
            </div>
            @endif

            <form wire:submit="authenticate" class="space-y-4">
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Username
                        </label>
                        <input wire:model="username" type="text" placeholder="Enter your Username"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        @error('username')
                        <p class="text-red-500 px-4 pt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pb-4">
                        <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                            Password
                        </label>
                        <input wire:model="password" type="password" placeholder="Enter password"
                            class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        @error('password')
                        <p class="text-red-500 px-4 pt-2">{{ $message }}</p>
                        @enderror
                    </div>

                <button 
                    type="submit" 
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300 text-sm md:text-base"
                >
                    Login
                </button>
            </form>
        </div>
    </div>
</div>