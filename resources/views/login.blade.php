<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="window=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <h2 class="text-center mt-4 mb-4">Inicio de Sesión</h2>
            @if(session('type'))
                <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
                    <strong>Noticia: </strong>{{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
            <div class="col-md-4"></div>
            <div class="card p-3 col-md-4 text-center">
                <form action="Check" method="POST">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md4">
                            <input type="email" name="email" class="form-control" placeholder="escriba el correo">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md4">
                            <input type="password" name="password" class="form-control" placeholder="escriba la contraseña">
                        </div>
                    </div>
                    <br>
                    <button class='btn btn-primary mt-2'>Ingresar</button>
                </form>
            </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    </body>
</html>