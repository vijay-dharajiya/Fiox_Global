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

    .brc-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .brc-header h4 {
        color: var(--fiox-charcoal);
        font-weight: 700;
        margin: 0;
    }

    .brc-header span {
        color: #8a8a8a;
        font-size: 0.85rem;
    }

    .upload-card {
        background: #fff;
        border: 1px solid var(--fiox-border);
        border-top: 3px solid var(--fiox-amber);
        border-radius: 14px;
        padding: 26px;
        margin-bottom: 26px;
    }

    .upload-card h6 {
        color: var(--fiox-charcoal);
        font-weight: 700;
        margin-bottom: 18px;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--fiox-charcoal);
    }

    .form-control {
        border: 1px solid var(--fiox-border);
        border-radius: 8px;
        background: var(--fiox-bg);
    }

    .form-control:focus {
        border-color: var(--fiox-amber);
        box-shadow: 0 0 0 0.2rem rgba(184, 121, 31, 0.12);
        background: #fff;
    }

    .btn-fiox-solid {
        background: linear-gradient(90deg, var(--fiox-amber), var(--fiox-amber-dark));
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 26px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .btn-fiox-solid:hover {
        color: #fff;
        opacity: 0.92;
    }

    .brc-card {
        background: #fff;
        border: 1px solid var(--fiox-border);
        border-radius: 14px;
        overflow: hidden;
    }

    .table-brochures {
        margin: 0;
    }

    .table-brochures thead th {
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

    .table-brochures tbody td {
        padding: 14px 16px;
        font-size: 0.88rem;
        color: var(--fiox-charcoal);
        border-bottom: 1px solid var(--fiox-border);
        vertical-align: middle;
    }

    .table-brochures tbody tr:last-child td {
        border-bottom: none;
    }

    .table-brochures tbody tr:hover {
        background: var(--fiox-bg);
    }

    .pdf-icon {
        color: #c0392b;
        font-size: 1.2rem;
        margin-right: 6px;
    }

    .btn-icon {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: 1px solid var(--fiox-border);
        color: var(--fiox-charcoal);
        background: #fff;
        text-decoration: none;
    }

    .btn-icon:hover {
        border-color: var(--fiox-amber);
        color: var(--fiox-amber-dark);
    }

    .btn-icon.danger:hover {
        border-color: #c0392b;
        color: #c0392b;
    }

    .empty-row td {
        text-align: center;
        padding: 50px 16px;
        color: #8a8a8a;
        font-size: 0.9rem;
    }
</style>

<div class="brc-header">
    <h4>Brochures</h4>
    <span>{{ $brochures->count() }} total</span>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="upload-card">
    <h6>Upload New Brochure</h6>
    <form action="{{ route('brochure.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="e.g. FIOX Company Brochure 2026" required>
            </div>
            <div class="col-md-5">
                <label class="form-label">PDF File</label>
                <input type="file" name="file" class="form-control" accept="application/pdf" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-fiox-solid w-100">Upload</button>
            </div>
        </div>
    </form>
</div>

<div class="brc-card">
    <div class="table-responsive">
        <table class="table table-brochures">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>File Name</th>
                    <th>Size</th>
                    <th>Uploaded On</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($brochures as $brochure)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $brochure->title }}</td>
                        <td><i class="bi bi-file-earmark-pdf-fill pdf-icon"></i>{{ $brochure->file_name }}</td>
                        <td>{{ $brochure->file_size ? round($brochure->file_size / 1024, 1) . ' KB' : '-' }}</td>
                        <td>{{ $brochure->created_at->format('d M Y, h:i A') }}</td>
                        <td class="text-end">
                            <a href="{{ asset($brochure->file_path) }}" target="_blank" class="btn-icon" title="View">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ asset($brochure->file_path) }}" download class="btn-icon" title="Download">
                                <i class="bi bi-download"></i>
                            </a>
                            <form action="{{ route('brochure.destroy', $brochure->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this brochure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon danger" title="Delete" style="border:1px solid var(--fiox-border); background:#fff;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="6">No brochures uploaded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection