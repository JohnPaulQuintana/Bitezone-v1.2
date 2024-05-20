<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>'My Records'])
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-red-700 font-bold">M</span>y  <span class="ml-1"><span class="text-red-700 font-bold">R</span>ecord's.</span>
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
                                        @foreach ($records as $f)
                                        <li class="flex items-center gap-1 px-2 hover:bg-slate-100 filter" data-name="{{ $f->fname }}">
                                            <img class="w-6 h-6 rounded-md" src="{{ asset('storage').'/'.$f->profile }}" alt="">
                                            <a href="#" class="block px-4 py-2">{{ $f->fname }}</a>
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
                                        Physician
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Clinic Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Appointment Details
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
                                {{-- {{ $records }} --}}
                                @foreach ($records as $record)
                                {{-- {{ $record }} --}}
                                    <tr data-name="{{ $record->fname }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input value="{{ $record->id }}" type="checkbox" class="checkbox-id w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-id" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-full" src="{{ asset('storage').'/'.$record->profile }}" alt="Jese image">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">{{ $record->fname }} {{ $record->mname }} {{ $record->lname }}</div>
                                                <div class="font-normal text-gray-500">{{ $record->email }}</div>
                                            </div>  
                                        </th>
                                        <td class="px-6 py-4 text-base font-semibold uppercase">
                                           {{ $record->clinic_name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center">
                                           
                                           @if (!empty($record->followup))
                                               <a href="{{ route('user.followup.details', $record->id) }}" class="fopen border-0 text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                                    Open <span>{{ count($record->followup) }}</span>
                                                </a>
                                           @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @switch($record->status )
                                                    @case(0)
                                                        <div class="h-2.5 w-2.5 rounded-full bg-orange-400 me-2"></div> Waiting
                                                        @break
                                                    @case(1)
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-600 me-2"></div> Recorded
                                                        @break
                                                    
                                                    @default
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Cancelled
                                                        @break
                                                @endswitch
                                                
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo date('Y-m-d H:i:s', strtotime($record->created_at)); ?>
                                        </td>
                                        <td class="px-6 py-4">

                                            @switch($record->status )
                                                    @case(0)
                                                        <a href="{{ route('user.edit',  $record->id) }}" type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                                        @break
                                                    @case(1)
                                                        <a href="{{ route('user.open', $record->id) }}" type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Open</a>
                                                        <button type="button" data-id="{{ $record->id }}" type="button" class="fu font-medium text-red-600 dark:text-blue-500 hover:underline">Follow-up</button>
                                                        @break
                                                    
                                                    @default
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Cancelled
                                                        @break
                                                @endswitch

                                            <!-- Modal toggle -->
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                
                                
                                
                            </tbody>
                        </table>
                        {{ $records->links() }}
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
    @include('user.followup.create')
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
                

                let {
                    title,
                    message,
                    icon
                } = @json(session()->only(['title', 'message', 'icon']));

                if (title !== undefined) {
                    popups(title, message, icon)
                }

                
                // send follow up
                $('.fu').click(function(){
                    // alert('dwadwa')
                    let consultation_id = $(this).data('id')

                    $('#consultation_id').val(consultation_id)
                    $('#followContainer').removeClass('hidden')
                })

                $('#cancelFU').click(function(){
                    $('#followContainer').addClass('hidden')
                })
                
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