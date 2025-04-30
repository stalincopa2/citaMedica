<?php 
print "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    <div class = 'container'>
        <div class = 'row mt-5 '> 
            <form method= 'POST'>
                <small id='emailHelp' class='form-text text-muted'>We'll never share your email with anyone else.</small>
                <h1 >Ingresar porfavor las credenciales de usuario </h1>
                <div class='form-group'>
                    <label for='usuario'>USUARIO</label>
                    <input type='text'     class='form-control' id='usuario'    name ='usuario' placeholder='Ingresa tu usuario'>
                </div>
                <div class='form-group py-2'>
                    <label for='contrasenia'>CONTRASEÑA</label>
                    <input type='password' class='form-control' id='contrasenia' name = 'contrasenia' placeholder='Password'>
                </div>

                <button type='submit' class='btn btn-primary'>Submit</button>
            </form>
        </div>  
    </div>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js'></script>
</body>
</html>
";
?>