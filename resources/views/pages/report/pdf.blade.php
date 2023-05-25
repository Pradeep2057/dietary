<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report PDF</title>
</head>

<body>
    <div class="container">
        <div class="row rep-design" style="max-width: 1230px; margin: auto;">
            <h1 class="rep-heading" style="text-align: center;"> डाईटरी सप्लिमेन्ट उत्पादन दर्ता सम्बन्धमा ।
            </h1>
            <div class="rep-des" style="margin-bottom: 20px">
                <span>श्रीमान्
                </span><br>
                उपरोक्त सम्बन्धमा तपसिलको फर्मले तपशिल बमोजिमका आहारपूरक खाद्य पदार्थहरु उत्पादन दर्ताका लागि तपसिलका
                मितिमा दर्ता गराएको निवेदन, कागजातहरु र संलग्न नमुनाहरु आहारपुरक (डाइटरी सप्लिमेन्ट) खाद्य पदार्थ नियमन
                कार्यविधि, २०७२ को आधारमा तपशिल बमोजिम रहेको देखिएकोले उत्पादन दर्ता गर्नका लागि पेश गर्दछु ।<br>
                <span style="font-weight: 400;">
                    तपसिलः
                </span>
            </div>

                <table style="width: 1320px; margin: auto;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;"> Name of Product</h1>
                            </td>
                            <td style="width: 75%; border: 1px solid rgb(151, 151, 151);
                    border-style: dotted;  font-size: 14px;"><h2>{{ $pdfreport->product->name }}</h2></td>
                        </tr>

                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; font-size: 20px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Application number and date
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                    border-style: dotted;"> <h2>{{ $pdfreport->application_number }}</h2></td>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Form of Product</h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                    border-style: dotted;"> <h2>{{ $pdfreport->product->productform->name }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Firm registration Number
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                                border-style: dotted;">
                                <h2>
                                @foreach ($pdfreport->product->importers as $importer)
                                    {{ $importer->firm_no }},
                                @endforeach
                                </h2>
                            </td>
                            
                            
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Type of Product
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->producttype->name }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Pan Number
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                                border-style: dotted;">
                                <h2>
                                @foreach ($pdfreport->product->importers as $importer)
                                    {{ $importer->pan }},
                                @endforeach
                                </h2>
                            </td>
                            
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Dose Specified
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->dose->name }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Name of Importer
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                                border-style: dotted;">
                                <h2>
                                @foreach ($pdfreport->product->importers as $importer)
                                    {{ $importer->name }},
                                @endforeach
                                </h2>
                            </td>
                            
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Address of Importer
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                                border-style: dotted;">
                                <h2>
                                @foreach ($pdfreport->product->importers as $importer)
                                    {{ $importer->address }},
                                @endforeach
                                </h2>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Production registration Number
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->registration }}</h2></td>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Statement of Not for medicinal use
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->medical_statement }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Date of Grant
                                </h1>
                            </td>
                            <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                    border-style: dotted;"><h2>{{ $pdfreport->date_of_grant }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Lable of product
                                </h1>
                            </td>
                            <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->product_label }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">This product is not intended to treat, cure or diagnose
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->diagnose_statement }}</h2></td>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">This product is not intended to treat, cure or diagnose
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->diagnose_statement }}<h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Health Claim
                                </h1>
                            </td>
                            <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                    border-style: dotted;"><h2>{{ $pdfreport->product->health_claim }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; ">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Nutritional Claim
                                </h1>
                            </td>
                            <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                    border-style: dotted;"><h2>{{ $pdfreport->product->nutritional_claim }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; margin-top: 15px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Expirydate Claim
                                </h1>
                            </td>
                            <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                    border-style: dotted;"><h2>{{ $pdfreport->product->expirydate->name }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; margin-top: 15px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;"> Product specification
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->product_specification }}</h2></td>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Process flow chart
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->process_flow }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; margin-top: 15px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;"> Specification Rational
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->specification_rational }}</h2></td>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;"> Authorization letter
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->authorization_letter }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; margin-top: 15px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;"> GMP certificate validity upto
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->gmp_validity }}</h2></td>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;"> GMP certificate
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->gmp_certificate }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; margin-top: 15px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;"> Composition
                                </h1>
                            </td>
                            <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>
                           {{ $pdfreport->compositions }} 
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; margin-top: 15px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;"> Name of Manufacturer
                                </h1>
                            </td>
                            <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->manufacturer->name }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; margin-top: 15px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Country Of Manufacturer
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->manufacturer->country->name }}</h2></td>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">COA inhouse
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->coa_inhouse }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; margin-top: 15px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Manufacturing Lic No.
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->manufacturer->registration_number }}</h2></td>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">COA Thirdparty
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->coa_thirdparty }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; margin-top: 15px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Certificate validity from
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->validity_from }}</h2></td>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Size of pack
                                </h1>
                            </td>
                            <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->product->size->name }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <table style="width: 1320px; margin: auto; margin-top: 15px;">
                    <tbody style="width:100%">
                        <tr>
                            <td style="width:25%;">
                                <h1 style="margin: 5px;">Certificate validity to
                                </h1>
                            </td>
                            <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                        border-style: dotted;"><h2>{{ $pdfreport->validity_to }}</h2></td>
                        </tr>
                    </tbody>
                </table>

                <div class="rep-des" style="margin-top: 50px">

                    आहारपूरक खाद्य पदार्थ नियमन कार्यविधि, २०७२ को दफा १३ मा “उत्पादन दर्ता गर्न तोकिएको ढाचामा निवेदन
                    साथ
                    नियमावलीको नियम २८ मा अनुज्ञापत्र जारी दस्तुर बमोजिम उत्पादन दर्ता दस्तुर लाग्नेछ साथै उक्त दफा
                    अन्तर्गत
                    तोकिएको कागजातहरु संलग्न गराउनुपर्ने छ” भनि उल्लेख भएकोमा उक्त दफा १३ को उपदफा (क), (ख), (ग), (घ),
                    (ङ),
                    (च), (छ),(ज),(झ) र (ञ) को विवरण सम्बन्धि कागजातहरु निवेदनसाथ संलग्न भएको हुदा सम्बन्धित निवेदकलाई
                    नियमानुसार उत्पादन दर्ता दस्तुर तिराई उक्त दफा १३ बमोजिम उत्पादन दर्ता हुन मनासिब हुने राय
                    निर्णयार्थ
                    पेश गर्दछु ।

                </div>

                <table style="width: 1320px; margin: auto; margin-top: 20px;">
                    <tbody style="width:100%;">
                        <tr>
                            <td style="width: 50%;"><img src="{{ $qrCodeImage }}" alt="QR code"></td>
                            <td style="width: 50%; text-align: right;"><h3> {{ $pdfreport->prepared_by}} <br> {{ $pdfreport->post }} <br> {{ $pdfreport->date_of_preparation }} </h3>
                    </td>
                        </tr>
                    </tbody>
                </table>

                
        </div>
    </div>

</body>

</html>