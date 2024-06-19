<div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    window.livewire.emit('setGeolocation', {
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude
                    });
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });
    </script>

    @foreach ($servicios as $servicio)
        <div>
            {{$servicio->nombre}}
        </div>
    @endforeach
</div>
