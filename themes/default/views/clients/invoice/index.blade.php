<x-app-layout title="Invoices" clients>
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <x-success class="mt-4" />

                    <!-- Header Section -->
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Invoices') }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{ __('View and manage your billing history') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Invoices Table -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                @if ($invoices->count() > 0)
                                    <div class="card-inner p-0">
                                        <div class="nk-tb-list nk-tb-ulist">
                                            <div class="nk-tb-item nk-tb-head">
                                                <div class="nk-tb-col"><span class="sub-text">{{ __('ID') }}</span></div>
                                                <div class="nk-tb-col"><span class="sub-text">{{ __('Total') }}</span></div>
                                                <div class="nk-tb-col"><span class="sub-text">{{ __('Created Date') }}</span></div>
                                                <div class="nk-tb-col"><span class="sub-text">{{ __('Status') }}</span></div>
                                                <div class="nk-tb-col text-end"><span class="sub-text">{{ __('Actions') }}</span></div>
                                            </div>

                                            @foreach ($invoices->sortByDesc('status') as $invoice)
                                                @if ($invoice->items->count() == 0)
                                                    @continue
                                                @endif
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <span class="tb-lead">#{{ $invoice->id }}</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-amount"><x-money :amount="$invoice->total()" /></span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span>{{ $invoice->created_at->format('M d, Y') }}</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        @if (ucfirst($invoice->status) == 'Pending')
                                                            <span class="badge badge-dim bg-warning">
                                                                <em class="icon ni ni-clock"></em>
                                                                <span>{{ __('Pending') }}</span>
                                                            </span>
                                                        @elseif (ucfirst($invoice->status) == 'Paid')
                                                            <span class="badge badge-dim bg-success">
                                                                <em class="icon ni ni-check"></em>
                                                                <span>{{ __('Paid') }}</span>
                                                            </span>
                                                        @elseif (ucfirst($invoice->status) == 'Cancelled')
                                                            <span class="badge badge-dim bg-danger">
                                                                <em class="icon ni ni-cross"></em>
                                                                <span>{{ __('Cancelled') }}</span>
                                                            </span>
                                                        @else
                                                            <span class="badge badge-dim bg-secondary">
                                                                {{ ucfirst($invoice->status) }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <a href="{{ route('clients.invoice.show', $invoice->id) }}" 
                                                           class="btn btn-sm btn-primary">
                                                            <em class="icon ni ni-eye"></em>
                                                            <span>{{ __('View') }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="card-inner">
                                        <div class="nk-empty">
                                            <h5 class="nk-empty-title">{{ __('No Invoices Found') }}</h5>
                                            <p class="nk-empty-text">
                                                {{ __('You don\'t have any invoices yet.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
