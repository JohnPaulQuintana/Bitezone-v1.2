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
                            <span class="text-red-700 font-bold">U</span>pdate  <span class="ml-1"><span class="text-red-700 font-bold">E</span>xamination.</span>
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
                                
                                <form action="{{ route('admin.treatment.update') }}" method="post">
                                    @csrf
                                    {{-- basic information --}}
                                    <div class="grid grid-cols-1 bg-slate-100 p-1 md:grid-cols-3 lg:grid-cols-3 gap-2 mb-4">
                                        <div class="col-span-3 text-center uppercase font-bold text-white bg-red-500">
                                            <h1>basic information</h1>
                                        </div>
                                        <div class="hidden">
                                            {{-- <input type="number" name="patient_id" value="{{ $treatment->user_id }}"> --}}
                                            <input type="number" name="treatment_id" value="{{ $treatment->id }}">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" name="lastname" value="{{ $treatment->user->lastname }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="middlename">Middle Name</label>
                                            <input type="text" name="middlename" value="{{ $treatment->user->middlename }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="firstname">First Name</label>
                                            <input type="text" name="firstname" value="{{ $treatment->user->firstname }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                        </div>
                                        
                                        <div class="col-span-3">
                                            <div class="grid grid-cols-3 gap-2 md:grid-cols-5 lg:grid-cols-5 ">
                                                <div class="flex flex-col">
                                                    <label for="age">Age</label>
                                                    <input type="number" name="age" value="<?php echo date('Y') - date('Y', strtotime($treatment->user->dateofbirth)); ?>" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="gender">Gender</label>
                                                    <select name="gender" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                        <option value="{{ $treatment->user->gender }}">{{ $treatment->user->gender }}</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="date">Date</label>
                                                    <input type="date" name="date" value="<?php echo date('Y-m-d', strtotime($treatment->user->dateofbirth)); ?>" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="time">Time</label>
                                                    <input type="time" name="time" value="<?php echo date('H:i:s', strtotime($treatment->created_at)); ?>" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="record_number">Patient's Record Number</label>
                                                    <input type="text" name="record_number" value="{{ $treatment->record_number }}" class="rounded-md p-2 ps-2 border-0 ">
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-span-3">
                                            <div class="grid grid-cols-1 gap-2 md:grid-cols-3 lg:grid-cols-3">
                                                <div class="flex flex-col">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="address" value="{{ $treatment->user->address }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="place_of_birth">Place of Birth</label>
                                                    <input type="text" name="place_of_birth" value="{{ $treatment->place_of_birth }}" class="rounded-md p-2 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="contact_no">Contact Number</label>
                                                    <input type="tel" name="contact_no" value="{{ $treatment->user->contact_no }}" class="rounded-md p-2 ps-2 border-0 uppercase font-bold" readonly>
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
                                            <input type="text" name="complain" value="{{ $treatment->chief_complain }}" class="rounded-md p-3 ps-2 border-0">
                                        </div>

                                    </div>
                                    {{-- VITAL SIGN'S --}}
                                    <div class="grid grid-cols-2 bg-slate-100  p-1 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4">
                                        <div class="col-span-5 text-center uppercase font-bold text-white bg-red-500">
                                            <h1>vital sign's</h1>
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="bp">BP</label>
                                            <input type="text" name="bp" value="{{ $treatment->bp }}" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="pr">PR</label>
                                            <input type="text" name="pr" value="{{ $treatment->pr }}" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="rr">RR</label>
                                            <input type="text" name="rr" value="{{ $treatment->rr }}" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="temp">Temperature</label>
                                            <input type="text" name="temperature" value="{{ $treatment->temp }}" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="wt">WT</label>
                                            <input type="text" name="wt" value="{{ $treatment->wt }}" class="rounded-md p-3 ps-2 border-0">
                                        </div>

                                    </div>
                                    {{-- DOCTOR'S ORDER --}}
                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-4">
                                        <div class="col-span-2 text-center uppercase font-bold text-white bg-red-500">
                                            <h1>doctor's order</h1>
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="history_of_present_illness">History of Present Illness</label>
                                            <input type="text" name="history_of_present_illness" value="{{ $treatment->history_of_illness }}" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="site_of_bite">Site of Bite</label>
                                            {{-- {{ $treatment->bite->site_of_bite }} --}}
                                            @php
                                                $selected = json_decode($treatment->bite->site_of_bite);
                                                // print_r($selected);
                                            @endphp
                                           
                                            <ul class="grid grid-cols-2 md:grid-cols-6 lg:grid-cols-6 items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                @foreach(['head', 'neck', 'shoulder-left', 'shoulder-right', 'arm-left', 'arm-right', 'elbow-left', 'elbow-right', 'hand-left', 'hand-right', 'chest', 'back', 'abdomen', 'hips', 'leg-left', 'leg-right'] as $bodyPart)
                                                    <li class="w-full border-b border-gray-200 sm:border-b-0 dark:border-gray-600">
                                                        <div class="flex items-center ps-3">
                                                            <input name="body_parts[]" type="checkbox" value="{{ $bodyPart }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" {{ in_array($bodyPart, $selected) ? 'checked' : '' }}>
                                                            <label class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ ucwords(str_replace('-', ' ', $bodyPart)) }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            @error('body_parts')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="pertinent_pe">Pertinent PE</label>
                                            <input type="text" name="pertinent_pe" value="{{ $treatment->pertinent_pe }}" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="diagnosis">Diagnosis</label>
                                            <input type="text" name="diagnosis" value="{{ $treatment->diagnosis }}" class="rounded-md p-3 ps-2 border-0">
                                        </div>
                                        <div class="col-span-2 flex flex-col">
                                            <label for="home_medecine">Home Medicine</label>
                                            <input type="text" name="home_medicine" value="{{ $treatment->home_medicine }}" class="rounded-md p-3 ps-2 border-0">
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
                                            <input type="date" name="date_of_incidence" value="{{ $treatment->exposure->date_of_incidence }}" class="rounded-md p-3 ps-2 border-0 @error('date_of_incidence') error @enderror">
                                            @error('date_of_incidence')
                                                <p class="text-red-500">Date of incidence field is required.</p>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="place_of_incidence">Place of Incidence</label>
                                            <input type="text" name="place_of_incidence" value="{{ $treatment->exposure->place_of_incidence }}" class="rounded-md p-3 ps-2 border-0 @error('place_of_incidence') error @enderror">
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
                                                        <option value="pet dog" @if($treatment->exposure->animal_type === "pet dog") selected @endif>Pet Dog</option>
                                                        <option value="pet cat" @if($treatment->exposure->animal_type === "pet cat") selected @endif>Pet Cat</option>
                                                        <option value="stray dog" @if($treatment->exposure->animal_type === "stray dog") selected @endif>Stray Dog</option>
                                                        <option value="stray cat" @if($treatment->exposure->animal_type === "stray cat") selected @endif>Stray Cat</option>
                                                        <option value="others" @if($treatment->exposure->animal_type === "others") selected @endif>Others</option>
                                                    </select>
                                                    @error('animal')
                                                        <p class="text-red-500">Animal type field is required.</p>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="status_of_animal">Status of Animal</label>
                                                    <input type="text" name="status_of_animal" class="rounded-md p-3 ps-2 border-0" value="{{ $treatment->exposure->animal_status }}">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="type_of_bite">Type of Bite</label>
                                                    <select type="text" name="type_of_bite" class="rounded-md p-3 ps-2 border-0 @error('type_of_bite') error @enderror">
                                                        <option value="">Select type of bite</option>
                                                        <option value="bite" @if($treatment->exposure->type_of_bite === 'bite') selected @endif>Bite</option>
                                                        <option value="non-bite" @if($treatment->exposure->type_of_bite === 'non-bite') selected @endif>Non Bite</option>
                                                    </select>
                                                    @error('site_of_bite')
                                                        <p class="text-red-500">Type of bite field is required.</p>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="washing_of_bite">Washing of Bite</label>
                                                    <input type="text" name="washing_of_bite" class="rounded-md p-3 ps-2 border-0" value="{{ $treatment->exposure->washing_of_bite }}">
                                                    
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="site_of_bite">Site of Bite</label>
                                                    <input type="text" name="site_of_bite" value="{{ $treatment->exposure->site_of_bite }}" class="rounded-md p-3 ps-2 border-0 @error('site_of_bite') error @enderror">
                                                    @error('site_of_bite')
                                                        <p class="text-red-500">Site of bite field is required.</p>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="previous_vaccination_year">Previous Vaccination Year</label>
                                                    <input type="date" name="previous_vaccination_year" value="{{ $treatment->exposure->previous_vaccination }}" class="rounded-md p-3 ps-2 border-0" min="1900" max="2099" placeholder="YYYY">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="previous_vaccination_status">Previous Vaccination Status</label>
                                                    <select type="text" name="previous_vaccination_status" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select status</option>
                                                        <option value="completed" @if($treatment->exposure->status === 'completed') selected @endif>Completed</option>
                                                        <option value="incomplete" @if($treatment->exposure->status ==='incompleted') selected @endif>Incomplete</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="tissue_culture_vaccine">Tissue Culture Vaccine</label>
                                                    <select type="text" name="tissue_culture_vaccine" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select here</option>
                                                        <option value="pcev" @if($treatment->exposure->tissue_culture_vaccine ==='pcev') selected @endif>PCEV</option>
                                                        <option value="pvrv" @if($treatment->exposure->tissue_culture_vaccine ==='pvrv') selected @endif>PVRV</option>
                                                        <option value="id" @if($treatment->exposure->tissue_culture_vaccine ==='id') selected @endif>ID</option>
                                                        <option value="im" @if($treatment->exposure->tissue_culture_vaccine ==='im') selected @endif>IM</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="rabies_immunoglobulin">Rabies Immunoglobulin</label>
                                                    <select type="text" name="rabies_immunoglobulin" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select here</option>
                                                        <option value="equirab" @if($treatment->exposure->rabies_immunoglobulin ==='equirab') selected @endif>EQUIRAB</option>
                                                        <option value="ravirab" @if($treatment->exposure->rabies_immunoglobulin ==='ravirab') selected @endif>RAVBIRAB</option>
                                                    </select>
                                                </div>  
                                                <div class="flex flex-col">
                                                    <label for="erig">ERIG</label>
                                                    <input type="text" name="erig" value="{{ $treatment->exposure->erig }}" class="rounded-md p-3 ps-2 border-0">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="dose">DOSE (ml)</label>
                                                    <input type="number" name="dose" value="{{ $treatment->exposure->dose }}" class="rounded-md p-3 ps-2 border-0" min="1" max="1000">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="anti_tetanus">Anti-Tetanus</label>
                                                    <select type="text" name="anti_tetanus" class="rounded-md p-3 ps-2 border-0">
                                                        <option value="">Select here</option>
                                                        <option value="1,5000 u" @if($treatment->exposure->anti_titanus ==='1,5000 u') selected @endif>1,500 u</option>
                                                        <option value="5,000 u" @if($treatment->exposure->anti_titanus ==='5,000 u') selected @endif>5,000 u</option>
                                                        <option value="6,000 u" @if($treatment->exposure->anti_titanus ==='6,000 u') selected @endif>6,000 u</option>
                                                        <option value="TOXOID" @if($treatment->exposure->anti_titanus ==='TOXOID') selected @endif>TOXOID</option>
                                                    </select>
                                                </div>
                                           </div>
                                        </div>
                                    </div>

                                     

                                    <div class="grid grid-cols-1 bg-slate-100  p-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mb-4">
                                        <div class="col-span-2">
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 rounded-md hover:cursor-pointer w-full p-2 text-white">Update Record's</button>
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
                let sessionStatus = @json(session('status'));
                let sessionMessage = @json(session('message'));
                let sessionTitle = @json(session('title'));
               
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

                const popups = (t,m,s) => {
                    Swal.fire({
                        title: t,
                        text: m,
                        icon: s
                    });
                }

                if(sessionTitle,sessionMessage !== null && sessionStatus !== null){
                    popups(sessionTitle,sessionMessage, sessionStatus);
                }
                
            })
        </script>
    @endsection
</x-app-layout>