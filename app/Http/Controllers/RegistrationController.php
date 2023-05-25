<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Registration;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Auth;
// use Barryvdh\Snappy\Facades\SnappyPdf;

class registrationController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('pages.registration.index',[
            'registrations'    => Registration::all(),
        ]);
    }

    public function create(Registration $registration)
    {
        $this->authorize('create', $registration);
        return view('pages.registration.create',[
            'products' => Product::where('status', 'verified')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $registration = new Registration;
        $registration->validity = $request->validity;
        $registration->approval = $request->approval;
        $registration->application_number = $request->application_number;
        $registration->date_of_preparation = $request->date_of_preparation;
        $registration->product_id = $request->product_id;
        $registration->author_id = auth()->user()->id;
        $registration->save();
        return redirect()->route('registration.index')->with('successct', 'registration created successfully.');
    }

    public function edit(Registration $registration)
    {
        $this->authorize('update', $registration);
        $selectedProduct = $registration->product;
        return view('pages.registration.edit', [
            'registration'            => $registration,
            'products'        => Product::all(),
            'selectedProduct'  => $selectedProduct,
        ]);
    }

    public function update(Request $request, Registration $registration)
    {
        $this->authorize('update', $registration);
        $registration->validity = $request->validity;
        $registration->approval = $request->approval;
        $registration->application_number = $request->application_number;
        $registration->date_of_preparation = $request->date_of_preparation;
        $registration->product_id = $request->product_id;

        if($request->status){
            $registration->status = $request->status;
        }else{
            $registration->status = 'Processing';
        }
        
        $registration->save();
        return redirect()->route('registration.index')->with('successup', 'registration updated successfully.');;
    }


    public function destroy(Registration $registration)
    {
        $this->authorize('delete', $registration);
        $registration->delete();
        return redirect()->route('registration.index')->with('successdt', 'registration deleted successfully.');;
    }


    // public function generatePdf(Registration $registration)
    // {
    //     $pdf_url = asset('storage/reports/product_registration/' . $registration->product->name .'.pdf');
    //     $pdf_path = storage_path('app/public/reports/product_registration/' . $registration->product->name . '.pdf');

    //     $registration->product_registration = $registration->product->name . '.pdf';
    //     $registration->save();

    //     if (file_exists($pdf_path)) {
    //         return response()->download($pdf_path, $registration->product->name . '.pdf');
    //     }
    

    //     $writer = new PngWriter();
    //     $qrCode = new QrCode($pdf_url);
    //     $qrCode->setSize(200);
    //     $result = $writer->write($qrCode);
    //     $dataUri = $result->getDataUri();
        

    //     SnappyPdf::loadView('pages.registration.pdf', [
    //         'pdfproduct' => $registration,
    //         'qrCodeImage' => $dataUri,
    //     ])->save($pdf_path);
        
    //     return response()->download($pdf_path, $registration->product_registration);
    // }

    public function generatePdf(Registration $registration)
    {
        $pdf_url = asset('storage/reports/product_registration/' . $registration->product->name .'.pdf');
        $writer = new PngWriter();
        $qrCode = new QrCode($pdf_url);
        $qrCode->setSize(150);
        $result = $writer->write($qrCode);
        $dataUri = $result->getDataUri();
 
        
        $logoImagePath = storage_path('app/public/image/np-min.png');
        $logoImageContents = file_get_contents($logoImagePath);
        $logoImageData = base64_encode($logoImageContents);
        $logoImageMimeType = mime_content_type($logoImagePath);
        $logoImageDataUri = 'data:' . $logoImageMimeType . ';base64,' . $logoImageData;
 
        $html = view('pages.registration.pdf', [
            'pdfproduct' => $registration,
            'qrCodeImage' => $dataUri,
            'logo' => $logoImageDataUri,
            ])->render();
 
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'autoScriptToLang' => false, 
            'autoLangToFont' => true,
            'default_font' => 'freesans',
            'default_font_size' => 12,
            'showImageErrors' => true,
        ]);
        
        $mpdf->WriteHTML($html);
        $pdf_path = Storage::disk('public')->put('reports/product_registration/' . $registration->product->name . '.pdf', $mpdf->Output('', 'S'));
        $registration->product_registration = $registration->product->name . '.pdf';
        $registration->save();
 
        return response()->download(storage_path('app/public/reports/product_registration/' . $registration->product->name . '.pdf'));
    }

}