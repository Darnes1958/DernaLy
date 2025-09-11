<x-filament-widgets::widget @class('grid grid-cols-12 gap-4 w-full')>

    <x-filament::section @class('col-span-4 col-start-3')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold"> {{__('East Vally')}} </span>

        </div>
        <div class="text-center mt-8">

            <span class="text-4xl text-danger-600 font-extrabold"> {{$east}} </span>
        </div>

    </x-filament::section>
    <x-filament::section @class('col-span-4 col-start-7')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold"> {{__('West Vally')}} </span>

        </div>
        <div class="text-center mt-8">

            <span class="text-4xl text-danger-600 font-extrabold"> {{$west}} </span>
        </div>
    </x-filament::section>
    <x-filament::section @class('col-span-4 col-start-3')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold"> {{__('Derna Vally')}} </span>

        </div>
        <div class="text-center mt-8">

            <span class="text-4xl text-danger-600 font-extrabold"> {{$derna}} </span>
        </div>

    </x-filament::section>
    <x-filament::section @class('col-span-4 col-start-7')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold"> {{__('Elnaga Vally')}} </span>

        </div>
        <div class="text-center mt-8">

            <span class="text-4xl text-danger-600 font-extrabold"> {{$naga}} </span>
        </div>
    </x-filament::section>



</x-filament-widgets::widget>
