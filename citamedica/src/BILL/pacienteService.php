<?php
global  $carpetaPincpal; 
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/medempreRepository.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/medespecRepository.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/medpacieRepository.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DTO/pacienteDTO.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/MODEL/medpacie.php';

  class pacienteService {

    private $_medpacieRepository;

    public function __construct()
    {
        $this->_medpacieRepository =  new medpacieRepository();
    }

    public function lista(){

        $listaPacientes =  $this->_medpacieRepository->select();

        return $listaPacientes;
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