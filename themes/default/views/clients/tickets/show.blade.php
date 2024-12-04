<x-app-layout clients title="{{ __('Ticket Details') }}">
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <!-- Header -->
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Ticket') }} <strong class="text-primary small">#{{ $ticket->id }}</strong></h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>{{ __('Created At') }}: <span class="text-base">{{ $ticket->created_at->format('d M, Y H:i A') }}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <a href="{{ route('clients.tickets.index') }}" class="btn btn-outline-light bg-white">
                                                    <em class="icon ni ni-arrow-left"></em>
                                                    <span>{{ __('Back') }}</span>
                                                </a>
                                            </li>
                                            @if($ticket->status !== 'closed')
                                                <li>
                                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#closeTicketModal">
                                                        <em class="icon ni ni-cross-circle"></em>
                                                        <span>{{ __('Close Ticket') }}</span>
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
                        <div class="card card-bordered">
                            <!-- Ticket Info -->
                            <div class="card-inner border-bottom">
                                <div class="row g-3 align-center justify-between">
                                    <div class="col-lg-6">
                                        <div class="ticket-info">
                                            <h5 class="title">{{ $ticket->title }}</h5>
                                            <ul class="list-plain text-soft">
                                                <li><em class="icon ni ni-user-alt"></em> <span>{{ $ticket->user->name }}</span></li>
                                                <li><em class="icon ni ni-clock"></em> <span>{{ $ticket->created_at->diffForHumans() }}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 text-lg-end">
                                        <span class="badge badge-dim rounded-pill 
                                            @if($ticket->status === 'open') bg-success
                                            @elseif($ticket->status === 'closed') bg-danger
                                            @elseif($ticket->status === 'on-hold') bg-warning
                                            @else bg-info @endif">
                                            {{ ucwords(str_replace('-', ' ', $ticket->status)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Messages -->
                            <div class="nk-chat-panel" style="height: calc(100vh - 400px); overflow-y: auto;" data-simplebar>
                                @foreach($ticket->messages()->with('user')->get() as $message)
                                    <div class="nk-chat-item {{ $message->user->role_id == 1 ? 'is-admin' : '' }}">
                                        <div class="nk-chat-bubble">
                                            <div class="nk-chat-msg">{!! Str::markdown($message->message) !!}</div>
                                            @if($message->files->count() > 0)
                                                <div class="nk-chat-attachments">
                                                    <div class="nk-chat-attachment-list">
                                                        @foreach($message->files as $file)
                                                            @php
                                                                $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                                            @endphp
                                                            
                                                            @if($isImage)
                                                                <div class="nk-chat-attachment">
                                                                    <div class="nk-chat-attachment-item">
                                                                        <a href="{{ route('clients.tickets.download', $file->id) }}" 
                                                                           class="nk-chat-attachment-img"
                                                                           target="_blank">
                                                                            <img src="{{ route('clients.tickets.download', $file->id) }}" 
                                                                                 alt="{{ $file->name }}"
                                                                                 class="img-fluid">
                                                                        </a>
                                                                        <div class="nk-chat-attachment-info">
                                                                            <a href="{{ route('clients.tickets.download', $file->id) }}" 
                                                                               class="btn btn-sm btn-icon btn-outline-light">
                                                                                <em class="icon ni ni-download"></em>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="nk-chat-attachment">
                                                                    <a href="{{ route('clients.tickets.download', $file->id) }}" 
                                                                       class="nk-chat-attachment-link">
                                                                        <div class="nk-chat-attachment-item">
                                                                            <div class="nk-chat-attachment-icon">
                                                                                <em class="icon ni ni-{{ getFileIcon($extension) }}"></em>
                                                                            </div>
                                                                            <div class="nk-chat-attachment-title">
                                                                                <span class="title">{{ $file->name }}</span>
                                                                                <span class="size">{{ formatFileSize($file->size) }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="nk-chat-meta">
                                                <span class="user">{{ $message->user->name }}</span>
                                                <span class="time">{{ $message->created_at->format('d M, Y H:i A') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Reply Form -->
                            @if($ticket->status !== 'closed')
                                <div class="nk-chat-editor border-top">
                                    <form action="{{ route('clients.tickets.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div id="file-preview" class="nk-chat-editor-attachments"></div>
                                        <div class="nk-chat-editor-form">
                                            <div class="form-control-wrap">
                                                <textarea class="form-control form-control-simple no-resize" 
                                                          name="message"
                                                          rows="3"
                                                          placeholder="{{ __('Type your reply...') }}"
                                                          required></textarea>
                                            </div>
                                        </div>
                                        <div class="nk-chat-editor-tools">
                                            <ul class="nk-chat-editor-buttons g-2">
                                                <li>
                                                    <label class="btn btn-sm btn-icon btn-outline-light" for="file-upload">
                                                        <em class="icon ni ni-clip-v"></em>
                                                    </label>
                                                    <input type="file" 
                                                           name="files[]" 
                                                           multiple 
                                                           id="file-upload"
                                                           accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx"
                                                           style="display: none;">
                                                </li>
                                                <li>
                                                    <button type="submit" class="btn btn-primary">
                                                        <em class="icon ni ni-send-alt"></em>
                                                        <span>{{ __('Send') }}</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Close Ticket Modal -->
    @include('clients.tickets.partials.close-modal')

    <style>
    .nk-chat-panel {
        padding: 1.5rem;
        background: #f5f6fa;
    }
    .nk-chat-item {
        margin-bottom: 1.5rem;
    }
    .nk-chat-bubble {
        max-width: 85%;
        padding: 1rem 1.25rem;
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    .nk-chat-item.is-admin .nk-chat-bubble {
        background: #e4efff;
        margin-left: auto;
    }
    .nk-chat-msg {
        margin-bottom: 0.5rem;
    }
    .nk-chat-msg p:last-child {
        margin-bottom: 0;
    }
    .nk-chat-meta {
        display: flex;
        gap: 1rem;
        font-size: 12px;
        color: #8094ae;
        margin-top: 0.5rem;
    }
    .nk-chat-attachments {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(0,0,0,0.05);
    }
    .nk-chat-attachment-list {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .nk-chat-attachment {
        position: relative;
    }
    .nk-chat-attachment-img {
        display: block;
        border-radius: 4px;
        overflow: hidden;
        position: relative;
    }
    .nk-chat-attachment-img img {
        max-width: 200px;
        max-height: 150px;
        object-fit: cover;
        border-radius: 4px;
    }
    .nk-chat-attachment-info {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        opacity: 0;
        transition: opacity 0.2s;
    }
    .nk-chat-attachment:hover .nk-chat-attachment-info {
        opacity: 1;
    }
    .nk-chat-attachment-link {
        display: block;
        padding: 0.75rem;
        background: rgba(101, 118, 255, 0.1);
        border-radius: 4px;
        transition: all 0.2s;
    }
    .nk-chat-attachment-link:hover {
        background: rgba(101, 118, 255, 0.15);
    }
    .nk-chat-attachment-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .nk-chat-attachment-icon {
        font-size: 1.5rem;
        color: #6576ff;
    }
    .nk-chat-attachment-title {
        display: flex;
        flex-direction: column;
    }
    .nk-chat-attachment-title .title {
        font-size: 0.875rem;
        font-weight: 500;
        color: #364a63;
    }
    .nk-chat-attachment-title .size {
        font-size: 0.75rem;
        color: #8094ae;
    }
    .nk-chat-editor {
        padding: 1rem;
        background: #fff;
    }
    .nk-chat-editor-attachments {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding: 0.5rem 0;
    }
    .nk-chat-editor-form {
        margin-bottom: 0.5rem;
    }
    .nk-chat-editor-tools {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .file-item {
        background: #f5f6fa;
        border: 1px solid #e5e9f2;
        border-radius: 4px;
        padding: 0.25rem 0.5rem;
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .file-item .icon {
        font-size: 1rem;
        color: #6576ff;
    }
    .file-item .remove-file {
        color: #e85347;
        cursor: pointer;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file-upload');
        const previewContainer = document.getElementById('file-preview');
        
        if (fileInput && previewContainer) {
            fileInput.addEventListener('change', function() {
                previewContainer.innerHTML = '';
                
                Array.from(this.files).forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'col-sm-6 col-lg-4';
                    
                    const fileExt = file.name.split('.').pop().toLowerCase();
                    const iconClass = getFileIcon(fileExt);
                    
                    fileItem.innerHTML = `
                        <div class="file-item">
                            <em class="icon ni ${iconClass}"></em>
                            <div class="file-info">
                                <span class="file-name text-ellipsis">${file.name}</span>
                                <span class="file-size text-soft">${formatFileSize(file.size)}</span>
                            </div>
                            <a href="#" class="remove-file" data-index="${index}">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                    `;
                    
                    previewContainer.appendChild(fileItem);
                });
                
                // Add remove functionality
                document.querySelectorAll('.remove-file').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const index = this.dataset.index;
                        this.closest('.col-sm-6').remove();
                        
                        // Create new FileList without removed file
                        const dt = new DataTransfer();
                        Array.from(fileInput.files).forEach((file, fileIndex) => {
                            if (fileIndex != index) dt.items.add(file);
                        });
                        fileInput.files = dt.files;
                    });
                });
            });
        }
        
        function getFileIcon(ext) {
            const icons = {
                'pdf': 'file-pdf',
                'doc': 'file-doc',
                'docx': 'file-doc',
                'xls': 'file-xls',
                'xlsx': 'file-xls',
                'zip': 'file-zip',
                'rar': 'file-zip',
                'txt': 'file-text',
            };
            return icons[ext.toLowerCase()] || 'file';
        }
        
        function formatFileSize(bytes) {
            if (!bytes) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    });
    </script>
</x-app-layout>