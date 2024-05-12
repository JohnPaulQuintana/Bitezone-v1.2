<x-guest-layout>
    
    <div class="w-full max-w-lg p-4 mt-20 bg-bgprimary border-bgprimary rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            <h5 class="text-xl font-medium text-white dark:text-white">Create Account</h5>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div>
                    <label for="firstname" class="block mb-2 text-sm font-medium text-white dark:text-white">First Name</label>
                    <input type="text" value="{{ old('firstname') }}" name="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="First Name" />
                    <div x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 5000)" x-show="showError">
                        @error('firstname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="middlename" class="block mb-2 text-sm font-medium text-white dark:text-white">Middle Name</label>
                    <input type="text" value="{{ old('middlename') }}" name="middlename" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Middle Name" />
                    <div x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 5000)" x-show="showError">
                        @error('middlename')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="lastname" class="block mb-2 text-sm font-medium text-white dark:text-white">Last Name</label>
                    <input type="text" value="{{ old('lastname') }}" name="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Last Name" />
                    <div x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 5000)" x-show="showError">
                        @error('lastname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div>
                    <label for="gender" class="block mb-2 text-sm font-medium text-white dark:text-white">Gender</label>
                    <select type="text" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        <option>Select Gender</option>
                        <option value="male" @if(old('gender') === 'male') selected @endif>Male</option>
                        <option value="female" @if(old('gender') === 'female') selected @endif>Female</option>
                    </select>
                    <div x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 5000)" x-show="showError">
                        @error('gender')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="dateofbirth" class="block mb-2 text-sm font-medium text-white dark:text-white">Date of Birth</label>
                    <input type="date" value="{{ old('dateofbirth') }}" name="dateofbirth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Date of Birth" />
                    <div x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 5000)" x-show="showError">
                        @error('dateofbirth')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="contact_no" class="block mb-2 text-sm font-medium text-white dark:text-white">Contact Number</label>
                    <input type="text" value="{{ old('contact_no') }}" name="contact_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="+63" />
                    <div x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 5000)" x-show="showError">
                        @error('contact_no')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-white dark:text-white">Email</label>
                    <input type="email" value="{{ old('email') }}" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Email" />
                    <div x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 5000)" x-show="showError">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="address" class="block mb-2 text-sm font-medium text-white dark:text-white">Address</label>
                    <input type="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Address" />
                    <div x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 5000)" x-show="showError">
                        @error('address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-white dark:text-white">Password</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
                    
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-white dark:text-white">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2" x-data="{ showError: true }" x-init="setTimeout(() => { showError = false }, 10000)" x-show="showError">
                @error('password')
                    <div class="text-red-500 col-span-2">
                        {!! $message !!}
                    </div>
                @enderror
            </div>
            
            
            <div class="flex gap-2 justify-between items-center">
                <input type="submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 capitalize" name="p" value="patient" />
                <input type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 capitalize" name="p" value="physician" />
            </div>
            {{-- <div class="text-sm font-medium text-textprimary dark:text-gray-300">
                Already registered? <a href="{{ route('login') }}" class="text-blue-700 hover:underline dark:text-blue-500">Login account</a>
            </div> --}}
        </form>
    </div>
</x-guest-layout>
