<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Application;
use App\Models\ApplicationImage;
use App\Models\Contact;
use App\Models\Brochure;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard(){
        if(Auth::check() && Auth::user()->usertype == 'admin'){
            return view('admin.dashboard');
        }
        else{
            return view('dashboard');
        }
    }

    public function index(){
        return view('index');
    }

    public function aboutus(){
        return view('aboutus');
    }

    public function contactus(){
        return view('contact');
    }

    public function productShow($slug){
        $product = Product::with(['images', 'comparisonImages'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return view('productdetails', compact('product'));
    }

    public function applicationShow($id)
    {
        $application = Application::with('images')
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        return view('applicationdetails', compact('application'));
    }

    //==========================        inquiry form        ==========================
    public function store(Request $request)
    {
        // 1) Validate all fields (captcha included)
        $validated = $request->validate([
            'full_name'        => 'required|string|max:255',
            'company_name'     => 'nullable|string|max:255',
            'phone'            => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'product_interest' => 'nullable|exists:products,id',
            'description'      => 'nullable|string',
            'captcha'          => 'required|string',
        ], [
            'captcha.required' => 'Please enter the captcha code.',
        ]);

        // 2) Verify captcha against the session code
        $sessionCode = (string) session('contact_captcha', '');

        if ($sessionCode === '' || !hash_equals($sessionCode, trim($validated['captcha']))) {

            return back()
                ->withErrors(['captcha' => 'Invalid captcha code. Please try again.'])
                ->withInput();
        }

        // One-time use: a code can't be reused by a bot
        session()->forget('contact_captcha');

        // 3) Save inquiry
        $contact = Contact::create([
            'full_name'    => $validated['full_name'],
            'company_name' => $validated['company_name'] ?? null,
            'phone'        => $validated['phone'],
            'email'        => $validated['email'] ?? null,
            'product_id'   => $validated['product_interest'] ?? null,
            'description'  => $validated['description'] ?? null,
        ]);

        // 4) Build WhatsApp message
        $productName = $contact->product ? $contact->product->name : 'Not specified';

        $message = "New Inquiry - FIOX Global Composites\n"
            . "Name: {$contact->full_name}\n"
            . "Company: " . ($contact->company_name ?: '-') . "\n"
            . "Phone: {$contact->phone}\n"
            . "Email: " . ($contact->email ?: '-') . "\n"
            . "Product: {$productName}\n"
            . "Details: " . ($contact->description ?: '-');

        $whatsappNumber = '919228270185'; // Shaiban Girach, no + or spaces
        $whatsappUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);

        return redirect()->away($whatsappUrl);
    }

    public function downloadBrochure(Brochure $brochure)
    {
        $filePath = public_path($brochure->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $brochure->file_name);
    }

    // ================= CAPTCHA IMAGE (SVG, mixed case) =================
    public function captcha()
    {
        // Uppercase: no I, O
        $upper = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        // Lowercase: only letters that look different from their capital (no c, i, k, l, o, p, s, u, v, w, x, z)
        $lower = 'abdefghmnqrty';
        $digit = '23456789';

        $all  = $upper . $lower . $digit;
        $code = '';

        // guarantee at least 1 capital and 1 small letter
        $code .= $upper[random_int(0, strlen($upper) - 1)];
        $code .= $lower[random_int(0, strlen($lower) - 1)];

        for ($i = 0; $i < 3; $i++) {
            $code .= $all[random_int(0, strlen($all) - 1)];
        }

        // shuffle so the guaranteed ones aren't always first
        $code = str_shuffle($code);

        session(['contact_captcha' => $code]);

        $w = 180;
        $h = 56;

        $svg  = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $w . '" height="' . $h . '" viewBox="0 0 ' . $w . ' ' . $h . '">';
        $svg .= '<rect width="100%" height="100%" rx="8" fill="#FAF8F5"/>';

        // noise lines
        for ($i = 0; $i < 6; $i++) {
            $svg .= '<line x1="' . random_int(0, $w) . '" y1="' . random_int(0, $h)
                . '" x2="' . random_int(0, $w) . '" y2="' . random_int(0, $h)
                . '" stroke="#D2C3AA" stroke-width="1.5"/>';
        }

        // noise dots
        for ($i = 0; $i < 40; $i++) {
            $svg .= '<circle cx="' . random_int(0, $w) . '" cy="' . random_int(0, $h)
                . '" r="1.2" fill="#D2C3AA"/>';
        }

        // characters
        $x = 18;
        foreach (str_split($code) as $c) {
            $y      = random_int(36, 44);
            $rotate = random_int(-15, 15);
            $fill   = random_int(0, 1) ? '#2F2F30' : '#B8791F';

            $svg .= '<text x="' . $x . '" y="' . $y . '" font-family="Arial, Helvetica, sans-serif" '
                . 'font-size="32" font-weight="bold" fill="' . $fill . '" '
                . 'transform="rotate(' . $rotate . ' ' . $x . ' ' . $y . ')">' . $c . '</text>';
            $x += 30;
        }

        $svg .= '</svg>';

        return response($svg, 200, [
            'Content-Type'  => 'image/svg+xml',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma'        => 'no-cache',
        ]);
    }
}