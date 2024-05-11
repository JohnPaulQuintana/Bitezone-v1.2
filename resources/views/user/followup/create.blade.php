<div id="followContainer" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-99999 @if($errors->any()) visible @else hidden @endif">
    <div class="bg-white p-8 rounded shadow-md max-h-[600px] overflow-auto">
        <h2 class="text-2xl font-bold mb-4 capitalize text-center">Send a follow-up vaccine</h2>
        <div>
            <form action="{{ route('user.followup') }}" method="post" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                @csrf
                <input type="number" value="" id="consultation_id" name="consultation_id" class="hidden">
                
                <div class="flex flex-col tracking-wider col-span-2 shadow p-1">
                    <label for="details" class="">Follow-up Details</label>
                    <textarea name="details" cols="30" rows="5" class="rounded-md">{{ old('details') }}</textarea>
                    @error('details')
                        <p class="text-red-500">Follow-up details is required!.</p>
                    @enderror
                </div>
                <div class="flex flex-col tracking-wider shadow p-1">
                    <label for="date" class="">Follow-up Date</label>
                    <input type="date" name="date" class="rounded-md" value="{{ old('date') }}"></input>
                    @error('date')
                        <p class="text-red-500">Follow-up date is required!.</p>
                    @enderror
                </div>
                <div class="flex flex-col tracking-wider shadow p-1">
                    <label for="time" class="">Follow-up Time</label>
                    <input type="time" name="time" class="rounded-md" value="{{ old('time') }}"></input>
                    @error('time')
                        <p class="text-red-500">Follow-up time is required!.</p>
                    @enderror
                </div>
                
                <div class="flex flex-col tracking-wider shadow p-1">
                    <button type="submit" class="rounded-md bg-red-500 text-white p-2 hover:cursor-pointer hover:bg-red-700">Send follow-up</button>
                </div>
                <div class="flex flex-col tracking-wider shadow p-1">
                    <button id="cancelFU" type="button" class="rounded-md bg-red-500 text-white p-2 hover:cursor-pointer hover:bg-red-700">Cancel follow-up</button>
                </div>
            </form>
        </div>
    </div>  
</div>
