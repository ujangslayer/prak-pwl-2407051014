<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .center { text-align: center; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 8px 12px; border: 1px solid #6cace4; }
        th { background-color: #6cace4; color: white; }
        tr:nth-child(even) { background-color: #e3f2fd; }
    </style>
</head>
<body>
@extends('layouts.app')


@section('content')
    <h1 >User Management</h1>
    <p>ini adalah halaman user management</p>


    <table border="1" cellpadding="10" style="margin: 0 auto;">
        <tr style="background-color: #0000ff;">
            <th>ID</th>
            <th>Nama</th>
            <th>NPM</th>
            <th>Kelas</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->npm }}</td>
                <td>{{ $user->nama_kelas }}</td>
            </tr>
        @endforeach
    </table>
@endsection

</body>
</html>

