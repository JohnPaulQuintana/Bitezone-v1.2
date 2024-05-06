<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 grid grid-cols-1 gap-2 md:grid-cols-3" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="border rounded-md p-2 flex justify-center items-center">

            @if (empty($user->profile))
                <img src="{{ asset('images/default-profile.png') }}" class="h-[250px]" alt="Profile">
            @else
                <img src="{{ asset('storage').'/'.$user->profile }}" class="h-[250px]" alt="Profile">
            @endif
            
        </div>
        <div class="col-span-2">
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <div class="mb-3">
                    <x-input-label for="firstname" :value="__('First Name')" />
                    <x-text-input name="firstname" type="text" class="mt-1 block w-full" :value="old('firstname', $user->firstname)" required autofocus autocomplete="firstname" />
                    <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
                </div>
                <div class="mb-3">
                    <x-input-label for="middlename" :value="__('Middle Name')" />
                    <x-text-input name="middlename" type="text" class="mt-1 block w-full" :value="old('middlename', $user->middlename)" required autofocus autocomplete="middlename" />
                    <x-input-error class="mt-2" :messages="$errors->get('middlename')" />
                </div>
                <div class="mb-3">
                    <x-input-label for="lastname" :value="__('Last Name')" />
                    <x-text-input name="lastname" type="text" class="mt-1 block w-full" :value="old('lastname', $user->lastname)" required autofocus autocomplete="lastname" />
                    <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
                </div>
            </div>
    
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <div class="mb-3">
                    <x-input-label for="gender" :value="__('Gender')" />
                        <select type="text" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            @switch($user->gender)
                                @case('male')
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    @break
                            
                                @default
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            @endswitch
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                </div>
                <div class="mb-3">
                    <x-input-label for="dateofbirth" :value="__('Date of Birth')" />
                    <x-text-input name="dateofbirth" type="date" class="mt-1 block w-full" :value="old('dateofbirth', $user->dateofbirth)" required autofocus autocomplete="dateofbirth" />
                    <x-input-error class="mt-2" :messages="$errors->get('dateofbirth')" />
                </div>
                <div class="mb-3">
                    <x-input-label for="contact_no" :value="__('Contact Number')" />
                    <x-text-input name="contact_no" type="text" class="mt-1 block w-full" :value="old('contact_no', $user->contact_no)" required autofocus autocomplete="contact_no" />
                    <x-input-error class="mt-2" :messages="$errors->get('contact_no')" />
                </div>
            </div>
            <div>
                <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" required autocomplete="address" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="profile" :value="__('Profile')" />
                        <x-text-input name="profile" type="file" class="mt-1 block w-full" :value="old('profile', $user->profile)" autocomplete="profile" />
                        <x-input-error class="mt-2" :messages="$errors->get('profile')" />
                    </div>
                </div>
                
    
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}
    
                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
    
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
    
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
    
                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-green-600 dark:text-gray-400"
                    >{{ __('Profile Information Successfully updated!.') }}</p>
                @endif
            </div>
        </div>

        
    </form>
</section>
