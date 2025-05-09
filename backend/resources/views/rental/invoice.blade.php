<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        html {
            height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f4f4f4; */
            height: 100%;
        }

        .invoice-container {
            max-width: 800px;
            margin: 30px auto;
            /* background-color: #fff; */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice-header img {
            max-width: 150px;
        }

        .invoice-title {
            font-size: 24px;
            margin: 0;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .invoice-table th {
            background-color: #f4f4f4;
        }

        .invoice-total {
            font-weight: bold;
        }

        .invoice-footer {
            margin-top: 20px;
        }

        .invoice-footer p {
            margin: 5px 0;
        }

        .paid-stamp {
            font-size: 24px;
            color: red;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="invoice-container">
        <div class="invoice-header">
            {{-- <img src="{{ asset('assets/img/hasta.png') }}" alt="Hasta" style="max-width: 150px;"> --}}
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/hasta.png'))) }}"
                alt="Image">
            <h2 class="invoice-title">Invoice</h2>
        </div>
        <div class="invoice-details">
            <div>
                <p><strong>Bill To:</strong></p>
                <p>{{ $rental->customer->name }}</p>
            </div>
            <div>
                <p><strong>Invoice No. :</strong>{{ $rental->payment->invoice_id }}</p>
                <p><strong>Date:</strong> {{ $rental->created_at->format('Y-m-d') }}</p>
                <p class="paid-stamp">PAID</p>
            </div>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $rental->fleet->model }} ({{ $rental->fleet->license_plate }})
                        ({{ $rental->pickup_date }} to {{ $rental->return_date }})
                    </td>
                    <td class="text-right">MYR {{ $rental->payment->rental_amount }}.00</td>
                </tr>
                {{-- <tr>
                    <td>Discount</td>
                    <td class="text-right">- 0.00</td>
                </tr> --}}
                {{-- <tr>
                    <td class="invoice-total">Total Amount Before Tax</td>
                    <td class="text-right">MYR {{ $rental->rental_amount }}.00</td>
                </tr> --}}
            </tbody>
            <tfoot>
                {{-- <tr>
                    <td class="text-right">Total Amount:</td>
                    <td class="text-right">MYR {{ $rental->total_amount }}.00</td>
                </tr> --}}
                {{-- <tr>
                    <td class="text-right">Rounding:</td>
                    <td class="text-right">MYR 0.00</td>
                </tr> --}}
                <tr>
                    <td class="text-right">Deposit:</td>
                    <td class="text-right">MYR {{ $rental->deposit->amount }}.00</td>
                </tr>
                <tr>
                    <td class="invoice-total text-right">Grand Total:</td>
                    <td class="text-right">MYR {{ $rental->deposit->amount + $rental->payment->rental_amount }}.00</td>
                </tr>
            </tfoot>
        </table>
        <div class="invoice-footer">
            <h5>BANKING DETAILS</h5>
            <p><strong>Bank Name:</strong> MALAYAN BANKING BERHAD</p>
            <p><strong>Acc. Name:</strong> HASTA TRAVEL & TOURS SDN. BHD.</p>
            <p><strong>Acc. Number:</strong> 551306541568</p>
        </div>
    </div>

</body>

</html>
