@extends('layouts.landing')

@section('title',"contacto")

@section('main')
    <h2>Contacto 1111</h2>
    @component('components.landing-components.form-contact')
        @slot("tituloForm", "Formulario de contacto")
        @slot("actionForm", "Formulario de contacto")
        @slot("methodForm", "Formulario de contacto")
        @slot("onsubmitForm", "Formulario de contacto")
        @slot("idForm", "Formulario de contacto")
        @section('inputs')
            @component('components.landing-components.input')
                @slot("forLabel", "")
                @slot("labelInput", "Nombre")
                @slot("typeInput", "text")
                @slot("nameInput", "")
                @slot("idInput", "")
                @slot("valueInput", "")
            @endcomponent
            @component('components.landing-components.input')
                @slot("forLabel", "")
                @slot("labelInput", "Email")
                @slot("typeInput", "email")
                @slot("nameInput", "")
                @slot("idInput", "")
                @slot("valueInput", "")
            @endcomponent
            @component('components.landing-components.input')
                @slot("forLabel", "")
                @slot("labelInput", "")
                @slot("typeInput", "submit")
                @slot("nameInput", "")
                @slot("idInput", "")
                @slot("valueInput", "Enviar")
            @endcomponent
            @component('components.landing-components.input')
                @slot("forLabel", "")
                @slot("labelInput", "Enceder y apagar")
                @slot("typeInput", "checkbox")
                @slot("nameInput", "")
                @slot("idInput", "")
                @slot("valueInput", "")
            @endcomponent
        @endsection
        
    @endcomponent
    <h2 id="ph" value="30"></h2>
@endsection
@section("scripts")
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

    client.on('connect',()=>{
        console.log("Cliente MQTT conectado con éxito!!!")

        client.subscribe('test/ph',{qos: 0}, function (err) {
            if (!err) {
                console.log("Suscripcion exitosa a commands")

                
            }else{
                console.log("Suscripcion falló")
            }
            
        })
        // Receive messages
        
    })
    client.on('message', function (topic, message) {
        // message is Buffer
        console.log("Mensaje recibido desde tópico= ",topic," y el mensaj es: ", message.toString())
        var ph = document.getElementById("ph")
        ph.innerHTML = message.toString()
        
    })
    

    
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

@endsection