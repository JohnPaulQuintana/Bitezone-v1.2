<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>"Patient's Record"])
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-red-700 font-bold">P</span>atient  <span class="ml-1"><span class="text-red-700 font-bold">R</span>ecord's.</span>
                        </div>
                        {{-- <button type="button" id="consultationBtn" class="bg-red-500 p-1 text-white rounded-md hover:bg-red-700"><i class="fa-regular fa-calendar-plus"></i> Consultation</button> --}}
                    </div>
                    {{-- record table here --}}
                    
                    <div class="overflow-x-auto shadow-md sm:rounded-lg px-2">
                        <div class="flex items-center justify-end flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
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
                                        <li class="filter" data-name="all">
                                            <a href="#" id="filter-all" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Display All</a>
                                        </li>
                                        @foreach ($patientRecords as $f)
                                        <li class="flex items-center gap-1 px-2 hover:bg-slate-100 filter" data-name="{{ $f->user->firstname }}">
                                            <img class="w-6 h-6 rounded-md" src="{{ asset('storage').'/'.$f->user->profile }}" alt="">
                                            <a href="#" class="block px-4 py-2">{{ $f->user->firstname }}</a>
                                        </li>
                                        @endforeach
                                        
                                    </ul>
                                    
                                </div>
                            </div>
                            {{-- <label for="table-search" class="sr-only">Search</label>
                            <div class="">
                               
                                <input type="text" id="table-search-users" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search here...">
                            </div> --}}
                        </div>
                        <table id="records-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Patient Name
                                    </th>
                                    
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>  
                                {{-- {{ $patientRecords }} --}}
                                @foreach ($patientRecords as $patientRecord)
                                    <tr data-name="{{ $patientRecord->user->firstname }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input value="{{ $patientRecord->id }}" type="checkbox" class="checkbox-id w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-id" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-full" src="{{ asset('storage').'/'.$patientRecord->user->profile }}" alt="Jese image">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">{{ $patientRecord->user->firstname }} {{ $patientRecord->user->middlename }} {{ $patientRecord->lastname }}</div>
                                                <div class="font-normal text-gray-500">{{ $patientRecord->user->email }}</div>
                                            </div>  
                                        </th>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="h-2.5 w-2.5 rounded-full bg-green-600 me-2"></div> Recorded
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo date('Y-m-d H:i:s', strtotime($patientRecord->created_at)); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <!-- Modal toggle -->
                                            <a href="{{ route('admin.open', $patientRecord->id) }}" type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Open</a>
                                            <a href="{{ route('admin.treatment.edit', $patientRecord->id) }}" type="button" class="font-medium text-red-600 dark:text-red-500 hover:underline">Update</a>
                                            <a href="{{ route('admin.vaccination', $patientRecord->id) }}" type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Vaccine</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>

                    @if (empty($location))
                        <div id="locationSetupPopup">
                            @include('admin.popup.clinic-setup')
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

               $('.filter').click(function(){
                    // alert($(this).data('name'))
                    filterTable($(this).data('name'))
               }) 
                

               function filterTable(filter) {
                    $('#records-table tbody tr').each(function() {
                        const rowName = $(this).data('name');
                        if (filter === 'all' || rowName === filter) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }
            })
        </script>
    @endsection
</x-app-layout>