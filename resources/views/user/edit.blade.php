<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>'Edit Records'])
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center px-2">
                        <div>
                            <span class="text-red-700 font-bold">E</span>dit  <span class="ml-1"><span class="text-red-700 font-bold">R</span>ecord.</span>
                        </div>
                        {{-- <button type="button" id="consultationBtn" class="bg-red-500 p-1 text-white rounded-md hover:bg-red-700"><i class="fa-regular fa-calendar-plus"></i> Consultation</button> --}}
                    </div>
                    {{-- record table here --}}
                    
                    <div class="overflow-x-auto shadow-md sm:rounded-lg px-2 z-0">
                        
                        <p class="mb-6 text-lg font-normal text-left text-gray-500 lg:text-xl dark:text-gray-400">Please update the message content below:</p>

                        <form action="{{ route('user.update') }}" method="post">
                            @csrf
                            <input type="number" name="id" value="{{ $records->id }}" class="hidden">
                            {{-- {{ $records }} --}}
                            <div class="grid gap-2 grid-cols-1 md:grid-cols-3 lg:grid-cols-3 justify-center items-center p-2">
                                <div class="col-span-2">
                                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consultation Message</label>
                                    <input type="text" name="message" id="input-group-1" value="{{ $records->consultation }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com">
                                </div>
                                <div>
                                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of consultation</label>
                                    <input type="date" name="date" id="input-group-1" value="{{ $records->created_at->format('Y-m-d') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com">
                                </div>
                                <div>
                                    <button type="submit" class="bg-blue-500 p-1 text-white rounded-md hover:bg-blue-700 hover:cursor-pointer">Update Consultation</button>
                                </div>
                            </div>
                        </form>
                        
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
    @include('user.popup.consulation')
    @section('scripts')
        <script>
            $(document).ready(function() {

                $('#consultationBtn').click(function(){
                    $('#consultationContainer').removeClass('hidden')
                    
                })
                
                $('#consultationClose').click(function(){
                    $('#consultationContainer').addClass('hidden')
                })

                $('#locationBtn').click(function(){
                    let name = $('#name').val();
                    let email = $('#email').val();
                    let message = $('#message').val();
                    let requestData = {name:name, email:email,message:message}
                    sendRequest('POST', '/user/send', requestData)
                        .then(function(response) {
                            // Handle successful response
                            console.log(response);
                            sweetAlertSuccess(response.status, response.message)
                        })
                        .catch(function(error) {
                            // Handle error
                            Swal.fire({
                                icon: 'error',
                                title: "We encounter an error!",
                                html: `<span>The data you provided is invalid.</span>`,
                                showClass: {
                                    popup: `
                                animate__animated
                                animate__fadeInUp
                                animate__faster
                                `
                                },
                                hideClass: {
                                    popup: `
                                animate__animated
                                animate__fadeOutDown
                                animate__faster
                                `
                                },
                                didOpen: () => {
                                    
                                    const data = Swal.getPopup().querySelector("b");
                                    console.log(error.errors)
                                    // timerInterval = setInterval(() => {
                                    //     timer.textContent = `${Swal.getTimerLeft()}`;
                                    // }, 100);
                                },
                            });

                            console.log(error)
                        });
                })

                //dynamic request
                function sendRequest(method, url, data = {}) {
                    return new Promise(function(resolve, reject) {
                        // Get the CSRF token from the meta tag
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        // Add the CSRF token to the data object
                        data._token = csrfToken;

                        $.ajax({
                            method: method,
                            url: url,
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Include CSRF token in the request headers
                            },
                            success: function(response) {
                                resolve(response);
                            },
                            error: function(xhr, status, error) {
                                reject(error);
                            }
                        });
                    });
                }

                //popups
                function sweetAlertSuccess(status, message) {
                    let timerInterval;
                    Swal.fire({
                        title: "Sent successfully!",
                        html: `<span>${message}</span><span class="block"><b></b></span>`,
                        text: message,
                        icon: status,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                                timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log("I was closed by the timer");
                            window.location.reload();
                        }
                    });
                }
                
            })
        </script>
    @endsection
</x-app-layout>