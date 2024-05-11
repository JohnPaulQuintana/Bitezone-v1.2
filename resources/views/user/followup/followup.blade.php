<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-center justify-between mb-2">
            @include('partials.breadcrum', ['section' => 'Appointment Details'])
        </div>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 h-full shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {{ $followups }} --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-2 mb-4">
                        <div
                            class="flex flex-col col-span-3 font-bold text-sm md:text-xl bg-red-500 text-white text-center uppercase">
                            <label>Appointment Details</label>
                        </div>
                        @php
                            $i = 2;
                            function ordinal($number) {
                                $suffix = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
                                if (($number % 100) >= 11 && ($number % 100) <= 13) {
                                    return $number . 'th';
                                } else {
                                    return $number . $suffix[$number % 10];
                                }
                            }

                        @endphp
                        @foreach ($followups as $f)
                            <div
                                class="col-span-3 md:grid grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4 border-t-4 border-red-500 p-2">
                                <div class="flex flex-col">
                                    <label>Details</label>
                                    <div class="rounded-md border-0 py-2 bg-slate-100">{{ $f->consultation }}</div>
                                </div>
                                <div class="flex flex-col">
                                    <label>Status</label>
                                    <div class="rounded-md border-0 py-2 bg-slate-100">
                                        @switch($f->status)
                                            @case(0)
                                                <span class="text-red-500 bg-slate-100">{{ __('in-complete') }}</span>
                                            @break

                                            @case(1)
                                                <span class="text-green-500 ">{{ __('completed') }}</span>
                                            @break

                                            @default
                                        @endswitch
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <label>Created Date</label>
                                    <div class="rounded-md border-0 py-2 bg-slate-100">
                                        {{ \Carbon\Carbon::parse($f->created_at)->format('F d, Y') }}
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <label>Completed Date</label>
                                    <div class="rounded-md border-0 py-2 bg-slate-100">
                                        {{ \Carbon\Carbon::parse($f->updated_at)->format('F d, Y') }}
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <label>Vaccine Dosage</label>
                                    <div class="rounded-md border-0 py-2 bg-slate-100">
                                        1st dossage
                                    </div>
                                </div>
                            </div>

                            @foreach ($f->followup as $fs)

                                
                                <div class="col-span-3 md:grid grid-cols-2 md:grid-cols-5 lg:grid-cols-5 gap-2 mb-4 border-t-4 border-red-500 p-2">
                                    <div class="flex flex-col">
                                        <label>Details</label>
                                        <div class="rounded-md border-0 py-2 bg-slate-100">{{ $fs->details }}</div>
                                    </div>
                                    <div class="flex flex-col">
                                        <label>Status</label>
                                        <div class="rounded-md border-0 py-2 bg-slate-100">
                                            @switch($fs->status)
                                                @case(0)
                                                    <span class="text-red-500 bg-slate-100">{{ __('in-complete') }}</span>
                                                @break

                                                @case(1)
                                                    <span class="text-green-500 ">{{ __('completed') }}</span>
                                                @break

                                                @default
                                            @endswitch
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <label>Created Date</label>
                                        <div class="rounded-md border-0 py-2 bg-slate-100">
                                            {{ \Carbon\Carbon::parse($fs->created_at)->format('F d, Y') }}
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <label>Completed Date</label>
                                        @if ($fs->status !== 0)
                                            <div class="rounded-md border-0 py-2 bg-slate-100">
                                                {{ \Carbon\Carbon::parse($f->updated_at)->format('F d, Y') }}
                                            </div>
                                        @else
                                            <div class="rounded-md border-0 py-2 bg-slate-100">
                                                <span class="text-red-500 bg-slate-100">{{ __('in-complete') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <label>Vaccine Dosage</label>
                                        <div class="rounded-md border-0 py-2 bg-slate-100">
                                            {{ ordinal($i) }} dosage {{-- Display the dosage based on the index --}}
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $i++;
                                @endphp
                            @endforeach

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
