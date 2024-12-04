<x-app-layout clients title="{{ __('Create Ticket') }}">
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <!-- Header -->
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Create Support Ticket') }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{ __('Submit a new support ticket for assistance') }}</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('clients.tickets.index') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
                                    <em class="icon ni ni-arrow-left"></em>
                                    <span>{{ __('Back') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket Form -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form method="POST" action="{{ route('clients.tickets.store') }}" class="form-validate">
                                    @csrf
                                    <div class="row g-gs">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="title">{{ __('Title') }}</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-ticket"></em>
                                                    </div>
                                                    <input type="text" 
                                                           class="form-control" 
                                                           id="title" 
                                                           name="title" 
                                                           value="{{ old('title') }}" 
                                                           required 
                                                           placeholder="{{ __('Enter ticket subject') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="priority">{{ __('Priority') }}</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-bar-chart"></em>
                                                    </div>
                                                    <select class="form-select js-select2" id="priority" name="priority" required>
                                                        <option value="low" @if(old('priority') == 'low') selected @endif>
                                                            {{ __('Low') }}
                                                        </option>
                                                        <option value="medium" @if(old('priority') == 'medium') selected @endif>
                                                            {{ __('Medium') }}
                                                        </option>
                                                        <option value="high" @if(old('priority') == 'high') selected @endif>
                                                            {{ __('High') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="department">{{ __('Department') }}</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-building"></em>
                                                    </div>
                                                    <select class="form-select js-select2" id="department" name="department" required>
                                                        <option value="support" @if(old('department') == 'support') selected @endif>
                                                            {{ __('Technical Support') }}
                                                        </option>
                                                        <option value="billing" @if(old('department') == 'billing') selected @endif>
                                                            {{ __('Billing') }}
                                                        </option>
                                                        <option value="sales" @if(old('department') == 'sales') selected @endif>
                                                            {{ __('Sales') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="description">{{ __('Description') }}</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control form-control-lg" 
                                                              id="description" 
                                                              name="description" 
                                                              required 
                                                              rows="5"
                                                              placeholder="{{ __('Describe your issue in detail') }}">{{ old('description') }}</textarea>
                                                </div>
                                                <div class="form-note">
                                                    {{ __('Please provide as much detail as possible to help us assist you better.') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <em class="icon ni ni-send"></em>
                                                    <span>{{ __('Submit Ticket') }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
