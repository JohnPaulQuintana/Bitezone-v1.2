<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>"Examination"])
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 h-full shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-red-700 font-bold">U</span>nder  <span class="ml-1"><span class="text-red-700 font-bold">E</span>xamination.</span>
                        </div>
                        {{-- <button type="button" id="consultationBtn" class="bg-red-500 p-1 text-white rounded-md hover:bg-red-700"><i class="fa-regular fa-calendar-plus"></i> Consultation</button> --}}
                    </div>
                    {{-- record table here --}}
                    
                    <div class="overflow-auto shadow-md sm:rounded-lg px-2">
                       
                        
                        {{-- data here --}}
                        {{-- {{ $examination }} --}}
                        <div class="shadow py-2">
                            <div class="uppercase font-bold text-blue-900">
                                <h1>animal Bite treatment consultation form</h1>
                            </div>
                            <div class="">
                                
                                <form action="{{ route('admin.treatment') }}" method="post">
                                    @csrf
                                    {{-- basic information --}}
                                    <div class="grid grid-cols-1 bg-slate-100 p-1 md:grid-cols-3 lg:grid-cols-3 gap-2 mb-4">
                                        <div class="col-span-3 text-center uppercase font-bold text-white bg-red-500">
                                            <h1>basic information</h1>
                                        </div>
                                        <div class="hidden">
                                            <input type="number" name="patient_id" value="{{ $examination->user_id }}">
                                            <input type="number" name="consultation_id" value="{{ $examination->id }}">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" name="lastname" value="{{ $examination->user->lastname }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="middlename">Middle Name</label>
                                            <input type="text" name="middlename" value="{{ $examination->user->middlename }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="firstname">First Name</label>
                                            <input type="text" name="firstname" value="{{ $examination->user->firstname }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                        </div>
                                        
                                        <div class="col-span-3">
                                            <div class="grid grid-cols-3 gap-2 md:grid-cols-5 lg:grid-cols-5 ">
                                                <div class="flex flex-col">
                                                    <label for="age">Age</label>
                                                    <input type="number" name="age" value="<?php echo date('Y') - date('Y', strtotime($examination->user->dateofbirth)); ?>" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="gender">Gender</label>
                                                    <select name="gender" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                        <option value="{{ $examination->user->gender }}">{{ $examination->user->gender }}</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="date">Date</label>
                                                    <input type="date" name="date" value="<?php echo date('Y-m-d', strtotime($examination->user->dateofbirth)); ?>" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="time">Time</label>
                                                    <input type="time" name="time" value="<?php echo date('H:i:s', strtotime($examination->created_at)); ?>" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="record_number">Patient's Record Number</label>
                                                    <input type="text" name="record_number" class="rounded-md p-2 ps-2 border-0" value="{{ old('record_number') }}">
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-span-3">
                                            <div class="grid grid-cols-1 gap-2 md:grid-cols-3 lg:grid-cols-3">
                                                <div class="flex flex-col">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="address" value="{{ $examination->user->address }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="place_of_birth">Place of Birth</label>
                                                    <input type="text" name="place_of_birth" class="rounded-md p-2 ps-2 border-0" value="{{ old('place_of_birth') }}">
                                                    @error('place_of_birth')
                                                        <p class="text-red-500">Place of birth is required</p>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="contact_no">Contact Number</label>
                                                    <input type="tel" name="contact_no" value="{{ $examination->user->contact_no }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- CHIEF COMPLAIN'S --}}
                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-3 lg:grid-cols-3 gap-2 mb-4">

                                        <div class="col-span-3 flex flex-col">
                                            <div class="col-span-2 text-center uppercase font-bold text-white bg-red-500">
                                                <h1>chief complain's</h1>
                                            </div>
                                            <input type="text" name="complain" class="rounded-md p-3 ps-2 border-0" value="{{ old('complain') }}">
                                        </div>

                                    </div>
                                    {{-- VITAL SIGN'S --}}
                                    <div class="grid grid-cols-2 bg-slate-100  p-1 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                        <div class="col-span-5 text-center uppercase font-bold text-white bg-red-500">
                                            <h1>vital sign's</h1>
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="bp">BP</label>
                                            <input type="text" name="bp" class="rounded-md p-3 ps-2 border-0" value="{{ old('bp') }}">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="pr">PR</label>
                                            <input type="text" name="pr" class="rounded-md p-3 ps-2 border-0" value="{{ old('pr') }}">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="rr">RR</label>
                                            <input type="text" name="rr" class="rounded-md p-3 ps-2 border-0" value="{{ old('rr') }}">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="temp">Temperature</label>
                                            <input type="text" name="temperature" class="rounded-md p-3 ps-2 border-0" value="{{ old('temperature') }}">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="wt">WT</label>
                                            <input type="text" name="wt" class="rounded-md p-3 ps-2 border-0" value="{{ old('wt') }}">
                                        </div>

                                    </div>
                                    {{-- DOCTOR'S ORDER --}}
                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-4">
                                        <div class="col-span-2 text-center uppercase font-bold text-white bg-red-500">
                                            <h1>doctor's order</h1>
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="history_of_present_illness">History of Present Illness</label>
                                            <input type="text" name="history_of_present_illness" class="rounded-md p-3 ps-2 border-0" value="{{ old('history_of_present_illness') }}">
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="site_of_bite">Site of Bite</label>
                                            <ul class="grid grid-cols-2 md:grid-cols-6 lg:grid-cols-6 items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="head" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Head</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="neck" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Neck</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="shoulder-left" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Shoulder-Right</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="shoulder-right" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Shoulder-Right</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="arm-left" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Arm-Left</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="arm-right" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Arm-Right</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="elbow-left" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Elbow-Left</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="elbow-right" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Elbow-Right</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="hand-left" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hand-Left</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="hand-right" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hand-right</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="chest" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Chest</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="back" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Back</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="abdomen" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Abdomen</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="hips" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hips</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="leg-left" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">leg-Left</label>
                                                    </div>
                                                </li>
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input name="body_parts[]" type="checkbox" value="leg-right" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">leg-Right</label>
                                                    </div>
                                                </li>
                                                
                                            </ul>

                                            @error('body_parts')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="pertinent_pe">Pertinent PE</label>
                                            <input type="text" name="pertinent_pe" class="rounded-md p-3 ps-2 border-0" value="{{ old('pertinent_pe') }}">
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="diagnosis">Diagnosis</label>
                                            <input type="text" name="diagnosis" class="rounded-md p-3 ps-2 border-0" value="{{ old('diagnosis') }}">
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="home_medecine">Home Medicine</label>
                                            <input type="text" name="home_medicine" class="rounded-md p-3 ps-2 border-0" value="{{ old('home_medicine') }}">
                                        </div>
                                        <div class="col-span-2 flex flex-col justify-center items-center">
                                            
                                            <input type="text" name="physician" value="{{ auth()->user()->firstname  }} {{ auth()->user()->middlename  }} {{ auth()->user()->lastname  }}" class="rounded-md w-[25%] text-center p-3 ps-2 border-0 uppercase font-bold text-blue-900">
                                            <label for="physician">Physician</label>
                                        </div>
                                    </div>
                                    {{-- HISTORY OF EXPOSURE --}}
                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-4">
                                        <div class="col-span-2 text-center uppercase font-bold text-white bg-red-500 p-2">
                                            <h1>history of exposure</h1>
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="date_of_incidence">Date of Incidence</label>
                                            <input type="date" name="date_of_incidence" value="{{ old('date_of_incidence') }}" class="rounded-md p-3 ps-2 border-0 @error('date_of_incidence') error @enderror">
                                            @error('date_of_incidence')
                                                <p class="text-red-500">Date of incidence field is required.</p>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="place_of_incidence">Place of Incidence</label>
                                            <input type="text" name="place_of_incidence" value="{{ old('place_of_incidence') }}" class="rounded-md p-3 ps-2 border-0 @error('place_of_incidence') error @enderror">
                                            @error('place_of_incidence')
                                                <p class="text-red-500">Place of incidence field is required.</p>
                                            @enderror
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                           <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-2">
                                                <div class="flex flex-col">
                                                    <label for="animal">Animal</label>
                                                    <select name="animal" class="grid grid-cols-2 border-0 md:grid-cols-6 lg:grid-cols-6 p-3 ps-2 items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('animal') error @enderror">
                                                        <option value="">Select animal</option>
                                                        <option value="pet dog" @if(old('animal')=='pet dog') selected @endif>Pet Dog</option>
                                                        <option value="pet cat" @if(old('animal')=='pet cat') selected @endif>Pet Cat</option>
                                                        <option value="stray dog" @if(old('animal')=='stray dog') selected @endif>Stray Dog</option>
                                                        <option value="stray cat" @if(old('animal')=='stray cat') selected @endif>Stray Cat</option>
                                                        <option value="others" @if(old('animal')=='others') selected @endif>Others</option>
                                                    </select>
                                                    @error('animal')
                                                        <p class="text-red-500">Animal type field is required.</p>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="status_of_animal">Status of Animal</label>
                                                    <input type="text" name="status_of_animal" class="rounded-md p-3 ps-2 border-0" value="{{ old('status_of_animal') }}">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="type_of_bite">Type of Bite</label>
                                                    <select type="text" name="type_of_bite" class="rounded-md p-3 ps-2 border-0 @error('type_of_bite') error @enderror">
                                                        <option value="">Select type of bite</option>
                                                        <option value="bite" @if(old('type_of_bite')=='bite') selected @endif>Bite</option>
                                                        <option value="non-bite" @if(old('type_of_bite')=='non-bite') selected @endif>Non Bite</option>
                                                    </select>
                                                    @error('site_of_bite')
                                                        <p class="text-red-500">Type of bite field is required.</p>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="washing_of_bite">Washing of Bite</label>
                                                    <input type="text" name="washing_of_bite" class="rounded-md p-3 ps-2 border-0" value="{{ old('washing_of_bite') }}">
                                                    
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="site_of_bite">Site of Bite</label>
                                                    <input type="text" name="site_of_bite" class="rounded-md p-3 ps-2 border-0 @error('site_of_bite') error @enderror">
                                                    @error('site_of_bite')
                                                        <p class="text-red-500">Site of bite field is required.</p>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="previous_vaccination_year">Previous Vaccination Year</label>
                                                    <input type="date" name="previous_vaccination_year" value="{{ old('previous_vaccination_year') }}" class="rounded-md p-3 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="previous_vaccination_status">Previous Vaccination Status</label>
                                                    <select type="text" name="previous_vaccination_status" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select status</option>
                                                        <option value="completed" @if(old('previous_vaccination_status')=='completed') selected @endif>Completed</option>
                                                        <option value="incomplete" @if(old('previous_vaccination_status')=='incompleted') selected @endif>Incomplete</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="tissue_culture_vaccine">Tissue Culture Vaccine</label>
                                                    <select type="text" name="tissue_culture_vaccine" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select here</option>
                                                        <option value="pcev" @if(old('tissue_culture_vaccine')=='pcev') selected @endif>PCEV</option>
                                                        <option value="pvrv" @if(old('tissue_culture_vaccine')=='pvrv') selected @endif>PVRV</option>
                                                        <option value="id" @if(old('tissue_culture_vaccine')=='id') selected @endif>ID</option>
                                                        <option value="im" @if(old('tissue_culture_vaccine')=='im') selected @endif>IM</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="rabies_immunoglobulin">Rabies Immunoglobulin</label>
                                                    <select type="text" name="rabies_immunoglobulin" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select here</option>
                                                        <option value="equirab" @if(old('rabies_immunoglobulin')=='equirab') selected @endif>EQUIRAB</option>
                                                        <option value="ravirab" @if(old('rabies_immunoglobulin')=='ravirab') selected @endif>RAVBIRAB</option>
                                                    </select>
                                                </div>  
                                                <div class="flex flex-col">
                                                    <label for="erig">ERIG</label>
                                                    <input type="text" name="erig" value="{{ old('erig') }}" class="rounded-md p-3 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="dose">DOSE (ml)</label>
                                                    <input type="number" name="dose" value="{{ old('dose') }}" class="rounded-md p-3 ps-2 border-0" min="1" max="2000" placeholder="YYYY">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="anti_tetanus">Anti-Tetanus</label>
                                                    <select type="text" name="anti_tetanus" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select here</option>
                                                        <option value="1,5000 u" @if(old('anti_tetanus')=='1,5000 u') selected @endif>1,500 u</option>
                                                        <option value="5,000 u" @if(old('anti_tetanus')=='5,000 u') selected @endif>5,000 u</option>
                                                        <option value="6,000 u" @if(old('anti_tetanus')=='6,000 u') selected @endif>6,000 u</option>
                                                        <option value="TOXOID" @if(old('anti_tetanus')=='TOXOID') selected @endif>TOXOID</option>
                                                    </select>
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
                                                                <option data-type="all" value="">Select Exposure</option>
                                                                <option data-type="booster" value="BOOSTER DOSE" @if(old('type')=='BOOSTER DOSE') selected @endif>BOOSTER DOSE</option>
                                                                <option data-type="post" value="POST EXPOSURE" @if(old('type')=='POST EXPOSURE') selected @endif>POST EXPOSURE</option>
                                                                <option data-type="pre" value="PRE EXPOSURE" @if(old('type')=='PRE EXPOSURE') selected @endif>PRE EXPOSURE</option>
                                                            </select>
                                                            @error("type")
                                                                <p class="text-red-500">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Day</label>
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