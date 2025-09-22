@php
    $pageTitle = $record->title . ' - Scientific Facts That Changed';
    $description = $record->content_old ?
        'Learn how our understanding of ' . strip_tags($record->title) . ' has evolved from what we learned in school to what we know now.' :
        'Discover the latest scientific understanding about ' . strip_tags($record->title) . '.';
    $publishedDate = $record->ended_at ? $record->ended_at->toISOString() : null;
    $keywords = array_merge(['scientific facts', 'education'], $record->tags->pluck('name')->toArray());
@endphp
<x-app-layout
    :title="$pageTitle"
    :description="$description"
    type="article"
    :keywords="$keywords"
    :tags="$record->tags"
    :publishedDate="$publishedDate">

        <main class="min-h-screen bg-background pt-20">
            <div class="container mx-auto px-4 py-8 md:py-16">

                    <header class="flex items-center justify-center relative overflow-hidden py-16 text-center">
                        <div>
                            @if($record->tags->count())
                                <div>
                                    @foreach($record->tags as $tag)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full mr-2 mb-2">
                                    {{ $tag->name }}
                                </span>
                                    @endforeach
                                </div>
                            @endif
                            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight my-6 block">
                                {{ $record->title }}
                            </h1>
                                @if($record->ended_at)
                                    <div class="flex items-center justify-center text-gray-600 mb-6">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <time datetime="{{ $record->ended_at->toISOString() }}">
                                            {{ $record->ended_at->format($record->ended_at_format ?? 'Y') }}
                                        </time>
                                    </div>
                                @endif
                        </div>
                </header>

                <!-- Main Content -->
                <article class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-4">
                            @if($record->content_old)
                                <!-- Before and After Comparison -->
                                <div class="space-y-8">
                                    <div class="border-l-4 border-[#ea384c] bg-[#ea384c]/5 p-6 rounded-r-lg">
                                        <div class="flex items-start">
                                            <div class="flex-1">
                                                <h2 class="text-xl font-bold text-[#ea384c] mb-3">What you learned in school</h2>
                                                <div class="text-gray-700 text-lg leading-relaxed">
                                                    {{ $record->content_old }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border-l-4 border-green-500 bg-green-50 p-6 rounded-r-lg">
                                        <div class="flex items-start">

                                            <div class="flex-1">
                                                <h2 class="text-xl font-bold text-green-800 mb-3">What we know now</h2>
                                                <div class="text-gray-700 text-lg leading-relaxed">
                                                    {{ $record->content_new }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Single Content Block -->
                                <div class="border-l-4 border-[#ea384c] bg-[#ea384c]/5 p-6 rounded-r-lg">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mr-4">
                                            <div class="w-10 h-10 bg-[#ea384c] rounded-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h2 class="text-xl font-bold text-[#ea384c] mb-3">What we know</h2>
                                            <div class="text-gray-700 text-lg leading-relaxed">
                                                {{ $record->content_new }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </article>

            </div>
        </main>
</x-app-layout>
