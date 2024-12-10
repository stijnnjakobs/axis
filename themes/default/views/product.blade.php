<x-app-layout description="{{ $category->description ?? null }}" title="{{ $category->name ?? __('Products') }}">
    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <x-success />

                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><span>{{ __('Store') }}</span></div>
                            <div class="nk-block-between-md g-4">
                                <div class="nk-block-head-content">
                                    <h2 class="nk-block-title fw-normal">{{ $category->name ?? __('Products') }}</h2>
                                    @if($category->description)
                                        <div class="nk-block-des">
                                            <p>@markdownify($category->description)</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="row g-gs">
                            @if ($categories->count() > 0)
                                <!-- Categories Sidebar -->
                                <div class="col-lg-3">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-3">
                                                <div class="card-title">
                                                    <h6 class="title">{{ __('Categories') }}</h6>
                                                </div>
                                            </div>

                                            <ul class="nk-menu">
                                                @foreach ($categories as $categoryItem)
                                                    @php $hasActiveChild = false; @endphp
                                                    @if ($categoryItem->children->count() > 0)
                                                        @foreach ($categoryItem->children as $childCategory)
                                                            @if ($category->name == $childCategory->name)
                                                                @php $hasActiveChild = true; @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                    @if ($categoryItem->products()->where('hidden', false)->count() > 0 || $categoryItem->children->count() > 0)
                                                        <li class="nk-menu-item @if($categoryItem->children->count() > 0) has-sub @endif">
                                                            <a href="{{ route('products', $categoryItem->slug) }}" 
                                                               class="nk-menu-link @if($categoryItem->children->count() > 0) nk-menu-toggle @endif @if ($category->name == $categoryItem->name || $hasActiveChild) active @endif">
                                                                <span class="nk-menu-text">{{ $categoryItem->name }}</span>
                                                                @if($categoryItem->children->count() > 0)
                                                                    <em class="icon ni ni-chevron-right"></em>
                                                                @endif
                                                            </a>
                                                            @if($categoryItem->children->count() > 0)
                                                                <ul class="nk-menu-sub @if($hasActiveChild) active @endif">
                                                                    @foreach ($categoryItem->children as $childCategory)
                                                                        <li class="nk-menu-item">
                                                                            <a href="{{ route('products', $childCategory->slug) }}" 
                                                                               class="nk-menu-link @if ($category->name == $childCategory->name) active @endif">
                                                                                <span class="nk-menu-text">{{ $childCategory->name }}</span>
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Main Content -->
                            <div class="@if ($categories->count() > 0) col-lg-9 @else col-12 @endif">
                                @if($category->children->count() > 0)
                                    <div class="row g-gs">
                                        @foreach($category->children as $childCat)
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="card card-bordered h-100">
                                                    <div class="card-inner">
                                                        <div class="d-flex align-items-center mb-3">
                                                            @if($childCat->image)
                                                                <div class="me-3">
                                                                    <img src="/storage/categories/{{ $childCat->image }}" 
                                                                         class="rounded" 
                                                                         style="width: 48px; height: 48px; object-fit: cover;"
                                                                         onerror="removeElement(this);" />
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <h6 class="title mb-1">{{ $childCat->name }}</h6>
                                                                <div class="text-soft">@markdownify($childCat->description)</div>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('products', $childCat->slug) }}" 
                                                           class="btn btn-block btn-dim btn-primary">
                                                            <em class="icon ni ni-arrow-right"></em>
                                                            <span>{{ __('Browse Category') }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="row g-gs">
                                    @foreach ($category->products()->where('hidden', false)->with('prices')->orderBy('order')->get() as $product)
                                        <div class="col-sm-6 col-lg-4">
                                            <livewire:product :product="$product" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function removeElement(element) {
            element.remove();
            this.error = true;
        }
    </script>

    <style>
    .nk-menu-link {
        padding: 0.625rem 1.25rem;
        color: #526484;
        font-size: 0.875rem;
        font-weight: 500;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all .3s;
    }
    .nk-menu-link:hover, .nk-menu-link.active {
        color: #6576ff;
        background: #f5f6fa;
    }
    .nk-menu-sub {
        padding-left: 1.5rem;
        display: none;
    }
    .nk-menu-sub.active {
        display: block;
    }
    .nk-menu-sub .nk-menu-link {
        padding: 0.5rem 1.25rem;
    }
    .card-bordered {
        border: 1px solid #dbdfea;
    }
    .text-soft {
        color: #8094ae !important;
    }
    </style>
</x-app-layout>
