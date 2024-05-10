<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-center justify-between mb-2">
            
            @include('partials.breadcrum', ['section'=>"Announcement's"])
            
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 h-full shadow-sm sm:rounded-lg overflow-auto">
                <div class="p-6 text-gray-900 dark:text-gray-100">
            
                    <div class="shadow w-full p-1 border-l-4 border-red-500 mb-2">
                        <a href="#" class="grid grid-cols-1 md:grid-cols-3 items-center">
                            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="https://img.freepik.com/premium-vector/hand-holding-megaphone-with-important-announcement-megaphone-banner-web-design_100456-10005.jpg" alt="">
                            <div class="col-span-2">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                                <div class="flex items-center gap-1 mb-2 font-bold">
                                    <img class="w-6 h-6 rounded-md" src="{{ asset('storage').'/'.auth()->user()->profile }}" alt="">
                                    <span>{{ auth()->user()->firstname }} {{ auth()->user()->middlename }} {{ auth()->user()->lastname }}</span>
                                </div>
                                <div class="flex justify-start items-center gap-2 p-1">
                                    
                                    <p class="bg-slate-100 text-red-500 px-2">Date: 2024-03-09</p>
                                    <p class="bg-slate-100 text-red-500 px-2">Time: 2024-03-09</p>
                                </div>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                <div class="flex gap-2 bg-slate-100 w-fit px-2">
                                    <span>tags:</span>
                                    <span>Vaccine</span>
                                    <span>Seminar</span>
                                    <span>Free</span>
                                </div>
                            </div>
                            
                        </a>
                    </div>
                    

                    {{-- <div class="shadow p-2">
                        dwadwad p-2
                    </div> --}}

                    @if (empty($location))
                        <div id="locationSetupPopup">
                            @include('user.popup.location-setup')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>