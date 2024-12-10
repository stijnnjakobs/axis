<div class="nk-block">
    <div class="row g-gs">
        <!-- Account Details -->
        <div class="col-lg-5">
            <div class="card card-bordered h-100">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-3">
                        <div class="card-title">
                            <h6 class="title">{{ __('Account Details') }}</h6>
                        </div>
                    </div>
                    
                    <div class="py-2">
                        <div class="row g-3">

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-package"></em>
                                        </div>
                                        <input type="text" class="form-control" value="{{$limit['package']}}" readonly>
                                        <label class="form-label text-muted">{{ __('Package Name') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-user"></em>
                                        </div>
                                        <input type="text" class="form-control" value="{{$user['username']}}" readonly>
                                        <label class="form-label text-muted">{{ __('Username') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-lock"></em>
                                        </div>
                                        <input type="text" class="form-control" value="{{$user['password']}}" readonly>
                                        <label class="form-label text-muted">{{ __('Password') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-globe"></em>
                                        </div>
                                        <input type="text" class="form-control" value="{{$user['domain']}}" readonly>
                                        <label class="form-label text-muted">{{ __('Main Domain') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-link"></em>
                                        </div>
                                        <input type="text" class="form-control" value="{{$user['panel']}}" readonly>
                                        <label class="form-label text-muted">{{ __('Panel URL') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- Usage Statistics -->
        <div class="col-lg-7">
            <div class="card card-bordered">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-3">
                        <div class="card-title">
                            <h6 class="title">{{ __('Resource Usage') }}</h6>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="card bg-lighter">
                                <div class="card-inner py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-2">
                                            <div class="text-muted fs-12px mb-1">{{ __('Bandwidth') }}</div>
                                            <div class="d-flex align-items-center">
                                                <div class="lead-text mb-0">{{$stats['bandwidth']}}</div>
                                                <small class="text-muted ms-1">MB</small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            @if($limit['bandwidth'] == "unlimited")
                                            <span class="badge bg-primary">{{ __('Unlimited') }}</span>
                                            @else
                                            <div class="fs-11px text-muted">{{ __('Limit:') }} {{$limit['bandwidth']}} MB</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card bg-lighter">
                                <div class="card-inner py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-2">
                                            <div class="text-muted fs-12px mb-1">{{ __('Disk Space') }}</div>
                                            <div class="d-flex align-items-center">
                                                <div class="lead-text mb-0">{{$stats['quota']}}</div>
                                                <small class="text-muted ms-1">MB</small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            @if($limit['quota'] == "unlimited")
                                            <span class="badge bg-primary">{{ __('Unlimited') }}</span>
                                            @else
                                            <div class="fs-11px text-muted">{{ __('Limit:') }} {{$limit['quota']}} MB</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card bg-lighter">
                                <div class="card-inner py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-2">
                                            <div class="text-muted fs-12px mb-1">{{ __('Domains') }}</div>
                                            <div class="d-flex align-items-center">
                                                <div class="lead-text mb-0">{{$stats['vdomains']}}</div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            @if($limit['vdomains'] == "unlimited")
                                            <span class="badge bg-primary">{{ __('Unlimited') }}</span>
                                            @else
                                            <div class="fs-11px text-muted">{{ __('Limit:') }} {{$limit['vdomains']}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card bg-lighter">
                                <div class="card-inner py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-2">
                                            <div class="text-muted fs-12px mb-1">{{ __('MySQL DBs') }}</div>
                                            <div class="d-flex align-items-center">
                                                <div class="lead-text mb-0">{{$stats['mysql']}}</div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            @if($limit['mysql'] == "unlimited")
                                            <span class="badge bg-primary">{{ __('Unlimited') }}</span>
                                            @else
                                            <div class="fs-11px text-muted">{{ __('Limit:') }} {{$limit['mysql']}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card card-bordered">
                                <div class="card-inner py-2">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <em class="icon ni ni-toggle-on text-success fs-17px me-2"></em>
                                                <div>
                                                    <div class="text-muted fs-11px">{{ __('SSH Status') }}</div>
                                                    <span class="fs-13px">{{ $limit['ssh'] == 'ON' ? __('Enabled') : __('Disabled') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <em class="icon ni ni-calendar text-primary fs-17px me-2"></em>
                                                <div>
                                                    <div class="text-muted fs-11px">{{ __('Created At') }}</div>
                                                    <span class="fs-13px">{{$limit['date_created']}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <em class="icon ni ni-file-text text-info fs-17px me-2"></em>
                                                <div>
                                                    <div class="text-muted fs-11px">{{ __('Inodes') }}</div>
                                                    <span class="fs-13px">{{$stats['inode']}} /
                                                @if($limit['inode'] == "unlimited")
                                                    {{ __('Unlimited') }}
                                                @else
                                                    {{$limit['inode']}}
                                                @endif
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card card-bordered mt-3">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-3">
                        <div class="card-title">
                            <h6 class="title">{{ __('Quick Actions') }}</h6>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-12">
                            <a href="#" onclick="event.preventDefault(); directadmin_login();"
                               class="d-flex align-items-center p-3 bg-lighter rounded">
                                <div class="square btn-dim btn-primary d-inline-flex align-items-center justify-content-center me-3">
                                    <em class="icon ni ni-signin fs-17px"></em>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ __('Login to Panel') }}</h6>
                                    <p class="text-soft m-0 fs-13px">{{ __('Access DirectAdmin Control Panel') }}</p>
                                </div>
                                <em class="icon ni ni-chevron-right fs-21px text-soft"></em>
                            </a>
                        </div>
                        <div class="col-12">
                            <a href="#" onclick="event.preventDefault(); directadmin_reset_pwd();"
                               class="d-flex align-items-center p-3 bg-lighter rounded">
                                <div class="square btn-dim btn-warning d-inline-flex align-items-center justify-content-center me-3">
                                    <em class="icon ni ni-lock-alt fs-17px"></em>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ __('Reset Password') }}</h6>
                                    <p class="text-soft m-0 fs-13px">{{ __('Generate New Password') }}</p>
                                </div>
                                <em class="icon ni ni-chevron-right fs-21px text-soft"></em>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>

<script>
    function directadmin_login() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route("extensions.directadmin.login", $orderProduct->id) }}');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                if (data.status == 'success') {
                    var win = window.open(data.data.url, '_blank');
                    win.focus();
                } else {
                    alert(data.message);
                }
            } else {
                alert('{{ __("An error occurred while trying to perform this action.") }}');
            }
        };
        xhr.onerror = function () {
            alert('{{ __("An error occurred while trying to perform this action.") }}');
        };
        xhr.send('_token={{ csrf_token() }}');
    }

    function directadmin_reset_pwd() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route("extensions.directadmin.resetPwd", $orderProduct->id) }}');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                if (data.status == 'success') {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            } else {
                alert('{{ __("An error occurred while trying to perform this action.") }}');
            }
        };
        xhr.onerror = function () {
            alert('{{ __("An error occurred while trying to perform this action.") }}');
        };
        xhr.send('_token={{ csrf_token() }}');
    }
</script>
<style>
    .square {
        width: 36px;
        height: 36px;
        border-radius: 6px;
    }
</style>