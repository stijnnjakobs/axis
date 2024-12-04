<x-app-layout clients title="{{ __('API') }}">
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <!-- Header -->
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('API Settings') }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{ __('Manage your API tokens and permissions') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="row g-gs">
                            <!-- Main Content -->
                            <div class="col-md-12">
                                <x-success />

                                <!-- Create Token -->
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-head">
                                            <h5 class="card-title">{{ __('Create API Token') }}</h5>
                                        </div>
                                        <form method="POST" action="{{ route('clients.api.create') }}">
                                            @csrf
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="name">{{ __('Token Name') }}</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Token Name') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ __('Permissions') }}</label>
                                                        <div class="row g-3">
                                                            @foreach($permissions as $permission)
                                                                <div class="col-md-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" 
                                                                               class="custom-control-input"
                                                                               name="permissions[{{ $permission }}]"
                                                                               id="{{ $permission }}">
                                                                        <label class="custom-control-label" for="{{ $permission }}">
                                                                            {{ $permission }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">
                                                        <em class="icon ni ni-plus"></em>
                                                        <span>{{ __('Create Token') }}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Manage Tokens -->
                                <div class="card card-bordered mt-4">
                                    <div class="card-inner">
                                        <div class="card-head">
                                            <h5 class="card-title">{{ __('Manage API Tokens') }}</h5>
                                        </div>
                                        @if ($tokens->isEmpty())
                                            <div class="text-center text-soft">
                                                <em class="icon ni ni-info fs-24px"></em>
                                                <p class="mt-2">{{ __('No tokens created yet') }}</p>
                                            </div>
                                        @else
                                            <div class="nk-tb-list">
                                                @foreach($tokens as $token)
                                                    <div class="card card-bordered mb-3">
                                                        <div class="card-inner">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <h6 class="mb-0">{{ $token->name }}</h6>
                                                                    @if ($token->last_used_at)
                                                                        <span class="text-soft fs-13px">
                                                                            {{ __('Last used') }} {{ $token->last_used_at->diffForHumans() }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <form method="POST" action="{{ route('clients.api.delete', $token->id) }}" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-icon btn-trigger text-danger">
                                                                        <em class="icon ni ni-trash"></em>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
