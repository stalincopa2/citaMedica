<?php  
global  $carpetaPincpal; 
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/medespecRepository.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DTO/especialidadDTO.php';

  class especialidadService {

    private $_medespecRepository;

    public function __construct()
    {
        $this->_medespecRepository =  new medespecRepository();
    }

   public function lista(){
    return  $this->_medespecRepository->select();
   }

  }
?>