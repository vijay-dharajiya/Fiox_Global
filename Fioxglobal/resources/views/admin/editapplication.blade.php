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

    .section-label {
        font-size: 0.76rem;
        font-weight: 700;
        color: var(--fiox-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin: 4px 0 12px;
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

    /* ===== USE ROWS ===== */
    .use-row {
        border: 1px solid var(--fiox-border);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 14px;
        background: var(--fiox-bg);
        position: relative;
    }

    .use-row.existing-row {
        background: #fff;
        border-color: var(--fiox-border);
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

    .existing-thumb {
        width: 100%;
        height: 100px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid var(--fiox-border);
    }

    .existing-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
        text-decoration: none;
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

    .divider-line {
        border-top: 1px solid var(--fiox-border);
        margin: 24px 0;
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
        <h4 class="fw-bold mb-1" style="color: var(--fiox-charcoal);">Update Application</h4>
        <small class="text-muted">Editing: {{ $application->name }}</small>
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

@if (session('msg'))
    <div class="alert alert-success rounded-3 border-0">
        {{ session('msg') }}
    </div>
@endif

<form action="{{ route('update_application', $application->id) }}" method="POST" enctype="multipart/form-data" id="applicationForm">
    @csrf

    <div class="panel-card p-4 mb-3">
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Application Name <span class="required-mark">*</span></label>
                <input type="text" name="name" value="{{ old('name', $application->name) }}" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ old('status', $application->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $application->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
    </div>

    <div class="panel-card p-4">

        @if ($application->images->count() > 0)
            <div class="section-label">Existing Use Cases</div>

            @foreach ($application->images as $use)
                <div class="use-row existing-row">
                    <a href="{{ route('delete_application_image', $use->id) }}"
                       class="remove-use-row"
                       title="Delete this use"
                       onclick="return confirm('Remove this use case? This cannot be undone.');">
                        <i class="bi bi-x"></i>
                    </a>
                    <div class="use-row-grid">
                        <div class="existing-thumb">
                            <img src="{{ asset('application/' . $use->image) }}" alt="{{ $use->title }}">
                        </div>
                        <div class="use-row-fields">
                            <input type="hidden" name="existing_id[]" value="{{ $use->id }}">
                            <div>
                                <label class="form-label">Use Title</label>
                                <input type="text" name="existing_title[]" value="{{ $use->title }}" class="form-control">
                            </div>
                            <div>
                                <label class="form-label">Use Description</label>
                                <div class="existing-desc-toolbar">
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
                                <div class="existing-desc-editor">{!! $use->description !!}</div>
                                <input type="hidden" name="existing_description[]" class="existing-desc-input">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="divider-line"></div>
        @endif

        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="section-label mb-0">Add New Use Cases</div>
                <p class="form-hint mt-0 mb-0">Optional — add more uses without touching the existing ones above.</p>
            </div>
        </div>

        <div id="useRowsWrap"></div>

        <div class="add-use-btn" id="addUseBtn">
            <i class="bi bi-plus-lg me-1"></i> Add Another Use
        </div>
    </div>

    <div class="form-actions d-flex justify-content-end gap-2">
        <a href="{{ route('view_application') }}" class="btn btn-light border">Cancel</a>
        <button type="submit" class="btn-fiox px-4">
            <i class="bi bi-check2-circle me-1"></i> Update Application
        </button>
    </div>
</form>

<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<script>
    const useRowsWrap = document.getElementById('useRowsWrap');
    const addUseBtn = document.getElementById('addUseBtn');

    // ===== Rich text for the EXISTING use-case rows already on the page =====
    const existingQuills = [];
    document.querySelectorAll('.existing-row').forEach(row => {
        const toolbarEl = row.querySelector('.existing-desc-toolbar');
        const editorEl = row.querySelector('.existing-desc-editor');
        const inputEl = row.querySelector('.existing-desc-input');

        const q = new Quill(editorEl, {
            theme: 'snow',
            modules: { toolbar: toolbarEl },
            placeholder: 'Short description of this use case...'
        });

        existingQuills.push({ quill: q, input: inputEl });
    });

    function renumberRows() {
        const rows = useRowsWrap.querySelectorAll('.use-row');
        rows.forEach((row, index) => {
            row.querySelector('.use-row-number').textContent = 'New Use #' + (index + 1);
        });
    }

    function createUseRow() {
        const row = document.createElement('div');
        row.className = 'use-row';
        row.innerHTML = `
            <div class="use-row-number">New Use</div>
            <div class="remove-use-row" title="Remove this row" style="cursor:pointer;">
                <i class="bi bi-x"></i>
            </div>
            <div class="use-row-grid">
                <div>
                    <div class="use-image-drop" data-role="drop">
                        <div class="placeholder-text" data-role="placeholder">
                            <i class="bi bi-cloud-arrow-up"></i>
                            Upload image
                        </div>
                        <img src="" class="d-none" data-role="preview" alt="New use image preview">
                    </div>
                    <input type="file" name="use_image[]" accept="image/*" class="d-none" data-role="input">
                </div>
                <div class="use-row-fields">
                    <div>
                        <label class="form-label">Use Title</label>
                        <input type="text" name="use_title[]" class="form-control" placeholder="e.g. Drainage Structures">
                    </div>
                    <div>
                        <label class="form-label">Use Description</label>
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

        // wire up rich text description for this new row
        const descToolbar = row.querySelector('[data-role="descToolbar"]');
        const descEditorEl = row.querySelector('[data-role="descEditor"]');
        const descInput = row.querySelector('[data-role="descInput"]');

        const descQuill = new Quill(descEditorEl, {
            theme: 'snow',
            modules: { toolbar: descToolbar },
            placeholder: 'Short description of this use case...'
        });

        row._descQuill = descQuill;
        row._descInput = descInput;

        row.querySelector('.remove-use-row').addEventListener('click', (e) => {
            e.preventDefault();
            row.remove();
            renumberRows();
        });

        useRowsWrap.appendChild(row);
        renumberRows();
    }

    addUseBtn.addEventListener('click', createUseRow);

    document.getElementById('applicationForm').addEventListener('submit', function () {
        // sync existing rows
        existingQuills.forEach(item => {
            item.input.value = item.quill.root.innerHTML;
        });
        // sync newly added rows
        useRowsWrap.querySelectorAll('.use-row').forEach(row => {
            if (row._descQuill && row._descInput) {
                row._descInput.value = row._descQuill.root.innerHTML;
            }
        });
    });
</script>

@endsection