<?php include('session_start.php'); 
	require_once("models/nota.php");
	require_once("models/menu.php");
	require_once("models/submenu.php");
	require_once("models/publi.php");
	$nta = new Nota();
	$mnu = new Menu();
	$submnu = new Submenu();
	$publ = new Publi();
?>
<!DOCTYPE html>
  <html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">      
	 <link type="text/css" href="<?=$rootDir.'/css/graph.css'?>" rel="stylesheet">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="<?=$rootDir.'/css/materialize.css'?>" media="screen,projection"/> 
	  <link type="text/css" href="<?=$rootDir.'/css/materialdesignicons.min.css'?>" rel="stylesheet">
      <link type="text/css" href="<?=$rootDir.'/css/styles.css'?>" rel="stylesheet">
	  <link type="text/css" href="<?=$rootDir.'/css/media.css'?>" rel="stylesheet">
	  <link type="text/css" href="<?=$rootDir.'/css/image.css?v=18'?>" rel="stylesheet">
	  <script src='https://www.google.com/recaptcha/api.js'></script>	  
	  
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	  <title>Proyecto Geo</title>
    </head>

    <body>
	<?php include_once("analyticstracking.php") ?>
			
	<header id="header-client">		
	
		<input type="hidden" id="header_id" value='<?= !empty($id) ? $id:''?>'>
		<input type="hidden" id="header_nombre" value='<?= !empty($nombre) ? $nombre: ''?>'>
		<input type="hidden" id="header_apellido" value='<?= !empty($apellido) ? $apellido: ''?>'>
		<input type="hidden" id="header_tipo" value='<?= !empty($tipo) ? $tipo: ''?>'>
		<input type="hidden" id="header_email" value='<?= !empty($email) ? $email: '' ?>'>
		
		
		<input type="hidden" id="header_nombreTwt" value='<?= !empty($_SESSION['request_vars']['screen_name']) ? $_SESSION['request_vars']['screen_name']: ''?>'>
		<input type="hidden" id="header_emailTwt" value='<?= !empty($_SESSION['request_vars']['user_id']) ? $_SESSION['request_vars']['user_id']: ''?>'>		
		<input type="hidden" id="header_picTwt" value='<?= !empty($_SESSION['imgTwt']) ? $_SESSION['imgTwt']: ''?>'>
	
		
		
	<!--nav -->
	
	
	<div class="navbar-fixed">
	
	<nav id="nav-ppal" >
		
			
			<div class="nav-wrapper">
				
				
			
                <a href="/index.php#" class="brand-logo brand-logo-lat hide-on-med-and-up"><img id ="img-logoo1" src="<?=$rootDir.'/img/logoo1.png'?>" alt="logo"></a>
				
				<a data-activates="nav-mobile" class="button-collapse"><i id="mnu-collapse" class="material-icons">menu</i></a>

				
				
				
				<ul class="left left-nav hide-on-small-only" id="ul-mnu">
					<!-- * template menu --->
					<li id="mnu-contacto" class="scroll"><a><i class="material-icons">email</i></a></li>
					
					<li>
					    <a id="toggle-search" href="">
					    <i class="large mdi-action-search"></i>
					    </a>
					</li>
					<li>
					<a id="btn-login-nav" class="right btn-floating btn orange darken-4 modal-trigger"  style="right: 0px; top: 0px; position: absolute; <?= !empty($id) ? 'display:none;':'' ?>" href="#modal-login">
							<i class="material-icons">account_box</i>
						</a>
					</li>
					<li>
						<div id="btn-account-nav" class="right chip chip-account" style="<?= empty($id) ? 'display:none;':'' ?>">
							<img src="<?php if (empty($belong)) { echo($rootDir.'/img/account-grey.jpg');} else{ echo($rootDir.'/files/usr/'.$id.'/avatar.jpg'); }?>" alt="logo">
							<span><?= !empty($nombre) ? $nombre: ''?></span>
						</div>
					</li>
				</ul>
				
				
				<ul class="left left-nav hide-on-med-and-up" id="ul-mnu-mobile">
					<!-- * template menu mobile --->
					<li> 
					<a id="btn-login-nav-mobile" class="right btn-floating btn orange darken-4 modal-trigger"  style="right: 15px; top: 8px; position: absolute; <?= !empty($id) ? 'display:none;':'' ?>" href="#modal-login">
							<i class="material-icons">account_box</i>
						</a>
					</li>
					<li>
						<div id="btn-account-nav-mobile" class="right chip chip-account" style="<?= empty($id) ? 'display:none;':'' ?>">
							<img src="<?php if (empty($belong)) { echo($rootDir.'/img/account-grey.jpg');} else{ echo($rootDir.'/files/usr/'.$id.'/avatar.jpg'); }?>" alt="logo">
							<span><?= !empty($nombre) ? $nombre: ''?></span>
						</div>
					</li>
				</ul>
				
				
				
        
				<!-- **** SIDE-NAV -->
				<ul id="nav-mobile" class="side-nav" style="width: 240px;">
					<li class="logo"><a id="logo-container" href="/index.php" class="brand-logo">
						<object id="front-page-logo" type="image/png" data="<?=$rootDir.'/img/minilogo.png'?>">minilogo</object></a></li>
					<li class="search">
					  <div class="search-wrapper card">
						<input id="search"><i class="material-icons">search</i>
						<div class="search-results"></div>
					  </div>
					</li>					
					<li class="no-padding">
					  <ul class="collapsible collapsible-accordion" id="ul-side-menu">
						
                          
					  </ul>
					</li>					
					<li class="bold"><a class="modal-trigger" href="#modal-contact" class="waves-effect waves-teal">Contacto</a></li>
					
				</ul>
			</div>
		
	</nav>
	
	</div>
	

	
	
		<div id="search" class="row white-text grey darken-3"  style="margin-top:35px">

			<div class="container">
				<form method="post" action="<?=$rootDir.'/searcher/'?>">
					<input name="searchQuery" class="form-control" type="text" placeholder="Buscar ..." name="q"/>
				</form>
			</div>
	
        </div>
        
       
		<div class="container container-tit hide-on-small-only">
			<div class="row">			
				 
				  
                <div class="col s12 m6">
					<a href="<?=$rootDir.'/index.php'?>" class="brand-logo hide-on-small-only"><img src="<?=$rootDir.'/img/logo1_ori.png'?>" alt="logo"></a>
				</div>
				<div class="col m6">
					<a href = "http://alsolnet.com/stream/radiogeo" class="brand-logo hide-on-small-only radio-online"><img src="<?=$rootDir.'/img/logo2_ori.png'?>" alt="logo"></a>
				</div>
				<div class="container-2">
					 <div class="row">
						 <div class="col s12" >
							<!-- <i class="material-icons">close</i>-->
							<div class="row">
								<div class="col s6 " style="text-align:right">
									<!-- <span class="flow-text-2">Leemos y escuchamos todos tus mensajes </span>-->
								</div>
								<div class="col s5" style="text-align:left">
									<!-- <img src="<?=$rootDir.'/img/whatsapp-icon3.png'?>" style="height:32px; width:32px; margin-top:2px" alt="whatsapp-icon">-->
									<!-- <span  class="flow-text">(11) 2296-9000</span>-->
								</div>
								
								
							</div>
						</div>
		
						 
					</div>
					  
				</div>
			</div>
		</div>
		
        
		<!-- Modal Structure -->
	
		<div id="modal-login" class="modal modal-fixed-footer contact-form">
			<div class="modal-content">
				<span><i class="modal-close material-icons right">close</i></span>
				<div class="row">
					<!-- start-form -->
					<form class="col s12" name="login_form" id="login_form">
						<div class="row row-login-tit">
							<div class="input-field col s12">								
								<h4 class="flow-text center">INGRESA A PROYECTO GEO</h4>
  
								<div class="divider" style="margin-bottom: 15px;"></div>
							</div>   
							<div class="input-field col m6 hide-on-small-only">
								<h6 class="center flow-text">ENTRAR CON</h6>
							</div>
							
							<div class="input-field col m6 costado-0 hide-on-small-only">
								<h6 class="center flow-text">USUARIOS REGISTRADOS</h6>
							</div>
							
						</div>
						<div class="row">  
							<div class="input-field col s12 hide-on-med-and-up">
									<!--<div class="divider" style="margin-bottom: 30px;">-->
									<h6 class="center flow-text">ENTRAR CON</h6>
							</div>
							<div class="input-field col s12 m6 hide-on-med-and-up" style="margin-top: 0px;">
								<div class="row"> 
									<div class="input-field col s12">                                                                         
										<a class="waves-effect waves-light btn-large btn-face"><i class="mdi mdi-facebook"></i>Facebook </a>                                
										<a class="waves-effect waves-light btn-large btn-twt"><i class="mdi mdi-twitter"></i>Twitter </a>
										<a id="btn-gp-id1" class="waves-effect waves-light btn-large btn-gp"><i class="mdi mdi-google-plus"></i>Google+ </a>
									</div>
								</div>
							</div>
							<div class="input-field col s12 m6 hide-on-small-only">
								<div class="row"> 
									<div class="input-field col s12">                                                                         
										<a class="waves-effect waves-light btn-large btn-face"><i class="mdi mdi-facebook"></i>Facebook </a>                                
										<a  class="waves-effect waves-light btn-large btn-twt"><i class="mdi mdi-twitter"></i>Twitter </a>
										<a id="btn-gp-id2" class="waves-effect waves-light btn-large btn-gp"><i class="mdi mdi-google-plus"></i>Google+ </a>
									</div>
								</div>
							</div>
							
							<div class="input-field col s12 m6 col-top-0">
								<div class="row">
									<div class="input-field col s12 costado-0 hide-on-med-and-up">
										<h6 class="center flow-text">USUARIOS REGISTRADOS</h6>
									</div>
									<div class="input-field col s12">
										<i class="material-icons prefix">email</i>
										<input id="emaillogmodal" type="email" class="validate">
										<label for="emaillogmodal" data-error="mal" data-success="ok">Email</label>
									</div>
									<div class="input-field col s12">
										<i class="material-icons prefix">https</i>
										<input id="passlogmodal" type="password" class="validate">
										<label for="passlogmodal" >Password</label>
									</div>
									<div class="input-field col s12 " id="recordar-pad">                            	
										<input type="checkbox" id="recordar-pass"/>
										<label for="recordar-pass">
										<input type="checkbox" name="checkbox" checked><i></i>Recordar contraseña</label>
									</div>
									<br><br>
									                                   	
									<div class="input-field col s12">                                										
										<div style="padding: 0;" class="waves-effect waves-green btn-large btn100 waves-input-wrapper">
											<input style="width: 100%; height: 100%;" name="action" value="Ingresar" type="submit"/>
										</div>
									</div>
									<div id="error-login" class="input-field col s12" style="margin-top:0">             
										<p style="color:red"></p>	   			  
									</div>
									
									<div class="input-field col s12" id="olvidaste">
										<a class="waves-effect waves-light btn btn-flat btn-salmon btn12">olvidaste tu contraseña?</a>
									</div>
									
									
									
									
								</div>
							</div>
							
							
						</div>
						<div class="row">                             
							<div class="input-field col s12">
								<div class="divider"></div>
								<h6 class="flow-text center">Todavia no estas registrado?</h6>
							</div>
							<div class="input-field col s12 center">
								<a href="#modal-register" class="waves-effect waves-light btn modal-trigger">REGISTRATE</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	 
		<!-- Modal Structure -->	 
		  <div id="modal-register" class="modal bottom-sheet">
			<div class="modal-content">
				<span><i class="modal-close material-icons right">close</i></span>
			   <div class="row">
				<form id="frm-register" class="col s12">					
				  <div class="row">
					<div class="input-field col s12"> 						
                        <h4 class="flow-text center">FORMULARIO DE REGISTRACION</h4>                      
						<div class="divider"></div>
                    </div>
								
					<div class="input-field col s12 m6">
					  <i class="material-icons prefix">account_circle</i>
					  <input name="apellido" id="apellido" type="text" class="validate">
					  <label for="apellido">Apellido</label>
					</div>
					<div class="input-field col s12 m6">
					  <i class="material-icons prefix">account_circle</i>
					  <input name="nombre" id="nombre" type="text" class="validate">
					  <label for="nombre">Nombre</label>
					</div>
					<div class="input-field col s12 m6">
					  <i class="material-icons prefix">email</i>
					  <input name="email" id="emailmodal" type="email" class="validate">
					  <label for="emailmodal" data-error="mal" data-success="ok">Email</label>
					</div>
					<div class="input-field col s12 m6">
					  <i class="material-icons prefix">vpn_key</i>
					  <input name="passw" id="passmodal" type="password" class="validate">
					  <label for="passmodal">Contraseña</label>
					</div>
					<div class="input-field col s12 m6">
					  <i class="material-icons prefix">phone</i>
					  <input name="telefono" id="telefono" type="tel" class="validate">
					  <label for="telefono">Telefono</label>
					</div>
					
					<div class="input-field col s12 m6">
						  <i class="material-icons prefix">today</i>					
						  <input name="fechanac" type="date" class="datepicker" id="nacimiento">	
						  <label for="nacimiento">Fecha de Nacimiento</label>						  
					</div>
					
					<div class="input-field col s12" style="padding-left: 6px;">						
						  <input name="deseo" type="checkbox" id="recibir" value="1"/>
						  <label for="recibir">Deseo recibir noticias por mail</label>						
					</div>
					
					
				  </div>
				  
				</form>
			  </div>
			</div>
			<div class="modal-footer">
			  <a id="btn-register" class=" modal-action modal-close waves-effect waves-green btn">Confirmar</a>
			</div>
		  </div>
		  
		  
		  <!-- Modal Structure -->	
		
		  <div id="modal-contact" class="modal contact-form">
			
		  
			<div class="modal-content">
			   <span><i class="modal-close material-icons right">close</i></span>
			   <div class="row">
				<form class="col s12">
				  <div class="row">
					<div class="input-field col s12"> 
						<h4 class="flow-text center">FORMULARIO DE CONTACTO</h4>                      
						<div class="divider"></div>
					</div>
					<div class="input-field col s12 m6">
					  <i class="material-icons prefix">account_circle</i>
					  <input id="contact_apellido" type="text" class="validate">
					  <label for="contact_apellido">Apellido</label>
					</div>
					<div class="input-field col s12 m6">
					  <i class="material-icons prefix">account_circle</i>
					  <input id="contact_nombre" type="text" class="validate">
					  <label for="contact_nombre">Nombre</label>
					</div>
					<div class="input-field col s12 m6">
					  <i class="material-icons prefix">phone</i>
					  <input id="contact_telefono" type="tel" class="validate">
					  <label for="contact_telefono">Telefono</label>
					</div>
					<div class="input-field col s12 m6">
					  <i class="material-icons prefix">email</i>
					  <input id="contact_email" type="email" class="validate">
					  <label for="contact_email" data-error="mal" data-success="ok">Email</label>
					</div>
					<div class="input-field col s12">
					  <i class="material-icons prefix">mode_edit</i>
					  <textarea id="contact_comments" class="materialize-textarea"></textarea>
					  <label for="contact_comments" >Comentario</label>
					</div>				
					
				  </div>
				  
				</form>
			  </div>
			</div>
			<div class="modal-footer">
			  <a class=" modal-action modal-close waves-effect waves-green btn">Enviar</a>
			</div>
		  </div>
	
        
		  <!-- Modal Structure -->	
		
		  <div id="modal-contact-sualf" class="modal contact-form">
			
		  
			<div class="modal-content">
			   <span><i class="modal-close material-icons right">close</i></span>
			   <div class="row">
				<form id="form-sualf" class="col s12">
				  <div class="row">
					<div class="input-field col s12"> 
						<h4 class="flow-text center">Alfano & Suarez</h4>                      
						<h4 class="flow-text2 center">Website Design and Development Solution</h4>                      
						<div style="margin-bottom:15px;" class="divider"></div>
					</div>
					
					<div class="input-field col s12 m6">
					  <i style="text-align: center;" class="material-icons prefix">account_circle</i>
					  <input name="nombre" id="contact_nombre_sualf" type="text" class="validate input-fixed">
					  <label for="contact_nombre_sualf" >Nombre</label>
					</div>
					
					<div class="input-field col s12 m6">
					  <i style="text-align: center;" class="material-icons prefix">email</i>
					  <input name="email" id="contact_email_sualf" type="email" class="validate input-fixed">
					  <label for="contact_email_sualf" >Email</label>
					</div>
					<div class="input-field col s12 m12">
					  <i style="text-align: center;" class="material-icons prefix">mode_edit</i>
					   <textarea name="comments" id="contact_comments_sualf" type="printable" class="validate materialize-textarea textarea-fixed"></textarea>
					  <label for="contact_comments_sualf">Comentario</label>
					</div>				
					<div class="input-field col s12 m12 " style="padding-right:18px;">
						<div style="float:right" id="g-recaptcha" class="g-recaptcha" data-callback='prepareRecaptcha' data-sitekey="6LfIVAoUAAAAAKjjv99wFp181huASDIbxGSfJEtF"></div>						
					</div>
					<div class="input-field col s12 m12 hidden error-recaptcha" style="margin:0;" ><p style="color:red;padding-right:18px;float:right;" id="p-error-recaptcha">Verifica que sos humano</p></div>
				  </div>
				  
				</form>
			  </div>
			</div>
			<div class="modal-footer">
			  <a id="enviar-mail-sualf" class="waves-effect waves-green btn">Enviar</a>
			</div>
		  </div>
	
        
       
		  <!-- Modal Structure -->	
		
		  <div id="modal-account" class="modal contact-form" style="width:80%; height:80%">			
			
			<div class="modal-content">
			   <span><i class="modal-close material-icons right">close</i></span>
		   
				<div class="row">
					<div class="input-field col s12"> 
						<h4 id="h4-name-account" class="flow-text center"></h4>                      
						<div class="divider"></div>
					</div>
				
				
					<div class="col s12 m6">
						<div class="card-panel btn-card grey lighten-5 z-depth-1" id="btn-config">
							<div class="row valign-wrapper" style="margin-bottom:0">
								<div class="col s4">
									<img src="<?=$rootDir.'/img/psd/config.png'?>" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
								</div>
								<div class="col s8">
									<span class="header flow-text">
										Configuracion
									</span>
								</div>
							</div>							
						</div>			
					</div>
					<div class="col s12 m6">
						<div class="card-panel btn-card grey lighten-5 z-depth-1" id="btn-mails">
							<div class="row valign-wrapper" style="margin-bottom:0">
								<div class="col s4">
									<img src="<?=$rootDir.'/img/psd/mails.png'?>" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
								</div>
								<div class="col s8">
									<span class="header flow-text">
										Mensajes
									</span>
								</div>
							</div>							
						</div>			
					</div>
					<div class="col s12 m6">
						<div class="card-panel btn-card grey lighten-5 z-depth-1" id="btn-statics">
							<div class="row valign-wrapper" style="margin-bottom:0">
								<div class="col s4">
									<img src="<?=$rootDir.'/img/psd/statics.png'?>" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
								</div>
								<div class="col s8">
									<span class="header flow-text">
										Estadisticas
									</span>
								</div>
							</div>							
						</div>			
					</div>
 
					<div id="container-admin" class="col s12 m6  <?php if(empty($tipo) || $tipo=='user') :?> hidden <?php endif;?>">				
						<div class="card-panel btn-card grey lighten-5 z-depth-1 modal-action modal-close" id="btn-admin">
							<div class="row valign-wrapper" style="margin-bottom:0">
								<div class="col s4">
									<img src="<?=$rootDir.'/img/psd/apps.png'?>" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
								</div>
								<div class="col s8">
									<span class="header flow-text">
										Administrar
									</span>
								</div>
							</div>							
						</div>			
					</div>
					
					<div class="col s12 m6">
						<div class="card-panel btn-card grey lighten-5 z-depth-1" id="btn-logout">
							<div class="row valign-wrapper" style="margin-bottom:0">
								<div class="col s4">
									<img src="<?=$rootDir.'/img/psd/logout.png'?>" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
								</div>
								<div class="col s8">
									<span class="header flow-text">
										Cerrar Sesion
									</span>
								</div>
							</div>							
						</div>			
					</div>
					
				</div>
			 
			</div>
			<!--<div class="modal-footer">
			  <a class=" modal-action modal-close waves-effect waves-green btn">Cerrar</a>
			</div>-->
		</div>
	
        <!-- Modal Structure -->
  <div id="modalWhatsapp" class="modal bottom-sheet" >
    

     
	  <img width="100%" src="<?=$rootDir.'/img/whatsapp2.jpg'?>">
	 
   
   
  </div>
  
 
 <!-- Modal Structure -->
  <div id="modalPopup" class="modal modal-fixed-footer" style="width: 50% !important ; max-height: 80% !important ;overflow-y: hidden !important ;">
		<div class="modal-content" style=" overflow-y: hidden !important ; padding:0px !important;">
		</div>
		<div class="modal-footer" style="padding:6px;text-align:center">						
			<p></p>
		</div>
		<a style="position:absolute; absolute;top: 5px;right: 5px;"class="waves-effect waves-light btn disabled">Omitir en 4</a>
  </div>
        
  
     
</header>
		
		<div class="row" style="margin:0">
			<div class="col s12" style="max-height:100px; text-align:center; display: inline-table;">								
					<div class="row" style="margin:0; max-height: 100% !important ;overflow-y: hidden !important ;">
						<div class="col s12" id="col-header-publi" style="overflow-y: hidden !important ; padding:0px !important;">
							<?php 
								$headerPublis = $publ->getHeaderPubli();
								$qPublis = sizeof($headerPublis);
								if ($qPublis>0){			
									$indiceRandom = rand(0,$qPublis-1);				
									$strPath = $rootDir.'/'.$headerPublis[$indiceRandom]["pathFoto"].'/'.$headerPublis[$indiceRandom]["id"].'/'.$headerPublis[$indiceRandom]["filenameFoto"];
														
									$html  = '<object width="100%" data="';
									$html .= $strPath.'"';
									$html .= ' style="height: 100%; min-height: 150px; max-height: 2000px;">';
									$html .= ' <param name="wmode" value="transparent"></object>';	
										
									echo($html);
								}
							?>
						</div>
					</div>
			</div>
		</div>
		
	