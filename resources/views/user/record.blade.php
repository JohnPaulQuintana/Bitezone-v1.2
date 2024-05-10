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
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
    {{-- @include('user.popup.consulation') --}}
    @section('scripts')
        <script>
            $(document).ready(function() {

                // $('#consultationBtn').click(function(){
                //     $('#consultationContainer').removeClass('hidden')
                    
                // })
                
                // $('#consultationClose').click(function(){
                //     $('#consultationContainer').addClass('hidden')
                // })

                // $('#locationBtn').click(function(){
                //     let name = $('#name').val();
                //     let email = $('#email').val();
                //     let message = $('#message').val();
                //     let requestData = {name:name, email:email,message:message}
                //     sendRequest('POST', '/user/send', requestData)
                //         .then(function(response) {
                //             // Handle successful response
                //             console.log(response);
                //             sweetAlertSuccess(response.status, response.message)
                //         })
                //         .catch(function(error) {
                //             // Handle error
                //             Swal.fire({
                //                 icon: 'error',
                //                 title: "We encounter an error!",
                //                 html: `<span>The data you provided is invalid.</span>`,
                //                 showClass: {
                //                     popup: `
                //                 animate__animated
                //                 animate__fadeInUp
                //                 animate__faster
                //                 `
                //                 },
                //                 hideClass: {
                //                     popup: `
                //                 animate__animated
                //                 animate__fadeOutDown
                //                 animate__faster
                //                 `
                //                 },
                //                 didOpen: () => {
                                    
                //                     const data = Swal.getPopup().querySelector("b");
                //                     console.log(error.errors)
                //                     // timerInterval = setInterval(() => {
                //                     //     timer.textContent = `${Swal.getTimerLeft()}`;
                //                     // }, 100);
                //                 },
                //             });

                //             console.log(error)
                //         });
                // })

                // //dynamic request
                // function sendRequest(method, url, data = {}) {
                //     return new Promise(function(resolve, reject) {
                //         // Get the CSRF token from the meta tag
                //         var csrfToken = $('meta[name="csrf-token"]').attr('content');

                //         // Add the CSRF token to the data object
                //         data._token = csrfToken;

                //         $.ajax({
                //             method: method,
                //             url: url,
                //             data: data,
                //             headers: {
                //                 'X-CSRF-TOKEN': csrfToken // Include CSRF token in the request headers
                //             },
                //             success: function(response) {
                //                 resolve(response);
                //             },
                //             error: function(xhr, status, error) {
                //                 reject(error);
                //             }
                //         });
                //     });
                // }

                // //popups
                // function sweetAlertSuccess(status, message) {
                //     let timerInterval;
                //     Swal.fire({
                //         title: "Sent successfully!",
                //         html: `<span>${message}</span><span class="block"><b></b></span>`,
                //         text: message,
                //         icon: status,
                //         timer: 2000,
                //         timerProgressBar: true,
                //         didOpen: () => {
                //             Swal.showLoading();
                //             const timer = Swal.getPopup().querySelector("b");
                //             timerInterval = setInterval(() => {
                //                 timer.textContent = `${Swal.getTimerLeft()}`;
                //             }, 100);
                //         },
                //         willClose: () => {
                //             clearInterval(timerInterval);
                //         }
                //     }).then((result) => {
                //         if (result.dismiss === Swal.DismissReason.timer) {
                //             console.log("I was closed by the timer");
                //             window.location.reload();
                //         }
                //     });
                // }
                
            })
        </script>
    @endsection
</x-app-layout>