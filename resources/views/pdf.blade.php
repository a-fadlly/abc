<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Print Lampiran</title>
    <style>
        body {
            font-family: "Arial, Helvetica", sans-serif;
        }

        @page {
            size: A4;
        }

        table.lampiran-header {
            width: 100%;

        }

        table.lampiran-header th,
        table.lampiran-header td {
            font-size: 9px;
            font-style: bold;
        }

        table.product {
            border: solid #000;
            border-width: 1px 1px 1px 1px;
            width: 100%;
        }

        table.product th,
        table.product td {
            border: solid #000;
            border-width: 0 1px 1px 0;
            padding: 3px;
            font-size: 10px;
        }

        .print-logo {
            max-height: 40px;
        }

        .title {
            text-align: center;
        }
    </style>
</head>

<body>
    <h3 class="title"><u>LAMPIRAN SPONSORSHIP</u></h3>
    <br>
    <table class="lampiran-header">
        <tr>
            <td style="width: 14%">FF</td>
            <td style="width: 1%">:</td>
            <td style="width: 40%">4. GREEN-2 / PALU / MUHAMMAD FITAH KURNIAWAN</td>
            <td style="width: 14%">ID MR</td>
            <td style="width: 1%">:</td>
            <td style="width: 30%">{{ $lampirans[0]->user->username }}</td>
        </tr>
        <tr>
            <td style="width: 14%">ID MD</td>
            <td style="width: 1%">:</td>
            <td style="width: 40%">{{ $lampirans[0]->doctor->doctor_nu }}</td>
            <td style="width: 14%">NAMA MR</td>
            <td style="width: 1%">:</td>
            <td style="width: 30%">{{ $lampirans[0]->user->name }}</td>
        </tr>
        <tr>
            <td style="width: 14%">NAMA MD</td>
            <td style="width: 1%">:</td>
            <td style="width: 40%">{{ $lampirans[0]->doctor->name }}</td>
            <td style="width: 14%">RAYON / AREA</td>
            <td style="width: 1%">:</td>
            <td style="width: 30%">NOT_IMPLEMENTED_YET</td>
        </tr>
        <tr>
            <td style="width: 14%">TGL AJUAN</td>
            <td style="width: 1%">:</td>
            <td style="width: 40%">{{ $lampirans[0]->periode }}</td>
            <td style="width: 14%">REG / DIVISI</td>
            <td style="width: 1%">:</td>
            <td style="width: 30%">NOT_IMPLEMENTED_YET</td>
        </tr>
    </table>
    <br>
    <table class="product">
        <thead>
            <tr>
                <th colspan="8">PRODUK</th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 10%;">Prod No</th>
                <th style="width: 31%;">Prod Name</th>
                <th style="width: 8%;">Qty</th>
                <th style="width: 10%;">HNA</th>
                <th style="width: 15%;">Value</th>
                <th style="width: 8%;">%</th>
                <th style="width: 13%;">Value Cicilan</th>
            </tr>
        </thead>
        <tbody>
            @php
                function idr($num)
                {
                    return number_format($num, 2, ',', '.');
                }
                
                $distinct_products = $lampirans->unique(function ($product) {
                    return $product->product_nu . '-' . $product->product_nu;
                });
                
                $total_value_sum = 0;
                $total_value_cicilan_sum = 0;
                
                $product_no = 1;
            @endphp

            @foreach ($distinct_products as $product)
                @php
                    $value_cicilan = $product->sales * ($product->percent / 100);
                    
                    $total_value_sum = $total_value_sum + $product->sales;
                    $total_value_cicilan_sum = $total_value_cicilan_sum + $value_cicilan;
                @endphp
                <tr>
                    <td>{{ $product_no++ }}</td>
                    <td>{{ $product->product_nu }}</td>
                    <td>{{ $product->product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ idr($product->product->price) }}</td>
                    <td>{{ idr($product->sales) }}</td>
                    <td>{{ $product->percent }}</td>
                    <td>{{ idr($value_cicilan) }}</td>
                </tr>
            @endforeach
        <tfoot class="text-xs text-gray-900 uppercase dark:text-gray-400">
            <tr>
                <th colspan="4"></th>
                <th scope="col" class="px-4 py-2">Total</th>
                <th scope="col" class="px-4 py-2">{{ idr($total_value_sum) }}</th>
                <th scope="col" class="px-4 py-2"></th>
                <th scope="col" class="px-4 py-2">{{ idr($total_value_cicilan_sum) }}
                </th>
            </tr>
        </tfoot>
        </tbody>
    </table>
    <br>
    <br>
    @php
        $outlets = $lampirans->unique(function ($outlet) {
            return $outlet->outlet_nu . '-' . $outlet->outlet_nu;
        });
        
        $outlet_no = 1;
    @endphp
    <table class="product">
        <thead>
            <tr>
                <th colspan="4">OUTLET</th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Name</th>
                <th style="width: 45%;">Address</th>
                <th style="width: 20%;">Distributor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($outlets as $outlet)
                <tr>
                    <td>{{ $outlet_no++ }}</td>
                    <td>{{ $outlet->outlet->name }}</td>
                    <td>{{ $outlet->outlet->address }}</td>
                    <td>MUP/SST</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <br>
</body>

</html>
