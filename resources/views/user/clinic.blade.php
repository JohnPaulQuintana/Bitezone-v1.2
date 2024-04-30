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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-wrap">
                    <span class="text-red-700 font-bold">A</span>vailable  <span class="ml-1"><span class="text-red-700 font-bold">C</span>linic's</span>.
                    {{-- record table here --}}
                    <div>

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

    @section('scripts')
        <script>
            $(document).ready(function() {

                console.log('connected')

                

                
            })
        </script>
    @endsection
</x-app-layout>