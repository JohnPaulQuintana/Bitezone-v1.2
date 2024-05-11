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
            
                    @foreach ($announcements as $announcement)
                        <div class="flex gap-2 mb-2">
                            <div class="shadow p-2 border-t-4 border-red-500 w-full">
                                <div class="flex flex-col md:flex-row gap-2 items-center text-wrap">
                                    <img class="w-full md:w-[20%]"
                                        src="{{ asset('images/announcement.jpg') }}"
                                        alt="">
                                    <div
                                        class="bg-slate-50 rounded-md text-pretty p-2 w-full ease-in-out duration-300 overflow-hidden">
                                        <div class="flex flex-row md:gap-1 md:px-[30px] items-center">
                                            <img class="rounded-xl w-5" src="{{ asset('storage').'/'.$announcement->user->profile }}"
                                                alt="">
                                            <div class="grid grid-cols-2 gap-1 items-center md:flex md:gap-2">
                                                <span class="text-[10px] md:text-[12px] font-semibold h-fit">{{ $announcement->user->firstname }} {{ $announcement->user->lastname }} -
                                                </span>
                                                <span class="text-[10px] md:text-[12px] font-semibold">{{ $announcement->user->location->clinic->name }}</span>

                                            </div>
                                        </div>
                                        <div class="md:pl-4">
                                            <h1 class="text-sm md:text-xl px-2 font-bold tracking-wider mb-1">
                                                <span>{{ $announcement->title }}</span></h1>
                                            <div class="h-full flex flex-col bg-white py-2">
                                                <h1 class="text-sm md:text-md font-semibold px-2 tracking-wider"><span>Event
                                                        Detail's</span></h1>
                                                <p class="p-2 text-sm capitalize">
                                                    {{ $announcement->details }}
                                                </p>
                                            </div>
                                            @if ($announcement->type === 'seminar')
                                                <div class="px-2">
                                                    <span>Event Date:</span>
                                                </div>
                                            @else
                                                <div class="px-2">
                                                    <span>Created Date:</span>
                                                </div>
                                            @endif
                                            <div class="bg-white w-fit p-2 text-red-500 flex flex-row gap-4">
                                                
                                                <span class="font-bold text-sm md:text-md">{{ \Carbon\Carbon::parse($announcement->date)->format('F d, Y') }}</span>-
                                                <span class="font-bold text-sm md:text-md">{{ \Carbon\Carbon::parse($announcement->time)->format('g:i A') }}</span>
                                                @if (\Carbon\Carbon::parse($announcement->date)->format('F d, Y') === \Carbon\Carbon::parse(now())->format('F d, Y') && $announcement->type === 'seminar')
                                                    <a href="{{  $announcement->url }}"
                                                    class="bg-red-500 text-[10px] hover:bg-red-700 text-white px-2 capitalize">Join
                                                    Now</a>
                                                @endif
                                                
                                                <span
                                                    class="bg-red-500 text-[10px] text-white px-2 capitalize">{{  $announcement->type }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    

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