<div id="clinicContainer" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50" data-id="clinic">
    <div class="bg-white p-8 rounded shadow-md max-h-[600px] overflow-auto">
        {{-- <span id="closePopupBtn" class="absolute top-0 right-0 mt-4 mr-4 text-gray-700 cursor-pointer">&times;</span> --}}
        <h2 class="text-2xl font-bold mb-4 capitalize text-center">Setup your clinic information</h2>
        <p class="text-gray-700 mb-4">To enhance your experience, please enable location sharing.</p>
        <p class="text-gray-700 mb-4">Please click on the map based on your clinic location.</p>
        <div class="border">
          
            <div class="border">
                <div id="map" style="height: 300px;"></div>
            </div>

            <form action="{{ route('admin.setup') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="hidden">
                    <input type="text" name="lat" id="lat">
                    <input type="text" name="long" id="long">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 items-center">
                    <div class="p-2">
                        <div class="mb-2 flex flex-col">
                            <label for="profile">Clinic Profile</label>
                            <input type="file" name="profile" class="rounded-md border"/>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="mb-2 flex flex-col">
                            <label for="name">Clinic Name</label>
                            <input type="text" name="name" class="rounded-md border"/>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="mb-2 flex flex-col">
                            <label for="open">Opening hour's</label>
                            <input type="time" name="open" class="rounded-md border"/>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="mb-2 flex flex-col">
                            <label for="closed">Closing hour's</label>
                            <input type="time" name="closed" class="rounded-md border"/>
                        </div>
                    </div>
                    
                    <div class="p-2 col-span-2">
                        <div class="flex flex-col">
                            
                            <h3 class="font-semibold text-gray-900 dark:text-white">Week Days</h3>
                            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <li class="w-full dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="monday" name="days[]" type="checkbox" value="monday" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="monday" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Monday</label>
                                    </div>
                                </li>
                                <li class="w-full dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="tuesday" name="days[]" type="checkbox" value="tuesday" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="tuesday" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tuesday</label>
                                    </div>
                                </li>
                                <li class="w-full dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="wednesday" name="days[]" type="checkbox" value="wednesday" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="wednesday" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Wednesday</label>
                                    </div>
                                </li>
                                <li class="w-full dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="thursday" name="days[]" type="checkbox" value="thursday" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="thursday" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Thursday</label>
                                    </div>
                                </li>
                                <li class="w-full dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="friday" name="days[]" type="checkbox" value="friday" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="friday" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Friday</label>
                                    </div>
                                </li>
                                <li class="w-full dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="saturday" name="days[]" type="checkbox" value="saturday" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="saturday" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Saturday</label>
                                    </div>
                                </li>
                                <li class="w-full dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="sunday" name="days[]" type="checkbox" value="sunday" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="sunday" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sunday</label>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <div class="p-2 col-span-2">
                        <div class="mb-2 flex flex-col">
                            <input type="submit" class="rounded-md p-2 bg-red-500 hover:bg-red-700 hover:cursor-pointer text-white" value="Setup Complete"/>
                        </div>
                    </div>
                </div>
            </form>
            {{-- <button type="button" id="locationBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Enable Location Sharing</button> --}}
        </div>
        
        <p class="text-sm mt-2">Your location will only be used to provide relevant services and will not be shared with third parties.</p>
    </div>
</div>
