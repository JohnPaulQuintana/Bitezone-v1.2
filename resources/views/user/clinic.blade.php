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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-wrap">
                    <div class=""><span class="text-red-700 font-bold">A</span>vailable <span class="ml-1"><span
                                class="text-red-700 font-bold">C</span>linic's</span>.</div>

                </div>

                {{-- record table here --}}
                <div class="grid grid-cols-1 gap-1 md:grid-cols-2 pl-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        {{-- {{ $clinicLocation }} --}}
                        @foreach ($clinicLocation as $clinic)
                            <div
                                class="clinic shadow border-l-4 p-2 w-[300px] h-fit grid grid-cols-1 md:grid-cols-2 gap-2 rounded-md hover:cursor-pointer hover:opacity-50">
                                <img src="{{ asset('storage') . '/' . $clinic->clinic->profile }}" alt=""
                                    class="w-[200px] h-[100px] rounded-md">
                                
                                <div class="">
                                    <span class="text-sm font-bold">{{ $clinic->clinic->name }}</span>
                                    <div class="rounded-sm text-[12px] grid grid-cols-1 md:grid-cols-2 gap-2">
                                        <div class="shadow text-blue-500 text-center">
                                            <span>Open</span>
                                            <span class="block -mt-2">{{ \Carbon\Carbon::parse($clinic->clinic->open)->format('g:i A') }}</span>
                                        </div>
                                        <div class="shadow text-red-500 text-center">
                                            <span>Closed</span>
                                            <span class="block -mt-2">{{ \Carbon\Carbon::parse($clinic->clinic->closed)->format('g:i A') }}</span>
                                        </div>
                                    </div>
                                    
                                </div>

                                @php
                                    $daysOfWeek = json_decode($clinic->clinic->days_of_week);
                                @endphp
                                <div class="col-span-2 grid grid-cols-7 gap-1 text-[12px] text-center border-t-2 items-center justify-center capitalize">
                                    @foreach ($daysOfWeek as $day)
                                        <span class="px-1 py-1 bg-gray-200 rounded shadow">{{ substr($day, 0, 3) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        {{-- @for ($i = 1; $i <= 5; $i++)
                            @if ($i === 5)
                                <div
                                    class="clinic shadow p-2 w-20 h-20 flex flex-col items-center rounded-md hover:cursor-pointer hover:opacity-50">
                                    <img src="{{ asset('storage') . '/' . Auth::user()->profile }}" alt=""
                                        class="w-10 h-10">
                                    <span>Me</span>
                                </div>
                            @else
                                <div
                                    class="clinic shadow p-2 w-20 h-20 flex flex-col items-center rounded-md hover:cursor-pointer hover:opacity-50">
                                    <img src="{{ asset('storage') . '/' . Auth::user()->profile }}" alt=""
                                        class="w-10 h-10">
                                    <span>Clinic {{ $i }}</span>
                                </div>
                            @endif
                        @endfor --}}

                    </div>
                    <div id="map" style="width: 600px; height: 400px;" class=""></div>
                </div>

                @if (empty($location))
                    <div id="locationSetupPopup">
                        @include('user.popup.location-setup')
                    </div>
                @endif

            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                if (!$('#locationContainer, #clinicContainer').is(':visible')) {
                    // console.log('connected')

                    $clinicInformation = @json($clinicLocation);
                    $mylocation = @json($location);
                    // console.log($mylocation)
                    let clinicElements = []
                    //get the render clinic elements
                    $('.clinic').each(function(index, element) {
                        clinicElements.push(element)
                    });

                    clinicElements.push($('.me'))

                    const map = L.map('map').setView([$mylocation.lat, $mylocation.long], 15);

                    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);
                    //get the clinic location based on response
                    let coords = []
                    let images = [] //stored images 
                    let names = [] //stored labels for all registered clinic
                 
                    $clinicInformation.forEach(coord => {
                        // console.log(coord.clinic)
                        coords.push([parseFloat(coord.lat), parseFloat(coord.long)])
                        images.push(coord.clinic.profile);
                        names.push(coord.clinic.name)
                    });

                    coords.push([parseFloat($mylocation.lat), parseFloat($mylocation.long), {type:"starting-point"}])
                    images.push($mylocation.user.profile);
                    names.push(`${$mylocation.user.firstname} ${$mylocation.user.lastname}`);
                    
                
                    // console.log(coords)

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

                        // popups
                        if(startPointNotEmpty){
                            btnShow = 'hidden'
                        }else{
                            btnShow = ''
                        }
                        var pop = L.popup({
                            closeOnClick: true
                        }).setContent(`<div class="flex flex-col"><img src="${baseUrl}/storage/${images[index]}"/>
                                    <span>${names[index]}</span>
                                    <button class="mt-1 bg-red-500 p-1 rounded-md text-white ${btnShow}" href="#">Consult now</button>
                                    </div>`)

                        var marker = L.marker(coords[index]).addTo(map).bindPopup(pop);

                        //labels
                        let content = '';
                        

                        if (startPointNotEmpty) {
                            // console.log('yes')
                            content += `
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-blue-500">My location</span>
                            </div>`
                        } else {
                            content += `
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-red-500">${names[index]}</span><span class="text-red-500 text-[10px]">Distance: ${distances[index].toFixed(2)} meters</span>
                            </div>`
                        }
                        var toollip = L.tooltip({
                            permanent: true
                        }).setContent(content);

                        marker.bindTooltip(toollip);

                        //zoom in / fly to when hovering the clinic
                        clinicElements[index].addEventListener("click", () => {
                            map.flyTo(coords[index], 19)
                        })
                    }
                }


            })
        </script>
    @endsection
</x-app-layout>
