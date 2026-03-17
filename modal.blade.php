@props([
    'id',
    'title' => 'Modal',
    'size'  => 'max-w-lg',
])

<dialog id="{{ $id }}" class="modal shadow-sm">
    <div class="modal-box {{ $size }} p-0 rounded-lg overflow-hidden">

        {{-- ── HEADER ── --}}
        <div class="flex items-center justify-between text-white px-5 py-3 bg-[#275DAE] dark:bg-[#0E1A31] border-b border-[#e9e9e9a6] dark:border-[#e9e9e90c]">
            <h3 class="font-medium text-base">{{ $title }}</h3>
        </div>

        {{-- ── BODY ── --}}
        <div class="px-5 py-4 bg-base-100">
            {{ $slot }}
        </div>

        {{-- ── FOOTER ── --}}
        <div class="flex flex-wrap items-center justify-end gap-2 px-5 py-3 bg-base-100 border-t border-[#e9e9e9a6] dark:border-[#e9e9e90c]">
            {{ $footer ?? '' }}
            <form method="dialog">
                <button class="btn">Cerrar</button>
            </form>
            {{ $actions }}
        </div>

    </div>
</dialog>

{{-- EJEMPLO DE USO

    <x-modal id="mi-modal" title="Confirmar acción" size="max-w-lg">

        Contenido...

        <x-slot:actions>
            <button class="btn btn-primary">Confirmar</button>
        </x-slot:actions>

    </x-modal>


    <button class="btn" onclick="document.getElementById('mi-modal').showModal()">
        Abrir modal
    </button> 

--}}