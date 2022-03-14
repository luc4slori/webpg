<?php require_once('header.php');
	
 
 ?>


        <main>
 
        <div class="container-ppal" id="tabppal">           
		
			<div class="row" id="row-ppal-index">				
				<div class="col s12 m6 l3 col-izq" id="col-izq">
					<div class="row lo-ultimo">
						<div class="col s12 m12 l12">
							<h1 class="flow-text header header-izq center" style="color: white;">LO ÚLTIMO</h1>
						</div>
					</div>
					
					
					
					
					
				
					
					<?php
						$loUltimo = $nta->getLoUltimo();
						foreach ($loUltimo as $nota){
							echo('<div class="row loultimo" id="loultimo-'.$nota["id"].'" style="padding-top: 0px;">');
								if ($nota["fechavisible"]){
									echo('<div style="position: relative; left:10px; top:5px;"><p class="label label-primary"</p>'.$nota["fechaNotaUser"].'</p><p></p></div>');
								}else{
									echo('<div style="position: relative; left:10px; top:5px;"><p class="label label-primary"</p><p></p></div>');
								}
								echo(' 
								<div class="col s12 m12 center">
									<h5 class="flow-text header tit-lo-ultimo-2" style="color: #9E0C0C;font-family: monospace; margin-top:0px">'.$nota["titulo"].'</h5>
								</div>
								<div class="col s12 m12 center ">');
									if ($nota["filenameFoto"]){
										echo('<img src="'.$rootDir.'/'.$nota["pathFoto"].'/'.$nota["id"].'/'.$nota["filenameFoto"].'" alt="" class="circle2px responsive-img center" style="max-height=400px">');
									} else {
										echo('<img src="'.$rootDir.'/'.$nota["pathFoto"].'/'.$nota["id"].'" alt="" class="circle2px responsive-img center hidden" style="max-height=400px">');
									}
									
								echo('	
								</div>
								<div class="col s12 m12 " style="padding-top: 10px; padding-bottom:10px;">
									<h6>'.$nota["subtitulo"].'</h6>
								</div>');	
								
								if ($nota["twitter"] && $nota["twitter_enhome"]){
									$twitter_cards = ($nota["twitter_cards"] == 1) ? "visible" : "hidden";
									$twitter_conversation = ($nota["twitter_conversation"] == 1) ? "all" : "none";
									echo('<div class="col s12 m12 " style="padding-top: 10px; padding-bottom:10px;">
										<blockquote class="twitter-tweet" 
											data-lang="es"
											data-conversation = "'.$twitter_conversation.'"
											data-cards = "'.$twitter_cards.'"
										>
											<a href="https://twitter.com/x/status/'.$nota["twitter_status"].'"></a>
										</blockquote>
									</div>');
								}
								
							echo('</div>');
						}
					?>					
				</div>
		
				<div class="col s12 m6 l7" style="padding:0" id="col-medio-index">
					
					<div class="row hide-on-med-and-down">
						<div class="col col-slider s12 m12 l12">
							<div class="slider ">
								<ul class="slides">
									<?php
									$cars = $nta->getCarruselAmi();
									
									
									foreach($cars as $car){
										
										echo(' <li><a href="'.$rootDir.'/'.$car["tituloMenu_ami"].'.$car["tituloSubmenu_ami"].'.$car["id"].'-'.$car["titulo_ami"].'">
											<img src="'.$rootDir.'/'.$car["pathFoto"].'/'.$car["id"].'/'.$car["filenameFoto"].'" alt=""> 
										
										<div class="caption left-align">
										  <h3>'.$car["titulo"].'</h3>
										  <h5 class="light grey-text text-lighten-5">'.$car["subtitulo"].'</h5>
										</div>
										</a>
										</li>');  
									}
									?>
								</ul>
							</div> <!--fin slider-->
						</div> <!-- fin col-->
					</div> <!-- fin row-->
					
					
					<?php
					 $qmenu = 0;
					 $menus = $mnu->getAll();					 
					foreach($menus as $menu){
						//sacar '.$menu["titulo"].'
						echo('<div class="row" id="menu'.$menu["titulo"].'-oldnotas">');
						$offset = ($qmenu*2) + 16;
						$notasOld = $nta->getOldNotas($offset);
						foreach($notasOld as $nota){
							echo('<div class="col s12 m12 l6">
								<div class="row oldnotas" style="box-shadow: 0 27px 24px 0 rgba(0, 0, 0, 0.2), 0 40px 77px 0 rgba(0, 0, 0, 0.22);background-color: #C6D8E7;padding-top: 4px; margin-top:20px;">');
									if($nota["fechavisible"]){
										echo('<div style="position: relative; left:10px; top:5px;"><p class="label label-primary">'.$nota["fechaNotaUser"].'</p><p></p></div>');
									}else{
										echo('<div style="position: relative; left:10px; top:5px;"><p class="label label-primary"></p><p></p></div>');
									}
									
									echo('<div class="col s12 m12 center">
										<h5 class="flow-text header tit-lo-ultimo-2" style="color: #9E0C0C;font-family: monospace; margin-top:0px">'.$nota["titulo"].'</h5>
									</div>
									<div class="col s12 m12 center ">');
										if($nota["filenameFoto"]){
											echo('<img src="'.$rootDir.'/'.$nota["pathFoto"].'/'.$nota["id"].'/'.$nota["filenameFoto"].'" alt="" class="circle2px responsive-img center" style="max-height=400px; box-shadow: 0 27px 24px 0 rgba(0, 0, 0, 0.2), 0 40px 77px 0 rgba(0, 0, 0, 0.22);">');
										}else{
											echo('<img src="'.$rootDir.'/'.$nota["pathFoto"].'/'.$nota["id"].'" alt="" class="circle2px responsive-img center hidden" style="max-height=400px">');
										}
										
									echo('</div>
									<div class="col s12 m12 " style="padding-top: 10px; padding-bottom:10px;">
										<h6>'.$nota["subtitulo"].'</h6>
									</div>');	
									
									if ($nota["twitter"] && $nota["twitter_enhome"]){
										$twitter_cards = ($nota["twitter_cards"] == 1) ? "visible" : "hidden";
										$twitter_conversation = ($nota["twitter_conversation"] == 1) ? "all" : "none";
										echo('<div class="col s12 m12 " style="padding-top: 10px; padding-bottom:10px;">
											<blockquote class="twitter-tweet" 
												data-lang="es"
												data-conversation = "'.$twitter_conversation.'"
												data-cards = "'.$twitter_cards.'"
											>
												<a href="https://twitter.com/x/status/'.$nota["twitter_status"].'"></a>
											</blockquote>
										</div>');
									}
								echo('</div>	
								
							</div>');
						}
						echo('</div>');
							echo('<div style="background: url('."'".$rootDir."/".$menu['pathFoto']."/".$menu['id']."/".$menu['filenameFoto']."')".' no-repeat;
								background-size: cover;"'.' class="container-cards" id="menu'.$qmenu.'">');
							/*
							<style scoped>
								#menu{{@index}}:before {
								background: url('/{{pathFoto}}/{{id}}/{{filenameFoto}}') no-repeat;
								background-size: cover;
								}							
							</style>
							*/
							echo('<div class="row row-cards" id="menu'.$menu["id"].'-submenus">
								<div class="col s12 m12 l12 row-cards-titulo">
									<h2 class="flow-text header header-card">'.$menu["titulo"].'<a href="'.$menu["id"].'-'.$menu["titulo_ami"].'"><h6>Ver mas</h6></a></h2>
								</div> <!-- fin col-->');
								$submenus = $submnu->getPortadaByMenu($menu["id"]);
								foreach($submenus as $submenu){
									//'.$submenu["pathFoto"].'
									echo('<div class="col s12 m6 l4 hide-on-small-only">
										<div class="card">
											<div class="card-image waves-effect waves-block waves-light">
												<img class="activator" src="'.$rootDir.'/'.$submenu["pathFoto"].'/'.$submenu["id"].'/'.$submenu["filenameFoto"].'">
											</div>
											<div class="card-content">
												<span class="card-title activator grey-text text-darken-4">'.$submenu["titulo"].'</span>
												<p><a href="'.$rootDir.'/'.$submenu["tituloMenu_ami"].'/'.$submenu["id"].'-'.$submenu["titulo_ami"].'">Entrar</a><i class="activator material-icons right">more_vert</i></p>
											</div>
											<div class="card-reveal">      
												<span class="right card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
												<span class="card-title grey-text text-darken-4">'.$submenu["titulo"].'</span>
												<p>'.$submenu["descripcion"].'</p>
												<p><a href="'.$rootDir.'/'.$submenu["tituloMenu_ami"].'/'.$submenu["id"].'-'.$submenu["titulo_ami"].'">Entrar</a></p>
											</div>
										</div>
									</div> <!-- fin col-->');
								}
							echo('</div>
						</div>
						
						
						<!--v4-->
						<div class="row hide-on-med-and-down" id="menu'.$menu["id"].'-publiv2" style="margin-bottom:0px">');
							$publisV2 = $publ->getPubliv2Index($offset);
							foreach ($publisV2 as $publi){
								$href = $publi['href'];
								$onmousedown="window.location.href= '".$href."'";
								echo('
								<div class="col s6" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 27px 24px 0px, rgba(0, 0, 0, 0.219608) 0px 40px 77px 0px; padding-top: 4px; margin-top: 20px; cursor: pointer; ">
									<div class="vergini vergino" onmousedown="'.$onmousedown.'">	
									   <object width="100%" style="padding-bottom:10px;height:100%;min-height:180px;" class=""  data="'.$rootDir.'/'.$publi["pathFoto"].'/'.$publi["id"].'/'.$publi["filenameFoto"].'">
											<param name="wmode" value="transparent" />			
									   </object>  
									</div>
								</div>
								');
							}
						echo('</div>
						
						
						<div class="row" id="menu'.$menu["id"].'-publi">');
							$publisMedio = $publ->getAll($menu["id"]);
							foreach ($publisMedio as $publi){
								echo('<div class="row hide-on-med-and-up row-publi">
									<div class="col s12 m12">																							
										<a href="'.$publi["href"].'" class="radio-online"><object data="'.$rootDir.'/'.$publi["pathFoto"].'/'.$publi["id"].'/'.$publi["filenameFoto"].'" style="width:100%" alt="" class="responsive-img"></object></a>
									</div>						
								</div>');
							}
						echo('</div>');
						$qmenu++;
					}
					?>

				</div>		
		
				<!-- ***** PUBLICIDAD ***** -->
				<?php require('rightcol.php')?>
				 
			</div> <!-- fin row-del-container-ppal-->
		
		
            
		</div> <!-- fin container-ppal-->
	</main>
	<script async defer src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?=$rootDir.'/js/jquery-2.1.3.min.js?v=20200916'?>"></script>
	 <!-- <script type="text/javascript" src="js/prism.js?v=20200916"></script> -->
	  
	  <!--lunr.js is a simple full text search engine for your client side applications. 
	  It is designed to be small, yet full featured, enabling you to provide 
	  a great search experience without the need for external, server side, search services.-->	  
	  <script type="text/javascript" src="<?=$rootDir.'/js/lunr.min.js?v=20200916'?>"></script>	  
	  <script type="text/javascript" src="<?=$rootDir.'/js/search.js?v=20200916'?>"></script> 
	  
	  
	  <script type="text/javascript" src="<?=$rootDir.'/js/materialize.js?v=20200916'?>"></script> 
	
	 <script src="<?=$rootDir.'/js/handlebars-v3.0.3.js?v=20200916'?>"></script>
	 
	
	 <script src="<?=$rootDir.'/js/index-fill.js?v=20200916'?>"></script>
	 
       
	   <?php require('footer.php')?>