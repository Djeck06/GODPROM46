@props(['align' => 'right', 'width' => '48', 'id','btnClasses' => 'py-1 bg-white'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'origin-top-left left-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'origin-top-right right-0';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp



<div
    x-data="{
        open: false,
        toggle() {
            if (this.open) {
                return this.close()
            }

            this.$refs.button.focus()

            this.open = true
        },
        close(focusAfter) {
            if (! this.open) return

            this.open = false

            focusAfter && focusAfter.focus()
        }
    }"
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
    x-id="['dropdown-button']"
    class="relative"
>
    <!-- Button -->
    <x-button
        x-ref="button"
        x-on:click="toggle()"
        aria-expanded="open"
        :aria-controls="'dropdown-button'"
        type="button"
        class=" {{ $btnClasses }}"
    > 
    {{ $trigger }}
    </x-button>

    <!-- Panel 
    class="absolute left-0 mt-2 w-40 bg-white rounded shadow-md overflow-hidden"
    -->
    <div x-ref="panel" x-show="open" x-transition.origin.top.left="" x-on:click.outside="close($refs.button)"  id="dropdown-button" 
    {{ $attributes->merge([
            
            'style'  => 'display: none;',
            'class' => 'absolute origin-top-right right-0 mt-2 w-40 bg-white rounded shadow-md overflow-hidden rounded-lg shadow-lg py-2' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
        ]) }}>
    {{ $content }}
    </div>
</div>

