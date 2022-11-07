<div class="grid grid-cols-12 gap-4 mt-4 h-8">

    {{--    @include('order::components.list.filter-search')--}}

    <div class="col-span-6 gap-4 flex items-center flex flex-col sm:flex-row">
        <div class="flex items-center mr-4">
            <input wire:model="filter.on_netflix" id="on_netflix" type="checkbox" value="1"
                   class="w-4 h-4 text-red-600 bg-gray-100 rounded border-gray-300 focus:ring-red-500 focus:ring-2">
            <label for="on_netflix" class="ml-2 text-sm font-medium text-gray-900">Netflix</label>
        </div>
        <div class="flex items-center mr-4">
            <input wire:model="filter.on_hbo" id="on_hbo" type="checkbox" value="1"
                   class="w-4 h-4 text-purple-600 bg-gray-100 rounded border-gray-300 focus:ring-purple-500 focus:ring-2">
            <label for="on_hbo" class="ml-2 text-sm font-medium text-gray-900">HBO</label>
        </div>
        <div class="flex items-center mr-4">
            <input wire:model="filter.on_disney" id="on_disney" type="checkbox" value="1"
                   class="w-4 h-4 text-green-600 bg-gray-100 rounded border-gray-300 focus:ring-green-500 focus:ring-2">
            <label for="on_disney" class="ml-2 text-sm font-medium text-gray-900">Disney</label>
        </div>
    </div>

    <div class="col-span-6 flex items-center justify-end">
        <div wire:click="filterViewList()" class="mr-4 @if(isset($row) && $row == 'list') text-gray-900 @else text-gray-500 hover:text-gray-900 @endif">
            <x-movie::ui.movie-list-filter.icon-list/>
        </div>
        <div wire:click="filterViewBoxed()" class="@if(isset($row) && $row == 'boxed') text-gray-900 @else text-gray-500 hover:text-gray-900 @endif">
            <x-movie::ui.movie-list-filter.icon-boxed/>
        </div>
    </div>
</div>
