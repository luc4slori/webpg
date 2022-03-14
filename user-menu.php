<?php
	require("header.php");
	require("utils/common.php");
    
	$publ = new Publi();
	
    $idMenu = isset($_GET["id"]) ? $_GET["id"] : null;
    $menu_get = isset($_GET["menu"]) ? $_GET["menu"] : null;
	
	if (empty($idMenu) || empty($menu_get)){
        redirect("/404.html");
			exit();
    }	
  
    $m = new Menu();
    if ($menu = $m->get($idMenu)){
		if ($menu["titulo_ami"]!=$menu_get){			
			redirect("/404.html");
			exit();		
		}
	
		if (!empty($menu["filenameFoto"])){
			$srcImagen = $rootDir."/".$menu["pathFoto"]."/".$idMenu."/".$menu["filenameFoto"];
		} else {
			$srcImagen = "";		
		}
	} else {
		redirect("/404.html");
			exit();
	}
    $submenu = array();    
    $s = new Submenu();
    $submenu = $s->getAll($idMenu);
    
?>
<main>

<div class="row user-menu">
		
		<div class="col l3 hide-on-med-and-down">
			 <div class="row">
				  <div class="col s12">
					<h2 class="flow-text header">Estas viendo</h2>
					<ul class="collection">
					  <li class="collection-item avatar">
						<img id="leyendo-src" src="<?= $srcImagen ?>" alt="" class="circle materialboxed hidden">
						<p id="leyendo-titulo" style="padding-right: 20px;" class="title"><?= $menu["titulo"]; ?></p>						
						<a style="cursor:auto" class="secondary-content"><i class="material-icons">send</i></a>
					  </li>                           
					</ul>
				   </div> <!-- fin col s12 -->
			</div> <!-- fin class="row" -->
			<div class="row">
				  <div class="col s12">
					<h2 class="flow-text header">Más</h2>
					<input type="hidden" id="menu_id_user_menu" name="menu_id" value='<?= $menu["id"]; ?>'>
					<ul class="collection" id="otros-menus-collection">
					  
					</ul>
				   </div> <!-- fin col s12 -->
		   </div> <!-- fin class="row" -->
	   </div> <!-- col l3 hide-on-med-and-down -->
		
		<div class="col s12 m10 l7" id="col-medio-u-m" style="background-color:rgb(251, 247, 243)";>
			<div class="row hidden" id="menus-user-menu">
			</div>
			<div class="row" style="margin-top:22px;">
				<div class="col s12">
					<h6 class="center header flow-text titulo-listado-tarjetas"></h6>
				</div>
				<div class="col s12" id="submenus-user-menu" style="margin-top: 6px;">					
				</div>
			</div>
		</div>
		
		
		<?php require('rightcol.php')?>
     
</div>     


</main>

<script src="<?=$rootDir.'/js/jquery-2.1.3.min.js'?>"></script>
<script src="<?=$rootDir.'/js/underscore.js'?>"></script>
<script type="text/javascript" src="<?=$rootDir.'/js/materialize.js'?>"></script> 
<script type="text/javascript" src="<?=$rootDir.'/js/handlebars-v3.0.3.js'?>"></script>
<script type="text/javascript" src="<?=$rootDir.'/js/user-menu-fill.js'?>"></script> 
<!--
<script src="assets/js/main.js"></script>
<script src="assets/js/comentarios.js"></script>
-->
<?php require("footer.php"); ?>