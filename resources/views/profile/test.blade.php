<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight titulo">
            {{ __('Test') }}
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

    
</x-app-layout>
