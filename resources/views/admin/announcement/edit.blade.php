<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-center justify-between mb-2">

            @include('partials.breadcrum', ['section' => "Edit Announcement"])
            
        </div>
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 h-full shadow-sm sm:rounded-lg overflow-auto">
                <form action="{{ route('admin.announcement.update') }}" method="post">
                    @csrf
                    <div class="shadow grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 p-2">
                            <input type="number" name="id" value="{{ $announcement->id }}" class="hidden">
                            <div class="flex flex-col shadow p-1">
                                <label for="title">Announcement Title</label>
                                <input type="text" name="title" value="{{ $announcement->title }}" class="rounded-md">
                            </div>
                            <div class="flex flex-col shadow p-1">
                                <label for="type">Announcement Type</label>
                                <select name="type" class="rounded-md">
                                    <option value="seminar" @if ($announcement->type === 'seminar') selected @endif>Seminar</option>
                                    <option value="announcement" @if ($announcement->type === 'announcement') selected @endif>Announcement</option>
                                </select>
                            </div>
                            <div class="flex flex-col shadow p-1 col-span-2">
                                <label for="details">Announcement Details</label>
                                <textarea name="details" cols="30" rows="5" class="rounded-md text-start">
                                    {{ $announcement->details }}
                                </textarea>
                            </div>
                            <div class="flex flex-col shadow p-1">
                                <label for="date">Announcement Date</label>
                                <input type="date" name="date" value="{{ $announcement->date }}" class="rounded-md">
                            </div>
                            <div class="flex flex-col shadow p-1">
                                <label for="time">Announcement Time</label>
                                <input type="time" name="time" value="{{ $announcement->time }}" class="rounded-md">
                            </div>
                            <div class="flex flex-col shadow p-1 col-span-2">
                                <label for="url">Announcement URL - (if available)</label>
                                <input type="text" name="url" value="{{ $announcement->url }}" class="rounded-md">
                            </div>
                            <div class="flex flex-col shadow p-1">  
                                <a href="{{ route('admin.announcement') }}" class="rounded-md p-2 bg-red-500 hover:cursor-pointer hover:bg-red-700 text-white border-0 text-center">Cancel Update</a>
                            </div>
                            <div class="flex flex-col shadow p-1">  
                                <button type="submit" class="rounded-md p-2 bg-red-500 hover:cursor-pointer hover:bg-red-700 text-white border-0">Update Announcement</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function(){
                let {
                    title,
                    message,
                    icon
                } = @json(session()->only(['title', 'message', 'icon']));
                console.log(title)
                if (title !== undefined) {
                    popups(title, message, icon)
                }
            })

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