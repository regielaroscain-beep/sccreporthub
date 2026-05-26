<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Receipt – <?php echo e($ticket->ticket_number); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 11px;
            background: #f0f0f0;
            color: #1a1a1a;
        }

        .receipt-wrapper {
            width: 720px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 6px;
            overflow: hidden;
        }

        /* Header */
        .receipt-header {
            background: linear-gradient(135deg, #4f46e5, #3730a3);
            color: #fff;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .receipt-header img { height: 48px; width: 48px; border-radius: 50%; object-fit: contain; background: #fff; padding: 2px; }
        .receipt-header .school-name { font-size: 13px; font-weight: 700; letter-spacing: 0.3px; }
        .receipt-header .doc-title { font-size: 10px; opacity: 0.85; margin-top: 2px; }
        .receipt-header .ticket-no { margin-left: auto; text-align: right; }
        .receipt-header .ticket-no .label { font-size: 9px; opacity: 0.75; }
        .receipt-header .ticket-no .value { font-size: 13px; font-weight: 700; letter-spacing: 0.5px; }

        /* Body */
        .receipt-body { padding: 14px 20px; }

        /* Meta row */
        .meta-row {
            display: flex;
            justify-content: space-between;
            background: #f8f8f8;
            border: 1px solid #e8e8e8;
            border-radius: 4px;
            padding: 7px 12px;
            margin-bottom: 12px;
            font-size: 10px;
        }
        .meta-row .meta-item { display: flex; flex-direction: column; }
        .meta-row .meta-label { color: #888; font-size: 9px; text-transform: uppercase; letter-spacing: 0.4px; }
        .meta-row .meta-value { font-weight: 600; color: #1a1a1a; margin-top: 1px; }

        /* Section title */
        .section-title {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #4f46e5;
            border-bottom: 1.5px solid #4f46e5;
            padding-bottom: 3px;
            margin-bottom: 6px;
            margin-top: 10px;
        }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border: 1px solid #e8e8e8;
            border-radius: 4px;
            overflow: hidden;
        }
        .info-grid.single { grid-template-columns: 1fr; }
        .info-cell {
            padding: 5px 10px;
            border-bottom: 1px solid #f0f0f0;
            border-right: 1px solid #f0f0f0;
        }
        .info-cell:nth-child(even) { border-right: none; }
        .info-cell:last-child, .info-cell:nth-last-child(2):nth-child(odd) { border-bottom: none; }
        .info-cell .cell-label { font-size: 9px; color: #888; text-transform: uppercase; letter-spacing: 0.3px; }
        .info-cell .cell-value { font-size: 11px; font-weight: 500; color: #1a1a1a; margin-top: 1px; }
        .info-cell .cell-value.highlight { color: #059669; font-weight: 700; }
        .info-cell .cell-value.priority-urgent { color: #dc2626; font-weight: 700; }
        .info-cell .cell-value.priority-high { color: #d97706; font-weight: 700; }
        .info-cell .cell-value.priority-normal { color: #059669; font-weight: 700; }

        /* Status badge */
        .badge-completed {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
        }

        /* Signature */
        .signature-row {
            display: flex;
            gap: 12px;
            margin-top: 14px;
        }
        .sig-box {
            flex: 1;
            text-align: center;
            padding-top: 28px;
            border-top: 1px solid #333;
        }
        .sig-box .sig-name { font-size: 10px; font-weight: 600; color: #1a1a1a; }
        .sig-box .sig-role { font-size: 9px; color: #888; margin-top: 1px; }

        /* Footer */
        .receipt-footer {
            background: #f8f8f8;
            border-top: 1px solid #e8e8e8;
            padding: 8px 20px;
            text-align: center;
            font-size: 9px;
            color: #888;
            margin-top: 12px;
        }

        /* Print button */
        .no-print {
            text-align: center;
            padding: 16px;
        }
        .no-print button {
            padding: 8px 20px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            margin: 0 4px;
        }
        .btn-print { background: #4f46e5; color: #fff; border: none; }
        .btn-close-btn { background: #fff; color: #555; border: 1px solid #ccc; }

        /* ── PRINT ── */
        @media print {
            @page {
                size: A4 portrait;
                margin: 10mm 12mm;
            }
            html, body { background: #fff !important; }
            .no-print { display: none !important; }
            .receipt-wrapper {
                width: 100%;
                margin: 0;
                border: none;
                border-radius: 0;
                box-shadow: none;
            }
            .receipt-header { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .badge-completed { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>

<div class="receipt-wrapper">

    
    <div class="receipt-header">
        <img src="<?php echo e(asset('images/scc-logo.png')); ?>" alt="SCC Logo">
        <div>
            <div class="school-name">SOUTHERN CHRISTIAN COLLEGE</div>
            <div class="doc-title">SCC ReportHub &mdash; Repair Completion Receipt</div>
        </div>
        <div class="ticket-no">
            <div class="label">TICKET NO.</div>
            <div class="value"><?php echo e($ticket->ticket_number); ?></div>
        </div>
    </div>

    
    <div class="receipt-body">

        
        <div class="meta-row">
            <div class="meta-item">
                <span class="meta-label">Date Generated</span>
                <span class="meta-value"><?php echo e(now()->format('F d, Y h:i A')); ?></span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Date Submitted</span>
                <span class="meta-value"><?php echo e($ticket->created_at->format('F d, Y')); ?></span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Completion Date</span>
                <span class="meta-value"><?php echo e($ticket->completed_at?->format('F d, Y') ?? '—'); ?></span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Status</span>
                <span class="meta-value"><span class="badge-completed"><?php echo e(ucfirst($ticket->status)); ?></span></span>
            </div>
        </div>

        
        <div class="section-title">Ticket Information</div>
        <div class="info-grid">
            <div class="info-cell">
                <div class="cell-label">Title</div>
                <div class="cell-value"><?php echo e($ticket->title); ?></div>
            </div>
            <div class="info-cell">
                <div class="cell-label">Issue Category</div>
                <div class="cell-value"><?php echo e($ticket->category_label); ?></div>
            </div>
            <div class="info-cell">
                <div class="cell-label">Facility Location</div>
                <div class="cell-value"><?php echo e($ticket->facility?->full_location ?? 'Not specified'); ?></div>
            </div>
            <div class="info-cell">
                <div class="cell-label">Priority Level</div>
                <div class="cell-value priority-<?php echo e($ticket->priority_level); ?> text-capitalize"><?php echo e($ticket->priority_level); ?></div>
            </div>
            <div class="info-cell">
                <div class="cell-label">Submitted By</div>
                <div class="cell-value"><?php echo e($ticket->user->full_name); ?></div>
            </div>
            <div class="info-cell">
                <div class="cell-label">Department</div>
                <div class="cell-value"><?php echo e($ticket->user->department); ?></div>
            </div>
        </div>

        
        <div class="info-grid single" style="margin-top:4px;">
            <div class="info-cell">
                <div class="cell-label">Description</div>
                <div class="cell-value"><?php echo e($ticket->description); ?></div>
            </div>
        </div>

        
        <div class="section-title">Repair Information</div>
        <div class="info-grid">
            <div class="info-cell">
                <div class="cell-label">Assigned Personnel</div>
                <div class="cell-value"><?php echo e($ticket->assignedStaff?->full_name ?? '—'); ?></div>
            </div>
            <div class="info-cell">
                <div class="cell-label">Repair Cost</div>
                <div class="cell-value highlight">₱<?php echo e($latestLog ? number_format($latestLog->repair_cost, 2) : '0.00'); ?></div>
            </div>
            <?php if($latestLog): ?>
            <div class="info-cell">
                <div class="cell-label">Action Taken</div>
                <div class="cell-value"><?php echo e($latestLog->action_taken); ?></div>
            </div>
            <div class="info-cell">
                <div class="cell-label">Materials Used</div>
                <div class="cell-value"><?php echo e($latestLog->materials_used ?? '—'); ?></div>
            </div>
            <?php endif; ?>
        </div>

        <?php if($latestLog && $latestLog->repair_notes): ?>
        <div class="info-grid single" style="margin-top:4px;">
            <div class="info-cell">
                <div class="cell-label">Resolution Notes</div>
                <div class="cell-value"><?php echo e($latestLog->repair_notes); ?></div>
            </div>
        </div>
        <?php endif; ?>

        
        <div class="signature-row">
            <div class="sig-box">
                <div class="sig-name"><?php echo e($ticket->user->full_name); ?></div>
                <div class="sig-role">Submitted By</div>
            </div>
            <div class="sig-box">
                <div class="sig-name"><?php echo e($ticket->assignedStaff?->full_name ?? '—'); ?></div>
                <div class="sig-role">Performed By</div>
            </div>
            <div class="sig-box">
                <div class="sig-name"><?php echo e($ticket->approvedBy?->full_name ?? 'Administrator'); ?></div>
                <div class="sig-role">Verified By</div>
            </div>
        </div>

    </div>

    
    <div class="receipt-footer">
        This is an official repair receipt generated by SCC ReportHub &nbsp;&bull;&nbsp;
        Southern Christian College – Facilities &amp; Maintenance Department
    </div>

</div>

<div class="no-print">
    <button class="btn-print" onclick="window.print()">
        <i class="fas fa-print"></i> Print Receipt
    </button>
    <button class="btn-close-btn" onclick="window.close()">Close</button>
</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/admin/tickets/receipt.blade.php ENDPATH**/ ?>