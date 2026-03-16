@props([
    'label'       => null,
    'hint'        => null,
    'errors'      => [],
    'color'       => null,
    'size'        => null,
    'name'        => null,
    'id'          => null,
    'placeholder' => null,
    'value'       => null,
    'type'        => 'text',
    'required'    => false,
    'disabled'    => false,
    'readonly'    => false,
    'iconLeft'    => null,
    'iconRight'   => null,
])

@php
    $inputId    = $id ?? $name;
    $colorClass = $color ? "input-{$color}" : '';
    $sizeClass  = $size  ? "input-{$size}"  : '';
    $errorClass = !empty($errors) ? 'input-error' : '';

    $hasIconLeft  = ($iconLeft && is_string($iconLeft) && trim($iconLeft) !== '')
                    || (isset($iconLeft) && $iconLeft instanceof \Illuminate\View\ComponentSlot && $iconLeft->isNotEmpty());

    $hasIconRight = ($iconRight && is_string($iconRight) && trim($iconRight) !== '')
                    || (isset($iconRight) && $iconRight instanceof \Illuminate\View\ComponentSlot && $iconRight->isNotEmpty());

    $paddingLeft  = $hasIconLeft  ? 'pl-10' : '';
    $paddingRight = $hasIconRight ? 'pr-10' : '';
@endphp

<fieldset class="fieldset w-full h-22.5 relative">

    @if ($label)
        <legend class="fieldset-legend">
            {{ $label }}
            @if ($required) <span class="text-error">*</span> @endif
        </legend>
    @endif

    {{-- El div relative es el que contiene todo --}}
    {{-- El input y los iconos son hermanos dentro de este div --}}
    <div class="relative w-full">

        <input
            type="{{ $type }}"
            id="{{ $inputId }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            @if ($required) required @endif
            @if ($disabled) disabled @endif
            @if ($readonly) readonly @endif
            {{ $attributes->merge(['class' => "input w-full {$colorClass} {$sizeClass} {$errorClass} {$paddingLeft} {$paddingRight}"]) }}
        />

        {{-- Iconos FUERA del input, posicionados sobre él --}}
        @if ($hasIconLeft)
            <span class="absolute inset-y-0 left-0.5 top-1 w-10 flex items-center justify-center text-base-content/40 pointer-events-none z-10">
                @if (is_string($iconLeft))
                    {!! $iconLeft !!}
                @else
                    {{ $iconLeft }}
                @endif
            </span>
        @endif

        @if ($hasIconRight)
            <span class="absolute inset-y-0 right-0 top-1 w-10 flex items-center justify-center text-base-content/40 pointer-events-none z-10">
                @if (is_string($iconRight))
                    {!! $iconRight !!}
                @else
                    {{ $iconRight }}
                @endif
            </span>
        @endif

    </div>

    @if ($errors)
        @foreach ($errors as $error)
            <p class="absolute -bottom-2.5 label text-error">{{ $error }}</p>
        @endforeach
    @elseif ($hint)
        <p class="absolute -bottom-2.5 label">{{ $hint }}</p>
    @endif

</fieldset>

{{-- EJEMPLO DE USO (Aplica para text, number, email, password, search, url y tel)

    <x-input.text label="Email:" id="email" class="mt-1 border border-base-350" type="email"
        name="email" :value="old('email')" autofocus autocomplete="username" :errors="$errors->get('email')">

        PARA INCLUIR ICONOS ELIGE SEGÚN SEA EL CASO

        <x-slot:iconLeft>
            <svg class="h-[1em] opacity-75" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                    stroke="currentColor">
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </g>
            </svg>
        </x-slot:iconLeft>

        <x-slot:iconRight>
            <svg class="h-[1em] opacity-75" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                    stroke="currentColor">
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </g>
            </svg>
        </x-slot:iconRight>

    </x-input.text> 

--}}