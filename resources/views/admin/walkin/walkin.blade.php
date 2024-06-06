<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>"Examination"])
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 h-full shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-red-700 font-bold">U</span>nder  <span class="ml-1"><span class="text-red-700 font-bold">E</span>xamination.</span>
                        </div>
                        {{-- <button type="button" id="consultationBtn" class="bg-red-500 p-1 text-white rounded-md hover:bg-red-700"><i class="fa-regular fa-calendar-plus"></i> Consultation</button> --}}
                    </div>
                    {{-- record table here --}}
                    
                    <div class="overflow-auto shadow-md sm:rounded-lg px-2">
                       
                        
                        {{-- data here --}}
                        {{-- {{ $examination }} --}}
                        <div class="shadow py-2">
                            <div class="uppercase font-bold text-blue-900">
                                <h1>animal Bite treatment consultation form</h1>
                            </div>
                            <div class="">
                                @include('admin.stepper.examination-walkin')
                                
                            </div>
                        </div>
                    </div>

                    {{-- @include('admin.popup.error') --}}
                    {{-- @if (empty($location))
                        <div id="locationSetupPopup">
                            @include('user.popup.location-setup')
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
    {{-- @include('user.popup.consulation') --}}
    @section('scripts')
        <script>
            $(document).ready(function() {

                 // Scroll to the first input field with an error
                $('input.error, select.error, checkbox.error').first().focus();
                // Optionally, you can also scroll to the top of the page
                // window.scrollTo(0, 0);

                $('#typeSelect').change(function() {
                    var selectedType = $(this).find('option:selected').data('type');
                    switch (selectedType) {
                        case 'booster':
                            $('#daySelect option').hide();
                            $('#daySelect option[data-type="default"]').show(); // Show the default option
                            break;
                        case 'post':
                            $('#daySelect option').each(function() {
                                var optionType = $(this).data('type');
                                if(optionType==='pre'){
                                    $(this).hide(); 
                                }else{
                                    $(this).show(); 
                                } 
                            });
                            break;
                        case 'pre':
                            $('#daySelect option').each(function() {
                                var optionType = $(this).data('type');
                                if(optionType==='post'){
                                    $(this).hide(); 
                                }else{
                                    $(this).show(); 
                                }  
                            });
                            break;
                    
                        default:
                            $('#daySelect option').show();
                            break;
                    }
                    
                    $('#daySelect').val('');
                });
                
            })
        </script>
    @endsection
</x-app-layout>