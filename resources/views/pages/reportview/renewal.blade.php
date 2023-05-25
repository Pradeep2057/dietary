@extends('layouts.main')
@section('title', 'Product Renewal Certificate')
@section('reportcontent')

@if($renewalcertificate)
<div class="container" style="margin-top: 90px;">
    <object class="my-5" data="{{ asset('storage/reports/product_renewal/' . $renewalcertificate .'.pdf') }}" type="application/pdf"
        width="100%" height="800px">
        <p>Unable to display PDF file. <a href="{{ asset('storage/reports/product_renewal/' . $renewalcertificate .'.pdf') }}">Download</a> instead.</p>
    </object>
</div>
@endif

@endsection