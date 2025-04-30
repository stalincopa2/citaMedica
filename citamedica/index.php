<?php 
 include_once('parameters.php');
 include_once('rutas.php');
 $request = $_SERVER['REQUEST_URI'];

 if($request[0] != '/') {
    $request = '/' . $request;
}
 $rutas = new rutas ();
 $path =  $rutas->DireccionVistas($request);
  
 include($path);

 print "
 <html lang='es'>
 <head>
    
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css' rel='stylesheet'>
     <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css'>
     <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'>
     <title>CITAS MEDICAS</title>
 </head>
 <body>

     <nav   class='navbar navbar-expand-lg navbar-light bg-light' id='navbarNav'>
         <a class='navbar-brand' href='$directorioRaiz'>Navbar</a>
         <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
             <span class='navbar-toggler-icon'></span>
         </button>
         <div class='nav-item dropdown' id='navbarNav'>
             <ul class='navbar-nav'>
                 <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Agendamiento de citas
                    </a>
                    <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                        <a class='dropdown-item' href='$directorioRaiz/cita/crear'>Agendar Nueva Cita</a>
                        <a class='dropdown-item' href='$directorioRaiz/cita/lista'>Listado de citas medicas</a>
                    </div>
                </li>
             </ul>
         </div>
     </nav>
    
     <div class = 'container'>
         <div class = 'row mt-5 '>
           $contenido
         </div>  
     </div>
 </body>

 <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
 <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js'></script>
 <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js'></script>
 <script src='https://cdn.jsdelivr.net/npm/flatpickr'></script>
 </html>
 ";

?>