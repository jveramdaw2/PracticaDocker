<?php
    include "empleado.php";
    $plant = new empleadoPlantilla("Jhon", "Vera", "14-78451589-75", 3000, 200);
    $plant2 = new empleadoPlantilla("Diana", "Peralta", "15-25623687-25", 3000, 100);
    $comi = new EmpleadoPorComision("Erika", "Wajarai", "13-28964781-21", 6, 25, 2000);
    $empr = new empresa();

    $resultado = "";

    $resultado .= "<h3>Empleado:</h3>";

    $resultado .= "<h3>Empleado plantilla:</h3>";
    $resultado .= $plant->mostrar();
    $resultado .= "<br>" . $plant2->mostrar();

    $resultado .=  "<h3>Empleado por comisión:</h3>";
    $resultado .= $comi->mostrar();

    $resultado .=  "<h3>Prueba polimorfismo</h3>";
    $resultado .= "Los ingresos de " . $plant->getApellido() . " son: " . pruebaPolimorf::calcular($plant) . "<br>";
    $resultado .= "<br>Los ingresos de " . $plant2->getApellido() . " son: " . pruebaPolimorf::calcular($plant2) . "<br>";
    $resultado .= "<br>Los ingresos de " . $comi->getApellido() . " son: " . pruebaPolimorf::calcular($comi) . "<br>";

    $resultado .=  "<h3>Listado empresa</h3>";
    $empr->addEmpleado($plant);
    $empr->addEmpleado($plant2);
    $empr->addEmpleado($comi);

    $resultado .= $empr->listarEmpleados();

    $resultado .=  "<p><b>La suma total de ingresos es: </b>" .$empr->sumaIngresos() . "</p>";
    include "includes/vista_resultado.php"

?>