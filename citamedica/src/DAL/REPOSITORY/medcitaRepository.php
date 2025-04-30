<?php 
global  $carpetaPincpal; 
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/MODEL/medcita.php';
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/genericRepository.php';

class medcitaRepository extends genericRepository{
	
    public function __construct()
    {
        $this->_db =  new DataSoruce();
        $this->_model =  new medcita();
    }

    public function listaCitasMedicas(){
        $sql = "SELECT a.*, b.*, c.*, d.* FROM medcita as a 
        JOIN medpacie as b on a.cita_id_pacie = b.pacie_id_pacie
        JOIN medmedic as c on a.cita_id_medic = c.medic_id_medic
        JOIN medespec as d on a.cita_id_espec = d.espec_id_espec";

        $listadoCitas = $this->_db->ejecutarConsulta($sql);

        if ($listadoCitas==0)
            return null;
        else
            return $listadoCitas;

    }

}

?>

