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
                    <button class="btn btn-primary" onclick="manageNameservers()">
                        <em class="icon ni ni-server"></em>
                        <span>Manage Nameservers</span>
                    </button>
                    <button class="btn btn-primary" onclick="manageContacts()">
                        <em class="icon ni ni-users"></em>
                        <span>Manage Contacts</span>
                    </button>
                </div>
            </div>
        </div>

        <div id="dnsRecords" class="mt-4" style="display: none;">
            <!-- DNS Records will be loaded here -->
        </div>
    </div>
</div>

<script>
function manageDNS() {
    const orderId = '{{ $orderProduct->id }}';
    fetch(`/extensions/resellerclub/${orderId}/dns`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Implement DNS records display and management
                document.getElementById('dnsRecords').innerHTML = createDNSTable(data.records);
                document.getElementById('dnsRecords').style.display = 'block';
            } else {
                alert(data.message || 'An error occurred');
            }
        });
}

function createDNSTable(records) {
    // Implement DNS records table creation
}

function manageNameservers() {
    // Implement nameserver management
}

function manageContacts() {
    // Implement contact management
}
</script> 