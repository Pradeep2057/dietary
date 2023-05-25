<?php

namespace App\Http\Controllers;

use App\Models\Renewal;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
// use Barryvdh\Snappy\Facades\SnappyPdf;
use Mpdf\Mpdf;

class RenewalController extends Controller
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
       return view('pages.renewal.index',[
           'renewals'    => Renewal::all(),
       ]);
   }

   public function create(Renewal $renewal)
   {
       $this->authorize('create', $renewal);
       return view('pages.renewal.create',[
           'products' => Product::where('status', 'verified')->get(),
       ]);
   }

   public function store(Request $request)
   {
       $renewal = new Renewal;
       $renewal->valid_from = $request->valid_from;
       $renewal->valid_to = $request->valid_to;
       $renewal->application_number = $request->application_number;
       $renewal->date_of_preparation = $request->date_of_preparation;
       $renewal->product_id = $request->product_id;
       $renewal->author_id = auth()->user()->id;
       $renewal->save();
       return redirect()->route('renewal.index')->with('successct', 'renewal created successfully.');
   }

   public function edit(Renewal $renewal)
   {
       $this->authorize('update', $renewal);
       $selectedProduct = $renewal->product;
       return view('pages.renewal.edit', [
           'renewal'            => $renewal,
           'products'        => Product::all(),
           'selectedProduct'  => $selectedProduct,
       ]);
   }

   public function update(Request $request, Renewal $renewal)
   {
       $this->authorize('update', $renewal);
       $renewal->valid_from = $request->valid_from;
       $renewal->valid_to = $request->valid_to;
       $renewal->application_number = $request->application_number;
       $renewal->date_of_preparation = $request->date_of_preparation;
       $renewal->product_id = $request->product_id;
       if($request->status){
           $renewal->status = $request->status;
       }else{
           $renewal->status = 'Processing';
       }
       $renewal->save();
       return redirect()->route('renewal.index')->with('successup', 'renewal updated successfully.');;
   }


   public function destroy(Renewal $renewal)
   {
       $this->authorize('delete', $renewal);
       $renewal->delete();
       return redirect()->route('renewal.index')->with('successdt', 'renewal deleted successfully.');;
   }


//    public function generatePdf(Renewal $renewal)
//    {
//        $pdf_url = asset('storage/reports/product_renewal/' . $renewal->product->name .'.pdf');
//        $pdf_path = storage_path('app/public/reports/product_renewal/' . $renewal->product->name . '.pdf');

//        if (file_exists($pdf_path)) {
//            return response()->download($pdf_path, $renewal->product->name . '.pdf');
//        }
   
//        $renewal->product_renewal = $renewal->product->name . '.pdf';
//        $renewal->save();

//        $writer = new PngWriter();
//        $qrCode = new QrCode($pdf_url);
//        $qrCode->setSize(200);
//        $result = $writer->write($qrCode);
//        $dataUri = $result->getDataUri();

//        SnappyPdf::loadView('pages.renewal.pdf', [
//            'pdfproduct' => $renewal,
//            'qrCodeImage' => $dataUri,
//        ])->save($pdf_path);
       
       

//        return response()->download($pdf_path, $renewal->product->name . '.pdf');
//    }


   public function generatePdf(Renewal $renewal)
   {
       $pdf_url = asset('storage/reports/product_renewal/' . $renewal->product->name .'.pdf');
       $writer = new PngWriter();
       $qrCode = new QrCode($pdf_url);
       $qrCode->setSize(100);
       $result = $writer->write($qrCode);
       $dataUri = $result->getDataUri();

       
       $logoImagePath = storage_path('app/public/image/np-min.png');
       $logoImageContents = file_get_contents($logoImagePath);
       $logoImageData = base64_encode($logoImageContents);
       $logoImageMimeType = mime_content_type($logoImagePath);
       $logoImageDataUri = 'data:' . $logoImageMimeType . ';base64,' . $logoImageData;

       $html = view('pages.renewal.pdf', [
           'pdfproduct' => $renewal,
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
       $pdf_path = Storage::disk('public')->put('reports/product_renewal/' . $renewal->product->name . '.pdf', $mpdf->Output('', 'S'));
       $renewal->product_renewal = $renewal->product->name . '.pdf';
       $renewal->save();

       return response()->download(storage_path('app/public/reports/product_renewal/' . $renewal->product->name . '.pdf'));
   }






}
