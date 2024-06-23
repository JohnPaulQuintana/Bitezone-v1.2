<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Verification of Clinic Account") }}

                    <div class="border overflow-x-auto">
                        <table id="records-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    {{-- <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>
                                    </th> --}}
                                    {{-- <th scope="col" class="px-6 py-3">
                                        Email
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3">
                                        Full Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Gender
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Contact Number
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Address
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ $needToVerified }} --}}
                                @foreach ($needToVerified as $v)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        
                                         <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-full" src="{{ asset('storage').'/'.$v->profile }}" alt="Jese image">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">{{ $v->firstname }} {{ $v->middlename }} {{ $v->lastname }}</div>
                                                <div class="font-normal text-gray-500">{{ $v->email }}</div>
                                            </div>  
                                        </th>

                                        <td class="py-4 text-sm font-semibold uppercase">
                                            {{ $v->gender }}
                                         </td>
                                        <td class="px-4 py-4 text-sm font-semibold uppercase">
                                            {{ $v->contact_no }}
                                         </td>
                                        <td class="px-4 py-4 text-sm font-semibold uppercase">
                                            {{ $v->address }}
                                         </td>
                                         <td class="py-4 text-[10px] font-semibold uppercase">
                                            @switch($v->verified)
                                                @case(1)
                                                
                                                    <span class="bg-green-500 text-white p-1">{{ __('verified') }}</span>
                                                    
                                                    @break
                                                @case(0)
                                                        <span class="bg-red-500 text-white p-1">{{ __('not-verified') }}</span>
                                                    @break
                                                @default
                                                    
                                            @endswitch

                                        </td>
                                        <td class="py-4 text-sm flex gap-1">
                                           
                                            @if ($v->verified !== 1)
                                                <button type="button" data-id="{{ $v->id }}" class="verifiedBtn bg-blue-500 hover:bg-blue-700 p-1 text-white rounded-md"><i class="fa-solid fa-badge-check"></i> verify</button>
                                                <button type="button" data-id="{{ $v->id }}" class="rejectBtn bg-red-500 hover:bg-red-700 p-1 text-white rounded-md"><i class="fa-solid fa-xmark-to-slot"></i> reject</button>

                                            @else
                                            <button type="button" data-id="{{ $v->id }}" class="viewBtn bg-blue-500 hover:bg-blue-700 p-1 text-white rounded-md"><i class="fa-solid fa-badge-check"></i> view</button>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.popup.open')
    @section('scripts')
        <script>
            let accounts = @json($needToVerified);
            let verifiedStatus = @json(session('verified.status'));
            console.log(accounts)
            // Function to initialize the map
            

            $(document).ready(function(){
                console.log('connected!')

                if(verifiedStatus === 'success'){
                    Swal.fire({
                        title: "Verification Success!",
                        text: "Clinic is now verified and operational!",
                        icon: "success"
                    });
                }
                $('.verifiedBtn').click(function(){
                    // alert($(this).data('id'))
                    let id = $(this).data('id')
                    let path = "{{ asset('storage') }}";
                    accounts.forEach(a => {
                        if(a.id == id){
                            // console.log(a.location.clinic.profile)
                            $('#user_id').val(id)
                            $('#c_profile').attr('src',`${path}/${a.location.clinic.profile}`)
                            $('#c_certificate').attr('src',`${path}/${a.location.clinic.certificate}`)
                            $('#c_name').text(a.location.clinic.name)
                            $('#c_address').text(a.location.address)
                        }
                    });
                    $('#openModalbtn').trigger('click')
                })

                $('.rejectBtn').click(function(){
                    alert($(this).data('id'))
                })

                
            })
        </script>
    @endsection
</x-app-layout>