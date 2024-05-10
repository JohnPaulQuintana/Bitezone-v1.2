<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-center justify-between mb-2">
            <button class="text-sm p-1 bg-red-500 text-white hover:bg-red-700 hover:cursor-pointer rounded-sm" id="printBtn" type="button" onclick="PrintDiv()">
                <i class="fa-sharp fa-solid fa-print pr-1"></i>
                Print Document
            </button>
            @include('partials.breadcrum', ['section'=>"Open Record"])
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 h-full shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- record table here --}}
                    
                    <div class="overflow-auto shadow-md sm:rounded-lg px-2">
                       
                        {{-- actual display --}}
                        @include('user.template.display', ['treatment'=>$treatment])
                        
                        {{-- for printing --}}
                        {{-- {{ $examination }} --}}
                        @include('user.template.print', ['treatment'=>$treatment])
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
    {{-- @include('user.popup.consulation') --}}
    @section('scripts')
        <script>
            $(document).ready(function() {
                let sessionStatus = @json(session('status'));
                let sessionMessage = @json(session('message'));
                let sessionTitle = @json(session('title'));
               
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

                const popups = (t,m,s) => {
                    Swal.fire({
                        title: t,
                        text: m,
                        icon: s
                    });
                }

                if(sessionTitle,sessionMessage !== null && sessionStatus !== null){
                    popups(sessionTitle,sessionMessage, sessionStatus);
                }

                
                
            })
            const PrintDiv = ()=> {
                    var contents = document.getElementById("contents").innerHTML;
                    var frame1 = document.createElement('iframe');
                    frame1.name = "frame1";
                    frame1.style.position = "absolute";
                    frame1.style.top = "-1000000px";
                    document.body.appendChild(frame1);
                    var frameDoc = (frame1.contentWindow) ? frame1.contentWindow : (frame1.contentDocument.document) ? frame1.contentDocument.document : frame1.contentDocument;
                    frameDoc.document.open();
                    frameDoc.document.write(`<html><head><title>DIV Contents</title>`);
                        // Copy stylesheets from main document to iframe
                        var styles = document.querySelectorAll('link[rel="stylesheet"]');
                        styles.forEach(function(style) {
                            frameDoc.document.write(style.outerHTML);
                        });
                    frameDoc.document.write('</head><body>');
                    frameDoc.document.write(contents);
                    frameDoc.document.write('</body></html>');
                    frameDoc.document.close();
                    setTimeout(function () {
                        window.frames["frame1"].focus();
                        window.frames["frame1"].print();
                        document.body.removeChild(frame1);
                    }, 500);
                    return false;
                }
        </script>
    @endsection
</x-app-layout>