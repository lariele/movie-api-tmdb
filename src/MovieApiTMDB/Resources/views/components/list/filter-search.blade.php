<div class="search-ac block sm:flex col-span-4">
    <input wire:model="filter.search" type="text" class="form-control"
           placeholder="Search Orders, Customers...">

{{--    <div class="results rounded-md box">--}}
{{--        <div class="intro-x">--}}
{{--            @if(!empty($results))--}}
{{--                @foreach($results as $result)--}}
{{--                    <a href="{{ route('order', ['order' => $result->id, 'orderSlug' => Str::slug($result->name)]) }}">--}}
{{--                        <div class="px-5 py-3 mb-3 flex items-center hover:bg-slate-100">--}}
{{--                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">--}}
{{--                                <img alt="Midone - HTML Admin Template"--}}
{{--                                     src="{{ asset('build/assets/images/preview-'.($result->id % 10 + 1).'.jpg') }}">--}}
{{--                            </div>--}}
{{--                            <div class="ml-4 mr-auto">--}}
{{--                                <div class="font-medium">{{ $result->name }}</div>--}}
{{--                                <div class="text-slate-500 text-xs mt-0.5">{{ $result->year }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="flex justify-center items-center">--}}

{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
{{--                                     fill="none"--}}
{{--                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
{{--                                     stroke-linejoin="round"--}}
{{--                                     icon-name="star" data-lucide="star" class="lucide lucide-star w-4 h-4 mr-1">--}}
{{--                                    <polygon--}}
{{--                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>--}}
{{--                                </svg> {{ $result->rating }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
