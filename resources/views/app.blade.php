<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background: #e5e5e5;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }
            .form form{
              width: 768px;
              display: flex;
              margin: auto;
              align-items: center;
              padding: 1rem;
              background: #fff;
            } 
            .btn{
              width: 200px;
              margin-left: 10px;
            }
        </style>
    </head>
    <body class="antialiased">
       @yield('content')
    </body>
</html>
