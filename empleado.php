<?php
     abstract class empleado{
        private $_nombre;
        private $_apellido;
        private $_numSegSo;

        function __construct($nombre, $apellido, $numSegSo){
            $this->_nombre = $nombre;
            $this->_apellido = $apellido;
            $this->_numSegSo = $numSegSo;
        }

        function getNombre(){
            return $this->_nombre;
        }
        function getApellido(){
            return $this->_apellido;
        }
        function getNumSeguridadSocial(){
            return $this->_numSegSo;
        }

        function setNombre($nombre){
            $this->_nombre = $nombre;
        }
        function setApellido($apellido){
            $this->_apellido = $apellido;
        }
        function setNumSeguridadSocial($numSegSo){
            $this->_numSegSo = $numSegSo;
        }

        abstract function ingresos();

        function mostrar(){
            return "Está empleado $this->_nombre $this->_apellido con el NSS: $this->_numSegSo";
        }
    }
    class empleadoPlantilla extends empleado{
        private $_sueldo;
        private $_dietas;

        function __construct($nombre, $apellido, $numSegSo, $sueldo,$dietas){
            parent::__construct($nombre,$apellido,$numSegSo);
            $this->_sueldo= $sueldo;
            $this->_dietas = $dietas;
            
        }

        function getSueldo(){
            return $this->_sueldo;
        }
        function getDietas(){
            return $this->_dietas;
        }
        function setSueldo($sueldo){
            $this->_sueldo = $sueldo;
        }
        function setDietas($dietas){
            $this->_dietas = $dietas;
        }

        function ingresos(){
            return  $this->_sueldo + $this->_dietas;
        }
        function mostrar(){
            return parent::mostrar() . "<br>Sueldo: $this->_sueldo <br> Dietas: $this->_dietas<br>Ingresos son: " .$this->ingresos() ."<br>";
         }
    }

    class EmpleadoPorComision extends empleado{
        private $_horas;
        private $_tarifa;
        private $_base;

        function __construct($nombre, $apellido, $numSegSo, $horas, $tarifa, $base){
            parent::__construct($nombre, $apellido, $numSegSo);
            $this->_horas = $horas;
            $this->_tarifa = $tarifa;
            $this->_base = $base;
        }

        function getHoras(){
            return $this->_horas;
        }
        function getTarifa(){
            return $this->_tarifa;
        }
        function getBase(){
            return $this->_base;
        }
        function setHoras($horas){
            $this->_horas = $horas;
        }
        function setTarifa($tarifa){
            $this->_tarifa = $tarifa;
        }
        function setBase($base){
            $this->_base = $base;
        }

        function ingresos(){
            return $this->_base + ($this->_horas * $this->_tarifa);
        }
        function mostrar(){
            return parent::mostrar() . "<br>Horas: $this->_horas<br>Tarifa: $this->_tarifa<br>Base: $this->_base<br>Ingresos son: " . $this->ingresos() . "<br>";
        }
    }

    class pruebaPolimorf{
        static function calcular(empleado $emp){
            return $emp->ingresos();
        }
    }

    class empresa{
        private $empleados = array();
        
        function addEmpleado(empleado $emp){
            if($emp instanceof empleadoPlantilla){
                 $this->empleados[] = new empleadoPlantilla($emp->getNombre(),$emp->getApellido(),$emp->getNumSeguridadSocial(),$emp->getSueldo(),$emp->getDietas());
            }
            if($emp instanceof EmpleadoPorComision){
                $this->empleados[] = new EmpleadoPorComision($emp->getNombre(),$emp->getApellido(),$emp->getNumSeguridadSocial(),$emp->getHoras(),$emp->getTarifa(),$emp->getBase());
            }
        }

        function listarEmpleados(){
            $lista = "";
            foreach($this->empleados as $emp){
               $lista .= $emp->mostrar() . "<br>";
            }
            return $lista;
        }
        function sumaIngresos(){
            $sum = 0;
            foreach($this->empleados as $emp){
                $sum += $emp->ingresos();
            }
            return $sum;
        }
    }
?>