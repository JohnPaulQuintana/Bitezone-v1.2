<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Location Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Reset your account's location information.") }}
        </p>
    </header>

    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

    <form method="post" action="{{ route('profile.reset') }}" class="mt-6 space-y-6">
        @csrf
        <div class="">
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                
                <div class="flex items-center gap-4">
                    <x-primary-button><i class="fa-sharp fa-solid fa-recycle pr-2"></i> {{ __('Reset your location') }}</x-primary-button>
        
                    @if (session('status') === 'location-reset')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-green-600 dark:text-gray-400"
                        >{{ __('Location Information Successfully reset!.') }}</p>
                    @endif
                </div>
            </div>

    
            
        </div>

        
    </form>
</section>
