<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <title>ToyChest</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css1/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css1/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css1/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css1/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css1/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css1/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css1/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css1/style.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/logreg_.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body>



    <h1>Transaksi</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Tipe Pembayaran</th>
                <th>Waktu Transaksi</th>
                <th>Waktu Penyelesaian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->order_id }}</td>
                <td>{{ $transaction->transaction_status }}</td>
                <td>{{ $transaction->gross_amount }}</td>
                <td>{{ $transaction->payment_type }}</td>
                <td>{{ $transaction->transaction_time }}</td>
                <td>{{ $transaction->settlement_time }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>