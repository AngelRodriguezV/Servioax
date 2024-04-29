<x-guest-layout>
    <h1 class="text-center">¡Estas a un paso de convertirte en un proveedor de servicios!</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <x-input type="file" 
                id="" 
                name=""/>
            <x-input-error for=""/>
        </div>
    </form>
</x-guest-layout>