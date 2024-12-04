<x-app-layout title="Services" clients>
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    <x-success class="mt-4" />

                    <!-- Welcome Section -->
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Services') }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{ __('Manage your active services and subscriptions') }}</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                        <em class="icon ni ni-more-v"></em>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Services Grid -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            @if ($services->count() > 0)
                                @foreach ($services as $service)
                                    @foreach ($service->products as $product2)
                                        @php($product = $product2->product)
                                        @if($product2->status === 'cancelled')
                                            @continue
                                        @endif
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner">
                                                    <div class="project">
                                                        <div class="project-head">
                                                            <div class="project-title">
                                                                <div class="project-title-text">
                                                                    <h5 class="title">{{ ucfirst($product->name) }}</h5>
                                                                    <span class="badge badge-dim rounded-pill 
                                                                        @if($product2->status === 'paid') bg-success 
                                                                        @elseif($product2->status === 'pending') bg-warning
                                                                        @else bg-danger @endif">
                                                                        {{ ucfirst($product2->status) }}
                                                                    </span>
                                                                </div>
                                                                @if ($product->image !== 'null')
                                                                    <img src="{{ $product->image }}" 
                                                                         alt="{{ $product->name }}"
                                                                         class="project-logo rounded-lg"
                                                                         style="width: 40px; height: 40px;"
                                                                         onerror="removeElement(this);">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="project-details mt-3">
                                                            <div class="row g-2">
                                                                <div class="col-6">
                                                                    <div class="project-info">
                                                                        <span class="sub-text">{{ __('Price') }}</span>
                                                                        <span class="lead-text"><x-money :amount="$product2->price" /></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="project-info">
                                                                        <span class="sub-text">{{ __('Expiry Date') }}</span>
                                                                        <span class="lead-text">
                                                                            {{ $product2->expiry_date ? $product2->expiry_date->toDateString() : __('Doesn\'t Expire') }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="project-progress mt-4">
                                                            <div class="d-flex justify-content-between">
                                                                @if($product2->status === 'cancelled' || $product2->status === 'suspended')
                                                                    <button class="btn btn-light btn-block disabled">
                                                                        <em class="icon ni ni-eye"></em>
                                                                        <span>{{ __('View') }}</span>
                                                                    </button>
                                                                @else
                                                                    <a href="{{ route('clients.active-products.show', $product2->id) }}" 
                                                                       class="btn btn-light btn-block">
                                                                        <em class="icon ni ni-eye"></em>
                                                                        <span>{{ __('View') }}</span>
                                                                    </a>
                                                                @endif
                                                                
                                                                @if($product2->status === 'pending' || $product2->status === 'suspended')
                                                                    <a href="{{ route('clients.invoice.index') }}" 
                                                                       class="btn btn-primary btn-block ms-2">
                                                                        <em class="icon ni ni-wallet"></em>
                                                                        <span>{{ __('Pay Now') }}</span>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @else
                                <div class="col-12">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="nk-empty">
                                                <div class="nk-empty-img">
                                                    <em class="icon ni ni-servers"></em>
                                                </div>
                                                <h5 class="nk-empty-title">{{ __('No Services Found') }}</h5>
                                                <p class="nk-empty-text">
                                                    {{ __('You haven\'t purchased any services yet. Start exploring our offerings!') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
