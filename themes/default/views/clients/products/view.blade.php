<x-app-layout clients title="{{ __('Product') }} {{ $product->name }}">
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <x-success class="mt-4" />

                    <!-- Header Section -->
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
                                                        <span>{{ __('Upgrade') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($link)
                                                <li>
                                                    <a href="{{ $link }}" class="btn btn-dim btn-outline-primary" target="_blank">
                                                        <em class="icon ni ni-signin"></em>
                                                        <span>{{ __('Access Panel') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($orderProduct->getOpenInvoices()->count() > 0)
                                                <li>
                                                    <a href="{{ route('clients.invoice.show', $orderProduct->getOpenInvoices()->first()->id) }}" 
                                                       class="btn btn-dim btn-outline-danger">
                                                        <em class="icon ni ni-file-text"></em>
                                                        <span>{{ __('Unpaid Invoice') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <!-- Product Details -->
                            <div class="col-lg-7">
                                <div class="card card-bordered h-100">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-3">
                                            <div class="card-title">
                                                <h6 class="title">{{ __('Product Details') }}</h6>
                                            </div>
                                        </div>

                                        <div class="py-2">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-box"></em>
                                                            </div>
                                                            <input type="text" class="form-control" value="{{ $product->name }}" readonly>
                                                            <label class="form-label text-muted">{{ __('Product Name') }}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-sign-mxn"></em>
                                                            </div>
                                                            <input type="text" class="form-control" value="{{ $orderProduct->price }}" showFree="true" readonly/>
                                                            <label class="form-label text-muted">{{ __('Price') }}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted">{{ __('Description') }}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-note bg-lighter p-3 rounded">
                                                                @markdownify($product->description)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Information -->
                            <div class="col-lg-5">
                                <div class="card card-bordered h-100">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-3">
                                            <div class="card-title">
                                                <h6 class="title">{{ __('Status Information') }}</h6>
                                            </div>
                                        </div>

                                        @if ($orderProduct->expiry_date)
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <div class="nk-order-info">
                                                        <div class="sub-text">{{ __('Due Date') }}</div>
                                                        <div class="lead-text">{{ $orderProduct->expiry_date->toDateString() }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="nk-order-info">
                                                        <div class="sub-text">{{ __('Status') }}</div>
                                                        <div class="lead-text">
                                                            <span class="badge badge-dot badge-{{ $orderProduct->status == 'paid' ? 'success' : 'warning' }}">
                                                                {{ $orderProduct->status == 'paid' ? __('Active') : ucfirst($orderProduct->status) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="nk-order-info">
                                                        <div class="sub-text">{{ __('Billing Cycle') }}</div>
                                                        <div class="lead-text text-soft">{{ ucfirst($orderProduct->billing_cycle) }}</div>
                                                    </div>
                                                </div>
                                            </div>

                                        @if ($orderProduct->cancellation()->exists())
                                        <br>
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <h5 class="card-title">
                                                    {{ $orderProduct->status == 'cancelled' ? __('Product Cancelled') : __('Pending Cancellation') }}
                                                </h5>
                                                <div class="card-text">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <em class="icon ni ni-info me-2 text-warning"></em>
                                                        <span>{{ __('Reason:') }} {{ $orderProduct->cancellation->reason ?? __('No reason provided') }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <em class="icon ni ni-calendar me-2 text-warning"></em>
                                                        <span>{{ __('Date:') }} {{ $orderProduct->cancellation->created_at->toDateString() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                            @elseif ($orderProduct->cancellable)
                                                <div class="mt-4">
                                                    <button class="btn btn-danger btn-block"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#cancellationModal">
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

                    <!-- Extension Tabs -->
                    <!-- Extension Tabs -->
                    @isset($views['pages'])
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <ul class="nav nav-tabs nav-tabs-s2 justify-content-start">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->url() === route('clients.active-products.show', $orderProduct->id) ? 'active' : '' }}"
                                           href="{{ route('clients.active-products.show', [$orderProduct->id]) }}">
                                            <em class="icon ni ni-home me-1"></em>
                                            <span>{{ __('Overview') }}</span>
                                        </a>
                                    </li>
                                    @foreach ($views['pages'] as $page)
                                    <li class="nav-item">
                                        <a class="nav-link {{ str_contains(request()->url(), $page['url']) ? 'active' : '' }}"
                                           href="{{ route('clients.active-products.show', [$orderProduct->id]) }}/{{ $page['url'] }}">
                                            <span>{{ $page['name'] }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-4">
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

    <!-- Cancellation Modals -->
    @if ($orderProduct->cancellable && !$orderProduct->cancellation()->exists())
        <div class="modal fade" id="cancellationModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Cancel') }} {{ $product->name }}</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <form action="{{ route('clients.active-products.cancel', $orderProduct->id) }}"
                          method="POST" id="cancellationForm">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="cancellation_reason">{{ __('Reason (optional)') }}</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control" name="cancellation_reason" id="cancellation_reason"
                                              placeholder="{{ __('Why are you cancelling?') }}"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="cancellation_type">{{ __('When to Cancel') }}</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="cancellation_type" id="cancellation_type">
                                        <option value="end_of_billing_period">
                                            {{ __('End of Billing Period') }} ({{ $orderProduct->expiry_date->toDateString() }})
                                        </option>
                                        <option value="immediate">{{ __('Immediate') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="note-text mt-3">
                                <em class="icon ni ni-info"></em>
                                <span>{{ __('This action will cancel the product and any associated services.') }}</span>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                                {{ __('Request Cancellation') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmationModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Confirm Cancellation') }}</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-pro alert-warning">
                            <div class="alert-text">
                                <h6>{{ __('Are you sure?') }}</h6>
                                <p>{{ __('This will cancel the product and any associated services. This action cannot be undone.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Go Back') }}</button>
                        <button type="button" class="btn btn-danger" onclick="document.getElementById('cancellationForm').submit();">
                            {{ __('Yes, Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
