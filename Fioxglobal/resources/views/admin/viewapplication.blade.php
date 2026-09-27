@extends('admin.index')

@section('content')

<style>
    .app-card {
        border: 1px solid var(--fiox-border);
        border-radius: 12px;
        background: #fff;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .app-card.sortable-ghost {
        background: rgba(184, 121, 31, 0.1);
        opacity: 0.7;
    }

    .app-card.sortable-chosen {
        box-shadow: 0 12px 24px -12px rgba(0, 0, 0, 0.25);
    }

    .app-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        background: var(--fiox-bg);
        border-bottom: 1px solid var(--fiox-border);
        flex-wrap: wrap;
        gap: 10px;
    }

    .app-card-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .app-card-title {
        font-weight: 700;
        font-size: 1.02rem;
        color: var(--fiox-charcoal);
        margin: 0;
    }

    /* ===== DRAG HANDLE ===== */
    .drag-handle {
        cursor: grab;
        color: var(--fiox-text-muted);
        font-size: 1.25rem;
        line-height: 1;
        transition: color 0.15s ease;
    }

    .drag-handle:hover {
        color: var(--fiox-amber-dark);
    }

    .app-card.sortable-chosen .drag-handle {
        cursor: grabbing;
        color: var(--fiox-amber-dark);
    }

    .use-count-badge {
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

    .app-card-actions {
        display: flex;
        gap: 8px;
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

    .app-card-body {
        padding: 20px;
    }

    .use-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 14px;
    }

    .use-item {
        border: 1px solid var(--fiox-border);
        border-radius: 10px;
        overflow: hidden;
        background: var(--fiox-bg);
    }

    .use-item-image {
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: #fff;
    }

    .use-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .use-item-title {
        padding: 8px 10px;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--fiox-charcoal);
        text-align: center;
        line-height: 1.3;
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

    .no-uses-hint {
        font-size: 0.82rem;
        color: var(--fiox-text-muted);
        font-style: italic;
    }

    /* ===== REORDER TOAST ===== */
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
        <h4 class="fw-bold mb-1" style="color: var(--fiox-charcoal);">Applications</h4>
        <small class="text-muted">Manage GFRP application areas and their use cases. Drag <i class="bi bi-grip-vertical"></i> to reorder — this is the order shown on the website.</small>
    </div>
    <a href="{{ route('add_application') }}" class="btn-fiox">
        <i class="bi bi-plus-lg me-1"></i> Add Application
    </a>
</div>

@if (session('msg'))
    <div class="alert alert-success rounded-3 border-0">
        {{ session('msg') }}
    </div>
@endif

@if ($applications->count() > 0)
    <div id="applicationSortableList">
        @foreach ($applications as $application)
            <div class="app-card" data-id="{{ $application->id }}">
                <div class="app-card-header">
                    <div class="app-card-title-wrap">
                        <i class="bi bi-grip-vertical drag-handle" title="Drag to reorder"></i>
                        <h6 class="app-card-title">{{ $application->name }}</h6>
                        <span class="use-count-badge">
                            <i class="bi bi-images"></i> {{ $application->images->count() }} use{{ $application->images->count() == 1 ? '' : 's' }}
                        </span>
                        <span class="status-badge status-{{ $application->status }}">
                            {{ $application->status }}
                        </span>
                    </div>
                    <div class="app-card-actions">
                        <a href="{{ route('edit_application', $application->id) }}" class="action-btn" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="{{ route('delete_application', $application->id) }}" class="action-btn delete-btn" title="Delete"
                           onclick="return confirm('Are you sure you want to delete this application and all its uses?');">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>

                <div class="app-card-body">
                    @if ($application->images->count() > 0)
                        <div class="use-grid">
                            @foreach ($application->images as $use)
                                <div class="use-item">
                                    <div class="use-item-image">
                                        <img src="{{ asset('application/' . $use->image) }}" alt="{{ $use->title }}">
                                    </div>
                                    <div class="use-item-title">{{ $use->title }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="no-uses-hint mb-0">No use cases added yet for this application.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="app-card">
        <div class="empty-state">
            <i class="bi bi-diagram-3"></i>
            <p class="mb-1 fw-semibold">No applications yet</p>
            <p class="mb-3">Add your first GFRP application area with its use cases.</p>
            <a href="{{ route('add_application') }}" class="btn-fiox">
                <i class="bi bi-plus-lg me-1"></i> Add Application
            </a>
        </div>
    </div>
@endif

<div class="reorder-toast" id="reorderToast">
    <i class="bi bi-check-circle-fill"></i>
    <span id="reorderToastText">Order saved</span>
</div>

@if ($applications->count() > 0)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
    <script>
        (function () {
            var list = document.getElementById('applicationSortableList');
            var toast = document.getElementById('reorderToast');
            var toastText = document.getElementById('reorderToastText');
            var toastTimer = null;

            if (!list || typeof Sortable === 'undefined') return;

            function showToast(message, isError) {
                toastText.textContent = message;
                toast.classList.toggle('is-error', !!isError);
                toast.classList.add('show');

                clearTimeout(toastTimer);
                toastTimer = setTimeout(function () {
                    toast.classList.remove('show');
                }, 2200);
            }

            new Sortable(list, {
                handle: '.drag-handle',
                animation: 180,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                onEnd: function () {
                    var order = Array.prototype.map.call(list.querySelectorAll('.app-card'), function (card) {
                        return card.dataset.id;
                    });

                    var csrfToken = document.querySelector('meta[name="csrf-token"]');

                    fetch('{{ route('application.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : ''
                        },
                        body: JSON.stringify({ order: order })
                    })
                        .then(function (res) {
                            if (!res.ok) throw new Error('HTTP ' + res.status);
                            return res.json();
                        })
                        .then(function () {
                            showToast('Order saved');
                        })
                        .catch(function (err) {
                            console.error('[application reorder] failed:', err);
                            showToast('Could not save order — refresh and try again', true);
                        });
                }
            });
        })();
    </script>
@endif

@endsection