<div class="text-center">
    <button id="viewModalbtn" type="button" class="py-3 hidden px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-view">
      Open modal
    </button>
  </div>
  
  <div id="hs-view" class="hs-overlay hs-overlay-backdrop-open:bg-slate-950/50 hidden size-full fixed top-10 start-10 z-[1000000] overflow-x-hidden overflow-y-auto">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
      <div class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
        <div class="absolute top-2 end-2">
          <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700" data-hs-overlay="#hs-view">
            <span class="sr-only">Close</span>
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          </button>
        </div>
  
        <div class="p-4 sm:p-10 overflow-y-auto">
          <div class="mb-6 text-center">
            <h3 class="mb-2 text-xl font-bold text-green-500 dark:text-neutral-200">
              Verified of Clinic
            </h3>
            <p class="text-gray-500 dark:text-neutral-500">
              Verified this clinic information
            </p>
          </div>
  
          <div class="space-y-4">
            <!-- information -->
            <!-- Form -->
          
            <div class="gap-y-4 grid grid-cols-2 gap-2">
              <!-- Form Group -->
              <div class="flex flex-col items-center shadow">
                <img src="" id="v_profile" alt="" class="w-fit h-[200px]">
                <div class="text-center">
                  <h1 id="v_name" class="font-bold"></h1>
                  <h1 id="v_address" class="text-md"></h1>
                </div>
              </div>
              <!-- End Form Group -->
              <div class="flex flex-col items-center shadow">
                <img src="" id="v_certificate" alt="" class="w-fit h-[250px]">
                <span class="font-bold">Business Registration Certificate</span>
              </div>

              
            </div>
            <div class="flex mt-2 justify-end items-center gap-x-2 py-3 px-4 bg-gray-50 border-t dark:bg-neutral-950 dark:border-neutral-800">
                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-white dark:hover:bg-neutral-800" data-hs-overlay="#hs-view">
                  Cancel
                </button>
               
                
              </div>
          

            <!-- End information -->
          </div>
        </div>
  
        
      </div>
    </div>
  </div>