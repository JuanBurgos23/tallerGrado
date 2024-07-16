require('./bootstrap');

// Escuchar eventos de notificación
window.Echo.channel('notifications')
    .listen('NewNotification', (notification) => {
        console.log('Nueva notificación recibida:', notification);

        // Verificar permiso de notificación
        if (Notification.permission === 'granted') {
            // Mostrar la notificación
            new Notification('Nueva Denuncia', {
                body: `Se ha registrado una nueva denuncia con el ID: ${notification.denuncia.id}`,
                icon: '/path/to/icon.png'  // Ruta al ícono de la notificación
            });

            // Puedes añadir eventos de clic o cerrado a la notificación si lo deseas
            newNotification.onclick = function(event) {
                event.preventDefault();
                window.open(`/denuncias/${notification.denuncia.id}`, '_blank');
            };

            newNotification.onclose = function() {
                console.log('Notificación cerrada');
            };
        } else if (Notification.permission !== 'denied') {
            // Si no se ha denegado el permiso, solicitar permiso al usuario
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    // Permiso concedido, mostrar notificación
                    new Notification('Nueva Denuncia', {
                        body: `Se ha registrado una nueva denuncia con el ID: ${notification.denuncia.id}`,
                        icon: '/public/assets/img/felcc.jpg'
                    });
                }
            });
        }
    });

// Solicitar permiso para mostrar notificaciones push
if (Notification.permission !== 'granted') {
    Notification.requestPermission().then(permission => {
        if (permission === 'granted') {
            console.log('Permiso para notificaciones concedido.');
        } else {
            console.log('Permiso para notificaciones denegado.');
        }
    });
}
