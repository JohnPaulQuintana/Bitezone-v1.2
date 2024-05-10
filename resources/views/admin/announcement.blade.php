<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-center justify-between mb-2">
            
            @include('partials.breadcrum', ['section'=>"Announcement's"])
            <button class="text-sm p-1 bg-red-500 text-white hover:bg-red-700 hover:cursor-pointer rounded-sm" id="printBtn" type="button" onclick="PrintDiv()">
                <i class="fa-sharp fa-solid fa-megaphone pr-1"></i>
                Add Announcement
            </button>
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 h-full shadow-sm sm:rounded-lg overflow-auto">
                <div class="p-6 text-gray-900 dark:text-gray-100 grid grid-cols-2 gap-2">
                    
                    
                    <div class="shadow p-1">
                        <a href="#" class="grid grid-cols-1 md:grid-cols-3 items-center">
                            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="https://img.freepik.com/premium-vector/hand-holding-megaphone-with-important-announcement-megaphone-banner-web-design_100456-10005.jpg" alt="">
                            <div class="col-span-2">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                                <div class="flex justify-between items-center gap-2 p-1">
                                    <p class="bg-slate-100 text-red-500 px-2">Date: 2024-03-09</p>
                                    <p class="bg-slate-100 text-red-500 px-2">Time: 2024-03-09</p>
                                </div>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                
                            </div>
                            <div class="col-span-2 flex justify-end items-end gap-2 px-2">
                                <a class="bg-blue-500 hover:bg-blue-700 px-2 rounded-sm text-white" href="#">Edit</a>
                                <a class="bg-red-500 hover:bg-red-700 px-2 rounded-sm text-white" href="#">Delete</a>
                                <a class="bg-blue-500 hover:bg-blue-700 px-2 rounded-sm text-white" href="#">Open</a>
                                <a class="bg-red-500 hover:bg-red-700 px-2 rounded-sm text-white" href="#">Closed</a>
                            </div>
                        </a>
                    </div>
                    

                    {{-- <div class="shadow p-2">
                        dwadwad p-2
                    </div> --}}

                    @if (empty($location))
                        <div id="locationSetupPopup">
                            @include('admin.popup.clinic-setup')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>