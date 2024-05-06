<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>'Clinic'])
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-wrap">
                    <div class=""><span class="text-red-700 font-bold">A</span>vailable  <span class="ml-1"><span class="text-red-700 font-bold">C</span>linic's</span>.</div>
                    
                </div>

                {{-- record table here --}}
                <div class="grid grid-cols-1 gap-2 md:grid-cols-2 pl-6">
                    
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-2">
                        
                        @for ($i=1; $i <= 5; $i++)

                            @if ($i === 5)
                                <div class="clinic shadow p-2 w-20 h-20 flex flex-col items-center rounded-md hover:cursor-pointer hover:opacity-50">
                                    <img src="{{ asset('storage').'/'.Auth::user()->profile }}" alt="" class="w-10 h-10">
                                    <span>Me</span>
                                </div>
                            @else
                            <div class="clinic shadow p-2 w-20 h-20 flex flex-col items-center rounded-md hover:cursor-pointer hover:opacity-50">
                                <img src="{{ asset('storage').'/'.Auth::user()->profile }}" alt="" class="w-10 h-10">
                                <span>Clinic {{ $i }}</span>
                            </div>
                            @endif
                            
                        @endfor
                       
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

                console.log('connected')
                let clinicElements = []
                //get the render clinic elements
                $('.clinic').each(function(index, element) {
                    clinicElements.push(element)
                });
                
                clinicElements.push($('.me'))

                const map = L.map('map').setView([14.56422,120.59657], 17);

                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);
                
                coords = [[14.56103,120.59476], [14.56123,120.59390], [14.56181,120.59487], [14.56335,120.59380], [14.56422,120.59657]]
                const startPoint = L.latLng(coords[coords.length - 1]); // Last coordinate as starting point
                // let totalDistance = 0;
                let distances = [];
                for (let index = 0; index < coords.length; index++) {//minus 1 because it is my location test for starting point
                    const currentPoint = L.latLng(coords[index]);
                    const distance = startPoint.distanceTo(currentPoint);
                    distances.push(distance)
                    // console.log(`Distance between starting point and point ${index + 1}: ${distance} meters`);
                    // totalDistance += distance;
                }

                // console.log(`Distances array:`, distances);
                const baseUrl = window.location.origin;//extract the base url
                let images = ['profiles/4aK4MxODvjSdZTPQxav2DX2QYg2C4WJmlavtjK7n.png','profiles/4aK4MxODvjSdZTPQxav2DX2QYg2C4WJmlavtjK7n.png','profiles/4aK4MxODvjSdZTPQxav2DX2QYg2C4WJmlavtjK7n.png','profiles/4aK4MxODvjSdZTPQxav2DX2QYg2C4WJmlavtjK7n.png','profiles/4aK4MxODvjSdZTPQxav2DX2QYg2C4WJmlavtjK7n.png' ]
                let len = coords.length
                
                for (let index = 0; index < len; index++) {
                    // popups
                    var pop = L.popup({
                        closeOnClick : true
                    }).setContent(`<div class="flex flex-col"><img src="${baseUrl}/storage/${images[index]}"/>
                                    <span>DR.John Doe</span>
                                    <button class="mt-1 bg-red-500 p-1 rounded-md text-white" href="#">Consult now</button>
                                    </div>`)

                    var marker = L.marker(coords[index]).addTo(map).bindPopup(pop);

                    //labels
                    let content = '';
                    if (index+1 === 5) {
                        content += `
                            <div class="flex flex-col">
                                <span class="text-sm">My location</span>
                            </div>`
                    }else{
                        content += `
                            <div class="flex flex-col">
                                <span class="text-sm">Clinic ${index+1}</span><span class="text-red-500 text-[10px]">Distance: ${distances[index].toFixed(2)} meters</span>
                            </div>`
                    }
                    var toollip = L.tooltip({
                        permanent: true
                    }).setContent(content);

                    marker.bindTooltip(toollip);

                    //zoom in / fly to when hovering the clinic
                    clinicElements[index].addEventListener("click", ()=>{
                        map.flyTo(coords[index], 19)
                    })
                }
                
            })
        </script>
    @endsection
</x-app-layout>