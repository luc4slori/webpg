<?php
 require("../models/nota.php");
    $n = new Nota();
    if($notas = $n->getAllAllASC()){
		$seg = 0;
		foreach ($notas as  $row => $nota) {
			$seg+=1;
			$fecha= new DateTime($nota["fechaNota"]);
			$fecha->add(new DateInterval('PT'.$seg.'S'));			
			$fecha = $fecha->format('Y-m-d H:i:s');
			$nn = new Nota();
			if($nn->updateFecha($nota["id"],$fecha)){	
			}
				
				
						
		}
	}
?>