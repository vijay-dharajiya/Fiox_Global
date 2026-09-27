@extends('admin.index')

@section('content')

<style>
    .table-wrap {
        overflow-x: auto;
    }

    .product-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.88rem;
    }

    .product-table thead th {
        background: var(--fiox-bg);
        color: var(--fiox-charcoal);
        font-weight: 600;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        padding: 12px 16px;
        border-bottom: 1px solid var(--fiox-border);
        white-space: nowrap;
    }

    .product-table tbody td {
        padding: 12px 16px;
        border-bottom: 1px solid var(--fiox-border);
        color: var(--fiox-charcoal-soft);
        vertical-align: middle;
    }

    .product-table tbody tr:last-child td {
        border-bottom: none;
    }

    .product-table tbody tr:hover {
        background: rgba(184, 121, 31, 0.03);
    }

    .product-table tbody tr.sortable-ghost {
        background: rgba(184, 121, 31, 0.1);
    }

    .product-table tbody tr.sortable-chosen {
        background: rgba(184, 121, 31, 0.06);
    }

    .product-thumb {
        width: 54px;
        height: 54px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--fiox-border);
        background: #fff;
    }

    .product-name-cell {
        font-weight: 600;
        color: var(--fiox-charcoal);
    }

    .product-slug {
        font-size: 0.76rem;
        color: var(--fiox-text-muted);
        margin-top: 2px;
    }

    .gallery-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(184, 121, 31, 0.08);
        color: var(--fiox-amber-dark);
        font-size: 0.76rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .status-badge {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
        text-transform: capitalize;
    }

    .status-active {
        background: rgba(46, 139, 87, 0.1);
        color: #2e8b57;
    }

    .status-inactive {
        background: rgba(192, 57, 43, 0.1);
        color: #c0392b;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--fiox-border);
        background: #fff;
        color: var(--fiox-charcoal-soft);
        transition: all 0.15s ease;
    }

    .action-btn:hover {
        border-color: var(--fiox-amber);
        color: var(--fiox-amber-dark);
        background: rgba(184, 121, 31, 0.06);
    }

    .action-btn.delete-btn:hover {
        border-color: #c0392b;
        color: #c0392b;
        background: rgba(192, 57, 43, 0.06);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--fiox-text-muted);
    }

    .empty-state i {
        font-size: 2.4rem;
        color: var(--fiox-amber);
        display: block;
        margin-bottom: 10px;
    }

    /* ===== DRAG HANDLE ===== */
    .drag-handle-cell {
        width: 36px;
        text-align: center;
    }

    .drag-handle {
        cursor: grab;
        color: var(--fiox-text-muted);
        font-size: 1.05rem;
        transition: color 0.15s ease;
    }

    .drag-handle:hover {
        color: var(--fiox-amber-dark);
    }

    .product-table tbody tr.sortable-chosen .drag-handle {
        cursor: grabbing;
        color: var(--fiox-amber-dark);
    }

    .reorder-toast {
        position: fixed;
        right: 24px;
        bottom: 24px;
        z-index: 1080;
        background: var(--fiox-charcoal);
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 10px;
        box-shadow: 0 12px 24px -10px rgba(0,0,0,0.35);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        opacity: 0;
        transform: translateY(8px);
        pointer-events: none;
        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    .reorder-toast.show {
        opacity: 1;
        transform: translateY(0);
    }

    .reorder-toast.is-error {
        background: #c0392b;
    }
</style>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: var(--fiox-charcoal);">Products</h4>
        <small class="text-muted">Manage your product catalog. Drag <i class="bi bi-grip-vertical"></i> to reorder — this is the order shown in the site header's Product dropdown.</small>
    </div>
    <a href="{{ route('add_product') }}" class="btn-fiox">
        <i class="bi bi-plus-lg me-1"></i> Add Product
    </a>
</div>

@if (session('msg'))
    <div class="alert alert-success rounded-3 border-0">
        {{ session('msg') }}
    </div>
@endif

<div class="panel-card p-0">
    @if ($products->count() > 0)
        <div class="table-wrap">
            <table class="product-table">
                <thead>
                    <tr>
                        <th class="drag-handle-cell"></th>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Gallery</th>
                        <th>Status</th>
                        <th>Added On</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody id="productSortableBody">
                    @foreach ($products as $index => $product)
                        <tr data-id="{{ $product->id }}">
                            <td class="drag-handle-cell">
                                <i class="bi bi-grip-vertical drag-handle" title="Drag to reorder"></i>
                            </td>
                            <td class="row-index">{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ asset('product/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="product-thumb">
                            </td>
                            <td>
                                <div class="product-name-cell">{{ $product->name }}</div>
                                <div class="product-slug">{{ $product->slug }}</div>
                            </td>
                            <td>
                                <span class="gallery-count-badge">
                                    <i class="bi bi-images"></i> {{ $product->images->count() }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $product->status }}">
                                    {{ $product->status }}
                                </span>
                            </td>
                            <td>{{ $product->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('edit_product', $product->id) }}" class="action-btn" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ route('delete_product', $product->id) }}" class="action-btn delete-btn" title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this product?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-box-seam"></i>
            <p class="mb-1 fw-semibold">No products yet</p>
            <p class="mb-3">Get started by adding your first product to the catalog.</p>
            <a href="{{ route('add_product') }}" class="btn-fiox">
                <i class="bi bi-plus-lg me-1"></i> Add Product
            </a>
        </div>
    @endif
</div>

<div class="reorder-toast" id="reorderToast">
    <i class="bi bi-check-circle-fill"></i>
    <span id="reorderToastText">Order saved</span>
</div>

@if ($products->count() > 0)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
    <script>
        (function () {
            var body = document.getElementById('productSortableBody');
            var toast = document.getElementById('reorderToast');
            var toastText = document.getElementById('reorderToastText');
            var toastTimer = null;

            if (!body || typeof Sortable === 'undefined') return;

            function renumberRows() {
                var rows = body.querySelectorAll('tr');
                rows.forEach(function (row, i) {
                    var cell = row.querySelector('.row-index');
                    if (cell) cell.textContent = i + 1;
                });
            }

            function showToast(message, isError) {
                toastText.textContent = message;
                toast.classList.toggle('is-error', !!isError);
                toast.classList.add('show');

                clearTimeout(toastTimer);
                toastTimer = setTimeout(function () {
                    toast.classList.remove('show');
                }, 2200);
            }

            new Sortable(body, {
                handle: '.drag-handle',
                animation: 180,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                onEnd: function () {
                    renumberRows();

                    var order = Array.prototype.map.call(body.querySelectorAll('tr'), function (row) {
                        return row.dataset.id;
                    });

                    var csrfToken = document.querySelector('meta[name="csrf-token"]');

                    if (!csrfToken) {
                        console.error('[reorder] No <meta name="csrf-token"> found in <head> — add it to admin/index.blade.php');
                    }

                    fetch('{{ route('product.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : ''
                        },
                        body: JSON.stringify({ order: order })
                    })
                        .then(function (res) {
                            return res.text().then(function (text) {
                                console.log('[reorder] status:', res.status, 'body:', text);
                                if (!res.ok) throw new Error('HTTP ' + res.status);
                                return text ? JSON.parse(text) : {};
                            });
                        })
                        .then(function () {
                            showToast('Order saved');
                        })
                        .catch(function (err) {
                            console.error('[reorder] failed:', err);
                            showToast('Could not save order — refresh and try again', true);
                        });
                }
            });
        })();
    </script>
@endif

@endsection