<x-app-layout>

    <main class="min-h-screen bg-background pt-10">
        <div class="container mx-auto px-4 py-8 md:py-16">
<section>
    <ol
        class="relative space-y-8 before:absolute before:top-0 before:left-1/2 before:h-full before:w-0.5 before:-translate-x-1/2 before:rounded-full before:bg-gray-200"
    >
        @foreach($records as $record)
            <li class="group relative grid grid-cols-2 odd:-me-3 even:-ms-3">
                <div
                    class="relative flex items-start gap-4 group-odd:flex-row-reverse dis-group-odd:text-right group-even:order-last"
                >
                    <span class="size-3 shrink-0 rounded-full bg-blue-600"></span>

                    <div class="-mt-2">
                        <time class="text-xs/none font-medium text-gray-700 group-odd:text-right block">
                            {{ $record->ended_at?->format($record->ended_at_format ?? 'Y') }}
                        </time>

                        <h3 class="text-lg font-bold text-gray-900 group-odd:text-right">
                            {{ $record->title }}
                        </h3>

                        @if($record->content_old)
                            <div class="p-3  border-l-4 border-[#ea384c] bg-[#ea384c]/10 text-[#ea384c]  rounded-r">
                                <p class="text-sm font-medium text-red-800 mb-1">What you learned in school:</p>
                                <div class="text-red-700">
                                                                {{ $record->content_old }}
                        </div>
                            </div>

                        <div class="p-3 bg-green-50 border-l-4 border-green-400 rounded-r mt-4">
                            <p class="text-sm font-medium text-green-800 mb-1">What we know now:</p>
                            <div class="text-green-700">
                                {{ $record->content_new }}
                            </div>
                        </div>
                        @else
                            <div class="p-3  border-l-4 border-[#ea384c] bg-[#ea384c]/10 text-[#ea384c]  rounded-r">
                                <p class="text-sm font-medium text-red-800 mb-1">What we know:</p>
                                <div class="text-red-700">
                                    {{ $record->content_new }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div aria-hidden="true"></div>
            </li>
            @endforeach

    </ol>


</section>
        </div>
    </main>
</x-app-layout>
