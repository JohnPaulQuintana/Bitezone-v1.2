<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Clinic'])
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2 h-full">
                <div class="px-6 text-gray-900 dark:text-gray-100 mb-2">
                    <div class="flex flex-row justify-between items-center">
                        <div>
                            <span class="text-red-700 font-bold">A</span>vailable <span class="ml-1"><span
                            class="text-red-700 font-bold">C</span>linic's</span>.
                        </div>
                        <div>
                            
                            <form class="max-w-md mx-auto">   
                                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                <div class="">
                                    
                                    <input type="search" id="search-clinic" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Clinic's" required />
                                    
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

                {{-- record table here --}}
                <div class="grid grid-cols-1 gap-1 lg:grid-cols-3 pl-6">
                    {{-- <div class="col-span-3 bg-slate-50 text-red-700">
                        <span>All the clinic list is clickable for easy navigation.</span>
                    </div> --}}
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-2 w-full h-fit overflow-auto mb-2">
                        {{-- {{ $clinicLocation }} --}}
                        @foreach ($clinicLocation as $clinic)
                            <div data-name="{{ $clinic->clinic->name }}"
                                class="clinic shadow border-l-8 border-red-500 bg-slate-50 p-2 w-full h-fit grid grid-cols-1 lg:grid-cols-2 gap-2 mb-2 rounded-md hover:cursor-pointer hover:opacity-50">
                                <img src="{{ asset('storage') . '/' . $clinic->clinic->profile }}" alt=""
                                    class="w-[200px] h-[100px] rounded-md">
                                
                                <div class="">
                                    <span class="text-sm font-bold uppercase">{{ $clinic->clinic->name }}</span>
                                    <div class="rounded-sm text-[12px] grid grid-cols-1 md:grid-cols-2 gap-2">
                                        <div class="shadow text-blue-500 text-center">
                                            <span>Open</span>
                                            <span class="block -mt-2">{{ \Carbon\Carbon::parse($clinic->clinic->open)->format('g:i A') }}</span>
                                        </div>
                                        <div class="shadow text-red-500 text-center">
                                            <span>Closed</span>
                                            <span class="block -mt-2">{{ \Carbon\Carbon::parse($clinic->clinic->closed)->format('g:i A') }}</span>
                                        </div>
                                        <div class="shadow text-green-500 text-center col-span-2">
                                            <span>Status: <span class="">active</span></span>
                                        </div>
                                    </div>
                                    
                                </div>

                                @php
                                    $daysOfWeek = json_decode($clinic->clinic->days_of_week);
                                @endphp
                                <div class="col-span-2 grid grid-cols-7 gap-1 text-[12px] text-center border-t-2 items-center justify-center capitalize">
                                    <span class="col-span-7">Weekdays Open</span>
                                    @foreach ($daysOfWeek as $day)
                                        <span class="px-1 py-1 bg-gray-200 rounded shadow">{{ substr($day, 0, 3) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="map" style="width: 100%; height: 650px;" class="col-span-2"></div>
                </div>

                @if (empty($location))
                    <div id="locationSetupPopup">
                        @include('user.popup.location-setup')
                    </div>
                @endif

            </div>
        </div>
    </div>

    @include('user.popup.consulation')

    @section('scripts')
        <script>
            $(document).ready(function() {
                if (!$('#locationContainer, #clinicContainer').is(':visible')) {

                    $('#search-clinic').on('input', function() {
                        var query = $(this).val().toLowerCase().trim(); // Get the search query

                        // Iterate through each clinic card
                        $('.clinic').each(function() {
                            var clinicName = $(this).data('name').toLowerCase(); // Get the clinic's name
                            var isVisible = clinicName.includes(query); // Check if the clinic's name matches the search query

                            // Show or hide the clinic card based on the search result
                            if (isVisible) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    });

                    // console.log('connected')

                    $clinicInformation = @json($clinicLocation);
                    $mylocation = @json($location);
                    // console.log($mylocation)
                    let clinicElements = []
                    //get the render clinic elements
                    // $('.clinic').each(function(index, element) {
                    //     clinicElements.push(element)
                    // });

                    // clinicElements.push($('.me'))

                    const map = L.map('map').setView([$mylocation.lat, $mylocation.long], 15.5);

                    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);
                    //get the clinic location based on response
                    let coords = []
                    let images = [] //stored images 
                    let names = [] //stored labels for all registered clinic
                    let address = []
                    $clinicInformation.forEach(coord => {
                        // console.log(coord)
                        coords.push([parseFloat(coord.lat), parseFloat(coord.long)])
                        images.push(coord.clinic.profile);
                        names.push([{label:coord.clinic.name}, {userId: coord.user_id}])
                        let splitAddress = coord.address.split(", ")
                        address.push([{addr:`${splitAddress[2]} ${splitAddress[3]}, ${splitAddress[4]}.`}])
                    });
                    // console.log(address)
                    coords.push([parseFloat($mylocation.lat), parseFloat($mylocation.long), {type:"starting-point"}])
                    images.push($mylocation.user.profile);
                    names.push([{label:`${$mylocation.user.firstname} ${$mylocation.user.lastname}`}, {userId:$mylocation.user_id}]);
                    let splitMyAddress = $mylocation.address.split(", ")
                    address.push([{addr:`${splitMyAddress[2]} ${splitMyAddress[3]}, ${splitMyAddress[4]}.`}])
                    
                
                    console.log(address)

                    // coords = [
                    //     [14.56103, 120.59476],
                    //     [14.56123, 120.59390],
                    //     [14.56181, 120.59487],
                    //     [14.56335, 120.59380],
                    //     [14.56422, 120.59657]
                    // ]
                    const startPoint = L.latLng(coords[coords.length - 1]); // Last coordinate as starting point
                    // console.log(startPoint)
                    // console.log(startPoint)
                    // let totalDistance = 0;
                    let distances = [];
                    for (let index = 0; index < coords.length; index++) { //minus 1 because it is my location test for starting point
                        const currentPoint = L.latLng(coords[index]);
                        const distance = startPoint.distanceTo(currentPoint);
                        distances.push(distance)
                        // console.log(`Distance between starting point and point ${index + 1}: ${distance} meters`);
                        // totalDistance += distance;
                    }

                    // console.log(`Distances array:`, distances);
                    const baseUrl = window.location.origin; //extract the base url
                    // let images = ['profiles/4aK4MxODvjSdZTPQxav2DX2QYg2C4WJmlavtjK7n.png',
                    //     'profiles/4aK4MxODvjSdZTPQxav2DX2QYg2C4WJmlavtjK7n.png',
                    //     'profiles/4aK4MxODvjSdZTPQxav2DX2QYg2C4WJmlavtjK7n.png',
                    //     'profiles/4aK4MxODvjSdZTPQxav2DX2QYg2C4WJmlavtjK7n.png',
                    //     'profiles/4aK4MxODvjSdZTPQxav2DX2QYg2C4WJmlavtjK7n.png'
                    // ]
                    let len = coords.length
                    
                    let btnShow = ''
                    for (let index = 0; index < len; index++) {
                        let startPointExists = coords[index] && coords[index][2]?.type;
                        // console.log(coords[index][2].type)
                        let startPointNotEmpty = startPointExists ? coords[index][2]?.type !== "" : false;
                        let control = ''
                        // popups
                        if(startPointNotEmpty){
                            btnShow = 'hidden'
                        }else{
                            btnShow = ''
                        }
                        var pop = L.popup({
                            closeOnClick: true
                        }).setContent(`<div class="flex flex-col"><img src="${baseUrl}/storage/${images[index]}"/>
                                        <span>${names[index][0].label}</span>
                                        <button onclick="triggerConsultation(${names[index][1].userId})" class="mt-1 bg-red-500 p-1 rounded-md text-white hover:cursor-pointer hover:bg-red-700 consultationBtn ${btnShow}" >Consult now</button>
                                    </div>`)

                        var marker = L.marker(coords[index]).addTo(map).bindPopup(pop);

                        //labels
                        let content = '';
                        

                        if (startPointNotEmpty) {
                            // console.log('yes')
                            content += `
                            <div class="flex flex-col">
                                
                                <span class="text-[12px] font-bold">My Location</span>
                                <span class="text-[10px] text-blue-500 font-bold text-wrap">${address[index][0].addr}</span>
                            </div>`
                        } else {
                            content += `
                            <div class="flex flex-col items-center">
                                
                                <span class="text-[12px] font-bold text-wrap">${names[index][0].label}</span>
                                
                                <span class="text-[10px] text-blue-500 font-bold text-wrap">${address[index][0].addr}</span>
                                <span class="text-red-500 text-[10px]">Distance: ${distances[index].toFixed(2)} meters</span>
                            </div>`
                        }
                        var toollip = L.tooltip({
                            permanent: true
                        }).setContent(content);

                        marker.bindTooltip(toollip);

                        // console.log(startPointNotEmpty)
                        //zoom in / fly to when hovering the clinic
                        // console.log(clinicElements)
                        $('.clinic').each(function(i, element) {
                            // Add click event listener to each clinic element
                            $(element).click(function() {
                                // Scroll down to the bottom of the page
                                $("html, body, .main").animate({ scrollTop: $(document).height() }, 1000);

                                // Trigger map flyTo action using coords[index]
                                map.flyTo(coords[i], 19);
                               

                                setTimeout(() => {
                                    map.flyTo(coords[i], 15);
                                    // Add routing functionality
                                    var userLocation = [$mylocation.lat, $mylocation.long]; // user's current location
                                    if (control !== '') {
                                        map.removeControl(control)
                                        control = ''
                                    }
                                    // Create Leaflet Routing Machine control
                                    control = L.Routing.control({
                                        waypoints: [
                                            L.latLng(userLocation), // Start point (user's location)
                                            L.latLng(coords[i]) // End point (clinic's location)
                                        ],
                                        routeWhileDragging: false, // Show route while dragging the waypoint marker
                                        // hide: true, // Hide the instruction panel
                                        show: false // Hide the control completely
                                        // geocoder: L.Control.Geocoder.nominatim() // Geocoding service
                                    
                                    }).addTo(map);
                                }, 2000);
                                

                                
                                setTimeout(() => {
                                    map.removeControl(control)
                                    control = ''
                                }, 10000);
                                
                            });
                        });

                        window.triggerConsultation = (id) => {
                            // alert(id)
                            $('#user_id').val(id)
                            $('#consultationContainer').removeClass('hidden')
                        }
                    
                        $('#consultationClose').click(function(){
                            $('#consultationContainer').addClass('hidden')
                        })

                        // Unbind any existing click event handlers before binding a new one
                        $(document).off('click', '#locationBtn').on('click', '#locationBtn', function() {
                            let userId = $('#user_id').val();
                            let message = $('#message').val();
                            let requestData = {user_id:userId,message:message}
                            // console.log(requestData)
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
                                    $('#consultationContainer').addClass('hidden')
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
                    }

                    // $(document).on('click','.consultationBtn',function(){
                    //     alert('yes')
                    //     // $('#consultationContainer').removeClass('hidden')
                    // })

                    
                }

                
            })
        </script>
    @endsection
</x-app-layout>
