<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight titulo">
            {{ __('Desert Bloom!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div style="color:green; font-size:32px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Desert Bloom!") }}
                    
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 ">
                    <div class="flex justify-between h-8">
                        <div><h4>Ph mezcla: </h4></div>
                        <div class="col-4"><p id="ph"></p></div>
                    </div>
                    <div class="flex justify-between h-8">
                        <div><h4>Ec mezcla: </h4> </div>
                        <div><p id="ec"></p></div>
                    </div>
                    <div class="flex justify-between h-8">
                        <div><h4>Temperatura mezcla:</h4> </div>
                        <div><p id="temp"></p></div>
                    </div>

                   <div class="flex justify-between h-8">
                        <h4>Estado de retorno: </h4><p id="estado-retorno"></p><br>
                   </div>
                   
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="luz" value="" class="sr-only peer" onchange="switch2()">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Luz</span>
                    </label>
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
        const mqttTopics = 
        [
            'memcontrol/desertbloom/001/cultivoHidroponico/phMezcla', 
            'memcontrol/desertbloom/001/cultivoHidroponico/ecMezcla', 
            'memcontrol/desertbloom/001/cultivoHidroponico/tempMezcla',
            'memcontrol/desertbloom/001/cultivoHidroponico/estadoRetorno',
            'memcontrol/desertbloom/001/cultivoHidroponico/interruptorIot'
        ];
        //var ultimoMensajePh = localStorage.getItem('ultimoMensajePh') || '';
        //var ultimoMensajeEc = localStorage.getItem('ultimoMensajeEc') || '';
        //var ultimoMensajeTemp = localStorage.getItem('ultimoMensajeTemp') || '';

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
                case "memcontrol/desertbloom/001/cultivoHidroponico/phMezcla":
                    console.log("Mensaje recibido desde tópico= ",topic," y el mensaj es: ", message.toString())
                    var ph = document.getElementById("ph")
                    ph.innerHTML = message.toString()
                    mensajePh = message.toString()
                    // Almacena el último mensaje en localStorage
                    //localStorage.setItem('ultimoMensajePh', mensajePh);
                    break;
                case "memcontrol/desertbloom/001/cultivoHidroponico/ecMezcla":
                    console.log("Mensaje recibido desde tópico= ",topic," y el mensaj es: ", message.toString())
                    var ec = document.getElementById("ec")
                    ec.innerHTML = message.toString()
                    mensajeEc = message.toString()
                    // Almacena el último mensaje en localStorage
                    //localStorage.setItem('ultimoMensajeEc', mensajeEc);
                    break;
                case "memcontrol/desertbloom/001/cultivoHidroponico/tempMezcla":
                    console.log("Mensaje recibido desde tópico= ",topic," y el mensaj es: ", message.toString())
                    var temp = document.getElementById("temp")
                    temp.innerHTML = message.toString()
                    mensajeTemp = message.toString()
                    // Almacena el último mensaje en localStorage
                    //localStorage.setItem('ultimoMensajeTemp', mensajeTemp);
                    break;
                case "memcontrol/desertbloom/001/cultivoHidroponico/estadoRetorno":
                    console.log("Mensaje recibido desde tópico= ",topic," y el mensaj es: ", message.toString())
                    var retorno = document.getElementById("estado-retorno")
                    retorno.innerHTML = message.toString()
                    mensajeRetorno = message.toString()
                    
                break;
                case "memcontrol/desertbloom/001/cultivoHidroponico/interruptorIot":
                    console.log("Mensaje recibido desde tópico= ",topic," y el mensaj es: ", message.toString())
                    var s = document.getElementById("luz")
                    mensajeLuz = message.toString()
                    if(mensajeLuz == "on"){
                        s.checked = true;
                    }else{
                        s.checked = false;
                    }
                    break;
                default:
                        // Tópico desconocido
                        console.log('Mensaje en tópico desconocido:', topic, mensaje);

            } 
        })
        /*
        function obtenerPh(){
            return ultimoMensajePh
        }
        function obtenerEc(){
            return ultimoMensajeEc
        }
        function obtenerTemp(){
            return ultimoMensajeTemp
        }

        setInterval(function () {
            const mensaje = obtenerPh();
            console.log('Último mensaje:', mensaje);
            ph.innerHTML = mensaje
            localStorage.setItem('ultimoMensajePh', mensaje);
            
        }, 5000);
        */
        // Manejador de eventos en caso de error
        client.on('error', function (error) {
        console.error('Error de MQTT:', error);
        });
        
        function switch2(){
            var s = document.getElementById("luz")
            if(s.checked){
                console.log("encendido");
                client.publish("memcontrol/desertbloom/001/cultivoHidroponico/interruptorIot","on")
            }else{
                console.log("apagado");
                client.publish("memcontrol/desertbloom/001/cultivoHidroponico/interruptorIot","off")
            }
          
        }
    
    </script>
</x-app-layout>
