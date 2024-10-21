<!DOCTYPE html>
<html>

<head>
    <title>Hasta - Rental Agreement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        hr.line {
            border-top: 1px solid black;
        }

        .title {
            text-align: center;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .terms p {
            font-size: 14px;
            text-align: justify;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* .company-info {
            margin-bottom: 20px;
        } */

        .company-info img {
            width: 40%;
        }

        .company-details table {
            border: hidden;
        }

        .company-details td {
            border: hidden;
        }

        /*
        .company-details p {
            margin: 0 0 10px 0;
        } */

        .rental-details,
        .customer-details {
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table .table-borderless {
            border: hidden;

        }

        .table-borderless td {
            border: hidden;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
        }

        p {
            font-size: 10px;
        }

        .page_break {
            page-break-before: always;
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto;
            background-color: #2196F3;
            padding: 10px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            padding: 20px;
            font-size: 30px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>AGREEMENT FORM</h1>
        <div class="company-info">
            <div class="company-details">
                <table>
                    <tr>
                        <td><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/hasta.png'))) }}"
                                alt="Hasta Logo">
                        </td>
                        <td>
                            <p>
                                HASTA TRAVEL & TOURS SDN. BHD. (1359376-T)<br>
                                <!-- Address lines -->
                            </p>
                        </td>
                        <td>
                            <p>Office : +6011-10900700</p>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="rental-details">
            <h3>Rental Details</h3>
            <table>
                <tr>
                    <th>Vehicle</th>
                    <td>{{ $rental->fleet->model }}</td>
                </tr>
                <tr>
                    <th>Plate Number</th>
                    <td>{{ $rental->fleet->license_plate }}</td>
                </tr>
                <tr>
                    <th>Pick Up Location</th>
                    <td>{{ $rental->pickup_location }}</td>
                </tr>
                <tr>
                    <th>Return Location</th>
                    <td>{{ $rental->return_location }}</td>
                </tr>
                <tr>
                    <th>Pick Up Date</th>
                    <td>{{ $rental->pickup_date }}</td>
                </tr>
                <tr>
                    <th>Return Date</th>
                    <td>{{ $rental->return_date }}</td>
                </tr>
                <tr>
                    <th>Pick Up Time</th>
                    <td>{{ $rental->pickup_time }}</td>
                </tr>
                <tr>
                    <th>Return Time</th>
                    <td>{{ $rental->return_time }}</td>
                </tr>
                <tr>
                    <th>Duration</th>
                    <td>{{ $duration->days . ' days ' . $duration->h . ' hours ' . $duration->i . ' minutes ' }}</td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td>Depo rm50 paid 21/9</td>
                </tr>
            </table>
        </div>
        <div class="customer-details">
            <h3>Customer Details</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <td>{{ $rental->customer->name }}</td>
                </tr>
                <tr>
                    <th>Mobile Number</th>
                    <td>{{ $rental->customer->phone }}</td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>Vehicle</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td>{{ $rental->fleet->model }}</td>
                    <td>60.00</td>
                </tr>
                <tr>
                    <td>Discount</td>
                    <td>- 0.00</td>
                </tr>
                <tr>
                    <td>Total Amount Before Tax</td>
                    <td>{{ number_format($rental->payment->rental_amount, 2, '.', ',') }}</td>
                </tr>
            </table>
            <div class="total">
                <p><strong>Total Amount:</strong> MYR {{ number_format($rental->payment->rental_amount, 2, '.', ',') }}
                </p>
                <p><strong>Rounding:</strong> MYR 0.00</p>
                <p><strong>Refundable Deposit:</strong> MYR {{ number_format($rental->deposit->amount, 2, '.', ',') }}
                </p>
                <p><strong>Grand Total:</strong> MYR {{ number_format($rental->deposit->amount, 2, '.', ',') }}</p>
            </div>
        </div>
    </div>
    <div class="page_break"></div>
    {{-- Rental Agreement --}}
    <div class="terms">
        <h1>RENTAL AGREEMENT</h1>
        <p>HASTA TRAVEL & TOURS SDN. BHD. 202001003057 (1359376T)<br>KPK/LN 10181</p>

        <h2>Rates</h2>
        <p>Rental rates are charged for minimum of 1-hour RM30. Rental with more than 12 hours will be considered as
            1-day rental. Extend hour will be calculated at its rate based on Table 1. Rates include maximum mileage of
            300 km per day and replace car breakdown (if car got problem on road because of car maintenance only). Rates
            are in Ringgit Malaysia (RM).</p>

        <table>
            <caption>Table 1: Price List Hasta</caption>
            <tr>
                <th>HOUR</th>
                <th>1</th>
                <th>3</th>
                <th>5</th>
                <th>7</th>
                <th>9</th>
                <th>12</th>
                <th>24</th>
            </tr>
            <tr>
                <th>RATE (RM)</th>
                <td>30</td>
                <td>50</td>
                <td>60</td>
                <td>65</td>
                <td>70</td>
                <td>80</td>
                <td>110</td>
            </tr>
        </table>

        <table>
            <caption>Table 2: Excess Fee</caption>
            <tr>
                <th>TYPES OF CAR</th>
                <th>EXCESS FEE (RM)</th>
            </tr>
            <tr>
                <td>PERODUA MYVI</td>
                <td>2,500</td>
            </tr>
            <tr>
                <td>PROTON SAGA</td>
                <td>2,500</td>
            </tr>
            <tr>
                <td>PERODUA AXIA</td>
                <td>2,000</td>
            </tr>
            <tr>
                <td>PERODUA BEZZA</td>
                <td>2,500</td>
            </tr>
        </table>

        <h2>Driver's Age and License Requirements</h2>
        <p>The driver must be between 19 to 55 years old for all car category vehicles and in possession of a valid
            national or International Driving License. Probational license holders will not be accepted.</p>

        <h2>Terms of Payment & Deposit</h2>
        <p>All rentals are subjected to a compulsory deposit of RM50.00 per car with maximum rental of 5 days. For
            weekly rental deposit will be RM150 and for one month is equal to one month rental. Our company only accepts
            the online payment for deposits and rental. Cash is accepted as mode of payment at the counter. Refundable
            deposit depends on return car condition (fuel, late return, extend and accident).</p>

        <h2>Cancellation Policy</h2>
        <p>All paid rental and deposit cannot be cancelled, and payment made are non-refundable.</p>

        <h2>Excess Fee</h2>
        <p>The renter shall be held responsible for accidental damage to third party property and bodily injuries.
            However, the renter is always responsible for an amount equivalent to the excess fee based on Table 2. A
            full responsible will be on the renter for damage as a result of illegal, negligence, careless actions, tyre
            punctures, bust tyre, scratches and dent, lack of battery power because of forgotten turned off car
            electrical devices, loss or damage to the vehicle and vehicle accessories and damages of windows, mirror and
            undercarriage. In the event of any accident, the renter must agree to accept the Excess Fee and inform our
            company first before taking any action and make a police report within 24 hours from the time of the
            accident or theft. Our company shall be entitled to charge the renter an excess fee which is in accordance
            with the following Table 2. Upon the renter's acceptance and subject to the terms and conditions stipulated
            in the Rental Agreement, the renter's liability is limited to the Excess Fee. Excess Fee is used to cover
            loss of company sales for that particular car while repairing. Any extra charge of the repairing cost will
            be added if needed by the company. Receipt of any additional cost will be given to the customer.</p>
        <br>
        <h2>Fuel</h2>
        <p>Our company does not provide full tank unless requested by the renter and must be returned the same fuel
            level. Otherwise the renter will be charged based on 1 bar RM10.</p>

        <h2>Parking Fees and Traffic Fines</h2>
        <p>The renter is liable for all parking and traffic fines incurred for the duration of the rental. An additional
            RM20 administration fee will be charged to the renter over and above any fine and penalty cost for any
            violation arising from the renter's use of vehicle. Our company retains the right to charge against the
            renter's charge if and when payment is due for traffic fines committed by the renter, upon receiving
            notification from the government authorities.</p>

        <h2>Vehicle Condition & Cleanliness</h2>
        <p>Upon return, the car must be in the same condition as when it was rented. Failing which, the renter will be
            liable for the cost of restoring the vehicle to its original condition and loss of company sales for that
            particular car.</p>

        <h2>Surcharge</h2>
        <p>If customer want to meet reservations after operating hours, a fee of RM10 will be charged.</p>

        <h2>Restricted Entry</h2>
        <p>The vehicles cannot be driven into Singapore, Thailand, Brunei and Indonesia. Subsequently the vehicles are
            prohibited from being loaded onto other modes of transportation via sea, river and air for usage from
            mainland to Langkawi, Tioman, Redang, Pangkor island etc.</p>
        <br>
        <h2>Prohibited Odours</h2>
        <p>All items and goods discharging unpleasant odours are strictly forbidden from being carried in the vehicle
            (e.g. Durians, salted fish etc). The renter will be liable to reimburse on demand for all costs of
            deodorising such odours, including the servicing of the vehicle air conditioning system and the loss of
            rental days. Please be advised that smoking in vehicles is strictly prohibited.</p>

        <h2>Limitation Destination</h2>
        <p>All customer are limit to Johor state area only for 1 day rental. Minimum rental for 2 days for rental area
            outside Johor state area. If the customer fails to comply, penalty will be charge 1 day rental extra.</p>
    </div>
    <div class="">
        <p style="font-size: 14px">I have read Terms & Conditions of this agreement and agree here to</p>
        <br><br>
        <h4>__________________________</h4>
        ({{ $rental->customer->name }})

    </div>
</body>

</html>
