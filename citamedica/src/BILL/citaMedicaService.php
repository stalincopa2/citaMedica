<?php  
global  $carpetaPincpal; 
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/medempreRepository.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/medespecRepository.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/medcitaRepository.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DTO/citaMedicaDTO.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/MODEL/medcita.php';

  class citaMedicaService {

    private $_medcitaRespository;

    public function __construct()
    {
        $this->_medcitaRespository =  new medcitaRepository();
    }

    public function lista(){

        $citasMedicas =  $this->_medcitaRespository->listaCitasMedicas();

        $arrayCitasMedicas= array();

        if ($citasMedicas!=null){
          foreach($citasMedicas as  $clave => $valor)
          {
            $citaMedicaDTO = new citaMedicaDTO();
            $citaMedicaDTO->id = $citasMedicas[$clave]['cita_id_cita'];
            $citaMedicaDTO->medico= $citasMedicas[$clave]['medic_nom_medic'];
            $citaMedicaDTO->paciente= $citasMedicas[$clave]['pacie_nom_pacie']." ".$citasMedicas[$clave]['pacie_ape_pacie'];
            $citaMedicaDTO->fecha= $citasMedicas[$clave]['cita_fec_cita'];
            $citaMedicaDTO->espeialidad= $citasMedicas[$clave]['espec_nom_espec'];
            array_push( $arrayCitasMedicas,  $citaMedicaDTO );
          }
        }
      return  $arrayCitasMedicas;
    }

    public function insertar( $citaMedicaDTO){
      $medcita = new medcita();
      $medcita->cita_det_cita =  $citaMedicaDTO->detalle;
      $medcita->cita_fec_cita =  $citaMedicaDTO->fecha;
      $medcita->cita_id_pacie =  $citaMedicaDTO->id_paciente;
      $medcita->cita_id_medic =  $citaMedicaDTO->id_especialidad;
      $medcita->cita_id_espec =  $citaMedicaDTO->id_medico;
      $resultado =   $this->_medcitaRespository->insert($medcita);
      if ($resultado>0)
        return $citaMedicaDTO;
      return null; 

    }

    public function eliminar($citaMedicaDTO) {
        $where = "cita_id_cita = ". $citaMedicaDTO->id;
        $columnasAfectadas =   $this->_medcitaRespository->delete($where);
      
    }
  }


?>