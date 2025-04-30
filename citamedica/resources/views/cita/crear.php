<?php 

global  $carpetaPincpal; 

require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/BILL/citaMedicaService.php';
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/BILL/pacienteService.php';
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/BILL/especialidadService.php';
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/BILL/medicoService.php';
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DTO/citaMedicaDTO.php';

function guardarCitaMedica($citaMedicaDTO){
  $citaService = new citaMedicaService();
  $respuesta =  $citaService->insertar($citaMedicaDTO);
  header('Location:'.$directorioRaiz.'/cita/lista');

}



$citaMedicaService = new citaMedicaService();
$pacienteService =  new pacienteService();
$especialidadService =  new especialidadService ();
$medicoService = new medicoService();

$listaPacientes = $pacienteService->lista();
$listaEspecialidades=  $especialidadService->lista();
$listaMedicos = $medicoService->lista();


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{

     $citaMedicaDTO = new citaMedicaDTO();
     $citaMedicaDTO->fecha= $_POST['fechaCitaMedica'];
     $citaMedicaDTO->detalle= $_POST['detalleCitaMedica'];
     $citaMedicaDTO->id_paciente=$_POST['id_paciente'];
     $citaMedicaDTO->id_especialidad=$_POST['id_especialidad'];
     $citaMedicaDTO->id_medico= $_POST['id_medico'];
   
    $respuestaDTO =    guardarCitaMedica( $citaMedicaDTO); 
    $contenido =  $citaMedicaDTO;
    exit();

}else {



  $contenido =  "<form method='POST'>
  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>
  + Agregar Nuevo Paciente
  </button>
    <div class='form-group'>
    <div class='mb-3'>
    <label for='fechaCitaMedica' class='form-label'>Selecciona Fecha y Hora:</label>
    <input type='text' class='form-control' id='fechaCitaMedica' name='fechaCitaMedica'>
</div>
    </div>

    <div class='form-group'>
      <label for='id_paciente' style = 'margin-bottom:20px;'>Selecciona el paciente      
      </label>

      <select class='form-control' id='id_paciente' name='id_paciente'>";

      if (count($listaPacientes)> 0)
      {
          foreach($listaPacientes as $paciente)
          {
              $id_paciente = $paciente->pacie_id_pacie;
              $nombre_paciente = $paciente->pacie_nom_pacie." ".$paciente->pacie_ape_pacie;
              $contenido.=  "<option value = '$id_paciente'>$nombre_paciente</option>";
          }
          
      }
                  
    $contenido.=" </select>
                </div>

                <div class='form-group'>
                  <label for='id_especialidad' style = 'margin:20px auto 20px auto;'>Selecciona la especialidad </label>

                  <select class='form-control' id='id_especialidad' name ='id_especialidad'>";

                  if (count($listaEspecialidades)> 0)
                  {
                      foreach($listaEspecialidades as $especialidad)
                      {
                          $id_especialidad = $especialidad->espec_id_espec;
                          $nombre_especialidad = $especialidad->espec_nom_espec;
                          $contenido.=  "<option value = '$id_especialidad'>$nombre_especialidad</option>";
                      }
                      
                  }
      
    $contenido.=" </select>
                </div>
                

                <div class='form-group'>
                  <label for='id_medico' style = 'margin:20px auto 20px auto;'>Selecciona el medico </label>

                  <select class='form-control' id='id_medico' name='id_medico'>";

                  if (count($listaMedicos)> 0)
                  {
                      foreach($listaMedicos as  $medico)
                      {
                          $id_medico =$medico->medic_id_medic;
                          $nombre_medico = $medico->medic_nom_medic." ".$medico->medic_ape_medic;
                          $contenido.=  "<option value = '$id_medico'> $nombre_medico</option>";
                      }
                      
                  }
      
    $contenido.=" </select>
                </div>

                <div class='form-group'>
                <label for='detalleCitaMedica'  style = 'margin:20px; auto 20px; auto'>Detalle</label>
                <textarea class='form-control' name ='detalleCitaMedica' id='detalleCitaMedica' rows='3'></textarea>
                </div>
               
                <input type= 'submit' class='btn btn-primary' id='btnAgendarCita' value='Guardar Cita'/>

            </form>
        ";

  $contenido.= "
        <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
          <div class='modal-dialog' role='document'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>AGREGAR NUEVO PACIENTE</h5>
              </div>
              <div class='modal-body'>
                <form>
                <div class='form-group'>
                <label for='identificacionPaciente'>Identificacion</label>
                <input type='text' class='form-control' id='identificacionPaciente'>
                </div>

                <div class='form-group'>
                    <label for='nombrePaciente'>Nombre</label>
                    <input type='text' class='form-control' id='nombrePaciente' >
                </div>
                <div class='form-group'>
                    <label for='apellidoPaciente'>Apellido</label>
                    <input type='text' class='form-control' id='apellidoPaciente'>
                </div>
                </form>
              </div>
              <div class='modal-footer'>
                <button id='btnCancelarGuardarPaciente' type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                <button id='btnGuardarPaciente' type='button' class='btn btn-primary'>Guardar</button>
              </div>
            </div>
          </div>
        </div>";     

    $contenido.= "
        <script>    
            document.addEventListener('DOMContentLoaded', function () {
              flatpickr('#fechaCitaMedica', {
                  enableTime: true,
                    dateFormat: 'Y-m-d H:i', // Formato de fecha y hora
                });
            });
            
            const urlPacienteAPI = '$directorioRaiz/src/API/pacienteController.php';
            const urlCitaMedicaAPI = '$directorioRaiz/src/API/citaController.php';

            let btnGuardarPaciente = document.getElementById('btnGuardarPaciente');
            let btnAgendarCita = document.getElementById('btnAgendarCita');


          

            const guardarPacienteAjax= function (){
                let  pacienteDTO = {
                    id: 0,
                    nombre: document.getElementById('nombrePaciente').value,
                    apellido:document.getElementById('apellidoPaciente').value,
                    identificacion: document.getElementById('identificacionPaciente').value
                };
                
                let request = {
                    opcion: '1',
                    data: pacienteDTO,
                };
            //  console.log(request); 

            fetch(urlPacienteAPI, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body:  JSON.stringify(request)
              })
              .then(response => response.json()) 
              .then(data => {
                 if (data.codigo=='200')
                 {
                  alert('Paciente creado de manera existosa');
                  let select =  document.getElementById('id_paciente');
                  let option =  document.createElement('option');
                  option.value= data.data['id'];
                  option.innerHTML= data.data['nombre'] +' ' +data.data['apellido']; 
                  option.selected = 'selected'; 
                  select.appendChild(option);
                  $('#exampleModal').modal('hide');
                 }
                 else {
                  alert('Error interno del servidor: Revisa que no exista un paciente con esa mismas identificacion '); 
                 }
              })
              .catch(error => {
                alert('Error interno del servidor');
              });

        }


        
        // function  guardarCitaMedicaAjax (){
        //   let  citaMedicaDTO = {
        //       id: 0,
        //       fecha:  document.getElementById('fechaCitaMedica').value,
        //       detalle: document.getElementById('detalleCitaMedica').value,
        //       id_paciente: document.getElementById('id_paciente').value,
        //       id_especialidad: document.getElementById('id_especialidad').value,
        //       id_medico: document.getElementById('id_medico').value
        //   };
          
        //   let request = {
        //       opcion: '1',
        //       data: citaMedicaDTO,
        //   };
        //    //console.log(request); 

        //     fetch(urlCitaMedicaAPI , {
        //         method: 'POST',
        //         headers: {
        //           'Content-Type': 'application/json'
        //         },
        //         body:  JSON.stringify(request)
        //       })
        //       .then(response => response.json()) 
        //       .then(data => {
        //          if (data.codigo=='200')
        //          {
        //           alert ('cita guardada exitosamente');
        //          }
        //          else {
        //           alert('Error error interno del servidor '); 
        //          }
        //       })
        //       .catch(error => {
        //        console.log(error);
        //       });

        // }

        //   btnAgendarCita.addEventListener('click',function (e){
        //     e.preventDefault();
        //     guardarCitaMedicaAjax();
        //   }
        //   );

          btnGuardarPaciente.addEventListener('click',guardarPacienteAjax);
          

        </script>
        ";

}




?>