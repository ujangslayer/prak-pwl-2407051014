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
    <div class="center">
        <h1>Assalamualaikum</h1>
        <p>Data diri</p>

    <table border="1" >
        <tr>
            <th>Nama</th>
            <th>NPM</th>
            <th>Jurusan</th>
            <th>Prodi</th>
        </tr>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user['nama'] }}</td>
            <td>{{ $user['npm'] }}</td>
            <td>{{ $user['jurusan'] }}</td>
            <td>{{ $user['prodi'] }}</td>
        </tr>
    @endforeach
    </table>
</body>
</html>

