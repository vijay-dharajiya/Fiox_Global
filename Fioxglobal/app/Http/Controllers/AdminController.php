<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Application;
use App\Models\ApplicationImage;
use App\Models\Brochure;
use App\Models\Ctableimage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Save an uploaded image into public/product and return the file name.
     */
    private function saveProductImage($file, string $prefix = ''): string
    {
        $folder = public_path('product');

        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $name = $prefix . time() . '_' . Str::random(8) . '.' . $file->extension();
        $file->move($folder, $name);

        return $name;
    }

    /**
     * Delete an image file from public/product if it exists.
     */
    private function removeProductImageFile(?string $filename): void
    {
        if (!$filename) {
            return;
        }

        $path = public_path('product/' . $filename);

        if (file_exists($path)) {
            unlink($path);
        }
    }

    //========================= Product Management ========================

    public function addproduct()
    {
        return view('admin.addproduct');
    }

    public function view_product()
    {
        $products = Product::orderBy('position', 'asc')->get();
        return view('admin.viewproduct', compact('products'));
    }

    public function storeproduct(Request $rq)
    {
        $rq->validate([
            'name'                => 'required|string|max:150',
            'description'         => 'required|string',
            'advantages'          => 'nullable|string',
            'status'              => 'required|in:active,inactive',
            'image'               => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'images.*'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'comparison_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $product = new Product;
        $product->name        = $rq->name;
        $product->description = $rq->description;
        $product->advantages  = $rq->advantages;
        $product->status      = $rq->status;
        $product->slug        = Str::slug($rq->name) . '-' . time();

        // main image
        $product->image = $this->saveProductImage($rq->file('image'));

        // new products always go to the end of the drag order
        $product->position = (int) Product::max('position') + 1;

        $product->save();

        // gallery images
        if ($rq->hasFile('images')) {
            foreach ($rq->file('images') as $img) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $this->saveProductImage($img),
                ]);
            }
        }

        // comparison table images
        if ($rq->hasFile('comparison_images')) {
            foreach ($rq->file('comparison_images') as $img) {
                Ctableimage::create([
                    'product_id' => $product->id,
                    'image'      => $this->saveProductImage($img, 'cmp_'),
                ]);
            }
        }

        return redirect()->route('view_product')->with('msg', 'Product added successfully');
    }

    public function editproduct($id)
    {
        $product = Product::with(['images', 'comparisonImages'])->findOrFail($id);
        return view('admin.editproduct', compact('product'));
    }

    public function updateproduct(Request $rq, $id)
    {
        $rq->validate([
            'name'                => 'required|string|max:150',
            'description'         => 'required|string',
            'advantages'          => 'nullable|string',
            'status'              => 'required|in:active,inactive',
            'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'images.*'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'comparison_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $product = Product::findOrFail($id);

        $product->name        = $rq->name;
        $product->description = $rq->description;
        $product->advantages  = $rq->advantages;
        $product->status      = $rq->status;

        // replace main image only if a new one was uploaded
        if ($rq->hasFile('image')) {
            $this->removeProductImageFile($product->image);
            $product->image = $this->saveProductImage($rq->file('image'));
        }

        $product->save();

        // add new gallery images
        if ($rq->hasFile('images')) {
            foreach ($rq->file('images') as $img) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $this->saveProductImage($img),
                ]);
            }
        }

        // add new comparison images
        if ($rq->hasFile('comparison_images')) {
            foreach ($rq->file('comparison_images') as $img) {
                Ctableimage::create([
                    'product_id' => $product->id,
                    'image'      => $this->saveProductImage($img, 'cmp_'),
                ]);
            }
        }

        return redirect()->route('view_product')->with('msg', 'Product updated successfully');
    }

    public function deleteProduct($id)
    {
        $product = Product::with(['images', 'comparisonImages'])->findOrFail($id);

        // main image
        $this->removeProductImageFile($product->image);

        // gallery images
        foreach ($product->images as $image) {
            $this->removeProductImageFile($image->image);
        }

        // comparison images
        foreach ($product->comparisonImages as $cmp) {
            $this->removeProductImageFile($cmp->image);
        }

        // delete rows, then the product
        $product->images()->delete();
        $product->comparisonImages()->delete();
        $product->delete();

        return redirect()->route('view_product')->with('msg', 'Product deleted successfully');
    }

    public function deleteProductImage($id)
    {
        $productImage = ProductImage::findOrFail($id);

        $this->removeProductImageFile($productImage->image);
        $productImage->delete();

        return redirect()->back()->with('msg', 'Image removed successfully');
    }

    public function deleteComparisonImage($id)
    {
        $comparisonImage = Ctableimage::findOrFail($id);

        $this->removeProductImageFile($comparisonImage->image);
        $comparisonImage->delete();

        return redirect()->back()->with('msg', 'Comparison image removed successfully');
    }

    // Saves the new order after a drag on the Products list
    public function reorder(Request $request)
    {
        $order = $request->input('order', []); // array of product IDs, in new order

        foreach ($order as $index => $id) {
            Product::where('id', $id)->update(['position' => $index + 1]);
        }

        return response()->json(['status' => 'ok']);
    }

        //========================= Application Management ========================

    public function addapplication()
    {
        return view('admin.addapplication');
    }

    public function viewapplications()
    {
        $applications = Application::with('images')->orderBy('position', 'asc')->get();
        return view('admin.viewapplication', compact('applications'));
    }

    public function storeapplication(Request $rq)
    {
        $rq->validate([
            'name'          => 'required|string|max:150',
            'status'        => 'required|in:active,inactive',
            'use_title'     => 'required|array|min:1',
            'use_title.*'   => 'required|string|max:150',
            'use_description' => 'nullable|array',
            'use_description.*' => 'nullable|string|max:2000',
            'use_image'     => 'required|array|min:1',
            'use_image.*'   => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $folder = public_path('application');
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $application = Application::create([
            'name'     => $rq->name,
            'status'   => $rq->status,
            // new applications always go to the end of the drag order
            'position' => (int) Application::max('position') + 1,
        ]);

        foreach ($rq->file('use_image') as $key => $img) {
            $imagename = time() . '_' . $key . '.' . $img->getClientOriginalExtension();
            $img->move($folder, $imagename);

            ApplicationImage::create([
                'application_id' => $application->id,
                'title'          => $rq->use_title[$key],
                'description'    => $rq->use_description[$key] ?? '',
                'image'          => $imagename,
            ]);
        }

        return redirect()->route('view_application')->with('msg', 'Application added successfully');
    }

    public function editapplication($id)
    {
        $application = Application::with('images')->findOrFail($id);
        return view('admin.editapplication', compact('application'));
    }

    public function updateapplication(Request $rq, $id)
    {
        $rq->validate([
            'name'                  => 'required|string|max:150',
            'status'                => 'required|in:active,inactive',
            'existing_title.*'      => 'nullable|string|max:150',
            'existing_description.*' => 'nullable|string|max:2000',
            'use_title.*'           => 'nullable|string|max:150',
            'use_description.*'     => 'nullable|string|max:2000',
            'use_image.*'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $application = Application::findOrFail($id);
        $application->name   = $rq->name;
        $application->status = $rq->status;
        $application->save();

        // update title + description of existing uses
        if ($rq->has('existing_id')) {
            foreach ($rq->existing_id as $key => $existingId) {
                ApplicationImage::where('id', $existingId)->update([
                    'title'       => $rq->existing_title[$key],
                    'description' => $rq->existing_description[$key] ?? '',
                ]);
            }
        }

        // add brand new uses (if any were added on the edit page)
        if ($rq->hasFile('use_image')) {
            $folder = public_path('application');
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            foreach ($rq->file('use_image') as $key => $img) {
                if (!$img) continue;

                $imagename = time() . '_' . $key . '.' . $img->getClientOriginalExtension();
                $img->move($folder, $imagename);

                ApplicationImage::create([
                    'application_id' => $application->id,
                    'title'          => $rq->use_title[$key] ?? 'Untitled',
                    'description'    => $rq->use_description[$key] ?? '',
                    'image'          => $imagename,
                ]);
            }
        }

        return redirect()->route('view_application')->with('msg', 'Application updated successfully');
    }

    public function deleteApplicationImage($id)
    {
        $useImage = ApplicationImage::findOrFail($id);
        $folder = public_path('application');

        if (file_exists($folder . '/' . $useImage->image)) {
            unlink($folder . '/' . $useImage->image);
        }

        $useImage->delete();

        return redirect()->back()->with('msg', 'Use case removed successfully');
    }

    public function deleteApplication($id)
    {
        $application = Application::with('images')->findOrFail($id);
        $folder = public_path('application');

        foreach ($application->images as $img) {
            if (file_exists($folder . '/' . $img->image)) {
                unlink($folder . '/' . $img->image);
            }
        }

        $application->delete();

        return redirect()->route('view_application')->with('msg', 'Application deleted successfully');
    }

    // Saves the new order after a drag on the Applications list
    public function reorderApplications(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:applications,id',
        ]);

        foreach ($request->order as $index => $id) {
            Application::where('id', $id)->update(['position' => $index + 1]);
        }

        return response()->json(['status' => 'ok']);
    }

    //========================= Brochure Management ========================
    public function addBrochure()
    {
        $brochures = Brochure::latest()->get();
        return view('admin.addbrochure', compact('brochures'));
    }

    public function storeBrochure(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file'  => 'required|file|mimes:pdf|max:20480', // 20MB max
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $fileSize = $file->getSize();
        // Unique name for storage, e.g. 1758200000_FIOX-Brochure-2026.pdf
        $uniqueName = time() . '_' . preg_replace('/\s+/', '-', $originalName);

        $destination = public_path('brochures');

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $uniqueName);

        Brochure::create([
            'title'     => $request->title,
            'file_name' => $originalName,          // shown to the user
            'file_path' => 'brochures/' . $uniqueName, // actual stored path
            'file_size' => $fileSize,
        ]);

        return back()->with('success', 'Brochure uploaded successfully.');
    }

    public function destroyBrochure($id)
    {
        $brochure = Brochure::findOrFail($id);

        $fullPath = public_path($brochure->file_path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }

        $brochure->delete();

        return back()->with('success', 'Brochure deleted successfully.');
    }

    //========================= Inquiry Management ========================
    public function viewInquiries()
    {
        $inquiries = \App\Models\Contact::with('product')->latest()->get();
        return view('admin.inquery', compact('inquiries'));
    }

    public function deleteInquiry($id)
    {
        $inquiry = \App\Models\Contact::findOrFail($id);
        $inquiry->delete();

        return redirect()->route('inquiry.view')->with('msg', 'Inquiry deleted successfully');
    }

}