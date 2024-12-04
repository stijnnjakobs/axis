<x-app-layout clients title="{{ __('Invoice') }}">
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <!-- Header -->
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Invoice') }} <strong class="text-primary small">#{{ $invoice->id }}</strong></h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>{{ __('Created At') }}: <span class="text-base">{{ $invoice->created_at->format('d M, Y H:i A') }}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <a href="{{ route('clients.invoice.index') }}" class="btn btn-outline-light bg-white">
                                                    <em class="icon ni ni-arrow-left"></em>
                                                    <span>{{ __('Back') }}</span>
                                                </a>
                                            </li>
                                            @if($invoice->status == 'pending')
                                                <li>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                                        <em class="icon ni ni-wallet"></em>
                                                        <span>{{ __('Pay Now') }}</span>
                                                    </button>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="invoice">
                            <div class="invoice-action">
                                <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" href="#" onclick="window.print()">
                                    <em class="icon ni ni-printer-fill"></em>
                                </a>
                            </div>
                            <div class="invoice-wrap">
                                <div class="invoice-brand text-center">
                                    <div class="invoice-logo">
                                        <x-application-logo />
                                    </div>
                                    <div class="invoice-brand-name mt-2">
                                        <div class="title">{{ config('app.name', 'Paymenter') }}</div>
                                    </div>
                                </div>

                                <div class="invoice-head">
                                    <div class="invoice-contact">
                                        <span class="overline-title">{{ __('Invoice To') }}</span>
                                        <div class="invoice-contact-info">
                                            <h4 class="title">{{ auth()->user()->name }}</h4>
                                            <ul class="list-plain">
                                                <li><em class="icon ni ni-map-pin-fill"></em>
                                                    <span>{{ auth()->user()->address }}<br>
                                                    {{ auth()->user()->zip }} {{ auth()->user()->city }}<br>
                                                    {{ auth()->user()->country }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="invoice-desc">
                                        <ul class="list-plain">
                                            <li class="invoice-id">
                                                <span>{{ __('Status') }}</span>:
                                                <span>
                                                    @if ($invoice->status == 'pending')
                                                        <span class="badge badge-dim badge-warning">{{ __('Pending') }}</span>
                                                    @elseif($invoice->status == 'cancelled')
                                                        <span class="badge badge-dim badge-danger">{{ __('Cancelled') }}</span>
                                                    @else
                                                        <span class="badge badge-dim badge-success">{{ __('Paid') }}</span>
                                                    @endif
                                                </span>
                                            </li>
                                            <li class="invoice-date">
                                                <span>{{ __('Due Date') }}</span>:
                                                <span>{{ $invoice->due_at ?? 'N/A' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="invoice-bills">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Description') }}</th>
                                                    <th class="text-center">{{ __('Quantity') }}</th>
                                                    <th class="text-end">{{ __('Rate') }}</th>
                                                    <th class="text-end">{{ __('Amount') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $discount = 0.00; @endphp
                                                @foreach ($products as $product)
                                                    @php
                                                        if ($product->original_price > $product->price) {
                                                            $discount += $product->original_price - $product->price;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $product->name ?? $product2->description }}</td>
                                                        <td class="text-center">{{ $product->quantity ?? $product2->quantity }}</td>
                                                        <td class="text-end">
                                                            @if ($product->discount)
                                                                <span class="text-danger text-decoration-line-through">
                                                                    <x-money :amount="number_format((float) $product->original_price, 2, '.', '')" />
                                                                </span><br>
                                                            @endif
                                                            <x-money :amount="number_format((float) $product->price, 2, '.', '')" />
                                                        </td>
                                                        <td class="text-end">
                                                            <x-money :amount="number_format((float) ($product->price * $product->quantity), 2, '.', '')" />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                @if($discount > 0)
                                                    <tr>
                                                        <td colspan="3" class="text-end">{{ __('Discount') }}</td>
                                                        <td class="text-end">
                                                            <x-money :amount="number_format((float) ($discount), 2, '.', '')" />
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if(config('settings::tax_enabled') && $tax->amount > 0)
                                                    <tr>
                                                        <td colspan="3" class="text-end">{{ $tax->name }} ({{ $tax->rate }}%)</td>
                                                        <td class="text-end">
                                                            <x-money :amount="$tax->amount" />
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="3" class="text-end fw-bold">{{ __('Total Amount') }}</td>
                                                    <td class="text-end fw-bold">
                                                        <x-money :amount="number_format((float) $total, 2, '.', '')" />
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="nk-notes ff-italic fs-12px text-soft mt-4">
                                    {{ __('Thanks for choosing us. We hope you enjoy your purchase.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    @if($invoice->status == 'pending')
        <div class="modal fade" id="paymentModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Payment Method') }}</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <form action="{{ route('clients.invoice.pay', $invoice->id) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">{{ __('Select Payment Method') }}</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="payment_method" id="payment_method">
                                        @if (config('settings::credits'))
                                            <option value="credits">{{ __('Pay with credits') }}</option>
                                        @endif
                                        @foreach ($gateways as $gateway)
                                            <option value="{{ $gateway->id }}">
                                                {{ isset($gateway->display_name) ? $gateway->display_name : $gateway->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="submit" class="btn btn-primary">{{ __('Proceed to Payment') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
