<x-cliente-layout>
    <div
            class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
            <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6 relative">
                <a href="{{ route('cliente.dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-3 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500 float-right" viewBox="0 0 320.591 320.591">
                        <path
                            d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                            data-original="#000000"></path>
                        <path
                            d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                            data-original="#000000"></path>
                    </svg>
                </a>

                <div class="my-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                    </svg>                      
                    <h4 class="text-gray-800 text-lg font-semibold mt-4">¿Estas seguro de convertir tu cuenta a una de proveedor de servicios?</h4>
                    <p class="text-md text-gray-800 mt-4">Como proveedor, puedes ofrecer tus servicios y llegar a mas personas.</p>
                    <p class="text-sm text-red-600 mt-4">¡Atencion! Al aceptar ser un proveedor de servicios, será necesario que subas un documento para comprobar tu identidad y direccion.</p>
                </div>

                <div class="flex flex-col space-y-2">
                    <button type="button"
                        class="px-4 py-2 rounded-lg text-white text-sm tracking-wide bg-blue-500 hover:bg-blue-600 active:bg-blue-500"><a href="{{ route('cliente.convertirAProveedor') }}">Quiero ser proveedor de servicios</a></button>
                    <button type="button"
                        class="px-4 py-2 rounded-lg text-gray-800 text-sm tracking-wide bg-red-200 hover:bg-red-300 active:bg-red-200"><a href="{{ route('cliente.dashboard') }}">Quiero seguir siendo cliente</a></button>
                </div>
            </div>
        </div>
</x-cliente-layout>