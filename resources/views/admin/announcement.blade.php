<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-center justify-between mb-2">

            @include('partials.breadcrum', ['section' => "Announcement's"])
            <button class="text-sm p-1 bg-red-500 text-white hover:bg-red-700 hover:cursor-pointer rounded-sm"
                type="button" onclick="enableAnnouncement()">
                <i class="fa-sharp fa-solid fa-megaphone pr-1"></i>
                Add Announcement
            </button>
        </div>
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 h-full shadow-sm sm:rounded-lg overflow-auto">

                @foreach ($announcements as $ann)
                    <div class="flex gap-2 mb-2">
                        <div class="shadow p-2 border-t-4 border-red-500 w-full">
                            <div class="uppercase flex flex-col md:flex-row gap-2 items-center text-wrap">
                                <img class="w-full md:w-[20%]" src="{{ asset('images/announcement.jpg') }}"
                                    alt="">
                                <div
                                    class="bg-slate-50 rounded-md text-pretty p-2 w-full ease-in-out duration-300 overflow-hidden">
                                    <div class="flex flex-row md:gap-1 md:px-[25px] items-center">
                                        <img class="rounded-xl w-5"
                                            src="{{ asset('storage') . '/' . auth()->user()->profile }}" alt="">
                                        <div class="grid grid-cols-2 gap-1 items-center md:flex md:gap-2">
                                            <span
                                                class="text-[10px] md:text-[12px] font-semibold h-fit">{{ auth()->user()->firstname }}
                                                {{ auth()->user()->middlename }}. {{ auth()->user()->lastname }} -
                                            </span>
                                            <span
                                                class="text-[10px] md:text-[12px] font-semibold">{{ $ann->user->location->clinic->name }}</span>

                                        </div>
                                    </div>
                                    <div class="md:pl-4">
                                        <h1 class="text-sm md:text-xl px-2 font-bold tracking-wider mb-2">Title :
                                            <span>{{ $ann->title }}</span>
                                        </h1>
                                        <div class="h-full flex flex-col bg-white py-2">
                                            <h1 class="text-sm md:text-md font-semibold px-2 tracking-wider"><span>Event
                                                    Detail's</span></h1>
                                            <p class="p-2">
                                                {{ $ann->title }}
                                            </p>
                                        </div>
                                        <div class="bg-white w-fit p-2 text-red-500 flex flex-row gap-4">
                                            <span
                                                class="font-bold text-sm md:text-md">{{ \Carbon\Carbon::parse($ann->date)->format('F d, Y') }}</span>-
                                            <span
                                                class="font-bold text-sm md:text-md">{{ \Carbon\Carbon::parse($ann->time)->format('g:i A') }}</span>
                                            <a href="{{ route('admin.announcement.edit', $ann->id) }}"
                                                class="bg-red-500 text-[14px] hover:bg-red-700 text-white px-2 capitalize">Update</a>
                                            <form action="{{ route('admin.announcement.delete', $ann->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="bg-red-500 text-[14px] hover:bg-red-700 text-white px-2 capitalize">Delete</button>
                                            </form>
                                                

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    @include('admin.announcement.create')
    @section('scripts')
        <script>
            $(document).ready(function() {
                let {
                    title,
                    message,
                    icon
                } = @json(session()->only(['title', 'message', 'icon']));
                console.log(title)
                if (title !== undefined) {
                    popups(title, message, icon)
                }
                $('#cancelAnnouncement').click(function() {
                    $('#createContainer').addClass('hidden').fadeOut('slow')
                })
            })

            const enableAnnouncement = () => {
                $('#createContainer').removeClass('hidden').fadeIn('slow')
            }

            const popups = (t, m, i) => {
                Swal.fire({
                    title: t,
                    text: m,
                    icon: i
                });
            }
        </script>
    @endsection
</x-app-layout>
