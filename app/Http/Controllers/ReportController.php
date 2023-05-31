<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mpdf\Mpdf;
use App\Models\Report;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class ReportController extends Controller
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
            $reports = Report::whereIn('status', $statuses)->get();
        }else{
            $reports = Report::all();
        }
        return view('pages.report.index',[
            'reports' => $reports,
        ]);
    }

    public function create(Report $report)
    {
        $this->authorize('create', $report);
        return view('pages.report.create',[
            'products' => Product::where('status', 'verified')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'date_of_grant' => 'required | date',
            'validity_from' => 'required | date',
            'voucher_amount' => 'numeric',
            'application_number' => 'required',
            'validity_to' => 'required | date',
            'gmp_validity' => 'required | date',
            'date_of_preparation' => 'required | date',
            'prepared_by' => 'required',
            'post' => 'required',
        ]);

        $report = new Report;

        if (Auth::user()->role == 0) {
            $report->status = 'Verified';
            $report->verifier_id = Auth::user()->id;
            $report->verified_at = Carbon::now()->toDateTimeString();
        }elseif(Auth::user()->role == 1){
            $report->status = 'Pending';
            $report->pending_id = Auth::user()->id;
            $report->pending_at = Carbon::now()->toDateTimeString();
        }else{
            $report->status = 'Processing';
        }


        $report->voucher_number = $request->voucher_number;
        $report->voucher_amount = $request->voucher_amount;

        $report->date_of_grant = $request->date_of_grant;
        $report->validity_from = $request->validity_from;
        $report->application_number = $request->application_number;
        $report->validity_to = $request->validity_to;
        $report->gmp_validity = $request->gmp_validity;
        $report->date_of_preparation = $request->date_of_preparation;
        $report->product_id = $request->product_id;
        $report->prepared_by = $request->prepared_by;
        $report->post = $request->post;
        $report->author_id = auth()->user()->id;
        $report->save();
        return redirect()->route('report.index')->with('successct', 'Certificate created successfully.');
    }

    public function edit(Report $report)
    {
        $this->authorize('update', $report);
        $selectedProduct = $report->product;
        return view('pages.report.edit', [
            'report'            => $report,
            'products'        => Product::all(),
            'selectedProduct'  => $selectedProduct,
        ]);
    }

    public function display(Report $report)
    {
        $this->authorize('update', $report);
        $selectedProduct = $report->product;
        return view('pages.report.display', [
            'report'            => $report,
            'products'        => Product::all(),
            'selectedProduct'  => $selectedProduct,
        ]);
    }

    public function update(Request $request, Report $report)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'voucher_amount' => 'numeric',
            'date_of_grant' => 'required | date',
            'validity_from' => 'required | date',
            'application_number' => 'required',
            'validity_to' => 'required | date',
            'gmp_validity' => 'required | date',
            'date_of_preparation' => 'required | date',
            'prepared_by' => 'required',
            'post' => 'required',
        ]);
        
        $this->authorize('update', $report);
        $report->date_of_grant = $request->date_of_grant;
        $report->validity_from = $request->validity_from;
        $report->application_number = $request->application_number;
        $report->validity_to = $request->validity_to;
        $report->gmp_validity = $request->gmp_validity;
        $report->date_of_preparation = $request->date_of_preparation;
        $report->product_id = $request->product_id;
        $report->prepared_by = $request->prepared_by;
        $report->post = $request->post;
        
        if (Auth::user()->role == 0) {
            $report->status = 'Verified';
            $report->verifier_id = Auth::user()->id;
            $report->verified_at = Carbon::now()->toDateTimeString();
        }elseif(Auth::user()->role == 1){
            $report->status = 'Pending';
            $report->pending_id = Auth::user()->id;
            $report->pending_at = Carbon::now()->toDateTimeString();
        }else{
            $report->status = 'Processing';
        }

        $report->voucher_number = $request->voucher_number;
        $report->voucher_amount = $request->voucher_amount;

        $report->save();
        return redirect()->route('report.index')->with('successup', 'Certificate updated successfully.');;
    }


    public function destroy(Report $report)
    {
        $this->authorize('delete', $report);
        $report->delete();
        return redirect()->route('report.index')->with('successdt', 'report deleted successfully.');;
    }

    public function generatePdf(Report $report)
    {
        $pdf_url = asset('storage/reports/production_report/' . $report->product->name .'.pdf');
        $writer = new PngWriter();
        $qrCode = new QrCode($pdf_url);
        $qrCode->setSize(150);
        $result = $writer->write($qrCode);
        $dataUri = $result->getDataUri();

        $importers = $report->product->importers;

        // dd($importers);

        $html = view('pages.report.pdf', [
            'pdfreport' => $report,
            'importers'=> $importers,
            'qrCodeImage' => $dataUri
            ])->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'autoScriptToLang' => false, 
            'autoLangToFont' => true,
            'default_font' => 'freesans',
            'default_font_size' => 12,
        ]);
        
        $mpdf->WriteHTML($html);
        $pdf_path = Storage::disk('public')->put('reports/production_report/' . $report->product->name . '.pdf', $mpdf->Output('', 'S'));
        $report->production_tippani = $report->product->name . '.pdf';
        $report->save();

        return response()->download(storage_path('app/public/reports/production_report/' . $report->product->name . '.pdf'));
    }


    public function certificate(Report $report)
    {
        $pdf_url = asset('storage/reports/product_registration/' . $report->product->name .'.pdf');
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
            'pdfproduct' => $report,
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
        $pdf_path = Storage::disk('public')->put('reports/product_registration/' . $report->product->name . '.pdf', $mpdf->Output('', 'S'));
        $report->production_report = $report->product->name . '.pdf';
        $report->save();
 
        return response()->download(storage_path('app/public/reports/product_registration/' . $report->product->name . '.pdf'));
    }

    public function print(Report $report)
    {
        $pdf_url = asset('storage/reports/product_registration_print/' . $report->product->name .'.pdf');
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
 
        $html = view('pages.registration.print', [
            'pdfproduct' => $report,
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
        $pdf_path = Storage::disk('public')->put('reports/product_registration_print/' . $report->product->name . '.pdf', $mpdf->Output('', 'S'));
 
        return response()->download(storage_path('app/public/reports/product_registration_print/' . $report->product->name . '.pdf'));
    }
    

}