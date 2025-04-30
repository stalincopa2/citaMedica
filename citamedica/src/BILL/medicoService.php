<?php
global  $carpetaPincpal; 
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/medmedicRepository.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/MODEL/medmedic.php';

  class medicoService {

    private $_medmedicRepository;

    public function __construct()
    {
        $this->_medmedicRepository =  new medmedicRepository();
    }

    public function lista(){

        $listaMedicos=  $this->_medmedicRepository->select();

        return  $listaMedicos;
    }

    public function insertar($pacienteDTO)
    {
      $medpacie = new medpacie();
      $medpacie->pacie_id_pacie =  $pacienteDTO->id;
      $medpacie->pacie_ide_pacie = $pacienteDTO->identificacion;
      $medpacie->pacie_ape_pacie = $pacienteDTO->apellido;
      $medpacie->pacie_nom_pacie = $pacienteDTO->nombre;
      $resultado =   $this->_medpacieRepository->insert($medpacie);
      if ($resultado>0)
        $insertado = $this->_medpacieRepository->select( " where pacie_ide_pacie = '".$medpacie->pacie_ide_pacie."';");
        $pacienteDTO->id =  $insertado[0]->pacie_id_pacie;
        return $pacienteDTO;
      return null; 
    }

  }


?>