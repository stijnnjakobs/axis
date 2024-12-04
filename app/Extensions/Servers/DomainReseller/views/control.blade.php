<div class="card">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Domain Management</h5>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label">Domain Name</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" value="{{ $params['config']['domain'] }}" readonly>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label">Expiry Date</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" value="{{ $params['config']['expiry_date'] }}" readonly>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-primary" onclick="manageDNS()">
                        <em class="icon ni ni-setting"></em>
                        <span>Manage DNS</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function manageDNS() {
        // Implement DNS management functionality
        alert('DNS management coming soon');
    }
</script>