@php

$title = isset($title) && $title ? $title : config('app.name', 'Laravel');
$description = isset($description) && $description ? $description : config('app.description', 'Learn how our understanding of facts have evolved from what we learned in school to what we know now.');
$publishedDate = $publishedDate ?? null;
$tags = $tags ?? [];
$schema = [
    '@context' => "https://schema.org",
    '@type' => 'Article',
    'headline' => $title,
    'description' => $description,
    'url' => request()->url(),
    'author' => [
        '@type' => 'Organization',
        'name' => 'Crumbls'
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Crumbls',
        'url' => 'https://crumbls.com'
    ]
];

@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @stack('head')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ request()->url() }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HDV2BJM4NT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-HDV2BJM4NT');
    </script>


    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
        @json($schema)
    </script>


    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ request()->url() }}">
    @if($publishedDate)
        <meta property="article:published_time" content="{{ $publishedDate }}">
    @endif
    @if($tags)
        @foreach($tags as $tag)
            <meta property="article:tag" content="{{ $tag->name }}">
        @endforeach
    @endif

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @filamentStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="fixed w-full z-50 transition-all duration-300 bg-white md:top-0 shadow-lg" x-data="{ isOpen: false, isScrolled: false }" @scroll.window="isScrolled = (window.pageYOffset &gt; 1)" :class="{ 'bg-white': true, 'shadow-lg': isScrolled }">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <a href="https://www.crumbls.com" class="text-2xl font-bold text-[#ea384c]">Crumbls</a>
                    </div>

                    <div class="hidden md:flex items-center space-x-8">



                        <a href="{{ url('/') }}" class=" hover:text-[#ea384c] transition-colors hover:text-underline
                    text-gray-700
                    ">Facts</a>
                        <a href="{{ url('timeline') }}" class=" hover:text-[#ea384c] transition-colors hover:text-underline
                    text-gray-700
                    ">Timeline</a>

                        <a href="https://www.crumbls.com/contact" class=" hover:text-[#ea384c] transition-colors hover:text-underline
                    text-gray-700
                    ">
                            Contact Us
                        </a>
                    </div>

                    <button @click="isOpen = !isOpen" class="md:hidden text-gray-700">
                        <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div x-show="isOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="md:hidden bg-white" style="display: none;">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <a href="https://www.crumbls.com/services" class="block px-3 py-2 hover:text-[#ea384c] transition-colors text-center
                    text-[#ea384c]
                    ">Services
                        </a>
                        <a href="https://www.crumbls.com/about" class="block px-3 py-2 hover:text-[#ea384c] transition-colors text-center
                    text-gray-700
                    ">
                            About Us
                        </a>


                        <a href="https://www.crumbls.com/contact" class="block px-3 py-2 hover:text-[#ea384c] transition-colors text-center
                    text-gray-700
                    ">
                            Contact Us
                        </a>
                        <a href="https://helpdesk.crumbls.com" class="block px-3 py-2 transition-colors text-center
                       px-6 py-3 rounded-lg font-medium bg-[#ea384c] text-white hover:bg-[#d32d3f] transition-all duration-300
                    ">
                            Help Desk
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>


        <div class="text-center pb-8">
            <p class="text-sm text-muted-foreground">
                Science is always evolving. These facts represent our current understanding
                and may continue to be refined as we learn more.
            </p>
        </div>
    </div>

    @stack('scripts')
    @filamentScripts
</body>
</html>
