<div class="grid lg:grid-cols-3 gap-4 mt-4">
    <div>
        <button wire:click="confirmCrearDireccion" wire:loading.attr="disabled"
            class="p-2 bg-gray-50 rounded-lg border-2 hover:border-green-500 h-full w-full place-content-center "
            type="button">
            <x-icons.add class="hover:text-green-500 w-52 h-52 mx-auto" />
            <p>Nueva dirección</p>
        </button>
    </div>
    @foreach ($direcciones as $direccion)
        <div class="grid gap-2 p-4 px-4 w-full bg-gray-50 rounded-xl shadow-md border-2 hover:border-blue-500">
            <div>
                Calle:
                <span>{{ $direccion->calle }}</span>
            </div>
            <div>
                Numero exterior:
                <span>{{ $direccion->num_exterior }}</span>
            </div>
            <div>
                Numero interior:
                <span>{{ $direccion->num_interior }}</span>
            </div>
            <div>
                Colonia:
                <span>{{ $direccion->colonia }}</span>
            </div>
            <div>
                Municipio:
                <span>{{ $direccion->municipio }}</span>
            </div>
            <div>
                Estado:
                <span>{{ $direccion->estado }}</span>
            </div>
            <div>
                Codigo postal:
                <span>{{ $direccion->codigo_postal }}</span>
            </div>
            <div>
                Referencias:
                <span>{{ $direccion->referencias }}</span>
            </div>
            <div class="grid grid-cols-2 gap-2 text-center mt-2">
                <x-button wire:click="confirmUpdateDireccion({{ $direccion->id }})"
                    wire:loading.attr="disabled">Editar</x-button>
                <x-danger-button wire:click="confirmDeleteDireccion({{ $direccion->id }})"
                    wire:loading.attr="disabled">Eliminar</x-danger-button>
            </div>

        </div>
    @endforeach

    <x-dialog-modal wire:model.live="confirmingDeleteDireccion">
        <x-slot name="title">
            Eliminar Dirección
        </x-slot>
        <x-slot name="content">
            <p>Estas seguro de eliminar la dirección:</p>
            {{ isset($direccion_current) ? $direccion_current->calle . ' ' . $direccion_current->num_externo . ', ' . $direccion_current->colonia . ', ' . $direccion_current->municipio . ', ' . $direccion_current->estado . ', ' . $direccion_current->codigo_postal : '' }}
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingDeleteDireccion')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteDireccion" wire:loading.attr="disabled">
                Eliminar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="confirmingCrearDireccion">
        <x-slot name="title">
            Crear Dirección
        </x-slot>
        <x-slot name="content">
            <form wire:submit="saveDireccion">
                @csrf
                {{-- Codigo postal --}}
                <div>
                    <x-label for="codigo_postal" value="Codigo Postal" />
                    <x-input id="codigo_postal" type="text" wire:model.live="state.codigo_postal" class="mt-1 block w-full" required/>
                    <x-input-error for="codigo_postal" class="mt-2" />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="inputColonia">Colonia</label>
                    <select id="inputColonia" name="" wire:model="state.colonia"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="" selected>Selecciona su colonia..</option>
                    </select>
                </div>
                <div>
                    <x-label for="estado" value="Estado" />
                    <x-input id="estado" type="text" class="mt-1 block w-full" wire:model.live="state.estado" required/>
                    <x-input-error for="estado" class="mt-2" />
                </div>
                <div>
                    <x-label for="municipio" value="Municipio" />
                    <x-input id="municipio" type="text" class="mt-1 block w-full" wire:model="state.municipio" required/>
                    <x-input-error for="municipio" class="mt-2" />
                </div>
                <div>
                    <x-label for="calle" value="Calle" />
                    <x-input id="calle" type="text" class="mt-1 block w-full" wire:model="state.calle" required/>
                    <x-input-error for="calle" class="mt-2" />
                </div>
                <div>
                    <x-label for="num_exterior" value="Numero exterior" />
                    <x-input id="num_exterior" type="text" class="mt-1 block w-full" wire:model="state.num_exterior" required/>
                    <x-input-error for="num_exterior" class="mt-2" />
                </div>
                <div>
                    <x-label for="num_interior" value="Numero interior" />
                    <x-input id="num_interior" type="text" class="mt-1 block w-full" wire:model="state.num_interior"/>
                    <x-input-error for="num_interior" class="mt-2" />
                </div>
                <div>
                    <x-label for="entre_calle1" value="Entre calle" />
                    <x-input id="entre_calle1" type="text" class="mt-1 block w-full" wire:model="state.entre_calle1"/>
                    <x-input-error for="entre_calle1" class="mt-2" />
                </div>
                <div>
                    <x-label for="entre_calle2" value="Entre calle" />
                    <x-input id="entre_calle2" type="text" class="mt-1 block w-full" wire:model="state.entre_calle2"/>
                    <x-input-error for="entre_calle2" class="mt-2" />
                </div>
                <div>
                    <x-label for="referencias" value="Referencias" />
                    <x-input id="referencias" type="text" class="mt-1 block w-full" wire:model="state.referencias" required/>
                    <x-input-error for="referencias" class="mt-2" />
                </div>
                <div>
                    <x-label for="latitud" value="Latitud" />
                    <x-input id="latitud" type="text" class="mt-1 block w-full" wire:model="state.latitud"/>
                    <x-input-error for="latitud" class="mt-2" />
                </div>
                <div>
                    <x-label for="longitud" value="Longitud" />
                    <x-input id="longitud" type="text" class="mt-1 block w-full" wire:model="state.longitud"/>
                    <x-input-error for="longitud" class="mt-2" />
                </div>
                <x-button type="submit" class="my-4">Guardar</x-button>
                <script>
                    let cp = document.getElementById('codigo_postal')
                    let colonia = document.getElementById('inputColonia')
                    let URL_API = 'https://data.opendatasoft.com/api/records/1.0/search/?dataset=geonames-postal-code%40public&q=MX+';

                    cp.oninput = function() {
                        fetch(URL_API + cp.value)
                            .then(response => response.json())
                            .then(data => {
                                let element = document.getElementById('inputColonia');
                                element.innerHTML = "";
                                for (var i = 0; i < data.nhits; i++) {
                                    element.innerHTML +=
                                        `<option value="${data.records[i].fields.place_name}">${data.records[i].fields.place_name}</option>`
                                }
                            });
                    };

                    colonia.addEventListener('click', (event) => {
                        fetch(URL_API + cp.value)
                            .then(response => response.json())
                            .then(data => {
                                for (var i = 0; i < data.nhits; i++) {
                                    if (data.records[i].fields.place_name == colonia.value) {
                                        document.getElementById('estado').value = data.records[i].fields.admin_name1;
                                        document.getElementById('municipio').value = data.records[i].fields.admin_name2;
                                        document.getElementById('latitud').value = data.records[i].fields.latitude;
                                        document.getElementById('longitud').value = data.records[i].fields.longitude;
                                    }
                                }
                                console.log(data)
                            })
                    })
                </script>
            </form>
        </x-slot>
        <x-slot name="footer">
        </x-slot>
    </x-dialog-modal>
</div>
