<?php 
include_once('../../parameters.php');
header("Content-Type: application/json; charset=UTF-8");

global  $carpetaPincpal; 
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DTO/respuestaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/BILL/pacienteService.php';

$respuestaDTO = new respuestaDTO(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Obtener los datos JSON enviados por AJAX
   $datosPeticion = json_decode(file_get_contents("php://input"),true); 

   $opcion =  $datosPeticion['opcion'];
   $data =    $datosPeticion['data'];

    if ($opcion== 1){
     $pacienteDTO = new pacienteDTO();
     $pacienteDTO->id = $data['id'];
     $pacienteDTO->identificacion =  $data['identificacion'];
     $pacienteDTO->apellido =  $data['apellido'];
     $pacienteDTO->nombre =  $data['nombre'];

     $respuestaDTO =    guardarPaciente($pacienteDTO); 
    }
    print  json_encode( $respuestaDTO);
}
else 
{
  $respuestaDTO->codigo = '404';
  $respuestaDTO->mensaje = 'Metodo no encontrado o no permitido';
  $respuestaDTO->data = null; 

  print json_encode($respuestaDTO);
}


function guardarPaciente($pacienteDTO){
   $pacienteService = new pacienteService();
    $respuestaDTO = new respuestaDTO(); 
    $respuesta = $pacienteService->insertar($pacienteDTO);
    if ($respuesta!=null)
    {
      $respuestaDTO->codigo = '200';
      $respuestaDTO->mensaje = 'OK';
      $respuestaDTO->data =   $respuesta;
    }
    else {
      $respuestaDTO->codigo = '500';
      $respuestaDTO->mensaje = 'error';
      $respuestaDTO->data =   null;
    }
    return  $respuestaDTO;
}
?>