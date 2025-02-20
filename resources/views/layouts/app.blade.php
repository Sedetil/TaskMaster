<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'To-Do List App')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0D92F4, #77CDFF);
            color: white;
            font-family: 'Press Start 2P', cursive;
            margin: 0;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }
        .container {
            max-width: 850px;
            background: #2b2b2b;
            border: 6px solid white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 8px 8px 0px black;
        }
        h1, h2, h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }
        .btn-pixel {
            display: inline-block;
            padding: 12px 24px;
            font-size: 12px;
            background: #F95454;
            border: 4px solid black;
            box-shadow: 6px 6px 0px black;
            text-transform: uppercase;
            text-decoration: none;
            color: white;
            transition: all 0.2s;
            cursor: pointer;
        }
        .btn-pixel:hover {
            background: #C62E2E;
            transform: translateY(2px);
            box-shadow: 4px 4px 0px black;
        }
        .btn-pixel:active {
            transform: translateY(4px);
            box-shadow: 2px 2px 0px black;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            font-size: 12px;
            background: white;
            color: black;
            border: 3px solid black;
            box-shadow: 6px 6px 0px black;
        }
        .table th, .table td {
            padding: 10px;
            text-align: center;
        }
        .table th {
            background: #F95454;
            color: white;
        }
        .form-control {
            font-size: 12px;
        }
        .alert {
            font-size: 12px;
            padding: 10px;
            margin-bottom: 10px;
        }
        footer {
            margin-top: 20px;
            font-size: 10px;
            text-align: center;
            padding: 10px;
            border-top: 2px dashed white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>@yield('header')</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')

        <footer>
            <p>&copy; {{ date('Y') }} To-Do List App - Dibuat dengan Laravel</p>
        </footer>
    </div>
</body>
</html>
