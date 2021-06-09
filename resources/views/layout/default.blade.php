<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <base href='<?php echo url(); ?>/'>
        <link href="public/css/app.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="produtos">
                            Estoque Laravel
                        </a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="produtos">Listagem</a></li>
                        <li><a href="produtos/create">Novo</a></li>
                    </ul>
                </div>
            </nav>
            @yield('conteudo')
            <footer class="footer">
                <p>© Treinamento Laravel</p>
            </footer>
        </div>
    </body>    
</html>
