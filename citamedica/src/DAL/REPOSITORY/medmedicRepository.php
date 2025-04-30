<?php 
global  $carpetaPincpal; 
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/genericRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/MODEL/medmedic.php';

class medmedicRepository extends genericRepository{
	
    public function __construct()
    {
        $this->_db =  new DataSoruce();
        $this->_model =  new medmedic();
    }

    public function citaMedicaConJoins(){
            
    }

}

?>

