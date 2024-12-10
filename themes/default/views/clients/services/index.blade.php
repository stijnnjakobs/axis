<x-app-layout title="Services" clients>
    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><span>{{ __('Overview') }}</span></div>
                            <div class="nk-block-between-md g-4">
                                <div class="nk-block-head-content">
                                    <h2 class="nk-block-title fw-normal">{{ __('Active Services') }}</h2>
                                    <div class="nk-block-des">
                                        <p>{{ __('Manage your active services and subscriptions.') }}</p>
                                    </div>
                                </div>
                                <div class="nk-block-head-content">
                                    <ul class="nk-block-tools gx-3">
                                        <li>
                                            <a href="{{ route('clients.home') }}" class="btn btn-white btn-light">
                                                <em class="icon ni ni-plus"></em>
                                                <span>{{ __('Order New Service') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($services->count() > 0)
                        <div class="nk-block">
                            <div class="nk-iv-scheme-list">
                                @foreach ($services as $service)
                                    @foreach ($service->products as $product2)
                                        @php($product = $product2->product)
                                        @if($product2->status === 'cancelled')
                                            @continue
                                        @endif

                                        <div class="nk-iv-scheme-item">
                                            <!-- Left Section: Icon & Basic Info -->
                                            <div class="nk-iv-scheme-content">
                                                <div class="nk-iv-scheme-icon {{ $product2->status === 'paid' ? 'is-running' : 'is-pending' }}">
                                                    @if($product->type === 'hosting')
                                                        <em class="icon ni ni-server"></em>
                                                    @elseif($product->type === 'domain')
                                                        <em class="icon ni ni-globe"></em>
                                                    @elseif($product->type === 'server')
                                                        <em class="icon ni ni-hard-drive"></em>
                                                    @elseif($product->type === 'license')
                                                        <em class="icon ni ni-shield-check"></em>
                                                    @else
                                                        <em class="icon ni ni-box"></em>
                                                    @endif
                                                </div>
                                                <div class="nk-iv-scheme-info">
                                                    <div class="nk-iv-scheme-name">{{ ucfirst($product->name) }}</div>
                                                    <div class="badge badge-dim rounded-pill {{ $product2->status === 'paid' ? 'badge-success' : 
                                                        ($product2->status === 'pending' ? 'badge-warning' : 'badge-danger') }}">
                                                        {{ ucfirst($product2->status) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Middle Section: Details -->
                                            <div class="nk-iv-scheme-details">
                                                <div class="row g-3">
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="nk-iv-scheme-value">
                                                            <span class="text-soft fs-12px mb-1">{{ __('Category') }}</span>
                                                            <h6 class="fs-13px mb-0">{{ ucfirst($product->category->name) }}</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="nk-iv-scheme-value">
                                                            <span class="text-soft fs-12px mb-1">{{ __('Price') }}</span>
                                                            <h6 class="fs-13px mb-0"><x-money :amount="$product2->price" /></h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="nk-iv-scheme-value">
                                                            <span class="text-soft fs-12px mb-1">{{ __('Billing Cycle') }}</span>
                                                            <h6 class="fs-13px mb-0">{{ ucfirst($product2->billing_cycle) }}</h6>
                                                        </div>
                                                    </div>
                                                    @if($product2->expiry_date)
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div class="nk-iv-scheme-value">
                                                                <span class="text-soft fs-12px mb-1">{{ __('Due Date') }}</span>
                                                                <h6 class="fs-13px mb-0">{{ $product2->expiry_date->toDateString() }}</h6>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($product->domain)
                                                        <div class="col-lg-8 col-sm-6">
                                                            <div class="nk-iv-scheme-value">
                                                                <span class="text-soft fs-12px mb-1">{{ __('Domain') }}</span>
                                                                <h6 class="fs-13px text-truncate mb-0">{{ $product->domain }}</h6>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Right Section: Actions -->
                                            <div class="nk-iv-scheme-actions">
                                                @if($product2->status === 'cancelled' || $product2->status === 'suspended')
                                                    <button class="btn btn-dim btn-outline-light btn-md" disabled>
                                                        <em class="icon ni ni-eye me-1"></em>
                                                        <span>{{ __('View') }}</span>
                                                    </button>
                                                @else
                                                    <a href="{{ route('clients.active-products.show', $product2->id) }}" 
                                                       class="btn btn-dim btn-outline-primary btn-md">
                                                        <em class="icon ni ni-forward-ios me-1"></em>
                                                        <span>{{ __('Manage') }}</span>
                                                    </a>
                                                @endif
                                            </div>

                                            <!-- Status Bar -->
                                            @if($product2->status === 'pending')
                                                <div class="nk-iv-scheme-progress">
                                                    <div class="progress-bar bg-warning" data-progress="100"></div>
                                                </div>
                                            @elseif($product2->status === 'suspended')
                                                <div class="nk-iv-scheme-progress">
                                                    <div class="progress-bar bg-danger" data-progress="100"></div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="nk-block">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="nk-empty">
                                        <div class="nk-empty-img">
                                            <em class="icon ni ni-servers fs-40px text-primary"></em>
                                        </div>
                                        <h5 class="nk-empty-title">{{ __('No Services Found') }}</h5>
                                        <p class="nk-empty-text w-50 mx-auto">
                                            {{ __('You haven\'t purchased any services yet. Start exploring our offerings!') }}
                                        </p>
                                        <a href="{{ route('clients.home') }}" class="btn btn-primary">
                                            <em class="icon ni ni-plus"></em>
                                            <span>{{ __('Order New Service') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
    .nk-iv-scheme-item {
        display: flex;
        flex-wrap: wrap;
        padding: 1.5rem;
        gap: 1.5rem;
    }
    .nk-iv-scheme-content {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        min-width: 200px;
    }
    .nk-iv-scheme-details {
        flex: 1;
        min-width: 300px;
    }
    .nk-iv-scheme-actions {
        display: flex;
        align-items: center;
    }
    .nk-iv-scheme-value {
        display: flex;
        flex-direction: column;
    }
    .nk-iv-scheme-info {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .nk-iv-scheme-name {
        font-weight: 500;
        font-size: 1.1rem;
        color: #364a63;
    }
    .badge {
        align-self: flex-start;
    }
    .text-truncate {
        max-width: 250px;
    }
    .badge-success {
        color: #1ee0ac;
        background-color: #1ee0ac20;
    }
    .badge-warning {
        color: #f4bd0e;
        background-color: #f4bd0e20;
    }
    .badge-danger {
        color: #e85347;
        background-color: #e8534720;
    }
    </style>
</x-app-layout>
