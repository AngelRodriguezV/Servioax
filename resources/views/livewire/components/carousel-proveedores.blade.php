<div id="indicators-carousel" class="relative w-full" data-carousel="static">
    <!-- Carousel wrapper -->
    <div class="relative h-[600px] overflow-hidden rounded-lg">
        @for ($i = 0; $i < round(count($proveedores) / 4); $i = $i + 4)
            <div class="grid grid-cols-4 px-16 p-4 gap-2" data-carousel-item>
                @for ($j = 0; $j < 4; $j++)
                    @if (($i+$j)<count($proveedores))
                        <x-cards.proveedor :proveedor="$proveedores[$i + $j]" />
                    @endif
                @endfor
            </div>
        @endfor
    </div>
    <!-- Slider controls -->
    <button type="button"
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-400 group-hover:bg-gray-500 group-focus:outline-none">
            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
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
            class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-400 group-hover:bg-gray-500 group-focus:outline-none">
            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
