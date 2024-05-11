<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.jqueryui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.jqueryui.css">
    <style>
        /* select[name=rejected-table_length]:not([size]) {
            background-image: none;
        }

        select[name=accepted-table_length]:not([size]) {
            background-image: none;
        }

        select[name=department-table_length]:not([size]) {
            background-image: none;
        } */

        /* Hide the default scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #e46953;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #2b302e;
            cursor: pointer;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- font awesome --}}
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome"
        href="/css/app-wa-462d1fe84b879d730fe2180b0e0354e0.css?vsn=d">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
    @yield('links')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    @include('partials.loader')
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        @include('partials.sidebar')

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden main">
            <!-- ===== Header Start ===== -->
            @include('partials.header')
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                {{ $slot }}
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    @yield('scripts')
    <script>
        $(document).ready(function() {
            //get the notif
            sendRequest('GET', '/notification', {})
                .then(function(response) {
                    // Handle successful response
                    // console.log(response);
                    populateNotif(response.notification)

                })
                .catch(function(error) {
                    // Handle error
                    console.log(error)
                });
            // Check if either locationContainer or clinicContainer is visible
            if ($('#locationContainer, #clinicContainer').is(':visible')) {
                // Determine the type based on which container is visible
                let type = ($('#locationContainer').is(':visible')) ? $('#locationContainer').data('id') : $(
                    '#clinicContainer').data('id');

                // Popup is visible
                console.log('Location setup popup is visible');
                // Set up the map after obtaining location
                var map = L.map('map').setView([14.561321, 120.593321], 15);
                // set icon
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Add a marker for initial location
                var marker = L.marker([14.561321, 120.593321]).addTo(map)
                    .bindPopup('Default Location')
                    .openPopup();

                // Add a circle to represent initial location with a radius
                var circle = L.circle([14.561321, 120.593321], {
                    color: 'blue',
                    fillColor: 'blue',
                    fillOpacity: 0.2,
                    radius: 100 // You can set your desired radius here
                }).addTo(map);


                map.on('click', function(e) {
                    console.log(e)
                    // Remove existing marker and circle
                    map.removeLayer(marker);
                    map.removeLayer(circle);

                    // Get coordinates of clicked location
                    var clickedLat = e.latlng.lat;
                    var clickedLng = e.latlng.lng;
                    let address = ''
                    // Use Leaflet's Geocoding API to reverse geocode the coordinates
                    L.Control.Geocoder.nominatim().reverse(e.latlng, map.options.crs.scale(map.getZoom()),
                        function(results) {
                            if (results.length > 0) {
                                address = results[0].name;
                                console.log(address);
                                // Add marker and circle for clicked location
                                marker = L.marker([clickedLat, clickedLng]).addTo(map)
                                    .bindPopup(`${address}`)
                                    .openPopup();

                                circle = L.circle([clickedLat, clickedLng], {
                                    color: 'red',
                                    fillColor: 'red',
                                    fillOpacity: 0.2,
                                    radius: 100 // You can set your desired radius here
                                }).addTo(map);

                                $('#lat').val(clickedLat)
                                $('#addr').val(address)
                                $('#long').val(clickedLng)
                            } else {
                                alert("No address found at this location.");
                            }
                        });


                })



                $('#locationBtn').click(function() {
                    let sendAddress = $('#addr').val()
                    let sendLat = $('#lat').val()
                    let sendLong = $('#long').val()
                    let requestData = {
                        address: sendAddress,
                        lat: sendLat,
                        long: sendLong
                    }
                    sendRequest('POST', '/user/location', requestData)
                        .then(function(response) {
                            // Handle successful response
                            console.log(response);
                            sweetAlertSuccess(response.status, response.message)
                        })
                        .catch(function(error) {
                            // Handle error
                            Swal.fire({
                                icon: 'error',
                                title: "Default location can't be used as your location!",
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
                                }
                            });
                        });
                })
            } else {
                // Popup is not visible
                console.log('Location setup popup is not visible');
            }


            //poppulates notification
            const populateNotif = (n) => {
                console.log(n)
                var renderNotif = ''
                $('#notif_count').text(n.length)
                const assetUrl = "{{ asset('storage') }}";
                n.forEach(e => {
                    renderNotif += `
                            <li class="w-full">
                                <a class="flex shadow-xl flex-col gap-2.5 border-t border-stroke px-4.5 py-3 hover:bg-gray-2 dark:border-strokedark dark:hover:bg-meta-4"
                                    href="#">
                                    <div class="flex gap-1 items-center">
                                        <img src="${assetUrl}/${e.profile}" alt="" class="w-6 rounded-xl">
                                        <span class="text-sm">${e.name}</span>
                                        <span class="text-sm bg-red-500 text-white h-fit rounded-md px-1">Follow-up</span>
                                    </div>
                                    <p class="text-sm -mt-2 break-words">
                                        ${e.details}
                                    </p>

                                    <p class="text-xs -mt-1">${formatDate(e.created_at)}</p>
                                </a>
                            </li>
                    `
                });

                $('#notif-container').html(renderNotif)
            }

            function formatDate(dateString) {
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const [year, month, day] = dateString.split('-');
                return `${parseInt(day)} ${months[parseInt(month) - 1]}, ${year}`;
            }

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
                    title: "Location is now enabled!",
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
</body>

</html>
