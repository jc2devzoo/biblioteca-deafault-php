<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

       
    </head>
    <body >
        <div class="cabeçalho">
            <ul>
                <li><a href="/">Livros</a></li>
                <li><a href="/">Usuarios</a></li>
                <li><a href="/">Emprestimos</a></li>
            </ul>
        </div>
        <div class="container">
           @yield('conteudo') 
        </div>
    <section class="footer">

    </section>
       
    </body>
</html>
