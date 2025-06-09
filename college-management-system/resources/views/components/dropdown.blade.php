<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>
    <div x-show="open" class="absolute z-50 mt-2 rounded-md shadow-lg {{ $width ?? 'w-48' }} {{ $alignmentClasses ?? '' }}" style="display: none;" @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses ?? '' }}">
            {{ $content }}
        </div>
    </div>
</div>
