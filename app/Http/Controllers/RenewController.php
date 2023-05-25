<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Renew;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class RenewController extends Controller
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
        if(auth()->user()->role == 0){
            $statuses = ['Pending', 'Verified'];
            $renews = Renew::whereIn('status', $statuses)->get();
        }else{
            $renews = Renew::all();
        }
        return view('pages.renew.index',[
            'renews'    => $renews,
        ]);
    }

    public function create(Renew $renew)
    {
        $this->authorize('create', $renew);
        return view('pages.renew.create',[
            'products' => Product::where('status', 'verified')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $renew = new Renew;
        $renew->date_of_grant = $request->date_of_grant;
        $renew->renew_valid = $request->renew_valid;
        $renew->application_number = $request->application_number;
        $renew->validity_from = $request->validity_from;
        $renew->validity_to = $request->validity_to;
        $renew->gmp_validity = $request->gmp_validity;
        $renew->date_of_preparation = $request->date_of_preparation;
        $renew->product_id = $request->product_id;
        $renew->prepared_by = $request->prepared_by;
        $renew->post = $request->post;
        $renew->author_id = auth()->user()->id;
        $renew->save();
        return redirect()->route('renew.index')->with('successct', 'renew created successfully.');
    }

    public function edit(Renew $renew)
    {
        $this->authorize('update', $renew);
        $selectedProduct = $renew->product;
        return view('pages.renew.edit', [
            'renew'            => $renew,
            'products'        => Product::all(),
            'selectedProduct'  => $selectedProduct,
        ]);
    }

    public function update(Request $request, Renew $renew)
    {
        $this->authorize('update', $renew);
        $renew->date_of_grant = $request->date_of_grant;
        $renew->renew_valid = $request->renew_valid;
        $renew->application_number = $request->application_number;
        $renew->validity_from = $request->validity_from;
        $renew->validity_to = $request->validity_to;
        $renew->gmp_validity = $request->gmp_validity;
        $renew->date_of_preparation = $request->date_of_preparation;
        $renew->product_id = $request->product_id;
        $renew->prepared_by = $request->prepared_by;
        $renew->post = $request->post;

        if($request->status){
            $renew->status = $request->status;
        }else{
            $renew->status = 'Processing';
        }

        $renew->save();
        return redirect()->route('renew.index')->with('successup', 'renew updated successfully.');;
    }


    public function destroy(Renew $renew)
    {
        $this->authorize('delete', $renew);
        $renew->delete();
        return redirect()->route('renew.index')->with('successdt', 'renew deleted successfully.');;
    }

    public function generatePdf(Renew $renew)
    {
        $pdf_url = asset('storage/reports/production_renew/' . $renew->product->name .'.pdf');
        $writer = new PngWriter();
        $qrCode = new QrCode($pdf_url);
        $qrCode->setSize(200);
        $result = $writer->write($qrCode);
        $dataUri = $result->getDataUri();

        
        $html = view('pages.renew.pdf', [
            'pdfrenew' => $renew,
            'qrCodeImage' => $dataUri
            ])->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'autoScriptToLang' => false, 
            'autoLangToFont' => true,
            'default_font' => 'freesans',
        ]);
        
        $mpdf->WriteHTML($html);
        $pdf_path = Storage::disk('public')->put('reports/production_renew/' . $renew->product->name . '.pdf', $mpdf->Output('', 'S'));
        $renew->production_renew = $renew->product->name . '.pdf';
        $renew->save();

        return response()->download(storage_path('app/public/reports/production_renew/' . $renew->product->name . '.pdf'));
    }
}
