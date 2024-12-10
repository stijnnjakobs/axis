<x-app-layout title="Tickets" clients>
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <x-success class="mt-4" />

                    <!-- Header Section -->
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Support Tickets') }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{ __('View and manage your support tickets') }}</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">

                                                <a href="{{ route('clients.tickets.create') }}" class="btn btn-primary">
                                                    <em class="icon ni ni-plus"></em>
                                                    <span>{{ __('Create Ticket') }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">{{ __('Total Tickets') }}</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ $tickets->count() }}</div>
                                                    <div class="nk-ecwg6-ck">
                                                        <em class="icon ni ni-ticket-fill text-primary"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">{{ __('Open Tickets') }}</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ $tickets->where('status', 'open')->count() }}</div>
                                                    <div class="nk-ecwg6-ck">
                                                        <em class="icon ni ni-clock text-success"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">{{ __('On Hold') }}</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ $tickets->where('status', 'on-hold')->count() }}</div>
                                                    <div class="nk-ecwg6-ck">
                                                        <em class="icon ni ni-pause-circle text-warning"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg6">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">{{ __('Closed') }}</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ $tickets->where('status', 'closed')->count() }}</div>
                                                    <div class="nk-ecwg6-ck">
                                                        <em class="icon ni ni-check-circle text-danger"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tickets List -->
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                @if ($tickets->count() > 0)

                                    <div class="card-inner p-0">
                                        <div class="nk-tb-list nk-tb-ulist">
                                            <div class="nk-tb-item nk-tb-head">
                                                <div class="nk-tb-col"><span class="sub-text">{{ __('Subject') }}</span></div>
                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">{{ __('Status') }}</span></div>
                                                <div class="nk-tb-col tb-col-lg"><span class="sub-text">{{ __('Last Updated') }}</span></div>
                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">{{ __('Messages') }}</span></div>
                                                <div class="nk-tb-col text-end"><span class="sub-text">{{ __('Actions') }}</span></div>
                                            </div>

                                            @foreach ($tickets as $ticket)
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <a href="{{ route('clients.tickets.show', $ticket->id) }}">
                                                            <div class="user-card">
                                                                <div class="user-avatar {{ 'bg-' . ['primary', 'purple', 'success', 'pink'][array_rand(['primary', 'purple', 'success', 'pink'])] }}">
                                                                    <span>{{ strtoupper(substr($ticket->title, 0, 2)) }}</span>
                                                                </div>
                                                                <div class="user-info">
                                                                    <span class="tb-lead">{{ $ticket->title }} 
                                                                        <span class="dot dot-success d-md-none ms-1"></span>
                                                                    </span>
                                                                    <span class="text-soft">#{{ $ticket->id }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-md">
                                                        <span class="badge badge-dim rounded-pill
                                                            @if($ticket->status === 'open') bg-success
                                                            @elseif($ticket->status === 'closed') bg-danger
                                                            @elseif($ticket->status === 'on-hold') bg-warning
                                                            @else bg-info @endif">
                                                            <em class="icon ni ni-circle-fill"></em>
                                                            <span>{{ ucwords(str_replace('-', ' ', $ticket->status)) }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="text-soft">{{ $ticket->updated_at->diffForHumans() }}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-md">
                                                        <span class="tb-status text-soft">
                                                            <em class="icon ni ni-chat-fill me-1"></em>
                                                            {{ $ticket->messages->count() }}
                                                        </span>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li>
                                                                <a href="{{ route('clients.tickets.show', $ticket->id) }}"
                                                                   class="btn btn-sm btn-icon btn-trigger">
                                                                    <em class="icon ni ni-eye"></em>
                                                                </a>
                                                            </li>
                                                            @if($ticket->status !== 'closed')
                                                                <li>
                                                                    <a href="#" class="btn btn-sm btn-icon btn-trigger">
                                                                        <em class="icon ni ni-cross-circle"></em>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="card-inner">
                                        <div class="nk-empty">
                                            <p class="text-center nk-empty-text w-50 mx-auto">
                                                {{ __('You haven\'t created any support tickets yet. Need help? Create a new ticket and our support team will assist you.') }}
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
