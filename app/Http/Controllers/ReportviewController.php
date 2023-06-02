<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Renew;
use App\Models\Registration;
use App\Models\Renewal;
use App\Models\Product;

use Illuminate\Support\Facades\Redirect;

class ReportviewController extends Controller
{
        public function index()
        {
            $registrations = Registration::where('status', 'verified')->get();
            $renews = Renew::where('status', 'verified')->get();
            $productions = Report::where('status', 'verified')->get();
            $renewals = Renewal::where('status', 'verified')->get();

            $reports = collect([$registrations, $renews, $productions, $renewals])->flatten();

            return view('pages.reportview.index', compact('reports'));
        }


        public function display(Request $request, Renewal $renewal, Registration $registration, Report $report, Product $product){
            $registration_number = $request->registration_num;
            $certificate_category = $request->certificate_category;
            $product = Product::where('registration', $registration_number)->first();

            if(!$product){
                return Redirect::back()->with(['msg' => 'Product registration number is not available!']);
            }
            else{
                if($certificate_category == 'Product Registration'){
                    $registration = Report::whereHas('product', function ($query) use ($registration_number) {
                        $query->where('registration', $registration_number);
                    })->first();

                    if($registration){
                        if($registration->production_report === null){
                            return Redirect::back()->with(['msg' => 'Certificate generation not completed yet!']);
                        }else{
                            if($registration->status=="Verified"){
                                $certificate = $registration->product->name;
                                return view('pages.reportview.display', compact('certificate'));
                            }elseif($registration->status!="Verified"){
                                return Redirect::back()->with(['msg' => 'Report not verified yet.']);
                            }
                        }
                    }    
                }

                if($certificate_category == 'Product Renewal'){
                    $renewal = Renew::whereHas('product', function ($query) use ($registration_number) {
                        $query->where('registration', $registration_number);
                    })->first();

                    if($renewal){
                        if($renewal->production_renew === null){
                            return Redirect::back()->with(['msg' => 'Certificate generation not completed yet!']);
                        }else{
                            if($renewal->status=="Verified"){
                                $renewalcertificate = $renewal->product->name;
                                return view('pages.reportview.display_two', compact('renewalcertificate'));
                            }elseif($renewal->status!="Verified"){
                                return Redirect::back()->with(['msg' => 'Report not verified yet.']);
                            }
                        }

                       
                    }
                }

            }
        }

}
