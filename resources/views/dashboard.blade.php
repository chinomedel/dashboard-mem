<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight titulo">
            {{ __('Dashboard Mem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in Nelson!") }}
                    <div>
                        <span>ph: </span><h3 id="ph"></h3>
                        <span>ecMezcla: </span> <h3 id="ec"></h3>
                        <span>tempMezcla: </span><h3 id="temp"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script  type="text/javascript">
    
        //Conect options
        const options = {
        // Clean session
        clean: true,
        connectTimeout: 4000,
       
        // Authentication
        clientId: 'emqxapp',
        //username: 'emqx_test',
        //password: 'emqx_test',
        }
        const url = 'ws://iotmem.cl:8083/mqtt';
        const client  = mqtt.connect(url, options)
        const mqttTopics = ['test/ph', 'test/ec', 'test/temp'];
        var ultimoMensajePh = localStorage.getItem('ultimoMensajePh') || '';
        var ultimoMensajeEc = localStorage.getItem('ultimoMensajeEc') || '';
        var ultimoMensajeTemp = localStorage.getItem('ultimoMensajeTemp') || '';

        client.on('connect',()=>{
            console.log("Cliente MQTT conectado con éxito!!!")
    
            mqttTopics.forEach((topic) => {

                client.subscribe(topic,{qos: 0}, function (err) {
                    if (!err) {
                        console.log("Suscripcion exitosa a: ",topic)
        
                        
                    }else{
                        console.log("Suscripcion falló ",err)
                    }
                    
                })
            });
        })
        // Receive messages
        client.on('message', function (topic, message) {
            const mensaje = message

            switch(topic){
                case "test/ph":
                    console.log("Mensaje recibido desde tópico= ",topic," y el mensaj es: ", message.toString())
                    var ph = document.getElementById("ph")
                    ph.innerHTML = message.toString()
                    mensajePh = message.toString()
                    // Almacena el último mensaje en localStorage
                    localStorage.setItem('ultimoMensajePh', mensajePh);
                    break;
                case "test/ec":
                    console.log("Mensaje recibido desde tópico= ",topic," y el mensaj es: ", message.toString())
                    var ec = document.getElementById("ec")
                    ec.innerHTML = message.toString()
                    mensajeEc = message.toString()
                    // Almacena el último mensaje en localStorage
                    localStorage.setItem('ultimoMensajeEc', mensajeEc);
                    break;
                case "test/temp":
                    console.log("Mensaje recibido desde tópico= ",topic," y el mensaj es: ", message.toString())
                    var temp = document.getElementById("temp")
                    temp.innerHTML = message.toString()
                    mensajeTemp = message.toString()
                    // Almacena el último mensaje en localStorage
                    localStorage.setItem('ultimoMensajeTemp', mensajeTemp);
                    break;
                    default:
                        // Tópico desconocido
                        console.log('Mensaje en tópico desconocido:', topic, mensaje);

            } 
        })

        function obtenerPh(){
            return ultimoMensajePh
        }
        function obtenerEc(){
            return ultimoMensajeEc
        }
        function obtenerTemp(){
            return ultimoMensajeTemp
        }

        // Ejemplo de cómo obtener el último mensaje
        setInterval(function () {
            const mensaje = obtenerPh();
            console.log('Último mensaje:', mensaje);
            ph.innerHTML = mensaje
            localStorage.setItem('ultimoMensajePh', mensaje);
            
        }, 5000);
        
        // Manejador de eventos en caso de error
        client.on('error', function (error) {
        console.error('Error de MQTT:', error);
        });
        
        function switch2(){
            if($('#switch2').is(":checked")){
                console.log("encendido");
                client.publish('memcontrol/casaChelo/pieza/switch2', 'on')
            }else{
                console.log("apagado");
                client.publish('memcontrol/casaChelo/pieza/switch2', 'off')
            }
        }
    
    </script>
</x-app-layout>
