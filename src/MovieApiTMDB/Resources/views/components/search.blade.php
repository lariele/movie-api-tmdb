<div class="relative mx-auto relative">
    <div class="search hidden sm:block">
        <input wire:model="filter.search" type="text" class="search__input form-control border-transparent"
               placeholder="Search Actors, Genres, Orders...">
        <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
    </div>
    <a class="notification notification--light sm:hidden" href="">
        <i data-lucide="search" class="notification__icon dark:text-slate-500"></i>
    </a>
    <div class="search-result @if($results->isNotEmpty()) show @endif">
        <div class="search-result__content">
            {{--            <div class="search-result__content__title">Pages</div>--}}
            {{--            <div class="mb-5">--}}
            {{--                <a href="" class="flex items-center">--}}
            {{--                    <div--}}
            {{--                        class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">--}}
            {{--                        <i class="w-4 h-4" data-lucide="inbox"></i>--}}
            {{--                    </div>--}}
            {{--                    <div class="ml-3">Mail Settings</div>--}}
            {{--                </a>--}}
            {{--                <a href="" class="flex items-center mt-2">--}}
            {{--                    <div class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full">--}}
            {{--                        <i class="w-4 h-4" data-lucide="users"></i>--}}
            {{--                    </div>--}}
            {{--                    <div class="ml-3">Users & Permissions</div>--}}
            {{--                </a>--}}
            {{--                <a href="" class="flex items-center mt-2">--}}
            {{--                    <div--}}
            {{--                        class="w-8 h-8 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full">--}}
            {{--                        <i class="w-4 h-4" data-lucide="credit-card"></i>--}}
            {{--                    </div>--}}
            {{--                    <div class="ml-3">Transactions Report</div>--}}
            {{--                </a>--}}
            {{--            </div>--}}


            @if(!empty($results))
                <div class="search-result__content__title">Orders</div>
                <div class="mb-5">
                    @foreach ($results as $result)
                        <a href="{{ route('order', ['order' => $result->id, 'orderSlug' => Str::slug($result->name)]) }}">
                            <div class="flex items-center mt-3">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Midone - HTML Admin Template"
                                         src="{{ asset('build/assets/images/preview-'.($result->id % 10 + 1).'.jpg') }}">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">{{ $result->name }}</div>
                                    <div class="text-slate-500 text-xs mt-0.5">{{ $result->year }}</div>
                                </div>
                                <div class="flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         icon-name="star" data-lucide="star" class="lucide lucide-star w-4 h-4 mr-1">
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg> {{ $result->rating }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            {{--            <div class="search-result__content__title">Products</div>--}}
            {{--            @foreach (array_slice($fakers, 0, 4) as $faker)--}}
            {{--                <a href="" class="flex items-center mt-2">--}}
            {{--                    <div class="w-8 h-8 image-fit">--}}
            {{--                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][0]) }}">--}}
            {{--                    </div>--}}
            {{--                    <div class="ml-3">{{ $faker['products'][0]['name'] }}</div>--}}
            {{--                    <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">{{ $faker['products'][0]['category'] }}</div>--}}
            {{--                </a>--}}
            {{--            @endforeach--}}
        </div>
    </div>
</div>
