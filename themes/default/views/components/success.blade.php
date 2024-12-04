@if (session('success'))
    <div class="alert alert-pro alert-success alert-dismissible alert-icon">
        <em class="icon ni ni-check-circle"></em>
        <strong>{{ session('success') }}</strong>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-pro alert-danger alert-dismissible alert-icon">
        <em class="icon ni ni-cross-circle"></em>
        <strong>{{ session('error') }}</strong>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
@endif

@props(['errors'])

@if ($errors->any())
    <div class="alert alert-pro alert-danger alert-dismissible alert-icon">
        <em class="icon ni ni-alert-circle"></em>
        <div>
            <strong>{{ __('Something went wrong:') }}</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            // Add initial transform
            alert.style.transform = 'translateY(100%)';
            alert.style.position = 'fixed';
            alert.style.bottom = '2rem';
            alert.style.left = '50%';
            alert.style.transform = 'translateX(-50%)';
            alert.style.zIndex = '1000';
            alert.style.minWidth = '300px';
            alert.style.maxWidth = '600px';
            
            // Trigger animation
            requestAnimationFrame(function() {
                alert.style.transition = 'all 0.3s ease-in-out';
                alert.style.transform = 'translate(-50%, 0)';
            });

            // Auto dismiss after 5 seconds
            setTimeout(function() {
                alert.style.transform = 'translate(-50%, 200%)';
                alert.style.opacity = '0';
                
                // Remove element after animation
                alert.addEventListener('transitionend', function() {
                    alert.remove();
                }, { once: true });
            }, 5000);

            // Handle manual dismiss
            const closeBtn = alert.querySelector('.close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    alert.style.transform = 'translate(-50%, 200%)';
                    alert.style.opacity = '0';
                    
                    alert.addEventListener('transitionend', function() {
                        alert.remove();
                    }, { once: true });
                });
            }
        });
    });
</script>

<style>
    .alert {
        transition: all 0.3s ease-in-out;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
    }
    .alert.alert-success {
        border-left: 4px solid #1ee0ac;
    }
    .alert.alert-danger {
        border-left: 4px solid #e85347;
    }
    .alert .close {
        padding: 0.75rem;
        margin: -0.75rem -0.75rem -0.75rem auto;
    }
    .alert ul {
        margin: 0;
        padding-left: 1.25rem;
    }
    .alert ul li {
        margin-top: 0.25rem;
    }
</style>
