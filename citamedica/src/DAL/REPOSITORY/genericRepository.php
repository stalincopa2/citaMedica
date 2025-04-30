<?php 
global  $carpetaPincpal; 
require_once $_SERVER['DOCUMENT_ROOT'] .$carpetaPincpal.'/src/DAL/DB/DataSource.php';

class genericRepository{

    public  $_db;
    public $_model;


   	
	public  function  select($where="")
    {
        $columns= "*"; 
        $sql= "SELECT $columns FROM ".get_class($this->_model)." ".$where;

        $arrayModelo = $this->_db->ejecutarConsultaModelo(get_class($this->_model), $sql);
      
        if (count($arrayModelo)>0)
         return $arrayModelo; 
        else
         return null; 
    }

    public function  insert($model)
    {
        $columnas = [];
        $placeholders = [];
        $parametros = [];
    
        foreach ($model as $clave => $valor) {
            $columnas[] = "`" . $clave . "`";
            $placeholder = ":" . $clave;
            $placeholders[] = $placeholder;
            $parametros[$placeholder] = $valor;
        }
    
        $columnasString = implode(', ', $columnas);
        $placeholdersString = implode(', ', $placeholders);

    
        $sql = "INSERT INTO `" . get_class($this->_model) . "` (" . $columnasString . ") VALUES (" . $placeholdersString . ")";
    
        return  $this->_db->ejecutarActualizacion($sql, $parametros);   
    }

    public function  delete($where){
        $sql = "DELETE FROM".get_class($this->_model)." where ".$where;
        return  $this->_db->ejecutarActualizacion($sql);   
	}

    // public function update(){

	// }

}

?>

