<?php

class rutas {

    private $_direccionVistas;

    public function __construct()
    {
        $this->_direccionVistas =   'resources/views';
    }

    public function DireccionVistas($request){

        switch ($request) {
            case '/citamedica/':
                return $this->_direccionVistas.'/home/home.php';
                break;
            case '/citamedica/cita':
                    return $this->_direccionVistas.'/cita/lista.php';
                    break;
            case '/citamedica/cita/crear':
                        return $this->_direccionVistas.'/cita/crear.php';
                        break;
            case '/citamedica/cita/lista':
                return $this->_direccionVistas.'/cita/lista.php';
                break;
            case '/citamedica/cita/eliminar':
                return $this->_direccionVistas.'/cita/eliminar.php';
                break;
        
            case '/citamedica/cita/detalles':
                return  $this->_direccionVistas.'/cita/detalles.php';
                break;
        
           case '/citamedica/cita/editar':
                return $this->_direccionVistas.'/cita/editar.php';
                break;
            default: return $this->_direccionVistas.'/home/home.php';
        return $this->_direccionVistas.'/home/home.php';
        }
    }
}


?>