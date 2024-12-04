<div class="modal fade" id="closeTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Close Ticket') }}</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning alert-icon">
                    <em class="icon ni ni-alert-circle"></em>
                    <p>{{ __('Are you sure you want to close this ticket? This action cannot be undone.') }}</p>
                </div>
                <p class="text-soft">{{ __('If you need further assistance in the future, you can always create a new ticket.') }}</p>
            </div>
            <div class="modal-footer bg-light">
                <form action="{{ route('clients.tickets.close', $ticket->id) }}" method="POST">
                    @csrf
                    <div class="btn-group">
                        <button type="button" class="btn btn-dim btn-outline-light" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <em class="icon ni ni-cross-circle"></em>
                            <span>{{ __('Close Ticket') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.modal-dialog-centered {
    display: flex;
    align-items: center;
    min-height: calc(100% - 3.5rem);
}

.alert-warning.alert-icon {
    position: relative;
    padding-left: 3.25rem;
}

.alert-warning.alert-icon .icon {
    position: absolute;
    left: 1rem;
    top: 1rem;
    font-size: 1.25rem;
}

.btn-group {
    display: flex;
    gap: 0.5rem;
}
</style> 