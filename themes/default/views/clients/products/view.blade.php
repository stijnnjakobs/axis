<x-app-layout clients title="{{ __('Product') }} {{ $product->name }}">
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ $product->name }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{ __('Product Details and Management') }}</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content">
                                        <ul class="nk-block-tools g-3">
                                            @if($orderProduct->upgradable)
                                                <li>
                                                    <a href="{{ route('clients.active-products.upgrade', $orderProduct->id) }}" 
                                                       class="btn btn-primary">
                                                        <em class="icon ni ni-arrow-up"></em>
                                                        <span>{{ __('Upgrade Product') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($link)
                                                <li>
                                                    <a href="{{ $link }}" class="btn btn-dim btn-outline-primary" target="_blank">
                                                        <em class="icon ni ni-signin"></em>
                                                        <span>{{ __('Login to Product') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($orderProduct->getOpenInvoices()->count() > 0)
                                                <li>
                                                    <a href="{{ route('clients.invoice.show', $orderProduct->getOpenInvoices()->first()->id) }}" 
                                                       class="btn btn-dim btn-outline-primary">
                                                        <em class="icon ni ni-file-text"></em>
                                                        <span>{{ __('View Open Invoice') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-lg-8">
                                <div class="card card-bordered h-100">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-3">
                                            <div class="card-title">
                                                <h6 class="title">{{ __('Product Information') }}</h6>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="nk-iv-wg3">
                                                <div class="nk-iv-wg3-group flex-lg-nowrap gx-4">
                                                    <div class="nk-iv-wg3-sub">
                                                        <div class="nk-iv-wg3-text">
                                                            <h6 class="title">{{ __('Product Name') }}</h6>
                                                            <span class="sub-text">{{ $product->name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-iv-wg3-sub">
                                                        <div class="nk-iv-wg3-text">
                                                            <h6 class="title">{{ __('Product Price') }}</h6>
                                                            <span class="sub-text">
                                                                <x-money :amount="$orderProduct->price" showFree="true" />
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-iv-wg3 mt-4">
                                                <div class="nk-iv-wg3-text">
                                                    <h6 class="title">{{ __('Product Description') }}</h6>
                                                    <div class="sub-text">@markdownify($product->description)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="card card-bordered h-100">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-3">
                                            <div class="card-title">
                                                <h6 class="title">{{ __('Status Information') }}</h6>
                                            </div>
                                        </div>
                                        @if ($orderProduct->expiry_date)
                                            <ul class="nk-list-block">
                                                <li class="nk-list-item">
                                                    <div class="lead-text">{{ __('Due Date') }}</div>
                                                    <div class="sub-text text-soft">{{ $orderProduct->expiry_date->toDateString() }}</div>
                                                </li>
                                                <li class="nk-list-item">
                                                    <div class="lead-text">{{ __('Status') }}</div>
                                                    <div class="sub-text">
                                                        <span class="badge badge-dot badge-{{ $orderProduct->status == 'paid' ? 'success' : 'warning' }}">
                                                            {{ $orderProduct->status == 'paid' ? __('Active') : ucfirst($orderProduct->status) }}
                                                        </span>
                                                    </div>
                                                </li>
                                                <li class="nk-list-item">
                                                    <div class="lead-text">{{ __('Billing Cycle') }}</div>
                                                    <div class="sub-text text-soft">{{ ucfirst($orderProduct->billing_cycle) }}</div>
                                                </li>
                                            </ul>

                                            @if ($orderProduct->cancellation()->exists())
                                                <div class="alert alert-pro alert-warning mt-4">
                                                    <div class="alert-text">
                                                        <h6 class="alert-heading">
                                                            {{ $orderProduct->status == 'cancelled' 
                                                                ? __('Product Cancelled') 
                                                                : __('Pending Cancellation') }}
                                                        </h6>
                                                        <p class="mb-0">{{ __('Cancellation Reason:') }} 
                                                            {{ $orderProduct->cancellation->reason ?? __('No reason provided') }}</p>
                                                        <p class="mb-0">{{ __('Cancellation Date:') }} 
                                                            {{ $orderProduct->cancellation->created_at->toDateString() }}</p>
                                                    </div>
                                                </div>
                                            @elseif ($orderProduct->cancellable)
                                                <div class="mt-4">
                                                    <button class="btn btn-danger btn-block" 
                                                            data-modal-target="cancellationModal"
                                                            data-modal-toggle="cancellationModal">
                                                        <em class="icon ni ni-cross-circle"></em>
                                                        <span>{{ __('Cancel Product') }}</span>
                                                    </button>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @isset($views['pages'])
                        <div class="nk-block mt-5">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->url() === route('clients.active-products.show', $orderProduct->id) ? 'active' : '' }}"
                                               href="{{ route('clients.active-products.show', [$orderProduct->id]) }}">
                                                {{ __('Overview') }}
                                            </a>
                                        </li>
                                        @foreach ($views['pages'] as $page)
                                            <li class="nav-item">
                                                <a class="nav-link {{ str_contains(request()->url(), $page['url']) ? 'active' : '' }}"
                                                   href="{{ route('clients.active-products.show', [$orderProduct->id]) }}/{{ $page['url'] }}">
                                                    {{ $page['name'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active">
                                            @isset($extensionLink)
                                                @isset($views['pages'])
                                                    @foreach ($views['pages'] as $page)
                                                        @if ($extensionLink == $page['url'])
                                                            @include($page['template'], $views['data'])
                                                        @endif
                                                    @endforeach
                                                @endisset
                                            @else
                                                @isset($views['template'])
                                                    @include($views['template'], $views['data'])
                                                @endisset
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>

    @if ($orderProduct->cancellable && !$orderProduct->cancellation()->exists())
        <x-modal id="cancellationModal">
            <x-slot name="title">
                {{ __('Cancel') }} {{ $product->name }}
            </x-slot>
            <form action="{{ route('clients.active-products.cancel', $orderProduct->id) }}"
                  method="POST" id="cancellationForm">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="cancellation_reason">{{ __('Reason (optional)') }}</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control" name="cancellation_reason" id="cancellation_reason"
                                  placeholder="{{ __('Reason for cancellation') }}"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="cancellation_type">{{ __('Cancellation Type') }}</label>
                    <div class="form-control-wrap">
                        <select class="form-select" name="cancellation_type" id="cancellation_type">
                            <option value="end_of_billing_period">
                                {{ __('End of Billing Period') }} ({{ $orderProduct->expiry_date->toDateString() }})
                            </option>
                            <option value="immediate">{{ __('Immediate') }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="button" class="btn btn-lg btn-danger" 
                            data-modal-toggle="confimrationModal" 
                            data-modal-hide="cancellationModal">
                        {{ __('Cancel') }} {{ $product->name }}
                    </button>
                </div>
            </form>
            <div class="text-sm text-gray-500 mt-3">
                {{ __('This will cancel the product and any associated services.') }}
            </div>
        </x-modal>

        <x-modal id="confimrationModal">
            <x-slot name="title">
                {{ __('Confirm Cancellation') }}
            </x-slot>
            <div class="alert alert-warning">
                <div class="alert-text">
                    <p>{{ __('Are you sure you want to cancel this product?') }}</p>
                    <p class="mb-0">{{ __('This will cancel (delete) the product and any associated services. This is irreversible.') }}</p>
                </div>
            </div>
            <div class="mt-4 text-right">
                <button class="btn btn-secondary" data-modal-toggle="confimrationModal">
                    {{ __('No') }}
                </button>
                <button class="btn btn-danger" onclick="document.getElementById('cancellationForm').submit();">
                    {{ __('Yes') }}
                </button>
            </div>
        </x-modal>
    @endif
</x-app-layout>
