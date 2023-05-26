<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Renew PDF</title>
</head>

<body>
    <div class="container">
        <div class="row rep-design" style="max-width: 1230px; margin: auto;">
            <h1 class="rep-heading" style="text-align: center;"> डाईटरी सप्लिमेन्ट उत्पादन दर्ता नविकरण सम्बन्धमा ।
            </h1>
            <div class="rep-des" style="margin-bottom: 20px">
                <span>श्रीमान्
                </span><br>
                उपरोक्त सम्बन्धमा तपसिलको फर्मले तपशिल बमोजिमका आहारपूरक खाद्य पदार्थहरु उत्पादन दर्ता नविकरणका लागि
                तपसिलका
                मितिमा दर्ता गराएको निवेदन, कागजातहरु र संलग्न नमुनाहरु आहारपुरक (डाइटरी सप्लिमेन्ट) खाद्य पदार्थ नियमन
                कार्यविधि, २०७२ को आधारमा तपशिल बमोजिम रहेको देखिएकोले उत्पादन दर्ता गर्नका लागि पेश गर्दछु ।<br>
                <span style="font-weight: 400;">
                    तपसिलः
                </span>
            </div>
            ​
            <table style="width: 1320px; margin: auto;">
                <tbody style="width:100%">
                    <tr>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;"> Name of Product</h1>
                        </td>
                        <td style="width: 75%; border: 1px solid rgb(151, 151, 151);
            border-style: dotted;">
                            <h2>{{ $pdfrenew->product->name }}</h2>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 1320px; margin: auto;">
                <tbody style="width:100%">
                    <tr>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Application number and date
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
            border-style: dotted;">
                            <h2>{{ $pdfrenew->product->registration }}</h2>
                        </td>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Size of pack
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{ $pdfrenew->product->size->name }}</h2>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 1320px; margin: auto; margin-top: 15px;">
                <tbody style="width:100%">
                    <tr>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Firm registration Number
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2> 
                                @foreach ($pdfrenew->product->importers as $importer)
                                    {{ $importer->firm_no }},
                                @endforeach
                            </h2>
                        </td>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Pan Number
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>
                                @foreach ($pdfrenew->product->importers as $importer)
                                    {{ $importer->pan }},
                                @endforeach
                            </h2>
                        </td>

                    </tr>
                </tbody>
            </table>

            <table style="width: 1320px; margin: auto; margin-top: 15px;">
                <tbody style="width:100%">
                    <tr>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Name of Importer
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                    
                            <h2>
                                @foreach ($pdfrenew->product->importers as $importer)
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
                                @foreach ($pdfrenew->product->importers as $importer)
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
                            <h1 style="margin: 5px;">Production registration Certificate
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{$pdfrenew->product->product_registration_certificate }}</h2>
                        </td>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Date of Gant
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{ $pdfrenew->date_of_grant }}</h2>
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
                border-style: dotted;">
                            <h2>{{ $pdfrenew->product->registration }}</h2>
                        </td>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Renew valid till
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{ $pdfrenew->renew_valid }}</h2>
                        </td>
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
                border-style: dotted;">
                            <h2>{{ $pdfrenew->product->product_label }}</h2>
                        </td>
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
                border-style: dotted;">
                            <h2>$pdfrenew->product->compositions</h2>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table style="width: 1320px; margin: auto; margin-top: 15px;">
                <tbody style="width:100%">
                    <tr>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;"> Name of Manufacture
                            </h1>
                        </td>
                        <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{ $pdfrenew->product->manufacturer->name }}</h2>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 1320px; margin: auto; margin-top: 15px;">
                <tbody style="width:100%">
                    <tr>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Country Of manufacture
                            </h1>
                        </td>
                        <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{ $pdfrenew->product->manufacturer->country->name }}</h2>
                        </td>

                    </tr>
                </tbody>
            </table>​
            <table style="width: 1320px; margin: auto; margin-top: 15px;">
                <tbody style="width:100%">
                    <tr>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Manufacturing Lic No.
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{ $pdfrenew->product->manufacturer->registration_number }}</h2>
                        </td>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Certificate validity from
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{ $pdfrenew->validity_from }}</h2>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 1320px; margin: auto; margin-top: 15px;">
                <tbody style="width:100%">
                    <tr>

                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Registration validity
                            </h1>
                        </td>
                        <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{ $pdfrenew->product->manufacturer->registration_validity }}</h2>
                        </td>
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
                border-style: dotted;">
                            <h2>{{ $pdfrenew->gmp_validity }}</h2>
                        </td>
                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Certificate validity to
                            </h1>
                        </td>
                        <td style="width:25%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{ $pdfrenew->validity_to }}</h2>
                        </td>

                    </tr>
                </tbody>
            </table>
            <table style="width: 1320px; margin: auto; margin-top: 15px;">
                <tbody style="width:100%">
                    <tr>

                        <td style="width:25%;">
                            <h1 style="margin: 5px;">Authorization Letter
                            </h1>
                        </td>
                        <td style="width:75%; border: 1px solid rgb(151, 151, 151);
                border-style: dotted;">
                            <h2>{{ $pdfrenew->product->authorization_letter }}</h2>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 1320px; margin: auto; margin-top: 50px;">
                <tbody style="width:100%;">
                    <tr>
                        <td style="width: 50%;"><img src="{{ $qrCodeImage }}" alt="QR code"></td>
                        <td style="width: 50%; text-align: right;">
                            <h3>{{ $pdfrenew->prepared_by }}<br>{{ $pdfrenew->post }}<br>{{ $pdfrenew->date_of_preparation }}</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>