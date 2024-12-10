<div class="nk-iv-scheme-item">
    <div class="nk-iv-scheme-icon">
        @if ($product->image !== 'null')
            <img src="{{ $product->image }}" 
                 alt="{{ $product->name }}" 
                 class="rounded"
                 style="width: 40px; height: 40px; object-fit: cover;"
                 onerror="removeElement(this);">
        @else
            <em class="icon ni ni-box"></em>
        @endif
    </div>

    <div class="nk-iv-scheme-info">
        <div class="nk-iv-scheme-name">{{ $product->name }}</div>
        <div class="nk-iv-scheme-desc">
            <span class="amount"><x-money :amount="$product->price()" showFree="true" /></span>
        </div>
    </div>

    <div class="nk-iv-scheme-term">
        <div class="nk-iv-scheme-start nk-iv-scheme-order">
            <span class="nk-iv-scheme-label text-soft">{{ __('Category') }}</span>
            <span class="nk-iv-scheme-value">{{ $product->category->name }}</span>
        </div>
        @if ($product->stock_enabled)
            <div class="nk-iv-scheme-end nk-iv-scheme-order">
                <span class="nk-iv-scheme-label text-soft">{{ __('Stock') }}</span>
                <span class="nk-iv-scheme-value">{{ $product->stock }}</span>
            </div>
        @endif
    </div>

    <div class="nk-iv-scheme-amount">
        <div class="nk-iv-scheme-amount-a nk-iv-scheme-order">
            <span class="nk-iv-scheme-label text-soft">{{ __('Description') }}</span>
            <span class="nk-iv-scheme-value text-soft fs-13px">@markdownify($product->description)</span>
        </div>
    </div>

    <div class="nk-iv-scheme-more">
        @if ($product->stock_enabled && $product->stock <= 0)
            <button class="btn btn-icon btn-lg btn-round btn-dim btn-outline-light disabled">
                <em class="icon ni ni-alert-circle"></em>
            </button>
        @else
            <button class="btn btn-icon btn-lg btn-round btn-dim @if ($added) btn-success @else btn-primary @endif"
                    wire:click="addToCart">
                @if ($added)
                    <em class="icon ni ni-check-circle"></em>
                @else
                    <em class="icon ni ni-cart"></em>
                @endif
            </button>
        @endif
    </div>

    @if ($product->stock_enabled && $product->stock <= 3 && $product->stock > 0)
        <div class="nk-iv-scheme-progress">
            <div class="progress-bar bg-warning" data-progress="100"></div>
        </div>
    @endif
    <style>
        .nk-iv-scheme-item {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            padding: 1.5rem;
            background: #fff;
            border: 1px solid #dbdfea;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .nk-iv-scheme-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f6fa;
            border-radius: 4px;
            margin-right: 1rem;
        }
        .nk-iv-scheme-icon .icon {
            font-size: 1.4rem;
            color: #6576ff;
        }
        .nk-iv-scheme-info {
            flex-grow: 1;
            min-width: 160px;
        }
        .nk-iv-scheme-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: #364a63;
            margin-bottom: 0.25rem;
        }
        .nk-iv-scheme-desc {
            font-size: 0.875rem;
            color: #6576ff;
            font-weight: 500;
        }
        .nk-iv-scheme-term {
            padding: 0 1.5rem;
            border-left: 1px solid #dbdfea;
        }
        .nk-iv-scheme-amount {
            padding: 0 1.5rem;
            border-left: 1px solid #dbdfea;
            flex-grow: 1;
        }
        .nk-iv-scheme-more {
            margin-left: auto;
            padding-left: 1.5rem;
        }
        .nk-iv-scheme-label {
            display: block;
            font-size: 0.75rem;
            margin-bottom: 0.25rem;
        }
        .nk-iv-scheme-value {
            display: block;
            font-size: 0.875rem;
        }
        .btn-success {
            color: #1ee0ac;
            background-color: rgba(30,224,172,0.15);
        }
        .btn-success:hover {
            color: #1ee0ac;
            background-color: rgba(30,224,172,0.25);
        }
    </style>



</div>

