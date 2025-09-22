<x-app-layout>
<main class="min-h-screen bg-background">
    <div class="container mx-auto px-4 py-8 md:py-16">

        <section class="flex items-center justify-center relative overflow-hidden py-16 text-center">
            <div>
                <h1 class="text-4xl sm:text-5xl font-bold tracking-tight mb-6 block">
                    Facts That Changed Since You Were in School
                </h1>
                <ol class="text-lg text-gray-600 mt-4 max-w-3xl mx-auto">
                    <li>
                        Graduated in {{ $year }}
                    </li>
                    <li>
                    {{ number_format($records->count(), 0) }} major discoveries since your graduation
                    </li>
                </ol>

                <div class="pt-10">

                        <a href="{{ url('') }}" class="mt-4 px-6 py-3 rounded-lg font-medium bg-[#ea384c] text-white hover:bg-[#d32d3f] transition-all duration-300">
                            Try another year
                        </a>

                </div>
            </div>
        </section>

        @if($records->isEmpty())
            <div class="text-center py-12">
                <div class="space-y-4">
                    <div class="text-6xl">🎓</div>
                    <h2 class="text-2xl font-semibold text-foreground">
                        Lucky you!
                    </h2>
                    <p class="text-lg text-muted-foreground max-w-md mx-auto">
                        Most of our fact database covers discoveries from after 1970.
                        Try a more recent birth year to see what's changed in science and knowledge!
                    </p>
                </div>
            </div>
        @else
        <section class="grid gap-6 md:grid-cols-1  {{ $records->count() > 1 ? 'lg:grid-cols-2' : '' }}">
            @foreach($records as $record)
                <article class="
space-y-4
bg-white p-4                rounded-lg border bg-card text-card-foreground shadow-sm fact-card bg-gradient-to-br from-fact-card to-secondary/20 border-gray-600 shadow-[var(--shadow-card)] hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <header class="space-y-4">
                    <div class="flex items-center justify-between">
                    @if($record->tags->count())

                        <ul class="flex space-x-2">
                    @foreach($record->tags as $tag)
                        <li>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                {{ $tag->name }}
                            </span>
                        </li>
                    @endforeach
                        </ul>
                    @endif
                        <div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                {{ $record->ended_at?->format($record->ended_at_format ?? 'Y') }}
                            </span>
                        </div>
                    </div>
    <h3 class="text-xl font-bold text-foreground leading-tight">
        {{ $record->title }}
    </h3>
</header>
                    <div class="space-y-4">
                        <div class="space-y-3">
                            @if($record->content_old)
                            <div class="p-3  border-l-4 border-[#ea384c] bg-[#ea384c]/10 text-[#ea384c]  rounded-r">
                                <p class="text-sm font-medium text-red-800 mb-1">What you learned in school:</p>
                                <div class="text-red-700">
                                    {{ $record->content_old }}
                                </div>
                            </div>

                            <div class="p-3 bg-green-50 border-l-4 border-green-400 rounded-r">
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

                </article>
            @endforeach
        </section>
        @endif

        <div class="text-center pt-8">
            <p class="text-sm text-muted-foreground">
                Science is always evolving. These facts represent our current understanding
                and may continue to be refined as we learn more.
            </p>
        </div>
    </div>
</main>
</x-app-layout>
