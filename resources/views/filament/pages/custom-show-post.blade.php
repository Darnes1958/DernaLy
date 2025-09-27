<x-filament-panels::page>
    <div
        x-data ="{selectedId: null}"
        x-on:click.prevent="

        if($event.target.closest('.open-modal')) {

            $wire.call('openModal',$event.target.text )
        }
       "

    >
       {{ $this->form }}

    </div>

</x-filament-panels::page>
