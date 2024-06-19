<x-guest-layout>

    <div class="py-6 mx-auto max-w-7xl px-2">
        <h2 class="text-2xl font-bold mt-4">Proveedores de servicio</h2>
        @livewire('components.carousel-proveedores')

        <h2 class="text-2xl font-bold mt-4">Categorias</h2>
        <div id="indicators-carousel" class="relative w-full" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="hidden md:block relative h-56 overflow-hidden rounded-lg md:h-96">
                @for ($i = 0; $i < count($categorias) / 4; $i = $i + 4)
                    <div class="grid grid-cols-4 px-16 p-4 gap-2" data-carousel-item>
                        @for ($j = 0; $j < 4; $j++)
                            <x-cards.categoria :categoria="$categorias[$i + $j]" />
                        @endfor
                    </div>
                @endfor
            </div>
            <div class="block md:hidden relative h-56 overflow-hidden rounded-lg md:h-96">
                @for ($i = 0; $i < count($categorias); $i++)
                    <div class="px-16 p-4" data-carousel-item>
                        <x-cards.categoria :categoria="$categorias[$i]" />
                    </div>
                @endfor
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>

        <h2 class="text-2xl font-bold">Servicios</h2>
        <x-carousel.servicios :servicios="$servicios" />
    </div>
</x-guest-layout>
