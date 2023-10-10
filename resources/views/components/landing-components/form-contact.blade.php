
<div>
    <h2>{{ $tituloForm }}</h2>
    <form 
        action="{{ $actionForm }}" 
        method="{{ $methodForm }}" 
        onsubmit="{{ $onsubmitForm }}"
        id="{{ $idForm }}" 
        >
        @yield('inputs')
    </form>
</div>