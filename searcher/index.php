<?php 
	$searcherDir=rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
	$rootDir = rtrim($searcherDir, "/searcher");
	$searchQuery = isset($_POST["searchQuery"]) ? $_POST["searchQuery"] : null;
	require_once("../models/nota.php");		
	$nta = new Nota();
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/vendor/bootstrap/css/bootstrap.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/fonts/iconic/css/material-design-iconic-font.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/vendor/animate/animate.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/vendor/css-hamburgers/hamburgers.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/vendor/animsition/css/animsition.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/vendor/toastr/css/toastr.min.css"'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/css/util.min.css'?>">	
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/css/main.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$searcherDir.'/css/main.css'?>">
    
</head>
<body>
	<div class="container" style="padding-top:20px; padding-bottom:0">
		<div class="<?=$rootDir?>"></div>
		<div class="<?=$searcherDir?>"></div>
	
		<div class="row p-b-55">
			<div class="col-12 p-b-5">
				<div class="wrap-logo containerr" style="background-color:#5f925f">
					<!-- Logo desktop -->		
					<div class="logoo">
						<a href="<?=$rootDir.'/'?>"><img src="<?=$searcherDir.'/images/pg.png'?>" alt="LOGO"></a>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div id="custom-search-input">
					<form id="frm-search" role="form">
						<div class="input-group">
							<input id="search-query" type="text" class="search-query form-control" placeholder="Buscar" value="<?=$searchQuery?>" />
							<span class="input-group-btn">
								<button id="btn-search" type="submit" >
									<span class="fa fa-search"></span>
								</button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	
	
		
		
		
			<?php 
				$notas = null;
				if ($searchQuery && strlen($searchQuery)>2){
					$notas = $nta->getFromQuery($searchQuery);
					echo('<div class="h2-resultados col-12 p-b-55 fw-800"><h2><span class="q-resultados">'.count($notas).'</span> Resultados</h2></div>');
					echo('<div class="h2-error hidden col-12 p-b-55"><h2>Se requiere al menos 3 caracteres</h2></div>');
					echo('<div id="row-results"  class="row">');
					$html = "";
					foreach ($notas as $nota){
						$html .='<div class="col-6 p-b-5">';
						$html .='	<div class=" m-b-30">';
						$html .='		<a href="'.$rootDir.'/'.$nota["menu_titulo_ami"].'/'.$nota["submenu_titulo_ami"].'/'.$nota["id"].'-'.$nota["titulo_ami"].'">';
						$html .='			<img style="width:100%" src="'.$rootDir.'/'.$nota["pathFoto"].$nota["id"].'/'.$nota["filenameFoto"].'" alt="IMG">';
						$html .='		</a>';
						$html .='	</div>';
						$html .='</div>';
						$html .='<div class="col-6 p-b-5">';
						$html .='	<div class=" m-b-30">';
						$html .='		<div class="size-w-2">';
						$html .='			<h5 class="p-b-5">';
						$html .='				<a href="'.$rootDir.'/'.$nota["menu_titulo_ami"].'/'.$nota["submenu_titulo_ami"].'/'.$nota["id"].'-'.$nota["titulo_ami"].'" class="f1-s-5 cl3 hov-cl10 trans-03">';
						$html .='					'.$nota["titulo"].'';
						$html .='				</a>';
						$html .='			</h5>';

						$html .='			<span class="cl8">';
						$html .='				<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">';
						$html .='					'.$nota["submenu_titulo"].'';
						$html .='				</a>';

						$html .='				<span class="f1-s-3 m-rl-3">';
						$html .='					-';
						$html .='				</span>';

						$html .='				<span class="f1-s-3">';
						$html .='					'.$nota["fechaNota"].'';
						$html .='				</span>';
						$html .='			</span>';
						$html .='		</div>';
						$html .='	</div>';
						$html .='</div>';
						
					}
					echo ($html);	
					echo('</div>');
				} 
			
		
		
		if ($searchQuery && strlen($searchQuery)>2){
			
		} else {
			if (strlen($searchQuery)<3){
				echo('<div class="h2-resultados hidden col-12 p-b-55 fw-800"><h2><span class="q-resultados"></span> Resultados</h2></div>');
				echo('<div class="h2-error col-12 p-b-55"><h2>Se requiere al menos 3 caracteres</h2></div>');
			} else {
				echo('<div class="h2-resultados hidden col-12 p-b-55 fw-800"><h2><span class="q-resultados"></span> Resultados</h2></div>');
				echo('<div class="h2-error hidden col-12 p-b-55"><h2>Se requiere al menos 3 caracteres</h2></div>');
			}
			echo('<div id="row-results"  class="row">');
			echo('</div>');
		}
		
		?>
		
		
		
		
	</div>

</body>
	<script src="<?=$rootDir.'/nuevo/vendor/jquery/jquery-3.2.1.min.js'?>"></script>	
	<script src="<?=$rootDir.'/nuevo/vendor/animsition/js/animsition.min.js'?>"></script>
	<script src="<?=$rootDir.'/nuevo/vendor/bootstrap/js/popper.js'?>"></script>
	<script src="<?=$rootDir.'/nuevo/vendor/bootstrap/js/bootstrap.min.js'?>"></script>
	<script src="<?=$rootDir.'/nuevo/vendor/toastr/js/toastr.min.js'?>"></script>
	<script src="<?=$searcherDir.'/js/searcher.js'?>"></script>
</html>