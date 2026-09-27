@extends('admin.index')
@section('content')

<style>
    :root {
        --fiox-amber: #B8791F;
        --fiox-amber-dark: #8F5F16;
        --fiox-charcoal: #2F2F30;
        --fiox-bg: #FAF8F5;
        --fiox-border: #EDE6DA;
    }

    .inq-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .inq-header h4 {
        color: var(--fiox-charcoal);
        font-weight: 700;
        margin: 0;
    }

    .inq-header span {
        color: #8a8a8a;
        font-size: 0.85rem;
    }

    .inq-card {
        background: #fff;
        border: 1px solid var(--fiox-border);
        border-radius: 14px;
        overflow: hidden;
    }

    .table-inquiries {
        margin: 0;
    }

    .table-inquiries thead th {
        background: var(--fiox-bg);
        color: var(--fiox-amber-dark);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        border-bottom: 1px solid var(--fiox-border);
        padding: 14px 16px;
        white-space: nowrap;
    }

    .table-inquiries tbody td {
        padding: 14px 16px;
        font-size: 0.88rem;
        color: var(--fiox-charcoal);
        border-bottom: 1px solid var(--fiox-border);
        vertical-align: top;
    }

    .table-inquiries tbody tr:last-child td {
        border-bottom: none;
    }

    .table-inquiries tbody tr:hover {
        background: var(--fiox-bg);
    }

    .badge-product {
        display: inline-block;
        background: rgba(184, 121, 31, 0.1);
        color: var(--fiox-amber-dark);
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .desc-cell {
        max-width: 260px;
        white-space: normal;
        color: #6b6b6b;
        font-size: 0.85rem;
        line-height: 1.5;
    }

    .empty-row td {
        text-align: center;
        padding: 50px 16px;
        color: #8a8a8a;
        font-size: 0.9rem;
    }
</style>

<div class="inq-header">
    <h4>Product Inquiries</h4>
    <span>{{ $inquiries->count() }} total</span>
</div>

<div class="inq-card">
    <div class="table-responsive">
        <table class="table table-inquiries">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Company</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($inquiries as $inquiry)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $inquiry->full_name }}</td>
                        <td>{{ $inquiry->company_name ?: '-' }}</td>
                        <td><a href="tel:{{ $inquiry->phone }}" style="color: var(--fiox-charcoal); text-decoration: none;">{{ $inquiry->phone }}</a></td>
                        <td>
                            @if ($inquiry->email)
                                <a href="mailto:{{ $inquiry->email }}" style="color: var(--fiox-charcoal); text-decoration: none;">{{ $inquiry->email }}</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($inquiry->product)
                                <span class="badge-product">{{ $inquiry->product->name }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="desc-cell">{{ $inquiry->description ?: '-' }}</td>
                        <td>{{ $inquiry->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="8">No inquiries received yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection