<div id="createContainer" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-99999 @if($errors->any()) visible @else hidden @endif">
    <div class="bg-white p-8 rounded shadow-md max-h-[600px] overflow-auto">
        <h2 class="text-2xl font-bold mb-4 capitalize text-center">Create your announcement</h2>
        <div>
            <form action="{{ route('admin.announcement.create') }}" method="post" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                @csrf
                <div class="flex flex-col tracking-wider shadow p-1">
                    <label for="title" class="">Announcement Title</label>
                    <input type="text" name="title" class="rounded-md focus:border-red-500" value="{{ old('title') }}">
                    @error('title')
                        <p class="text-red-500">Announcement title is required!.</p>
                    @enderror
                </div>
                <div class="flex flex-col tracking-wider shadow p-1">
                    <label for="type" class="">Announcement Type</label>
                    <select name="type" class="rounded-md">
                        <option value="">Select a type</option>
                        <option value="seminar" @if(old('type') === 'seminar') selected @endif>Seminar</option>
                        <option value="announcement" @if(old('type') === 'announcement') selected @endif>Announcement</option>
                    </select>
                    @error('type')
                        <p class="text-red-500">Announcement type is required!.</p>
                    @enderror
                </div>
                <div class="flex flex-col tracking-wider col-span-2 shadow p-1">
                    <label for="details" class="">Announcement Details</label>
                    <textarea name="details" cols="30" rows="5" class="rounded-md">{{ old('details') }}</textarea>
                    @error('details')
                        <p class="text-red-500">Announcement details is required!.</p>
                    @enderror
                </div>
                <div class="flex flex-col tracking-wider shadow p-1">
                    <label for="date" class="">Announcement Date</label>
                    <input type="date" name="date" class="rounded-md" value="{{ old('date') }}"></input>
                    @error('date')
                        <p class="text-red-500">Announcement date is required!.</p>
                    @enderror
                </div>
                <div class="flex flex-col tracking-wider shadow p-1">
                    <label for="time" class="">Announcement Time</label>
                    <input type="time" name="time" class="rounded-md" value="{{ old('time') }}"></input>
                    @error('time')
                        <p class="text-red-500">Announcement time is required!.</p>
                    @enderror
                </div>
                <div class="flex flex-col tracking-wider col-span-2 shadow p-1">
                    <label for="url" class="">Announcement Url - (if available)</label>
                    <input type="url" name="url" class="rounded-md" placeholder="Place your link here..." value="{{ old('url') }}"></input>
                </div>
                <div class="flex flex-col tracking-wider shadow p-1">
                    <button type="submit" class="rounded-md bg-red-500 text-white p-2 hover:cursor-pointer hover:bg-red-700">Save announcement</button>
                </div>
                <div class="flex flex-col tracking-wider shadow p-1">
                    <button id="cancelAnnouncement" type="button" class="rounded-md bg-red-500 text-white p-2 hover:cursor-pointer hover:bg-red-700">Cancel announcement</button>
                </div>
            </form>
        </div>
    </div>  
</div>
