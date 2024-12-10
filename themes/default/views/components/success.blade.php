@if (session('success'))
    <div class="alert alert-success alert-icon">
        <em class="icon ni ni-check-circle"></em>
        <strong>{{ session('success') }}</strong>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-icon">
        <em class="icon ni ni-cross-circle"></em>
        <strong>{{ session('error') }}</strong>
    </div>
@endif

@props(['errors'])

@if ($errors->any())
    <div class="alert alert-danger alert-icon">
        <em class="icon ni ni-alert-circle"></em>
        <div>
            <strong>{{ __('Something went wrong:') }}</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<style>
    .alert {
        position: relative;
        padding: 1rem 1.25rem;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    .alert-icon {
        padding-left: 3.25rem;
    }
    .alert-icon > .icon {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.25rem;
        line-height: 1;
    }
    .alert-success {
        color: #1ee0ac;
        background-color: rgba(30, 224, 172, 0.1);
        border-color: rgba(30, 224, 172, 0.15);
    }
    .alert-danger {
        color: #e85347;
        background-color: rgba(232, 83, 71, 0.1);
        border-color: rgba(232, 83, 71, 0.15);
    }
    .alert ul {
        padding-left: 1.5rem;
        margin-bottom: 0;
    }
    .alert ul li {
        font-size: 0.875rem;
    }
</style>
