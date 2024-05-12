<div class="items-center justify-between pb-6">
    <div class="flex items-center justify-between">
        <div class="flex bg-gray-50 items-center p-2 rounded-md">
            <x-search wire:model.live="search" />            
      </div>
        
    </div>
    <div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Descripcion
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Slug
                            </th>
                            <th colspan="2"
                                class="text-center px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            @if($categoria->image)
                                                <img class="w-full h-full rounded-full" src="{{ Storage::url($categoria->image->url) }}" alt="{{ $categoria->slug }}" />
                                            @else
                                                <img class="w-full h-full rounded-full" src="https://as1.ftcdn.net/v2/jpg/00/95/83/46/1000_F_95834632_CL4kevuB3WZLoX72MB52KTLJqx4qhvQj.jpg" />
                                            @endif
                                        </div>
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{$categoria->nombre}}
                                                </p>
                                            </div>
                                        </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{$categoria->descripcion}}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$categoria->slug}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <span class="rounded-md bg-black px-4 py-2 text-white mt-4"><a href="{{ route('admin.editarCategoria', $categoria->id) }}">Editar</a></span>
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <!--<span class="rounded-md bg-black px-4 py-2 text-white mt-4"><a href="{{ route('admin.editarCategoria', $categoria->id) }}">Habilitar</a></span>-->
                                        <form method="POST" action="{{ route('admin.cambiarEstadoCategoria', $categoria->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="rounded-md bg-black px-4 py-2 text-white mt-0">
                                                {{ $categoria->estado ? 'Deshabilitar' : 'Habilitar' }}
                                            </button>
                                        </form>
                                    </p>
                                </td>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
