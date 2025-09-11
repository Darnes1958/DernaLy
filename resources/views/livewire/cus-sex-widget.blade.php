<x-filament-widgets::widget @class('grid grid-cols-12 gap-4 w-full')>



        <x-filament::section @class('col-span-4 col-start-3')>
            <div class="text-center">
                <span class="text-4xl text-indigo-600 font-extrabold">{{__('Male')}}</span>
            </div>
            <div class="text-center mt-8">
                <span class="text-4xl text-danger-600 font-extrabold"> {{\App\Models\Victim::where('male','ذكر')->count()}} </span>
            </div>
        </x-filament::section>
    <x-filament::section @class('col-span-4 col-start-7')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold">{{__('Female')}}</span>
        </div>
        <div class="text-center mt-8">
            <span class="text-4xl text-danger-600 font-extrabold"> {{\App\Models\Victim::where('male','أنثي')->count()}} </span>
        </div>
    </x-filament::section>
    <x-filament::section @class('col-span-4 col-start-3')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold">{{__('Grand Fathers')}}</span>
        </div>
        <div class="text-center mt-8">
            <span class="text-4xl text-danger-600 font-extrabold"> {{\App\Models\Victim::where('is_grandfather',1)->count()}} </span>
        </div>
    </x-filament::section>
    <x-filament::section @class('col-span-4 col-start-7')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold">{{__('Grand Mothers')}}</span>
        </div>
        <div class="text-center mt-8">
            <span class="text-4xl text-danger-600 font-extrabold"> {{\App\Models\Victim::where('is_grandmother',1)->count()}} </span>
        </div>
    </x-filament::section>
    <x-filament::section @class('col-span-4 col-start-3')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold">{{__('Fathers')}}</span>
        </div>
        <div class="text-center mt-8">
            <span class="text-4xl text-danger-600 font-extrabold"> {{\App\Models\Victim::where('is_father',1)->count()}} </span>
        </div>
    </x-filament::section>
    <x-filament::section @class('col-span-4 col-start-7')>
        <div class="text-center">
            <span class="text-4xl text-indigo-600 font-extrabold">{{__('Mothers')}}</span>
        </div>
        <div class="text-center mt-8">
            <span class="text-4xl text-danger-600 font-extrabold"> {{\App\Models\Victim::where('is_mother',1)->count()}} </span>
        </div>
    </x-filament::section>


</x-filament-widgets::widget>
