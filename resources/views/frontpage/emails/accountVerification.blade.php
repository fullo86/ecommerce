<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <style>
        .tabel {
            border: 0;
        }
        
        .tem-column {
            background-color: #ffffff;
            padding: 40px 0 30px 0;            
        }

        .data-column {
            background-color: #ffffff;
            padding: 20px 30px 40px 30px;
            border: 1px solid #dddddd;
        }

        .data-db {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <table class="tabel" align="center" cellpadding="0" cellspacing="0" width="600">
        <tr>
            <td class="tem-column" align="center">
                <h1>Verifikasi Akun</h1>
            </td>
        </tr>
        <tr>
            <td class="data-column">
                <p>Hello, {{ $customer->name }}</p>
                <p>Terima kasih telah mendaftar! Silakan verifikasi akun Anda dengan menekan tombol di bawah ini:</p>
                <p>
                    <a href="http://127.0.0.1:8000/account/verify/{{ $customer->id }}" class="data-db">Verifikasi Email</a>
                </p>
                <p>Jika tombol di atas tidak berfungsi, Anda dapat menyalin dan menempel tautan berikut ke browser Anda:</p>
                <a href="http://127.0.0.1:8000/account/verify/{{ $customer->id }}">http://127.0.0.1:8000/account/verify/{{ $customer->id }}</a>
            </td>
        </tr>
        <tr>
            <td class="data-column">
                <p>Salam,</p><br>
                <p>Minsu.id</p>
            </td>
        </tr>
    </table>
</body>
</html>
