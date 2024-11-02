<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\Barcode;

class BarcodeController extends Controller
{
    public function create()
    {
        return view('create_barcodes');
    }

    public function store(Request $request)
    {
        $request->validate([
            'count' => 'required|integer|min:1',
        ]);

        $count = $request->input('count');

        for ($i = 0; $i < $count; $i++) {
            // توليد رقم عشوائي
            $randomNumber = rand(1000, 9999);
            $barcodeName = 'QrA&M' . $randomNumber;

            // إنشاء كود QR
            $qrCode = new QrCode($barcodeName);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            // حفظ الصورة إلى قاعدة البيانات
            Barcode::create([
                'name' => $barcodeName,
                'code' => 'data:image/png;base64,' . base64_encode($result->getString()), // حفظ كود QR كصورة مشفرة
                'is_active' => true,
            ]);
        }

        return redirect()->route('barcodes.create')->with('success', 'تم إنشاء الباركودات بنجاح!');
    }


    public function index()
{
    $barcodes = Barcode::all();
    return view('index_barcodes', compact('barcodes'));
}


// ...

protected function generateBarcodeImage($code)
{
    $qrCode = new QrCode($code);
    $writer = new PngWriter();

    // يمكن استخدام هذا الخيار لتحديد حجم الصورة
    $qrCode->setSize(300);

    // كتابة الصورة إلى البيانات
    $result = $writer->write($qrCode);

    // ترميز الصورة إلى قاعدة 64
    return 'data:image/png;base64,' . base64_encode($result->getString());
}


public function show($id)
{
    $barcode = Barcode::findOrFail($id);
    $barcodeImage = $this->generateBarcodeImage($barcode->name); // استخدام الوظيفة السابقة لتوليد الصورة

    return view('show_barcode', compact('barcode', 'barcodeImage'));
}

public function toggle($code)
{
    $barcode = Barcode::where('code', $code)->first();

    if ($barcode) {
        $barcode->is_active = !$barcode->is_active; // عكس الحالة
        $barcode->save();

        return response()->json(['message' => 'تم تغيير الحالة بنجاح!']);
    }

    return response()->json(['message' => 'الباركود غير موجود!'], 404);
}

}
