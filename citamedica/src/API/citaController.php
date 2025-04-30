<?php 
include_once('../../parameters.php');
header("Content-Type: application/json; charset=UTF-8");

global  $carpetaPincpal; 
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DTO/respuestaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/BILL/citaMedicaDTO.php';
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/BILL/citaService.php';

$respuestaDTO = new respuestaDTO(); 
echo  json_encode( $datosPeticion);
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Obtener los datos JSON enviados por AJAX
   $datosPeticion = json_decode(file_get_contents("php://input"),true); 
   
   $opcion =  $datosPeticion['opcion'];
   $data =    $datosPeticion['data'];

    if ($opcion== 1){
     $citaMedicaDTO = new citaMedicaDTO();
     $citaMedicaDTO->fecha= $data['fechaCitaMedica'];
     $citaMedicaDTO->detalle= $data['detalleCitaMedica'];
     $citaMedicaDTO->id_paciente= $data['id_paciente'];
     $citaMedicaDTO->id_especialidad= $data['id_especialidad'];
     $citaMedicaDTO->id_medico= $data['id_medico'];
   
     $respuestaDTO =    guardarCitaMedica( $citaMedicaDTO); 
    }
    echo  json_encode( $respuestaDTO->data);
}
else 
{
  $respuestaDTO->codigo = '404';
  $respuestaDTO->mensaje = 'Metodo no encontrado o no permitido';
  $respuestaDTO->data = null; 

  echo json_encode( $respuestaDTO->data);
}


function guardarCitaMedica($citaMedicaDTO){
    $citaService = new citaService();
    $respuestaDTO = new respuestaDTO(); 
    $respuesta =  $citaService->insertar($citaMedicaDTO);
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