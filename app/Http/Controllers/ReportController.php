<?php

namespace App\Http\Controllers;

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
        $report = new Report;
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
        return redirect()->route('report.index')->with('successct', 'report created successfully.');
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

    public function update(Request $request, Report $report)
    {
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
        if($request->status){
            $report->status = $request->status;
        }else{
            $report->status = 'Processing';
        }
        
        $report->save();
        return redirect()->route('report.index')->with('successup', 'report updated successfully.');;
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
        $qrCode->setSize(200);
        $result = $writer->write($qrCode);
        $dataUri = $result->getDataUri();

        
        $html = view('pages.report.pdf', [
            'pdfreport' => $report,
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
        $report->production_report = $report->product->name . '.pdf';
        $report->save();

        return response()->download(storage_path('app/public/reports/production_report/' . $report->product->name . '.pdf'));
    }

}