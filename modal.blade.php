@props([
    'id',
    'title' => 'Modal',
    'size'  => 'max-w-lg',
])

<dialog id="{{ $id }}" class="modal items-start shadow-sm">
    <div class="modal-box {{ $size }} p-0 mt-8 mb-8 rounded-lg overflow-hidden flex flex-col max-h-[calc(100dvh-4rem)]">

        {{-- ── HEADER ── --}}
        <div class="shrink-0 flex items-center justify-between text-white px-5 py-3 color-base border-b border-[#e9e9e9a6] dark:border-[#e9e9e90c]">
            <h3 class="font-medium text-xl">{{ $title }}</h3>
        </div>

        {{-- ── BODY ── --}}
        <div class="flex-1 overflow-y-auto px-5 py-4 bg-base-100">
            {{ $slot }}
        </div>

        {{-- ── FOOTER ── --}}
        <div class="shrink-0 flex flex-wrap items-center justify-end gap-2 px-5 py-3 bg-base-100 border-t border-[#e9e9e9a6] dark:border-[#e9e9e90c]">
            {{ $footer ?? '' }}
            <form method="dialog">
                <button class="btn">Cerrar</button>
            </form>
            {{ $actions ?? '' }}
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