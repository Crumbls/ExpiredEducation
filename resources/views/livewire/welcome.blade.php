<main class="min-h-screen bg-background">
    <div class="container mx-auto px-4 py-8 md:py-16">

        <section class="min-h-screen flex items-center justify-center relative overflow-hidden pt-16 text-center">
            <div>
            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight mb-6 block">
                Facts That Changed
            </h1>
            <p class="text-lg text-gray-600 mt-4 max-w-3xl mx-auto">
                Discover what science has learned since you were in school
            </p>


            <div class="mt-4">
                <form wire:submit="submit">
                    {{ $this->form }}

                    <button type="submit" class="mt-4 px-6 py-3 rounded-lg font-medium bg-[#ea384c] text-white hover:bg-[#d32d3f] transition-all duration-300">
                        Find out what changed
                    </button>
                </form>

                <x-filament-actions::modals />
            </div>

                <div class="text-center text-sm text-muted-foreground mt-4">
                    <p>
                        We'll show you scientific discoveries and corrections made after your school years
                    </p>
                </div>
            </div>
        </section>
    </div>
</main>
