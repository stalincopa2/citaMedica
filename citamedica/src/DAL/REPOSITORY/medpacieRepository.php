<?php 
global  $carpetaPincpal; 
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/REPOSITORY/genericRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/MODEL/medpacie.php';


class medpacieRepository extends genericRepository{
	
    public function __construct()
    {
        $this->_db =  new DataSoruce();
        $this->_model =  new medpacie();
    }

}

?>

