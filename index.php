<?php

require_once 'vendor/autoload.php';
require_once 'app/core/Core.php';  
   
 $core = new Core;
 $core->run();
  
  
echo "contoller: " .$core->getController();
echo "<br>Método : " .$core->getMetodo();
$parametros = $core->getParametros();
foreach ($parametros as $param)
    echo "<br>Parâmetro : " .$param;
?>