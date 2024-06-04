<x-guest-layout>
   
<div class="w-full max-w-sm p-4 bg-bgprimary border-bgprimary rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
    <form class="space-y-6" action="{{ route('login') }}" method="POST">
        @csrf
         <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <h5 class="text-xl font-medium text-white dark:text-white">Sign in</h5>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-white dark:text-white">Email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Email" />
            <div x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 10000)" x-show="showError">
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-white dark:text-white">Password</label>
            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 10000)" x-show="showError"/>
        </div>
        <div class="flex items-start">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                </div>
                <label for="remember" class="ms-2 text-sm font-medium text-white dark:text-gray-300">Remember me</label>
            </div>
            <a href="{{ route('password.request') }}" class="ms-auto text-sm text-white hover:underline dark:text-blue-500">Forgot Password?</a>
        </div>
        <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
        {{-- <div class="text-sm font-medium text-textprimary dark:text-gray-300">
            Not registered? <a href="{{ route('register') }}" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
        </div> --}}
    </form>
</div>

    
</x-guest-layout>
