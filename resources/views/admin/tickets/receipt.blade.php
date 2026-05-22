<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Receipt – {{ $ticket->ticket_number }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; }
        .receipt-wrapper { max-width: 800px; margin: 30px auto; background: #fff; border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden; }
        .receipt-header { background: linear-gradient(135deg, #0d6efd, #0a58ca); color: #fff; padding: 30px; text-align: center; }
        .receipt-header img { height: 60px; margin-bottom: 10px; }
        .receipt-body { padding: 30px; }
        .receipt-footer { background: #f8f9fa; padding: 20px 30px; border-top: 1px solid #dee2e6; text-align: center; }
        .info-row { display: flex; border-bottom: 1px solid #f0f0f0; padding: 10px 0; }
        .info-label { width: 200px; font-weight: 600; color: #6c757d; flex-shrink: 0; }
        .info-value { flex: 1; }
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; }
        .status-completed { background: #d1e7dd; color: #0f5132; }
        @media print {
            body { background: #fff; }
            .receipt-wrapper { border: none; margin: 0; box-shadow: none; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

<div class="receipt-wrapper">
    <!-- Header -->
    <div class="receipt-header">
        <h3 class="mb-1 fw-bold">SOUTHERN CHRISTIAN COLLEGE</h3>
        <p class="mb-1 opacity-75">SCC ReportHub – Facility Maintenance System</p>
        <h5 class="mt-3 mb-0">REPAIR COMPLETION RECEIPT</h5>
    </div>

    <!-- Body -->
    <div class="receipt-body">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <div class="text-muted small">Receipt Generated</div>
                <div class="fw-semibold">{{ now()->format('F d, Y h:i A') }}</div>
            </div>
            <div class="text-end">
                <div class="text-muted small">Ticket Number</div>
                <div class="fw-bold fs-5 text-primary">{{ $ticket->ticket_number }}</div>
            </div>
        </div>

        <h6 class="text-primary fw-bold border-bottom pb-2 mb-3">TICKET INFORMATION</h6>

        <div class="info-row">
            <div class="info-label">Title</div>
            <div class="info-value">{{ $ticket->title }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Description</div>
            <div class="info-value">{{ $ticket->description }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Facility Location</div>
            <div class="info-value">{{ $ticket->facility?->full_location ?? 'Not specified' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Priority Level</div>
            <div class="info-value text-capitalize fw-semibold">{{ $ticket->priority_level }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Status</div>
            <div class="info-value">
                <span class="status-badge status-completed">{{ ucfirst($ticket->status) }}</span>
            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Submitted By</div>
            <div class="info-value">{{ $ticket->user->full_name }} — {{ $ticket->user->department }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Date Submitted</div>
            <div class="info-value">{{ $ticket->created_at->format('F d, Y h:i A') }}</div>
        </div>

        <h6 class="text-primary fw-bold border-bottom pb-2 mb-3 mt-4">REPAIR INFORMATION</h6>

        <div class="info-row">
            <div class="info-label">Assigned Personnel</div>
            <div class="info-value">{{ $ticket->assignedStaff?->full_name ?? '—' }}</div>
        </div>
        @if($latestLog)
        <div class="info-row">
            <div class="info-label">Action Taken</div>
            <div class="info-value">{{ $latestLog->action_taken }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Resolution Notes</div>
            <div class="info-value">{{ $latestLog->repair_notes ?? '—' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Materials Used</div>
            <div class="info-value">{{ $latestLog->materials_used ?? '—' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Repair Cost</div>
            <div class="info-value fw-bold text-success">₱{{ number_format($latestLog->repair_cost, 2) }}</div>
        </div>
        @endif
        <div class="info-row">
            <div class="info-label">Completion Date</div>
            <div class="info-value">{{ $ticket->completed_at?->format('F d, Y h:i A') ?? '—' }}</div>
        </div>

        <!-- Signature Lines -->
        <div class="row mt-5">
            <div class="col-4 text-center">
                <div style="border-top: 1px solid #333; padding-top: 8px;">
                    <div class="small fw-semibold">Submitted By</div>
                    <div class="text-muted small">{{ $ticket->user->full_name }}</div>
                </div>
            </div>
            <div class="col-4 text-center">
                <div style="border-top: 1px solid #333; padding-top: 8px;">
                    <div class="small fw-semibold">Performed By</div>
                    <div class="text-muted small">{{ $ticket->assignedStaff?->full_name ?? '—' }}</div>
                </div>
            </div>
            <div class="col-4 text-center">
                <div style="border-top: 1px solid #333; padding-top: 8px;">
                    <div class="small fw-semibold">Verified By</div>
                    <div class="text-muted small">{{ $ticket->approvedBy?->full_name ?? 'Administrator' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="receipt-footer">
        <p class="mb-1 small text-muted">This is an official repair receipt generated by SCC ReportHub.</p>
        <p class="mb-0 small text-muted">Southern Christian College – Facilities & Maintenance Department</p>
    </div>
</div>

<div class="text-center mt-3 no-print">
    <button onclick="window.print()" class="btn btn-primary me-2">
        <i class="fas fa-print me-2"></i>Print Receipt
    </button>
    <button onclick="window.close()" class="btn btn-outline-secondary">Close</button>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</body>
</html>
