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
                        <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
                            <div>
                                <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                                    <span class="sr-only">Action button</span>
                                    Filters
                                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="dropdownAction" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">All</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Waiting</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Recieving</a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Completed</a>
                                        </li>
                                        <li class="py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Rejected</a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="">
                               
                                <input type="text" id="table-search-users" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search here...">
                            </div>
                        </div>
                        
                        {{-- data here --}}
                        {{-- {{ $examination }} --}}
                        <div class="shadow py-2">
                            <div class="uppercase font-bold">
                                <h1>animal Bite treatment consultation form</h1>
                            </div>
                            <div class="">
                                
                                <form action="#" method="post">
                                    @csrf
                                    
                                    <div class="grid grid-cols-1 bg-slate-100 p-1 md:grid-cols-3 lg:grid-cols-3 gap-2 mb-4">
                                        <div class="col-span-3 text-center uppercase font-bold">
                                            <h1>basic information</h1>
                                        </div>
                                        <div class="hidden">
                                            <input type="number" name="patient_id" value="">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" name="lastname" class="rounded-md p-2 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="middlename">Middle Name</label>
                                            <input type="text" name="middlename" class="rounded-md p-2 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="firstname">First Name</label>
                                            <input type="text" name="lastname" class="rounded-md p-2 ps-2 border-0">
                                        </div>
                                        
                                        <div class="col-span-3">
                                            <div class="grid grid-cols-3 gap-2 md:grid-cols-5 lg:grid-cols-5 ">
                                                <div class="flex flex-col">
                                                    <label for="age">Age</label>
                                                    <input type="number" name="age" class="rounded-md p-2 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="gender">Gender</label>
                                                    <select name="gender" class="rounded-md p-2 ps-2 border-0">
                                                        <option value="">Male</option>
                                                        <option value="">Female</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="date">Date</label>
                                                    <input type="date" name="date" class="rounded-md p-2 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="time">Time</label>
                                                    <input type="time" name="time" class="rounded-md p-2 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="record_number">Patient's Record Number</label>
                                                    <input type="text" name="record_number" class="rounded-md p-2 ps-2 border-0">
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-span-3">
                                            <div class="grid grid-cols-1 gap-2 md:grid-cols-3 lg:grid-cols-3">
                                                <div class="flex flex-col">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="address" class="rounded-md p-2 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="place_of_birth">Place of Birth</label>
                                                    <input type="text" name="place_of_birth" class="rounded-md p-2 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="contact_no">Contact Number</label>
                                                    <input type="tel" name="contact_no" class="rounded-md p-2 ps-2 border-0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-3 lg:grid-cols-3 gap-2 mb-4">

                                        <div class="col-span-3 flex flex-col">
                                            <div class="col-span-2 text-center uppercase font-bold">
                                                <h1>chief complain's</h1>
                                            </div>
                                            <input type="text" name="complain" class="rounded-md p-3 ps-2 border-0">
                                        </div>

                                    </div>

                                    <div class="grid grid-cols-2 bg-slate-100  p-1 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                        <div class="col-span-5 text-center uppercase font-bold">
                                            <h1>vital sign's</h1>
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="bp">BP</label>
                                            <input type="text" name="bp" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="pr">PR</label>
                                            <input type="text" name="pr" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="rr">RR</label>
                                            <input type="text" name="rr" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="temp">Temperature</label>
                                            <input type="text" name="temperature" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="wt">WT</label>
                                            <input type="text" name="wt" class="rounded-md p-3 ps-2 border-0">
                                        </div>

                                    </div>

                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-4">
                                        <div class="col-span-2 text-center uppercase font-bold">
                                            <h1>doctor's order</h1>
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="history_of_present_illness">History of Present Illness</label>
                                            <input type="text" name="history_of_present_illness" class="rounded-md p-3 ps-2 border-0">
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
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="pertinent_pe">Pertinent PE</label>
                                            <input type="text" name="pertinent_pe" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="diagnosis">Diagnosis</label>
                                            <input type="text" name="diagnosis" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="home_medecine">Home Medicine</label>
                                            <input type="text" name="diagnosis" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="col-span-2 flex flex-col justify-center items-center">
                                            
                                            <input type="text" name="physician" class="rounded-md p-3 ps-2 border-0">
                                            <label for="physician">Physician</label>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-4">
                                        <div class="col-span-2 text-center uppercase font-bold">
                                            <h1>history of exposure</h1>
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="date_of_incidence">Date of Incidence</label>
                                            <input type="text" name="date_of_incidence" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="place_of_incidence">Place of Incidence</label>
                                            <input type="text" name="place_of_incidence" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                           <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-2">
                                                <div class="flex flex-col">
                                                    <label for="animal">Animal</label>
                                                    <select name="animal" class="grid grid-cols-2 border-0 md:grid-cols-6 lg:grid-cols-6 items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                        <option value="">Select animal</option>
                                                        <option value="pet dog">Pet Dog</option>
                                                        <option value="pet cat">Pet Cat</option>
                                                        <option value="stray dog">Stray Dog</option>
                                                        <option value="stray cat">Stray Cat</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="status_of_animal">Status of Animal</label>
                                                    <input type="text" name="status_of_animal" class="rounded-md p-3 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="type_of_bite">Type of Bite</label>
                                                    <select type="text" name="type_of_bite" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select type of bite</option>
                                                        <option value="bite">Bite</option>
                                                        <option value="non-bite">Non Bite</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="washing_of_bite">Washing of Bite</label>
                                                    <input type="text" name="washing_of_bite" class="rounded-md p-3 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="site_of_bite">Site of Bite</label>
                                                    <input type="text" name="site_of_bite" class="rounded-md p-3 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="previous_vaccination_year">Previous Vaccination Year</label>
                                                    <input type="number" name="previous_vaccination_year" class="rounded-md p-3 ps-2 border-0" min="1900" max="2099" placeholder="YYYY">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="previous_vaccination_status">Previous Vaccination Status</label>
                                                    <select type="text" name="previous_vaccination_status" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select status</option>
                                                        <option value="completed">Completed</option>
                                                        <option value="incomplete">Incomplete</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="tissue_culture_vaccine">Tissue Culture Vaccine</label>
                                                    <select type="text" name="tissue_culture_vaccine" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select here</option>
                                                        <option value="pcev">PCEV</option>
                                                        <option value="pvrv">PVRV</option>
                                                        <option value="id">ID</option>
                                                        <option value="im">IM</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="rabies_immunoglobulin">Rabies Immunoglobulin</label>
                                                    <select type="text" name="rabies_immunoglobulin" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select here</option>
                                                        <option value="equirab">EQUIRAB</option>
                                                        <option value="ravirab">RAVBIRAB</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="erig">ERIG</label>
                                                    <input type="text" name="erig" class="rounded-md p-3 ps-2 border-0" min="1900" max="2099" placeholder="YYYY">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="dose">DOSE (ml)</label>
                                                    <input type="number" name="dose" class="rounded-md p-3 ps-2 border-0" min="1900" max="2099" placeholder="YYYY">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="anti_tetanus">Anti-Tetanus</label>
                                                    <select type="text" name="anti_tetanus" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select here</option>
                                                        <option value="1,5000 u">1,500 u</option>
                                                        <option value="5,000 u">5,000 u</option>
                                                        <option value="6,000 u">6,000 u</option>
                                                        <option value="TOXOID">TOXOID</option>
                                                    </select>
                                                </div>
                                           </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-4">
                                        <div class="col-span-2 text-center uppercase font-bold">
                                            <h1>Schedule of vaccination</h1>
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                    <div class="flex items-center ps-3">
                                                        <input type="checkbox" name="schedule_of_vaccination[]" value="BOOSTER DOSE" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">BOOSTER DOSE</label>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>

                                        <div class="col-span-2 flex flex-col">
                                            <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5">
                                                <div class="col-span-5">
                                                    <div class="text-center uppercase font-bold">
                                                        <h1>POST EXPOSURE</h1>
                                                    </div>

                                                    <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                                        <div class="uppercase font-bold col-span-5">
                                                            <h3>DAY 0</h3>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Date</label>
                                                            <input type="date" name="post_date_of_day_zero" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Time</label>
                                                            <input type="time" name="post_time_of_day_zero" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Site</label>
                                                            <input type="text" name="post_site_of_day_zero" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>R/L</label>
                                                            <select type="text" name="post_r_or_l_zero" class="rounded-md p-3 ps-2 border-0">
                                                                <option value="">Right or Left</option>
                                                                <option value="right">Right</option>
                                                                <option value="left">Left</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>NOD</label>
                                                            <input type="text" name="post_nod_zero" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                                        <div class="uppercase font-bold col-span-5">
                                                            <h3>DAY 3</h3>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Date</label>
                                                            <input type="date" name="post_date_of_day_three" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Time</label>
                                                            <input type="time" name="post_time_of_day_three" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Site</label>
                                                            <input type="text" name="post_site_of_day_three" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>R/L</label>
                                                            <select type="text" name="post_r_or_l_three" class="rounded-md p-3 ps-2 border-0">
                                                                <option value="">Right or Left</option>
                                                                <option value="right">Right</option>
                                                                <option value="left">Left</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>NOD</label>
                                                            <input type="text" name="post_nod_three" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                                        <div class="uppercase font-bold col-span-5">
                                                            <h3>DAY 7</h3>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Date</label>
                                                            <input type="date" name="post_date_of_day_seven" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Time</label>
                                                            <input type="time" name="post_time_of_day_seven" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Site</label>
                                                            <input type="text" name="post_site_of_day_seven" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>R/L</label>
                                                            <select type="text" name="post_r_or_l_seven" class="rounded-md p-3 ps-2 border-0">
                                                                <option value="">Right or Left</option>
                                                                <option value="right">Right</option>
                                                                <option value="left">Left</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>NOD</label>
                                                            <input type="text" name="post_nod_seven" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                                        <div class="uppercase font-bold col-span-5">
                                                            <h3>DAY 14</h3>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Date</label>
                                                            <input type="date" name="post_date_of_day_fourteen" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Time</label>
                                                            <input type="time" name="post_time_of_day_fourteen" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Site</label>
                                                            <input type="text" name="post_site_of_day_fourteen" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>R/L</label>
                                                            <select type="text" name="post_r_or_l_fourteen" class="rounded-md p-3 ps-2 border-0">
                                                                <option value="">Right or Left</option>
                                                                <option value="right">Right</option>
                                                                <option value="left">Left</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>NOD</label>
                                                            <input type="text" name="post_nod_fourteen" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                                        <div class="uppercase font-bold col-span-5">
                                                            <h3>DAY 28</h3>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Date</label>
                                                            <input type="date" name="post_date_of_day_twenty_eight" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Time</label>
                                                            <input type="time" name="post_time_of_day_twenty_eight" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Site</label>
                                                            <input type="text" name="post_site_of_day_twenty_eight" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>R/L</label>
                                                            <select type="text" name="post_r_or_l_twenty_eight" class="rounded-md p-3 ps-2 border-0">
                                                                <option value="">Right or Left</option>
                                                                <option value="right">Right</option>
                                                                <option value="left">Left</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>NOD</label>
                                                            <input type="text" name="post_nod_twenty_eight" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-span-2 flex flex-col">
                                            <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5">
                                                <div class="col-span-5">
                                                    <div class="text-center uppercase font-bold">
                                                        <h1>PRE-EXPOSURE</h1>
                                                    </div>

                                                    <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                                        <div class="uppercase font-bold col-span-5">
                                                            <h3>DAY 0</h3>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Date</label>
                                                            <input type="date" name="pre_date_of_day_zero" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Time</label>
                                                            <input type="time" name="pre_time_of_day_zero" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Site</label>
                                                            <input type="text" name="pre_site_of_day_zero" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>R/L</label>
                                                            <select type="text" name="pre_r_or_l_zero" class="rounded-md p-3 ps-2 border-0">
                                                                <option value="">Right or Left</option>
                                                                <option value="right">Right</option>
                                                                <option value="left">Left</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>NOD</label>
                                                            <input type="text" name="pre_nod_zero" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                                        <div class="uppercase font-bold col-span-5">
                                                            <h3>DAY 7</h3>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Date</label>
                                                            <input type="date" name="pre_date_of_day_seven" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Time</label>
                                                            <input type="time" name="pre_time_of_day_seven" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Site</label>
                                                            <input type="text" name="pre_site_of_day_seven" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>R/L</label>
                                                            <select type="text" name="pre_r_or_l_seven" class="rounded-md p-3 ps-2 border-0">
                                                                <option value="">Right or Left</option>
                                                                <option value="right">Right</option>
                                                                <option value="left">Left</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>NOD</label>
                                                            <input type="text" name="pre_nod_seven" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                    </div>

                                                    <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                                        <div class="uppercase font-bold col-span-5">
                                                            <h3>DAY 21</h3>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Date</label>
                                                            <input type="date" name="pre_date_of_day_twenty_one" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Time</label>
                                                            <input type="time" name="pre_time_of_day_twenty_one" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>Site</label>
                                                            <input type="text" name="pre_site_of_day_twenty_one" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>R/L</label>
                                                            <select type="text" name="pre_r_or_l_twenty_one" class="rounded-md p-3 ps-2 border-0">
                                                                <option value="">Right or Left</option>
                                                                <option value="right">Right</option>
                                                                <option value="left">Left</option>
                                                            </select>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label>NOD</label>
                                                            <input type="text" name="pre_nod_twenty_one" class="rounded-md p-3 ps-2 border-0" />
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
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

                
                
            })
        </script>
    @endsection
</x-app-layout>