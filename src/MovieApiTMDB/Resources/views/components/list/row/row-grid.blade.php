<div class="col-span-2 grid grid-cols-12 py-4 border-b" x-data="{
        movie: @entangle('movie').defer
    }">
    <div class="col-span-12">
        <img src="{{ asset('storage/movies/posters/movie-'.($movie->id % 11 + 1).'.jpg') }}" title=""/>
        <div class="text-lg font-semibold">{{ $movie->name }}</div>
    </div>

{{--    <div class="col-span-6 py-4 px-8 flex flex-col">--}}
{{--        <div>{{ $movie->year }}, {{ $movie->genres->join(', ') }}</div>--}}
{{--        <div class="text-lg font-semibold">{{ $movie->name }}</div>--}}
{{--        <div class="mt-2 text-gray-500">--}}
{{--            {{ Str::limit($movie->description,190) }}--}}
{{--        </div>--}}
{{--        <div class="text-sm mt-2">--}}
{{--            @if($movie->on_netflix)--}}
{{--                <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Netflix</span>--}}
{{--            @endif--}}
{{--            @if($movie->on_hbo)--}}
{{--                <span class="bg-purple-100 text-purple-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">HBO</span>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--        <div class="mt-auto inline-flex">--}}
{{--            <button type="button"--}}
{{--                    class="inline-flex items-center h-8 py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">--}}
{{--                Watch Now--}}
{{--            </button>--}}

{{--            <button wire:click="toggleFavourite()" type="button"--}}
{{--                    class="inline-flex h-8 items-center @if(!$favourite) btn-def @else text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 shadow-lg shadow-green-500/50  font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 @endif">--}}
{{--                <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                    <line x1="12" y1="5" x2="12" y2="19"></line>--}}
{{--                    <line x1="5" y1="12" x2="19" y2="12"></line>--}}
{{--                </svg>--}}
{{--                Add to List--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-span-4 flex py-4 px-8 text-center items-start">
        {{--        <div class="flex justify-center items-center">--}}
        {{--            <a class="flex items-center @if($favourite) text-success @else text-slate-500 @endif hover:text-slate-900"--}}
        {{--               href="javascript:;"--}}
        {{--               wire:click="toggleFavourite()">--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
        {{--                     fill="@if(!$favourite)none @else currentColor @endif"--}}
        {{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
        {{--                     icon-name="star" data-lucide="star" class="w-4 h-4 mr-1">--}}
        {{--                    <polygon--}}
        {{--                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>--}}
        {{--                </svg> {{ $movie->rating }}--}}
        {{--            </a>--}}
        {{--        </div>--}}
        <div class="flex items-center">
            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg"><title>Rating star</title>
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            <p class="ml-2 font-bold text-gray-900">{{ $movie->rating/10 }}</p>
        </div>
    </div>
</div>
