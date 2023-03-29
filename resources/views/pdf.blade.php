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

        table.approved_by {
            border: solid #000;
            border-width: 1px 1px 1px 1px;
            width: 50%;
        }

        table.approved_by th,
        table.approved_by td {
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

        tr.strikethrough {
            background-color: rgb(254 202 202)
        }
    </style>
</head>

<body>
    <h3 class="title"><u>LAMPIRAN SPONSORSHIP</u></h3>
    <br>
    @php
        $additional_details = json_decode($lampirans[0]->user->additional_details, true);
    @endphp
    <table class="lampiran-header">
        <tr>
            <td style="width: 14%">FF</td>
            <td style="width: 1%">:</td>
            <td style="width: 40%"></td>

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
            <td style="width: 40%">{{ strtoupper($lampirans[0]->doctor->name) }}</td>
            <td style="width: 14%">RAYON / AREA</td>
            <td style="width: 1%">:</td>
            <td style="width: 30%">
                {{ $lampirans[0]->user->additional_details && $additional_details['rayon'] ? $additional_details['rayon'] : '' }}
            </td>
        </tr>
        <tr>
            <td style="width: 14%">CREATED BY</td>
            <td style="width: 1%">:</td>
            <td style="width: 40%">{{ $lampirans[0]->createdBy->name }}</td>
            <td style="width: 14%">REG / DIVISI</td>
            <td style="width: 1%">:</td>
            <td style="width: 30%">
                {{ $lampirans[0]->user->additional_details && $additional_details['regional'] ? $additional_details['regional'] : '' }}
            </td>
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
                $distinct_products = $lampirans
                    ->unique(function ($product) {
                        return $product->product_nu . '-' . $product->quantity . '-' . $product->is_expired;
                    })
                    ->sort(function ($a, $b) {
                        return $a['is_expired'] <=> $b['is_expired'];
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
                <tr class="{{ $product->is_expired ? 'strikethrough' : '' }}">
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
        <tfoot>
            <tr>
                <th colspan="4"></th>
                <th>Total</th>
                <th>{{ idr($total_value_sum) }}</th>
                <th></th>
                <th>{{ idr($total_value_cicilan_sum) }}
                </th>
            </tr>
        </tfoot>
        </tbody>
    </table>
    <br>
    <br>
    @php
        $outlets = $lampirans
            ->unique(function ($outlet) {
                return $outlet->outlet_nu;
            })
            ->sort(function ($a, $b) {
                return $a['is_expired'] <=> $b['is_expired'];
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
                <tr class="{{ $outlet->is_expired ? 'strikethrough' : '' }}">
                    <td>{{ $outlet_no++ }}</td>
                    <td>{{ $outlet->outlet->name_uni }}</td>
                    <td>{{ $outlet->outlet->address_uni }}</td>
                    <td>MUP/SST</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <table class="approved_by">
        <thead>
            <tr>
                <th colspan="4">APPROVED BY</th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th style="width: 50%;">MM</th>
                <th style="width: 50%;">DMD</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @if ($lampirans[0]->status == 1)
                        Menunggu
                    @elseif (in_array($lampirans[0]->status, [2, 3, 4, 5], true))
                        Disetujui
                    @else
                        Ditolak
                    @endif
                </td>
                <td>
                    @if (in_array($lampirans[0]->status, [1, 2], true))
                        Menunggu
                    @elseif ($lampirans[0]->status == 4)
                        Disetujui
                    @elseif($lampirans[0]->status == 5)
                        Ditolak
                    @else
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
</body>

</html>
