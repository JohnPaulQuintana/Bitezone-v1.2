<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>"Vaccination"])
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 h-full shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- record table here --}}
                    
                    <div class="overflow-auto shadow-md sm:rounded-lg px-2">
                       
                        
                        {{-- data here --}}
                        {{-- {{ $examination }} --}}
                        <div class="shadow py-2">
                            <div class="capitalize font-bold text-blue-900">
                                <h1><span class="text-red-500">a</span>nimal <span class="text-red-500">B</span>ite <span class="text-red-500">t</span>reatment <span class="text-red-500">v</span>accination</h1>
                            </div>
                            <div class="">
                                
                                <form action="{{ route('admin.vaccine') }}" method="post">
                                    @csrf

                                    <input type="number" name="follow_id" value="{{ $followId }}" class="hidden">
                                    {{-- basic information --}}
                                    <div class="grid grid-cols-1 bg-slate-100 p-1 md:grid-cols-3 lg:grid-cols-3 gap-2 mb-4">
                                        <div class="col-span-3 text-center uppercase font-bold text-white bg-red-500">
                                            <h1>basic information</h1>
                                        </div>
                                        <div class="hidden">
                                            <input type="number" name="treatment_id" value="{{ $record->id }}">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" name="lastname" value="{{ $record->user->lastname }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="middlename">Middle Name</label>
                                            <input type="text" name="middlename" value="{{ $record->user->middlename }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="firstname">First Name</label>
                                            <input type="text" name="firstname" value="{{ $record->user->firstname }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                        </div>
                                        
                                        <div class="col-span-3">
                                            <div class="grid grid-cols-3 gap-2 md:grid-cols-5 lg:grid-cols-5 ">
                                                <div class="flex flex-col">
                                                    <label for="age">Age</label>
                                                    <input type="number" name="age" value="<?php echo date('Y') - date('Y', strtotime($record->user->dateofbirth)); ?>" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="gender">Gender</label>
                                                    <select name="gender" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                        <option value="{{ $record->user->gender }}">{{ $record->user->gender }}</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="date">Date</label>
                                                    <input type="date" name="date" value="<?php echo date('Y-m-d', strtotime($record->user->dateofbirth)); ?>" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="time">Time</label>
                                                    <input type="time" name="time" value="<?php echo date('H:i:s', strtotime($record->created_at)); ?>" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="record_number">Patient's Record Number</label>
                                                    <input type="text" name="record_number" value="{{ $record->record_number }}" class="rounded-md p-2 ps-2 border-0 ">
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-span-3">
                                            <div class="grid grid-cols-1 gap-2 md:grid-cols-3 lg:grid-cols-3">
                                                <div class="flex flex-col">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="address" value="{{ $record->user->address }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="place_of_birth">Place of Birth</label>
                                                    <input type="text" name="place_of_birth" value="{{ $record->place_of_birth }}" class="rounded-md p-2 ps-2 border-0" readonly>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="contact_no">Contact Number</label>
                                                    <input type="tel" name="contact_no" value="{{ $record->user->contact_no }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="grid grid-cols-1 bg-red-500  p-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-4">
                                        <div class="col-span-2 text-center uppercase font-bold text-white">
                                            <h1>Schedule of vaccination</h1>
                                        </div>
                                        
                                    </div>

                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-4">
                                        <div class="col-span-2 flex flex-col">
                                            <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5">
                                                <div class="col-span-5">
                                                    
                                                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-2 mb-4">
                                                        <div class="flex flex-col">
                                                            <label>Type</label>
                                                           
                                                            <select id="typeSelect" type="text" name="type" class="rounded-md p-3 ps-2 border-0">
                                                                {{-- {{ isset($record->booster) }} --}}
                                                                @if (isset($record->booster))
                                                                    <option data-type="all" value="">Select Exposure</option>
                                                                    <option data-type="post" value="POST EXPOSURE" @if(old('type')=='POST EXPOSURE') selected @endif>POST EXPOSURE</option>
                                                                    <option data-type="pre" value="PRE EXPOSURE" @if(old('type')=='PRE EXPOSURE') selected @endif>PRE EXPOSURE</option>
                                                                {{-- @elseif () --}}
                                                                @else
                                                                    <option data-type="all" value="">Select Exposure</option>
                                                                    <option data-type="booster" value="BOOSTER DOSE" @if(old('type')=='BOOSTER DOSE') selected @endif>BOOSTER DOSE</option>
                                                                    <option data-type="post" value="POST EXPOSURE" @if(old('type')=='POST EXPOSURE') selected @endif>POST EXPOSURE</option>
                                                                    <option data-type="pre" value="PRE EXPOSURE" @if(old('type')=='PRE EXPOSURE') selected @endif>PRE EXPOSURE</option>
                                                                @endif
                                                                
                                                            </select>
                                                            @error("type")
                                                                <p class="text-red-500">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Day</label>
                                                            {{-- {{ $record-> }} --}}
                                                            <select id="daySelect" type="text" name="sday" class="rounded-md p-3 ps-2 border-0">
                                                                <option value="">Select Days</option>
                                                                <option data-type="default" value="0" @if(old('day')=='0') selected @endif>Day-0</option>
                                                                <option data-type="post" value="3"  @if(old('day')=='3') selected @endif>Day-3</option>
                                                                <option data-type="all" value="7"  @if(old('day')=='7') selected @endif>Day-7</option>
                                                                <option data-type="post" value="14"  @if(old('day')=='14') selected @endif>Day-14</option>
                                                                <option data-type="pre" value="21"  @if(old('day')=='21') selected @endif>Day-21</option>
                                                                <option data-type="post" value="28" @if(old('day')=='28') selected @endif>Day-28</option>
                                                            </select>
                                                            @error("day")
                                                                <p class="text-red-500">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Date</label>
                                                            <input type="date" name="sdate" class="rounded-md p-3 ps-2 border-0  @error('sdate') error @enderror" value="{{ old('sdate') }}" />
                                                            @error("sdate")
                                                                <p class="text-red-500">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Time</label>
                                                            <input type="time" name="stime" class="rounded-md p-3 ps-2 border-0  @error('stime') error @enderror" value="{{ old('stime') }}"/>
                                                            @error("stime")
                                                                <p class="text-red-500">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        
                                                        <div class="flex flex-col">
                                                            <label>R/L</label>
                                                            <select type="text" name="rl" class="rounded-md p-3 ps-2 border-0  @error('rl') error @enderror">
                                                                <option value="">Right or Left</option>
                                                                <option value="right" @if(old('rl') == 'right') selected @endif>Right</option>
                                                                <option value="left" @if(old('rl') == 'left') selected @endif>Left</option>
                                                            </select>
                                                            @error("rl")
                                                                <p class="text-red-500">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>NOD</label>
                                                            <input type="text" name="nod" class="rounded-md p-3 ps-2 border-0" value="{{ old('nod') }}"/>
                                                        </div>

                                                        <div class="flex flex-col col-span-3">
                                                            <label>Site</label>
                                                            <input type="text" name="site" class="rounded-md p-3 ps-2 border-0 @error('site') error @enderror" value="{{ old('site') }}"/>
                                                            @error("site")
                                                                <p class="text-red-500">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-4">
                                        <div class="col-span-2">
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 rounded-md hover:cursor-pointer w-full p-2 text-white">Save Record's</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if (empty($location))
                        <div id="locationSetupPopup">
                            @include('user.popup.location-setup')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- @include('user.popup.consulation') --}}
    @section('scripts')
        <script>
            $(document).ready(function() {

                 // Scroll to the first input field with an error
                $('input.error, select.error, checkbox.error').first().focus();
                // Optionally, you can also scroll to the top of the page
                // window.scrollTo(0, 0);

                $('#typeSelect').change(function() {
                    var selectedType = $(this).find('option:selected').data('type');
                    switch (selectedType) {
                        case 'booster':
                            $('#daySelect option').hide();
                            $('#daySelect option[data-type="default"]').show(); // Show the default option
                            break;
                        case 'post':
                            $('#daySelect option').each(function() {
                                var optionType = $(this).data('type');
                                if(optionType==='pre'){
                                    $(this).hide(); 
                                }else{
                                    $(this).show(); 
                                } 
                            });
                            break;
                        case 'pre':
                            $('#daySelect option').each(function() {
                                var optionType = $(this).data('type');
                                if(optionType==='post'){
                                    $(this).hide(); 
                                }else{
                                    $(this).show(); 
                                }  
                            });
                            break;
                    
                        default:
                            $('#daySelect option').show();
                            break;
                    }
                    
                    $('#daySelect').val('');
                });
                
            })
        </script>
    @endsection
</x-app-layout>