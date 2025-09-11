<x-filament-widgets::widget @class('grid grid-cols-12 gap-4 w-full')>
    <x-filament::section @class('col-span-4 col-start-5')>
                <div class="text-center">
                    <span class="text-4xl text-indigo-600 font-extrabold"> {{__('All Victims')}} </span>

                </div>
                <div class="text-center mt-8">

                    <span class="text-4xl text-danger-600 font-extrabold"> {{\App\Models\Victim::count()}} </span>
                </div>

    </x-filament::section>
    <x-filament::section @class('col-span-4 col-start-3')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold"> {{__('Libyans')}} </span>

        </div>
        <div class="text-center mt-8">

            <span class="text-4xl text-danger-600 font-extrabold"> {{\App\Models\Victim::wherein('family_id',\App\Models\Family::where('country_id',1)->pluck('id'))->count()}} </span>
        </div>

    </x-filament::section>
    <x-filament::section @class('col-span-4 col-start-7')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold"> {{__('Foreigners')}} </span>

        </div>
        <div class="text-center mt-8">

            <span class="text-4xl text-danger-600 font-extrabold"> {{\App\Models\Victim::wherein('family_id',\App\Models\Family::where('country_id','!=',1)->pluck('id'))->count()}} </span>
        </div>

    </x-filament::section>



</x-filament-widgets::widget>
