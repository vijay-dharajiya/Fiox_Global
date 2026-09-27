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

    /* ===== MAIN IMAGE DROPZONE ===== */
    .main-image-drop {
        border: 1.5px dashed var(--fiox-amber);
        border-radius: 12px;
        background: rgba(184, 121, 31, 0.03);
        height: 220px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        overflow: hidden;
        position: relative;
        transition: all 0.2s ease;
    }

    .main-image-drop:hover {
        background: rgba(184, 121, 31, 0.06);
    }

    .main-image-drop img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 10px;
    }

    .current-image-label {
        font-size: 0.76rem;
        color: var(--fiox-text-muted);
        margin-top: 6px;
    }

    /* ===== GALLERY / COMPARISON UPLOAD (shared style) ===== */
    .gallery-drop {
        border: 1.5px dashed var(--fiox-amber);
        border-radius: 12px;
        background: rgba(184, 121, 31, 0.03);
        padding: 22px;
        text-align: center;
        cursor: pointer;
        color: var(--fiox-amber-dark);
        transition: all 0.2s ease;
    }

    .gallery-drop:hover {
        background: rgba(184, 121, 31, 0.06);
    }

    .gallery-drop i {
        font-size: 1.8rem;
        display: block;
        margin-bottom: 6px;
    }

    .gallery-drop span {
        font-size: 0.86rem;
        font-weight: 600;
    }

    .gallery-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(96px, 1fr));
        gap: 12px;
        margin-top: 16px;
    }

    .gallery-thumb {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid var(--fiox-border);
        background: #fff;
        aspect-ratio: 1 / 1;
    }

    .gallery-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-thumb .remove-thumb {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: rgba(47, 47, 48, 0.75);
        color: #fff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        line-height: 1;
        cursor: pointer;
        text-decoration: none;
    }

    .gallery-thumb .remove-thumb:hover {
        background: #c0392b;
        color: #fff;
    }

    .gallery-thumb.existing-thumb .remove-thumb {
        background: rgba(192, 57, 43, 0.85);
    }

    .gallery-section-label {
        font-size: 0.76rem;
        font-weight: 600;
        color: var(--fiox-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin: 18px 0 8px;
    }

    /* ===== DESCRIPTION / ADVANTAGES EDITORS ===== */
    #descriptionEditor,
    #advantagesEditor {
        background: #fff;
        border-radius: 0 0 8px 8px;
        min-height: 220px;
        font-size: 0.9rem;
    }

    #advantagesEditor {
        min-height: 160px;
    }

    .ql-toolbar.ql-snow {
        border: 1px solid var(--fiox-border);
        border-radius: 8px 8px 0 0;
        background: var(--fiox-bg);
    }

    .ql-container.ql-snow {
        border: 1px solid var(--fiox-border);
        border-top: none;
        border-radius: 0 0 8px 8px;
    }

    .ql-editor.ql-blank::before {
        color: #b7b2ab;
        font-style: normal;
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
        <h4 class="fw-bold mb-1" style="color: var(--fiox-charcoal);">Update Product</h4>
        <small class="text-muted">Editing: {{ $product->name }}</small>
    </div>
    <a href="{{ route('view_product') }}" class="btn-fiox-outline">
        <i class="bi bi-arrow-left me-1"></i> View Products
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

<form action="{{ route('update_product', $product->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
    @csrf

    <div class="row g-3">
        <!-- LEFT: IMAGES -->
        <div class="col-xl-4">
            <div class="panel-card p-3 mb-3">
                <label class="form-label">Main Product Image</label>
                <div class="main-image-drop" id="mainImageDrop">
                    <img src="{{ asset('product/' . $product->image) }}" id="mainImagePreview" alt="Main image preview">
                </div>
                <input type="file" name="image" id="mainImageInput" accept="image/*" class="d-none">
                <p class="current-image-label">Click the image to replace it. Leave unchanged to keep the current one.</p>
            </div>

            <div class="panel-card p-3 mb-3">
                <label class="form-label">Additional Images (Gallery)</label>

                @if ($product->images->count() > 0)
                    <div class="gallery-section-label">Current Images</div>
                    <div class="gallery-preview mb-2">
                        @foreach ($product->images as $img)
                            <div class="gallery-thumb existing-thumb">
                                <img src="{{ asset('product/' . $img->image) }}" alt="Gallery image">
                                <a href="{{ route('delete_product_image', $img->id) }}"
                                   class="remove-thumb"
                                   onclick="return confirm('Remove this image? Any unsaved changes on this page will be lost.');">
                                    <i class="bi bi-x"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="gallery-section-label">Add New Images</div>
                <div class="gallery-drop" id="galleryDrop">
                    <i class="bi bi-images"></i>
                    <span>Click to upload multiple images</span>
                    <div class="form-hint mb-0">You can select more than one file at once</div>
                </div>
                <input type="file" name="images[]" id="galleryInput" accept="image/*" multiple class="d-none">
                <div class="gallery-preview" id="galleryPreview"></div>
            </div>

            <div class="panel-card p-3">
                <label class="form-label">Comparison Table Images</label>
                <p class="form-hint mt-0 mb-2">
                    Images shown in the product's comparison table section (e.g. GFRP vs Steel).
                </p>

                @if ($product->comparisonImages->count() > 0)
                    <div class="gallery-section-label">Current Images</div>
                    <div class="gallery-preview mb-2">
                        @foreach ($product->comparisonImages as $cimg)
                            <div class="gallery-thumb existing-thumb">
                                <img src="{{ asset('product/' . $cimg->image) }}" alt="Comparison image">
                                <a href="{{ route('delete_comparison_image', $cimg->id) }}"
                                   class="remove-thumb"
                                   onclick="return confirm('Remove this comparison image? Any unsaved changes on this page will be lost.');">
                                    <i class="bi bi-x"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="gallery-section-label">Add New Images</div>
                <div class="gallery-drop" id="comparisonDrop">
                    <i class="bi bi-table"></i>
                    <span>Click to upload comparison images</span>
                    <div class="form-hint mb-0">You can select more than one file at once</div>
                </div>
                <input type="file" name="comparison_images[]" id="comparisonInput" accept="image/*" multiple class="d-none">
                <div class="gallery-preview" id="comparisonPreview"></div>
            </div>
        </div>

        <!-- RIGHT: DETAILS -->
        <div class="col-xl-8">
            <div class="panel-card p-4 mb-3">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Product Name <span class="required-mark">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" placeholder="e.g. GFRP Rebar 12mm">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="panel-card p-4 mb-3">
                <label class="form-label">Product Description <span class="required-mark">*</span></label>
                <p class="form-hint mt-0 mb-2">
                    Write in paragraphs for the overview, and use the list button in the toolbar for spec/feature bullet points.
                </p>

                <div id="descriptionToolbar">
                    <span class="ql-formats">
                        <select class="ql-header">
                            <option value="3">Heading</option>
                            <option selected>Normal</option>
                        </select>
                    </span>
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
                        <button class="ql-link"></button>
                        <button class="ql-clean"></button>
                    </span>
                </div>
                <div id="descriptionEditor">{!! old('description', $product->description) !!}</div>

                <input type="hidden" name="description" id="descriptionInput">
            </div>

            <div class="panel-card p-4 mb-3">
                <label class="form-label">Product Advantages</label>
                <p class="form-hint mt-0 mb-2">
                    Use the list button in the toolbar to add each advantage as a separate bullet point.
                </p>

                <div id="advantagesToolbar">
                    <span class="ql-formats">
                        <select class="ql-header">
                            <option value="3">Heading</option>
                            <option selected>Normal</option>
                        </select>
                    </span>
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
                <div id="advantagesEditor">{!! old('advantages', $product->advantages) !!}</div>

                <input type="hidden" name="advantages" id="advantagesInput">
            </div>

            <div class="panel-card p-4">
                <div class="form-actions d-flex justify-content-end gap-2 pt-0 border-0 mt-0">
                    <a href="{{ route('view_product') }}" class="btn btn-light border">Cancel</a>
                    <button type="submit" class="btn-fiox px-4">
                        <i class="bi bi-check2-circle me-1"></i> Update Product
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
<script>
    // ===== Rich text description (paragraphs + bullet points) =====
    const quill = new Quill('#descriptionEditor', {
        theme: 'snow',
        modules: { toolbar: '#descriptionToolbar' },
        placeholder: 'Write the product overview as a paragraph, then use bullet points for key specs or features...'
    });

    // ===== Rich text advantages (bullet points) =====
    const advantagesQuill = new Quill('#advantagesEditor', {
        theme: 'snow',
        modules: { toolbar: '#advantagesToolbar' },
        placeholder: 'Add each advantage as a bullet point — e.g. Corrosion resistant, Lightweight and high strength...'
    });

    // Send an empty string when an editor is empty, so Laravel's "required"
    // works for description (Quill otherwise sends "<p><br></p>").
    function editorHtml(editor) {
        return editor.getText().trim().length === 0 && !editor.root.querySelector('img')
            ? ''
            : editor.root.innerHTML;
    }

    document.getElementById('productForm').addEventListener('submit', function () {
        document.getElementById('descriptionInput').value = editorHtml(quill);
        document.getElementById('advantagesInput').value = editorHtml(advantagesQuill);
    });

    // ===== Main image upload + preview (replace existing) =====
    const mainImageDrop = document.getElementById('mainImageDrop');
    const mainImageInput = document.getElementById('mainImageInput');
    const mainImagePreview = document.getElementById('mainImagePreview');

    mainImageDrop.addEventListener('click', () => mainImageInput.click());

    mainImageInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                mainImagePreview.src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    // ===== Reusable multi-image dropzone factory (gallery + comparison) =====
    function initMultiImageDrop(dropId, inputId, previewId, altPrefix) {
        const dropEl = document.getElementById(dropId);
        const inputEl = document.getElementById(inputId);
        const previewEl = document.getElementById(previewId);
        let files = [];

        dropEl.addEventListener('click', () => inputEl.click());

        inputEl.addEventListener('change', function () {
            files = files.concat(Array.from(this.files));
            render();
            sync();
        });

        function render() {
            previewEl.innerHTML = '';

            files.forEach((file, index) => {
                // create the thumb right away so the order always matches the files array
                const thumb = document.createElement('div');
                thumb.className = 'gallery-thumb';
                thumb.innerHTML = `
                    <img alt="${altPrefix} image ${index + 1}">
                    <button type="button" class="remove-thumb">
                        <i class="bi bi-x"></i>
                    </button>
                `;
                previewEl.appendChild(thumb);

                const reader = new FileReader();
                reader.onload = e => {
                    thumb.querySelector('img').src = e.target.result;
                };
                reader.readAsDataURL(file);

                thumb.querySelector('.remove-thumb').addEventListener('click', () => {
                    files.splice(index, 1);
                    render();
                    sync();
                });
            });
        }

        function sync() {
            const dataTransfer = new DataTransfer();
            files.forEach(file => dataTransfer.items.add(file));
            inputEl.files = dataTransfer.files;
        }
    }

    // Gallery (new images only)
    initMultiImageDrop('galleryDrop', 'galleryInput', 'galleryPreview', 'New product');

    // Comparison table images (new images only)
    initMultiImageDrop('comparisonDrop', 'comparisonInput', 'comparisonPreview', 'New comparison');
</script>

@endsection