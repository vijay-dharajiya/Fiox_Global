@extends('admin.index')

@section('content')

<style>
    .form-label {
        font-weight: 600;
        font-size: 0.86rem;
        color: var(--fiox-charcoal);
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border: 1px solid var(--fiox-border);
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: var(--fiox-charcoal-soft);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--fiox-amber);
        box-shadow: 0 0 0 0.2rem rgba(184, 121, 31, 0.12);
    }

    .required-mark { color: #c0392b; }

    .form-hint {
        font-size: 0.78rem;
        color: var(--fiox-text-muted);
        margin-top: 6px;
    }

    /* ===== RICH TEXT (same look as product page, sized down for use-case rows) ===== */
    .ql-toolbar.ql-snow {
        border: 1px solid var(--fiox-border);
        border-radius: 8px 8px 0 0;
        background: var(--fiox-bg);
    }

    .ql-container.ql-snow {
        border: 1px solid var(--fiox-border);
        border-top: none;
        border-radius: 0 0 8px 8px;
        background: #fff;
    }

    .ql-editor.ql-blank::before {
        color: #b7b2ab;
        font-style: normal;
    }

    .use-row .ql-container.ql-snow {
        min-height: 90px;
    }

    .use-row .ql-editor {
        min-height: 90px;
        font-size: 0.86rem;
    }

    /* ===== USE ROWS (repeater) ===== */
    .use-row {
        border: 1px solid var(--fiox-border);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 14px;
        background: var(--fiox-bg);
        position: relative;
    }

    .use-row .use-row-number {
        font-size: 0.74rem;
        font-weight: 700;
        color: var(--fiox-amber-dark);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 10px;
    }

    .use-row-grid {
        display: grid;
        grid-template-columns: 130px 1fr;
        gap: 16px;
        align-items: start;
    }

    .use-image-drop {
        border: 1.5px dashed var(--fiox-amber);
        border-radius: 10px;
        background: #fff;
        height: 100px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        overflow: hidden;
        text-align: center;
        transition: all 0.2s ease;
    }

    .use-image-drop:hover {
        background: rgba(184, 121, 31, 0.05);
    }

    .use-image-drop img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .use-image-drop .placeholder-text {
        color: var(--fiox-amber-dark);
        font-size: 0.68rem;
        font-weight: 600;
        padding: 4px;
    }

    .use-image-drop .placeholder-text i {
        font-size: 1.2rem;
        display: block;
        margin-bottom: 3px;
    }

    .use-row-fields {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .remove-use-row {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #fff;
        border: 1px solid var(--fiox-border);
        color: #c0392b;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.8rem;
        transition: all 0.15s ease;
    }

    .remove-use-row:hover {
        background: #c0392b;
        color: #fff;
        border-color: #c0392b;
    }

    .add-use-btn {
        border: 1.5px dashed var(--fiox-amber);
        border-radius: 10px;
        background: rgba(184, 121, 31, 0.03);
        color: var(--fiox-amber-dark);
        font-weight: 600;
        font-size: 0.86rem;
        padding: 12px;
        width: 100%;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .add-use-btn:hover {
        background: rgba(184, 121, 31, 0.07);
    }

    /* ===== FORM ACTIONS ===== */
    .form-actions {
        border-top: 1px solid var(--fiox-border);
        padding-top: 20px;
        margin-top: 8px;
    }
</style>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: var(--fiox-charcoal);">Add Application</h4>
        <small class="text-muted">Add a GFRP application with all its individual use cases.</small>
    </div>
    <a href="{{ route('view_application') }}" class="btn-fiox-outline">
        <i class="bi bi-arrow-left me-1"></i> View Applications
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger rounded-3 border-0">
        <strong>Please fix the following:</strong>
        <ul class="mb-0 mt-1 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('store_application') }}" method="POST" enctype="multipart/form-data" id="applicationForm">
    @csrf

    <div class="panel-card p-4 mb-3">
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Application Name <span class="required-mark">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                       placeholder="e.g. GFRP Rebar Applications">
                <p class="form-hint">The overall category name — e.g. "GFRP Rebar Applications".</p>
            </div>

            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
    </div>

    <div class="panel-card p-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <label class="form-label mb-0">Use Cases <span class="required-mark">*</span></label>
                <p class="form-hint mt-1 mb-0">Add every specific use — each needs its own image, title and description (e.g. "Drainage Structures", "RCC Roadways").</p>
            </div>
        </div>

        <div id="useRowsWrap">
            <!-- rows injected here by JS, starting with 1 -->
        </div>

        <div class="add-use-btn" id="addUseBtn">
            <i class="bi bi-plus-lg me-1"></i> Add Another Use
        </div>
    </div>

    <div class="form-actions d-flex justify-content-end gap-2">
        <a href="{{ route('view_application') }}" class="btn btn-light border">Cancel</a>
        <button type="submit" class="btn-fiox px-4">
            <i class="bi bi-check2-circle me-1"></i> Save Application
        </button>
    </div>
</form>

<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<script>
    const useRowsWrap = document.getElementById('useRowsWrap');
    const addUseBtn = document.getElementById('addUseBtn');

    function renumberRows() {
        const rows = useRowsWrap.querySelectorAll('.use-row');
        rows.forEach((row, index) => {
            row.querySelector('.use-row-number').textContent = 'Use #' + (index + 1);
        });
    }

    function createUseRow() {
        const row = document.createElement('div');
        row.className = 'use-row';
        row.innerHTML = `
            <div class="use-row-number">Use</div>
            <div class="remove-use-row" title="Remove this use">
                <i class="bi bi-x"></i>
            </div>
            <div class="use-row-grid">
                <div>
                    <div class="use-image-drop" data-role="drop">
                        <div class="placeholder-text" data-role="placeholder">
                            <i class="bi bi-cloud-arrow-up"></i>
                            Upload image
                        </div>
                        <img src="" class="d-none" data-role="preview" alt="Use image preview">
                    </div>
                    <input type="file" name="use_image[]" accept="image/*" class="d-none" data-role="input" required>
                </div>
                <div class="use-row-fields">
                    <div>
                        <label class="form-label">Use Title <span class="required-mark">*</span></label>
                        <input type="text" name="use_title[]" class="form-control" placeholder="e.g. Drainage Structures" required>
                    </div>
                    <div>
                        <label class="form-label">Use Description <span class="required-mark">*</span></label>
                        <div data-role="descToolbar">
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-clean"></button>
                            </span>
                        </div>
                        <div data-role="descEditor"></div>
                        <input type="hidden" name="use_description[]" data-role="descInput">
                    </div>
                </div>
            </div>
        `;

        // wire up image click + preview for this row
        const drop = row.querySelector('[data-role="drop"]');
        const input = row.querySelector('[data-role="input"]');
        const preview = row.querySelector('[data-role="preview"]');
        const placeholder = row.querySelector('[data-role="placeholder"]');

        drop.addEventListener('click', () => input.click());

        input.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    placeholder.classList.add('d-none');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        // wire up rich text description for this row
        const descToolbar = row.querySelector('[data-role="descToolbar"]');
        const descEditorEl = row.querySelector('[data-role="descEditor"]');
        const descInput = row.querySelector('[data-role="descInput"]');

        const descQuill = new Quill(descEditorEl, {
            theme: 'snow',
            modules: { toolbar: descToolbar },
            placeholder: 'Short description of this use case...'
        });

        // keep a reference on the row so the submit handler can pull its content
        row._descQuill = descQuill;
        row._descInput = descInput;

        // remove row (keep at least 1 row on the page), then renumber what remains
        row.querySelector('.remove-use-row').addEventListener('click', () => {
            if (useRowsWrap.children.length > 1) {
                row.remove();
                renumberRows();
            }
        });

        useRowsWrap.appendChild(row);
        renumberRows();
    }

    addUseBtn.addEventListener('click', createUseRow);

    // start with one row by default
    createUseRow();

    document.getElementById('applicationForm').addEventListener('submit', function () {
        useRowsWrap.querySelectorAll('.use-row').forEach(row => {
            if (row._descQuill && row._descInput) {
                row._descInput.value = row._descQuill.root.innerHTML;
            }
        });
    });
</script>

@endsection