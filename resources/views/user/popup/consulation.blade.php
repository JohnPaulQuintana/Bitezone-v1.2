<div id="consultationContainer" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-99999 hidden">
    <div class="bg-white p-8 rounded shadow-md">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold mb-4"><span class="text-red-700">V</span>accine <span class="text-red-700">C</span>onsultation</h2>
            <i id="consultationClose" class="fa-sharp fa-solid fa-square-xmark text-2xl font-bold mb-4 text-red-700 hover:text-red-800 hover:cursor-pointer"></i>
        </div>
        
        <p class="text-gray-700 mb-4">To enhance your vaccine consultation experience, please enable location sharing.</p>
        <div>
            
            <form class="max-w-full mx-auto">
                <span class="font-bold"><span class="text-[20px]">B</span>asic <span class="text-[20px]">I</span>nformation</span>
                <div class="border border-slate-100 shadow p-2 grid grid-cols-1 md:grid-cols-2 gap-2 mb-4">
                    <div class="hidden">
                        <input type="number" id="user_id" value="">
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fa-solid fa-user w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <input type="text" value="{{ Auth::user()->firstname }} {{ Auth::user()->middlename }} {{ Auth::user()->lastname }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fa-solid fa-phone w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <input type="text" value="{{ Auth::user()->contact_no }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                        </div>
                    </div>
                </div>

                <span class="font-bold"><span class="text-[20px]">C</span>onsultation <span class="text-[20px]">I</span>nformation</span>
                <div class="border border-slate-100 shadow p-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div class="col-span-2">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                        
                    </div>
                    
                </div>
            </form>
  
            <button type="button" id="locationBtn" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">Send Consultation</button>
        </div>
        <p class="text-sm mt-2">Your location will only be used for vaccine consultation purposes and will not be shared with third parties.</p>
    </div>
</div>
