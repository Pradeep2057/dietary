<!doctype html>
<html lang="en">
​

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <title>Renew PDF</title>

    <style>
    h2 {
        margin: 0;
    }

    h1 {
        margin: 0;

    }

    ol li {
        font-size: 16px;
        list-style: number;
        font-family: roboto;
        font-weight: 400;
    }

    table {
        margin-bottom: 10px !important;
    }
    </style>

</head>

<body>


    <table style="width: 1320px; margin: auto;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:20%;">
                    <img src="{{ $logo }}" alt="logo" style="width: 150px;">
                </td>
                <td style="width:58%; text-align: center;">
                    <h1 style="text-align: center; font-size: 28px; margin: 0 0 4px; color:red;">Government of Nepal
                    </h1>
                    <h1 style="text-align: center; font-size: 28px; margin: 0 0 4px; color:red;"> Ministry of
                        Agriculture and Livestock Development </h1>
                    <h1 style="text-align: center; font-size: 30px; margin: 0 0 4px; color:red; font-family: roboto;">
                        Department of Food Technology and Quality Control</h1>
                </td>
                <td style="width:22%; text-align: right; font-size: 20px; font-weight: 500; font-family: roboto;">
                    <div class="contact">
                        <table class="phone-num" style="margin-left:auto;">
                            <tr style="margin-bottom: 10px;">
                                <td class="phone-num-left" style="color:red;">
                                    Tel.
                                </td>
                                <td class="phone-num-right"
                                    style="color:red; 	border-left: 1px solid #ff0000; padding-left:20px; font-size: 18px;">
                                    977-1-4-262369<br>
                                    977.1-4-262430<br>
                                    977.1-4-240016<br>
                                    917-1-4-262739
                                </td>
                            </tr>
                        </table>
                        <div class="fax" style="color:red; font-size: 18px;">
                            Fax : 977-1-4262337
                        </div>
                    </div>
                    <div class="site">
                        <p style="margin-bottom:0; color:red; font-size: 18px;"> E-mail: info@dftgc.gov.np </p>
                        <p style="margin:0; color:red; font-size: 18px;">Webpage:- www.dttqc.gov.np </p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="fill">
        <p style="font-size: 10px; font-family: roboto; font-weight: 500; color:red;"> Our Ref. No. <br>
            Your Ref. No.</p>
    </div>

    <table style="width: 1320px; margin: auto;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    @foreach ($pdfproduct->product->importers->unique('name') as $importer)
                    <h1 style="font-family: roboto; font-size: 22px;">
                        {{ $importer->name }}
                        <br>
                        {{ $importer->address }}
                    </h1>
                    @endforeach
                </td>
                <td style="width:75%;text-align: right;">
                    <h2 style="font-size: 22px; font-family:roboto; font-weight:400;">
                        Date:{{ $pdfproduct->date_of_preparation }}</h2>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="div-highlight" style="padding-bottom: 1px; text-align: center; margin-bottom:15px; margin-top:15px;">
        <h1 style=" margin:auto; background-color: #cccccc; border-bottom: 2px solid rgb(0, 0, 0); margin-bottom: 5px;text-align: center; margin-top: 2px; font-size: 15px; font-family:roboto; width:60%">
            Dietary Supplement Product Registration Certificate</h1>
    </div>

    <div style="width: 1320px; margin: auto; font-size:12px; font-weight:400; font-family:roboto; margin-bottom: 10px;">
        Please refer to your Application {{ $pdfproduct->application_number }} regarding grant of dietary supplement
        product
        registration under Dietary Supplement Regulation Guidelines 2072. The product registration certificate
        for the above mentioned application is granted as per the details given below. Detail of label is
        attached in Annexture I.
    </div>

    <table style="width: 1320px; margin: auto; padding-top:10px;padding-bottom:10px;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    <h1 style="font-family: roboto; font-size: 24px; font-style: italic; text-decoration: underline; margin-bottom: 10px;">
                        Registration Number</h1>
                    <h2 style="padding: 0;margin: 5px;  font-size:24px;">{{ $pdfproduct->product->registration }} </h2>
                </td>
                <td style="width:25%;">
                    <h1 style="font-family: roboto; font-size: 24px; font-style: italic; text-decoration: underline; margin-bottom: 10px;"> Name of
                        Product</h1>
                    <h2 style="padding: 0;margin: 5px;  font-size:24px;">{{ $pdfproduct->product->name }} </h2>
                </td>
                <td style="width:25%;">
                    <h1 style="font-family: roboto; font-size: 24px; font-style: italic; text-decoration: underline; margin-bottom: 10px;"> Date of
                        approval</h1>
                    <h2 style="padding: 0 10px;margin: 5px;  font-size:24px;">{{ $pdfproduct->validity_from }}</h2>
                </td>
                <td style="width:25%;">
                    <h1 style="font-family: roboto; font-size: 24px; font-style: italic; text-decoration: underline; margin-bottom: 10px;"> Validity
                    </h1>
                    <h2 style="padding: 0;margin: 5px;  font-size:24px;">{{ $pdfproduct->validity_to }}</h2>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="max-width: 1320px; margin: auto;margin-top: 15px;">
        <h1 style="  border-bottom: 1px solid black; font-family: roboto; font-size:10px; margin-left:3px; margin-top:10px; margin-bottom:5px; width: 5%;"> Details</h1>
    </div>

    <table style="width: 1320px; margin: auto;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    <h1 style=" font-family: roboto; font-size:20px;"> Active
                        ingredients/:<br>{{ $pdfproduct->product->ingredient_unit }}</h1>
                </td>
                <td style="width: 75%; border: 0.5px solid rgb(240,242,245)
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                        {{ $pdfproduct->product->ingredients }}
                    </h2>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 1320px; margin: auto;margin-top: 15px;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    <h1 style=" font-family: roboto; font-size:20px;">Product Type
                    </h1>
                </td>
                <td style="width:25%; border: 1px solid rgb(220,220,220);
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                        {{ $pdfproduct->product->producttype->name }}</h2>
                </td>
                <td style="width:25%;">
                    <h1 style=" font-family: roboto; font-size:20px;">Size of pack
                    </h1>
                </td>
                <td style="width:25%; border: 1px solid rgb(220,220,220);
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                        {{ $pdfproduct->product->size->name }}</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 1320px; margin: 0 auto;margin-top: 15px;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    <h1 style=" font-family: roboto; font-size:20px;">Form of Product
                    </h1>
                </td>
                <td style="width:75%; border:1px solid rgb(220,220,220);
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                        {{ $pdfproduct->product->productform->name }}</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 1320px; margin: 0 auto;margin-top: 15px;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    <h1 style=" font-family: roboto; font-size:20px;">Dose specified
                    </h1>
                </td>
                <td style="width:75%; border:1px solid rgb(220,220,220);
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                    @if($pdfproduct->product->dose != null)
                        {{ $pdfproduct->product->dose->name }}</h2>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 1320px; margin:0 auto;margin-top: 15px;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    <h1 style=" font-family: roboto; font-size:20px;">Health claim
                    </h1>
                </td>
                <td style="width:25%; border: 1px solid rgb(220,220,220);
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                        {{ $pdfproduct->product->health_claim }}</h2>
                </td>
                <td style="width:25%;">
                    <h1 style="m font-family: roboto; font-size:20px;">Nutritional claim
                    </h1>
                </td>
                <td style="width:25%; border:1px solid rgb(220,220,220);
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                        {{ $pdfproduct->product->nutritional_claim }}</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 1320px; margin:0 auto;margin-top: 15px;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    <h1 style=" font-family: roboto; font-size:20px;">Expiry period claim
                    </h1>
                </td>
                <td style="width:75%; border: 1px solid rgb(220,220,220);
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                        {{ $pdfproduct->product->expirydate->name }}</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 1320px; margin: auto; margin-top: 15px;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    <h1 style=" font-family: roboto; font-size:20px;"> Name of Manufacture
                    </h1>
                </td>
                <td style="width:75%; border: 1px solid rgb(220,220,220);
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                        {{ $pdfproduct->product->manufacturer->name }}</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 1320px; margin: auto; margin-top: 15px;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    <h1 style=" font-family: roboto; font-size:20px;">Country
                    </h1>
                </td>
                <td style="width:75%; border:1px solid rgb(220,220,220);
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                        {{ $pdfproduct->product->manufacturer->country->name }}</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 1320px; margin: auto; margin-top: 15px;">
        <tbody style="width:100%">
            <tr style="margin-bottom: 10px;">
                <td style="width:25%;">
                    <h1 style=" font-family: roboto; font-size:20px;">Manufacturing Lic No.
                    </h1>
                </td>
                <td style="width:75%; border: 1px solid rgb(220,220,220);
            border-style: dotted;">
                    <h2 style="font-family: roboto; font-weight:400; font-size:20px; padding:5px;">
                        {{ $pdfproduct->product->manufacturer->registration_number }}</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="max-width: 1320px; margin: auto; padding-top: 15px;">
        <h1 style="border-bottom: 1px solid black; width: 16.5%; font-family: roboto; font-size: 11px;">Terms and Condition
        </h1>
        <ol style="list-style-type: number; padding-left: 25px;">
            <li style="font-size:10px; ">This certificate is applicable for the purpose of obtaining permission from the Department for
                the purpose of import, sale or distribution of dietary supplement and the application for the
                renewal must be made not later than 30 days of expiry.</li>
            <li style="font-size:10px; ">Prior approval has to be obtained from the Department if any alteration is to be made in the
                product specification and label submitted to the department in the above mentioned details.</li>
            <li style="font-size:10px; "> Prior to the import, concerned party has to obtain import permit for the registered products
                from the Department.</li>
            <li style="font-size:10px; "> The registration of the product is effectively within the domain of Food Act, 2023, Regulation,
                2027 and Dietary Supplement Regulation Guidelines, 2072. It is the responsibility of the party
                to respond to the concerned act and regulation of Nepal whenever necessary.</li>
            <li style="font-size:10px; ">Please note that your application had been considered on the basis of the documents submitted.
                The firm will be responsible for the authenticity of the documents supplied while obtaining
                registration certficate.</li>
        </ol>
    </div>
    <table style="width: 1320px; margin: auto; margin-top: 20px;">
        <tbody style="width:100%;">
            <tr style="margin-bottom: 10px;">
                <td style="width: 50%;"><img src="{{ $qrCodeImage }}" alt="QR code"></td>
                <td style="width: 50%; text-align: right;">
                    <p style="font-size:10px; font-weight:400; font-family:roboto;">{{ $pdfproduct->prepared_by }}</p>
                    <h1 style="text-align: right; font-family:roboto; font-size:20px;">Yours Faithfully
                    </h1>
                </td>
            </tr>
        </tbody>
    </table>
    <p style="font-size:10px; font-weight:400; font-family:roboto;"> (As per section 2, subsection 13 of the Dietary
        Supplement Regulation Guidelines, 2072)</p>


    <div class="footer" style="border-top:1px solid red; margin-top: 80px">
        <h1 style="text-align: center; font-size: 14px; color:red; margin:10px;">G.P.O Box No. 21265,
            Babarmahal, Kathmandu</h1>
    </div>
</body>

</html>