<div id="popupContainer" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-8 rounded shadow-md">
        {{-- <span id="closePopupBtn" class="absolute top-0 right-0 mt-4 mr-4 text-gray-700 cursor-pointer">&times;</span> --}}
        <h2 class="text-2xl font-bold mb-4">Enable Location Sharing</h2>
        <p class="text-gray-700 mb-4">To enhance your experience, please enable location sharing.</p>
        <p class="text-gray-700 mb-4">Please click on the map based on your location.</p>
        <div>
          
            <div class="border">
                <div id="map" style="height: 600px;"></div>
            </div>

            <div class="hidden">
                <input type="text" name="lat" id="lat">
                <input type="text" name="long" id="long">
            </div>
            <button type="button" id="locationBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Enable Location Sharing</button>
        </div>
        
        <p class="text-sm mt-2">Your location will only be used to provide relevant services and will not be shared with third parties.</p>
    </div>
</div>
