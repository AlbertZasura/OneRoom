<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengumuman</title>
</head>
<body>
    <h1>Pengumuman</h1>
    <table>
        <tr>
            <th style="width:25%"></th>
            <th style="width:25%"></th>
            <th style="width:25%"></th>
        </tr>
        <tr>
            <td>
                <a class="card-text">Pengirim :</a> 
                <br>
            </td>
            <td>
                <a>:</a>
            </td>
                
            <td>
                <a class="card-text">{{ Auth::user()->name }}</a>
            </td>
        </tr>
        <tr>
        </td>
            <td>
                <a class="card-text">Tanggal : </a> <a class="card-text">{{ $message->created_at->format('d M Y') }}</a>
                <br>
            </td>
            
        </tr>
        <tr>
            <td>
                <a class="card-text">Judul : </a> <a class="card-text">{{ $message->title }}</a>
                <br>
            </td>
        </tr>
    </table>
    <br>
    <a class="card-text"> {{ $message->content }}</a>
</body>
</html>