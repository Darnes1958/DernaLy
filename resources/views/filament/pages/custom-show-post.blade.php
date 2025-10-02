<x-filament-panels::page>
    <div
        x-data ="{selectedId: null}"
        x-on:click.prevent="

        if($event.target.closest('.open-modal')) {
            console.info($event.target.className)
            $wire.call('openModal',[$event.target.text,$event.target.className] )
        }
       "

    >
       {{ $this->form }}

    </div>

</x-filament-panels::page>
