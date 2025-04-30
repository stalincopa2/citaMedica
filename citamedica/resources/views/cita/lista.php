<?php 
global  $carpetaPincpal; 
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/BILL/citaMedicaService.php';

$citaMedicaService = new citaMedicaService();
$citasMedicas = $citaMedicaService->lista();

$contenido=  "
            <div>
                <h1> Listado de citas medicas </h1> 
                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#mdlAgendarCita'>
                    Agendar Nueva Cita
                </button>
            </div>
            <div class='card'>  
                <table>
                    <thead>
                        <th> ID </th>
                        <th> MEDICO </th>
                        <th> PACIENTE </th>
                        <th> FECHA  </th>
                        <th> ESPECIALIDAD </th> 
                        <th> OPCIONES </th> 
                    </thead>
                    <tbody>";
                    if (count($citasMedicas) >0 ){
                        foreach($citasMedicas  as $cita)
                        {
                            $contenido.="<tr>";
                            $contenido.="<td>". $cita->id."</td>";
                            $contenido.="<td>". $cita->medico."</td>";
                            $contenido.="<td>". $cita->paciente."</td>";
                            $contenido.="<td>". $cita->fecha."</td>";
                            $contenido.="<td>". $cita->espeialidad."</td>";
                            $contenido.="<td>
                                        <button> Detalles </button>
                                        <button> Editar </button>
                                        <button> Eliminar </button>
                                    </td>";
                           $contenido.="</tr>";
                        }

                    }else {
                      $contenido.="No hay citas medicas registradas";
                    }
                
      $contenido.="</tbody>
                </table>
            </div>
";

?>