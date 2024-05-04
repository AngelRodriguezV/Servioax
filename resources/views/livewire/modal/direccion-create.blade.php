<div id="direccion-create" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-opacity-65 bg-gray-400">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-2xl">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Agrega una dirección
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="direccion-create">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="#">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="inputCP">Codigo Postal</label>
                        <input type="text" name="codigo_postal" id="inputCP" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" maxlength="5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="inputColonia">Colonia</label>
                        <select id="inputColonia" name="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="" selected>Selecciona su colonia..</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="estado">Estado</label>
                        <input type="text" name="estado" id="inputEstado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="inputMunicipio">Municipio</label>
                        <input type="text" name="inputMunicipio" id="inputMunicipio" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="calle">Calle</label>
                        <input type="text" name="calle" id="calle" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="num_exterior">Numero exterior</label>
                        <input type="text" name="num_exterior" id="num_exterior" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="num_interior">Numero interior</label>
                        <input type="text" name="num_interior" id="num_interior" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="entre_calle1">Entre Calle</label>
                        <input type="text" name="entre_calle1" id="entre_calle1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="entre_calle2">Entre Calle</label>
                        <input type="text" name="entre_calle2" id="entre_calle2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <input type="number" name="coor_x" id="coor_x" hidden>
                    <input type="number" name="coor_y" id="coor_y" hidden>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>
    <script>
        let cp = document.getElementById('inputCP')
        let colonia = document.getElementById('inputColonia')
        let URL_API = 'https://data.opendatasoft.com/api/records/1.0/search/?dataset=geonames-postal-code%40public&q=';
        let pais = "MX";

        cp.addEventListener('keyup', (event) => {
            if (event.key === "Enter") {
                let code = event.target.value; //Recupera el codigo postal
                getdata(URL_API + pais + "+" + code);
            }
        })

        function getdata(URL) {
            fetch(URL)
                .then(response => response.json())
                .then(data => {
                    let element = document.getElementById('inputColonia')
                    element.innerHTML = "";
                    for (var i = 0; i < data.nhits; i++) {
                        element.innerHTML += `<option value="${data.records[i].fields.place_name}" selected>${data.records[i].fields.place_name}</option>`
                    }
                    console.log(data)
                })
        }

        colonia.addEventListener('click', (event) => {
            let cad = colonia.value.split(',')
            document.getElementById('inputEstado').value = cad[2];
            document.getElementById('inputMunicipio').value = cad[1];
            document.getElementById('coor_x').value = cad[3];
            document.getElementById('coor_y').value = cad[4];
            console.log(cad)
        })
    </script>
</div>
