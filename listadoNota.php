<?php @session_start(); 
require("utils/common.php");

    if((!isset($_SESSION['tipo'])) || ($_SESSION['tipo']!="admin" )){     
		redirect("404.html");
		exit();
    }

      require("header-partial.php");   
      require("models/nota.php");
 ?>
 <main>

  <nav class="nav-admin">
    <div class="nav-wrapper" style="width:100%">      
	<a href="#!" class="brand-logo  hide-on-large-only">Admin</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down ul-admin-ppal">
		
		<li class="active-li notas-li" ><a href="#">NOTAS</a></li>
		<li class="menus-li" ><a href="#">MENUS</a></li>
		<li class="submenus-li" ><a href="#">SUBMENUS</a></li>	
      </ul>
      <ul class="side-nav" id="mobile-demo">
		<li class="logo logo-admin">
			<a id="logo-container-admin" href="index.php" class="brand-logo">
			<object id="front-page-logo" type="image/png" data="img/minilogo.png">minilogo</object></a>
		</li>
		<li class="active-li notas-li" ><a href="#">NOTAS</a></li>
		<li class="menus-li" ><a href="#">MENUS</a></li>
		<li class="submenus-li" ><a href="#">SUBMENUS</a></li>
      </ul>
    </div>
  </nav>
          
	<div class="container-admin" id="tabppal" ng-app="testMod" >
			<div class="super-tabs-notas"  >
				<ul class="tabs tabs-notas" >
					<li class="tab col s3 visible notas-tab"><a  class="active" href="#listado">Listado</a></li>
					<li class="tab col s3 visible  notas-tab"><a href="#nueva-nota">Nueva Nota</a></li>
					<li class="tab col s3 visible notas-tab"><a href="#carrusel">Carrusel</a></li>
					<!--<li class="tab col s3 hidden"><a href="#editar-nota">Editar Nota</a></li>-->			
				</ul>
				<!--************* NOTAS ****************** -->
				
				<div id="listado" class="col s12"  style="margin-top:50px;">
				
				<div class="row row-listado">
			  
					<div class="input-field col s6">
							
					
						 <select class="select-menu" id="select-menu">
										
						</select>
						<label>Menu</label>
					 </div>
					 
					 <div class="input-field col s6">
							
						 <select  class="select-notas-submenu" id="select-submenu">
							 
						</select>
						<label>Submenu</label>
					 </div>
					 
					<div class="col s12">			
						
					<table id="listado-notas" class="table responsive-table centered bordered">
					  <thead>
					    <tr>
					      <th class="hidden">#</th>
						  <th>Fecha</th>
					      <th>Titulo</th>
					     <!-- <th>SubTitulo</th>
					      <th>Descripcion</th> -->
							  <th class="th-image">Imagen</th>
							  <th class="th-button">Opcion</th>
							  <th class="th-button">Opcion</th>
					    </tr>
					  </thead>
					  <tbody>               
					  </tbody>
					</table>

				    </div>   <!-- fin-class="col s12" -->                 

				</div>  <!-- fin-row-listado -->
			
			</div> <!-- fin-"id=listado" -->

				<div id="nueva-nota" class="col s12"  style="margin-top:50px;" >
				 
				<div class="row nueva-nota">    

				    <div class="col s12 section-body" >


					<form class="form-horizontal" id="form-nota-nueva" method="post" enctype="multipart/form-data">
					    <!-- *********************** header-nueva ******************** -->
						<div class="row">
							<div class="input-field col s3">	
							
								 <select class="select-menu" id="select-menu-nueva">
												
								</select>
								<label>Menu</label>
							 </div>
							 
							 <div class="input-field col s3">
									
								 <select  class="select-notas-submenu" id="select-submenu-nueva">
									 
								</select>
								<label>Submenu</label>
							 </div>
				
							  <div class="input-field col s3">
								
								 <select class="select-estado" id="select-estado-item-nueva">
									 
								</select>
								<label>Estado</label>
							 </div>
							
							 <div class="col s3">				
						 <label>Vistas</label>
						<p class="range-field">
						    <input type="range" id="input-vistas-nueva" min="0" max="10000" value=""/>
						 </p>														 
						<div class="number-input">
						  <button id ="btn-minus-nueva"></button>
						  <input id="inputtext-vistas-nueva" class="quantity" min="0" max="10000" name="quantity" value="1" type="number">
						  <button id ="btn-add-nueva" class="plus"></button>
						</div>
					 </div>
						
						</div>
						<div class="row row-para-completar" style="background-color: rgb(246, 243, 245);">
							<!-- *********************** titulo-nueva ******************** -->
							<div class="input-field col s12 has-feedback">            
								<textarea name="titulo-nueva" class="materialize-textarea" id="titulo-nueva"></textarea>
								<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
								<span class="help-block"></span>
								<label for="titulo-nueva">Titulo de la Nota</label>
							</div>
						    
							<!-- *********************** subtitulo-nueva ******************** -->
							<div class="input-field col s12 has-feedback">         
								<textarea name="subtitulo-nueva" class="materialize-textarea" id="subtitulo-nueva"></textarea>
								<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
								<span class="help-block"></span>
								<label class="control-label col-sm-3" for="subtitulo-nueva">SubTitulo de la Nota</label>
							</div>
						  
							<!-- *********************** descripcion-nueva ******************** -->
							<div class="input-field col s12 has-feedback">         
							      <textarea name="descripcion-nueva" class="materialize-textarea" id="descripcion-nueva"></textarea>
							      <span id="descripcion_error_icon-nueva" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
							      <span id="helpBlockDescripcion" class="help-block"></span>
							      <label for="descripcion-nueva">Descripción</label>
							 </div>
							 
							<!-- *********************** fuente-nueva ******************** -->
							 <div class="input-field col s12 has-feedback">         
							      <textarea name="autor-nueva" class="materialize-textarea" id="autor-nueva"></textarea>
							      <span id="autor_error_icon-nueva" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
							      <span id="helpBlockAutorNueva" class="help-block"></span>
							      <label for="autor-nueva">Fuente</label>
							 </div>
							 
							<!-- *********************** imagen-nueva ******************** --> 
							 <div class="input-field col s12">		
								<!-- <div class="divider" style="margin-top:30px;"></div> -->
								<input name="chk-imagen-nueva" type="checkbox" id="chk-imagen-nueva" value="0"/>
								<label for="chk-imagen-nueva">Quiero agregar una imagen</label>						
							</div>
										<!-- ********** imagen-local-nueva ********* --> 
							 <div class="input-field col s12 imagen-fila hidden">										 
								<p>
									<input class="with-gap" name="chkImagenNueva" type="radio" id="chk-local-nueva" checked="true"/>
									 <label for="chk-local-nueva">Local</label>
								</p>
							
							</div>
							
							 <div class= "col s12 col-local-nueva imagen-fila hidden"> 
								<div class="row">
									<div class="col s6 m6 l6">
										<div class="row">
											<div class="col s12 file-field input-field">
												<div class="btn565">
													<span></span>
													<input name="btnSeleccionar-nueva" id="btnSeleccionar-nueva"  type="file"  value="" />
												</div>
												<div class="file-path-wrapper hidden">
													<input id="file-path-nueva" class="file-path validate" type="text">
												</div>
											</div>
											<div class="col s12">
												<div class="switch">
													<label>
													Off
													<input type="checkbox" id="quiero-foto-nueva">
													<span class="lever"></span>
													On
													</label>
												</div>
											</div>										
											
										</div>
									</div>
									<div class="col s6 m6 l6 input-field" style="margin-top:0">
									      <input id="filenameFoto-nueva" name="filenameFoto-nueva" type="hidden" class="validate" value="">   
										<img id="fotoForm-nueva" class="materialboxed pull-left" width="120"  src="img/sinimagen.jpg">
										<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
										<span class="help-block"></span>						
									</div>
								</div>
							</div>
										<!-- ********** imagen-baul-nueva ********* -->
							 <div class="input-field col s12 imagen-fila hidden">								
								<p>
								  <input class="with-gap" name="chkImagenNueva" type="radio" id="chk-baul-nueva"  />
								  <label for="chk-baul-nueva">Baul</label>
								</p>	
										
							</div>
							
							<div class="col s12 col-baul-nueva hidden">
								<div class="fixed-action-btn" style="bottom: 80px; right: 12px;">
								    <a class="btn-floating btn-large red" id="btn-cerrar-gallery">
								      <i class="large material-icons">close</i>
								    </a>		    
								</div>
								
								<div class="row">
									<div class="col s6 m6 l6 options-gallery" style="padding-left:40px">
										
										<p>
											  <input class="with-gap" name="chkBaulNueva" type="radio" id="chk-baul-submenu-nueva" checked="true" />
											  <label for="chk-baul-submenu-nueva">Mismo submenu</label>
										</p>
										<p>
											<input class="with-gap" name="chkBaulNueva" type="radio" id="chk-baul-menu-nueva" />
											 <label for="chk-baul-menu-nueva">Mismo menu</label>
										</p>
										
										<p>
											  <input class="with-gap" name="chkBaulNueva" type="radio" id="chk-baul-todas-nueva"  />
											  <label for="chk-baul-todas-nueva">Todas</label>
										</p>
									</div>
									<div class="col s6 m6 l6 input-field">
									     <input id="filenameFoto-nueva-from-gallery" name="filenameFoto-nueva-from-gallery" type="hidden" class="validate" value="">   
										<img id="fotoForm-nueva-from-gallery" class="materialboxed pull-left" width="120"  src="img/sinimagen.jpg">
										<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
										<span class="help-block"></span>						
									</div>
									
									<div class="col s12 demo-gallery" id="demo-nueva">
										<ul id="lightgallery" class="list-unstyled row">
										</ul>
									</div> 
								</div>
							</div>
							
							<!-- ********** imagenpor-nueva ********* -->	
							<div class="col s12 imagen-fila hidden"> 
								<div class="row" style="margin-top:40px;">
									<div class="input-field col s12 has-feedback"> 								
										<textarea name="imagenpor-nueva" class="materialize-textarea" id="imagenpor-nueva"></textarea>														  
										<span id="imagenpor_error_icon-nueva" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
										<span id="helpBlockImagenporNueva" class="help-block"></span>
										<label for="imagenpor-nueva">Imagen Por</label>
									</div>											
								</div>	
							</div>
							<!-- *********************** tweet-nueva ******************** -->
							
							<div class="input-field col s12">		
								<div class="divider" style="margin-top:30px;margin-bottom:20px;"></div>
								<input name="chk-tweet-nueva" type="checkbox" id="chk-tweet-nueva" value="0"/>
								<label for="chk-tweet-nueva">Quiero agregar tweet</label>						
							</div>
							
							
							<div class="col s12 tweet-fila hidden" style="margin-top:10px">
								<div class="row">
									<div class="col s12 m6 l6">
										<div class="row" style="margin-bottom:50px">
											<div class="input-field col s12 has-feedback"> 
												<textarea name="tweet-status-nueva" class="materialize-textarea" id="tweet-status-nueva"></textarea>														  
												<span id="video_error_icon-nueva" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
												<span id="helpBlockTweetNueva" class="help-block"></span>
												<label for="tweet-status-nueva">STATUS</label>
											</div>											
										
											<div class="col s6">
												<div class="input-field" style="margin-top:0">
													<input name="chk-tweetennota-nueva" type="checkbox" checked id="chk-tweetennota-nueva" value="1"/>
													<label for="chk-tweetennota-nueva">En Nota</label>						
												</div>
												<div class="input-field">														
													<input name="chk-tweetenhome-nueva" type="checkbox" id="chk-tweetenhome-nueva" value="0"/>
													<label for="chk-tweetenhome-nueva">En Home</label>						
												</div>
											</div>
											<div class="col s6">											
												<div class="input-field" style="margin-top:0">
													<input name="chk-tweetconversation-nueva" type="checkbox" id="chk-tweetconversation-nueva" value="0"/>
													<label for="chk-tweetconversation-nueva">Conversacion</label>						
												</div>											
												<div class="input-field">														
													<input name="chk-tweetcards-nueva" type="checkbox" id="chk-tweetcards-nueva" value="0"/>
													<label for="chk-tweetcards-nueva">Mostrar Foto/Video</label>						
												</div>
											</div>
										</div>
										
										<div class="row" style="margin-bottom:0">
											<div class="col s12">
												<a id="btn-probar-tweet-nueva" class="waves-effect waves-light btn">Probar</a>
											</div>
										</div>
									</div>
									<div class="col s12 m6 l6">														
										<div id ="tweetDIVnueva" class="hidden">
											
										</div>   
									</div>
								</div>
							</div>
							<!-- *********************** video-nueva ******************** -->
							
							<div class="input-field col s12">		
								<div class="divider" style="margin-top:30px;margin-bottom:20px;"></div>
								<input name="chk-video-nueva" type="checkbox" id="chk-video-nueva" value="0"/>
								<label for="chk-video-nueva">Quiero agregar video de youtube</label>						
							</div>
							
							
							<div class="col s12 video-fila hidden" style="margin-top:10px">
								<div class="row">
									<div class="col s12 m3 l6">
										<div class="row">
											<div class="input-field col s12 has-feedback"> 
												<textarea name="video-nueva" class="materialize-textarea" id="video-nueva"></textarea>														  
												<span id="video_error_icon-nueva" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
												<span id="helpBlockVideoNueva" class="help-block"></span>
												<label for="video-nueva">ID</label>
											</div>
											<div class="col s12">
												<a id="btn-probar-video-nueva" class="waves-effect waves-light btn">Probar</a>
											</div>
										</div>
									</div>
									<div class="col s12 m9 l6">														
										<div class="codegena codegena-nueva hidden">
											<iframe id="src-youtube-nueva" width='426' height='251' src="" frameborder="0">
											</iframe>
										</div>   
									</div>
								</div>
							</div>
							<!-- *********************** fecha-nueva ******************** -->
								<div class="input-field col s12">
									<div class="divider" style="margin-top:30px;"></div>
									<p>
									  <input class="with-gap" name="chkFecha" type="radio" id="chkDefaultFecha" checked="true"/>
									  <label for="chkDefaultFecha">Fecha Actual</label>
									</p>
									<p>
									  <input class="with-gap" name="chkFecha" type="radio" id="chkCustomFecha"  />
									  <label for="chkCustomFecha">Otra Fecha</label>
									</p>
								</div>
								
								<div id="clearfix-nueva-nota" class="col s12 inner clearfix hidden" style="margin-top:30px;">
									<section id="main-content" ng-controller="testCtrl">
										<time-date-picker id="datetime-nueva-nota" ng-model="date" autosave="true"  display-twentyfour="true" data-display-mode="full" orientation="{{vertmode}}" class="modal-content"></time-date-picker>									
									</section>      
								</div>
							
							<!-- *********************** quiero-carrusel-nueva ******************** -->
							<div class="input-field col s12">		
										<div class="divider" style="margin-top:30px; margin-bottom:20px;"></div>
										<input name="chk-carrusel" type="checkbox" id="chk-carrusel" value="0"/>
										<label for="chk-carrusel">Quiero esta nota en el carrusel</label>						
							</div>
							
							<!-- *********************** quiero-word-nueva ******************** -->
							<div class="input-field col s12" id="fila-chk-word">		
								<div class="divider" style="margin-top:30px; margin-bottom:20px;"></div>
								<input name="chk-word" type="checkbox" id="chk-word" value="0"/>
								<label for="chk-word">Quiero esta nota version Word</label>						
							</div>
							
							<!-- *********************** submit-nueva ******************** -->
							<div class="col s12 center" style="margin-top:30px;">
								<input type="submit" class="btn" name="action" value="Guardar"/>
							</div>
						 </div> <!--fin-row-->
						
					</form>

				    </div>   <!--fin-col s12 section-body-->                  

				</div> <!-- fin- row nueva-nota -->
		 
		    
		    
		    </div> <!--fin id="nueva-nota" -->
		    
				<div id="carrusel" class="col s12"  style="margin-top:1px;">
				<div id="searchCarrusel" class="row" style="margin-bottom: 30px; background-color: rgba(22, 115, 206, 0.78);">
					<form id="frm-buscar-para-carrusel"  style="padding-left: 20px; padding-right: 20px;">
								
								 <div style="overflow: hidden; padding-right: .5em;">
									<input class="form-control" style="color: #FFF; font-size: 24px;"type="text" placeholder="Busca notas para agregar al carrusel" name="textnota"></input>							 							
								</div>
							</form>	
					<div class="col s12 container">				
							
							<p class="center" style="color: #900202;" id="p-resultado-carrusel"></p>
							<div id="resultado-busqueda-carrusel" class="hidden">						
								<table id="search-listado-carrusel" class="table responsive-table">
								  <thead>
								    <tr>
								      <th></th>
								      <th>Titulo</th>
								     <!-- <th>SubTitulo</th>
								      <th>Descripcion</th> -->
										   <th class="th-image">Imagen</th>
										<th class="th-button">Opcion</th>
																 
								    </tr>
								  </thead>
								  <tbody>               
								  </tbody>
								</table>
							</div>
							 
										
					</div>
				</div>
				
				<div class="fixed-action-btn" style="top: 200px; right: 24px;">
				    <a class="btn-floating btn-large red" id="btn-mas-carrusel">
				      <i class="large material-icons">add</i>
				    </a>		    
				</div>
			
				<div class="row row-slider" style="margin-top:30px;">
					<div class="col s12 center titulo--nohaycarrusel hidden">
						<h6 class="header flow-text" style="color:#F90046">No hay Imagenes en el Carrusel</h6>						
					</div>
					<div class="col s3 center titulo--haycarrusel hidden hide-on-small-only">
						<h6 class="header flow-text">Laminas Activas</h6>
							<div class="row">					
								<div class="col s12" id="col-car-img">
								
								</div>
							
							</div>						
					</div>
					<div class="col s12 m9 center">
						<h6 class="header flow-text  titulo--haycarrusel hidden">Vista Preliminar</h6>		
						<div class="slider">
								<ul class="slides">
														  
								</ul>
						</div> <!--fin slider-->
						
						
						<div class="row row-carrusel">
									 
							<div class="col s12">

							<input name="listado-chk-carrusel" id="chk-lis-123" type="checkbox" checked="true" value="0"/>	
							<table id="listado-carrusel" class="table responsive-table hidden">
							  <thead>
							    <tr>
							      <th></th>
							      <th>Titulo</th>
							     <!-- <th>SubTitulo</th>
							      <th>Descripcion</th> -->
									   <th class="th-image">Imagen</th>
							  <th class="th-button">Opcion</th>
													
							    </tr>
							  </thead>
							  <tbody>               
							  </tbody>
							</table>

						    </div>   <!-- fin-class="col s12" -->                 

						</div>  <!-- fin-row-carrusel -->
					</div>
					
					
					
									 
					
					
					
					
				</div>
				
				
				
				
			</div> <!--fin div id="carrusel"-->
			
		
			</div>
			<div class="super-tabs-menus"  >				
				<ul class="tabs tabs-menus"  style="margin-bottom:50px">
					<li class="tab col s3 menus-tab"><a href="#listado-menu">Listado</a></li>
					<li class="tab col s3 menus-tab"><a href="#nuevo-menu">Nuevo Menu</a></li>
					<li class="tab col s3 menus-tab"><a href="#publicidad">Publicidad</a></li>
					<!--<li class="tab col s3 hidden"><a href="#editar-menu">Editar Menu</a></li>-->
				</ul>
				<!--************* MENUS ****************** -->
				
		
				<div id="listado-menu" class="col s12">
		
		<div class="row row-listado">
	  			
			 
			<div class="col s12">			
				
			<table id="listado-menus" class="table responsive-table centered bordered">
			  <thead>
			    <tr>
			      <th>#</th>
			      <th>Titulo</th>
			     <!-- <th>SubTitulo</th>
			      <th>Descripcion</th> -->
					   <th class="th-image">Imagen</th>
							  <th class="th-button">Opcion</th>
							  <th class="th-button">Opcion</th>
			    </tr>
			  </thead>
			  <tbody>               
			  </tbody>
			</table>

		    </div>   <!-- fin-class="col s12" -->                 

		</div>  <!-- fin-row-listado -->
	
	</div> <!-- fin-"id=listado" -->

				<div id="nuevo-menu" class="col s12">
    		 
		<div class="row nuevo-menu">    

		    <div class="col s12 section-body">

			
			<form class="form-horizontal" id="form-menu-nuevo" method="post" enctype="multipart/form-data">
			    
				<div class="row">
					
		
					  <div class="input-field col s12">
						
						 <select class="select-estado" id="select-estado-item-nuevo-menu">
							 
						</select>
						<label>Estado</label>
					 </div>
					
					
				
				</div>
				<div class="row">
					<div class="input-field col s12 has-feedback">            
						<textarea name="titulo-nuevo-menu" class="materialize-textarea" id="titulo-nuevo-menu"></textarea>
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>
						<label for="titulo-nuevo-menu">Titulo del Menu</label>
					</div>				    
					
				  
				
					<div class="col s6 m6 l3">
						<div class="row">
							<div class="file-field input-field col s12">
								<div class="btn">
									<span>Imagen</span>
									<input name="btnSeleccionar-nuevo-menu" id="btnSeleccionar-nuevo-menu"  type="file"  value="" />
								</div>
								<div class="file-path-wrapper hidden">
									<input id="file-path-nuevo-menu" class="file-path validate" type="text">
								</div>
							</div>
							<div class="col s12">
								<div class="switch">
									<label>
									Off
									<input type="checkbox" id="quiero-foto-nuevo-menu">
									<span class="lever"></span>
									On
									</label>
								</div>
							</div>
							
							
							
						</div>
					</div>
			
					<div class="input-field col s6 m6 l9">
          				      <input id="filenameFoto-nuevo-menu" name="filenameFoto-nuevo-menu" type="hidden" class="validate" value="">   
						<img id="fotoForm-nuevo-menu" class="materialboxed pull-left" width="120"  src="img/sinimagen.jpg">
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>						
					</div>
			
				
					<hr>
				 </div> <!--fin-row-->
				<div class="row">
					<div class="col s12 center" style="margin-top:30px;">
						<input type="submit" class="btn" name="action" value="Guardar"/>
					</div>
				</div>
			</form>

		    </div>   <!--fin-col s12 section-body-->                  

		</div> <!-- fin- row nuevo-menu -->
 
    
    
    </div> <!--fin id="nuevo-menu" -->
    
	
				<div id="publicidad" class="col s12"  style="margin-top:1px;">
				
					<div class="row">									
						<div class = "col s6 m3 center pivote">
							<h6 class="header-600 flow-text tooltipped" data-position="top" data-delay="50" data-tooltip="Publicidades guardadas e inactivas">Repositorio</h6>
							<div class="row" id="listado-publicidad" style="background-color:rgba(228, 228, 228, 0.6); min-height:400px;">										
							</div>
						</div>
						<div class="col s6 m9 center">
							<div class="row">
								<div class="col s12 pivote">
									<h6 class="header-600 flow-text">Listado de Menus<span class="label label-primary lbl-derecha">ocultar</span></h6>								
									
									<div class="row row-listadov1 listado-en tohide"  id="listado-enMenus"  >		
									
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col s4 pivote">
									<div class="row" style="margin-bottom:0;">
										<div class="input-field col s12" style="margin-top:0px;">
											<h6 class="header-600 flow-text" style="margin-bottom:0px">PopUps<span class="label label-primary lbl-derecha">ocultar</span></h6>
										</div>
										<div class="input-field col s12 header-600 flow-text tohide" style ="margin-top: 0px;margin-bottom: 0px;">
											<select style="text-align:right; " id="select-delay-popup">										  
											  <option selected value="1">cada 1 min</option>
											  <option value="5">cada 5 min</option>
											  <option value="10">cada 10 min</option>
											  <option value="15">cada 15 min</option>
											  <option value="30">cada 30 min</option>
											  <option value="60">cada 1 hora</option>
											  <option value="120">cada 2 horas</option>
											  <option value="180">cada 3 horas</option>
											  <option value="360">cada 6 horas</option>
											  <option value="720">cada 12 horas</option>
											  <option value="1440">cada 24 horas</option>
											</select>											
										</div>
									</div>								
									<div class="row row-listadov2 listado-en tohide" id="listado-enPopup" style="background-color:rgba(228, 228, 228, 0.6); min-height:400px;">										
									</div>
								</div>
								<div class="col s4 pivote">
									<h6 class="header-600 flow-text">Headers<span class="label label-primary lbl-derecha">ocultar</span></h6>
									<div class="row row-listadov2 listado-en tohide" id="listado-enHeader" style="background-color:rgba(228, 228, 228, 0.6); min-height:400px;">										
									</div>
								</div>
								<div class="col s4 pivote">
									<h6 class="header-600 flow-text">Footers<span class="label label-primary lbl-derecha">ocultar</span></h6>
									<div class="row row-listadov2 listado-en tohide" id="listado-enFooter" style="background-color:rgba(228, 228, 228, 0.6); min-height:400px;">										
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col s4 pivote">
									<h6 class="header-600 flow-text">Index<span class="label label-primary lbl-derecha">ocultar</span></h6>
									<div class="row row-listadov2 listado-en tohide" id="listado-enIndex" style="background-color:rgba(228, 228, 228, 0.6); min-height:400px;">										
									</div>
								</div>
								<div class="col s4 pivote">
									<h6 class="header-600 flow-text">Notas<span class="label label-primary lbl-derecha">ocultar</span></h6>
									<div class="row row-listadov2 listado-en tohide" id="listado-enNota" style="background-color:rgba(228, 228, 228, 0.6); min-height:400px;">										
									</div>
								</div>
								<div class="col s4 pivote">
									<h6 class="header-600 flow-text">Derecha<span class="label label-primary lbl-derecha">ocultar</span></h6>
									<div class="row row-listadov2 listado-en tohide" id="listado-enDerecha" style="background-color:rgba(228, 228, 228, 0.6); min-height:400px;">										
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<div class="fixed-action-btn" style="bottom: 75px; right: 15px;">
								    <a class="btn-floating btn-large red" id="btn-mas-publi">
								      <i class="large material-icons">add</i>
								    </a>		    
								</div>
					
					
				</div> <!--fin div id="publicidad"-->
			
				
			</div>
			<div class="super-tabs-submenus">			
				<ul class="tabs tabs-submenus"  style="margin-bottom:50px">
					<li class="tab col s3 submenus-tab"><a href="#listado-submenu">Listado</a></li>
					<li class="tab col s3 submenus-tab"><a href="#nuevo-submenu">Nuevo Submenu</a></li>			
					<!--<li class="tab col s3 hidden"><a href="#editar-submenu">Editar Submenu</a></li>-->
				</ul>	
			
				<!--************* SUBMENUS ****************** -->
				
		
				<div id="listado-submenu" class="col s12">
		
		<div class="row row-listado">
	  
			<div class="input-field col s12">
					
			
				 <select class="select-submenu"  id="select-menu-submenu">
								
				</select>
				<label>Menu</label>
			 </div>
			 
			 
			 
			<div class="col s12">			
				
			<table id="listado-submenus" class="table responsive-table centered bordered">
			  <thead>
			    <tr>
			      <th>#</th>
			      <th>Titulo</th>
			     <!-- <th>SubTitulo</th>
			      <th>Descripcion</th> -->
					  <th class="th-image">Imagen</th>
							  <th class="th-button">Opcion</th>
							  <th class="th-button">Opcion</th>
			    </tr>
			  </thead>
			  <tbody>               
			  </tbody>
			</table>

		    </div>   <!-- fin-class="col s12" -->                 

		</div>  <!-- fin-row-listado -->
	
	</div> <!-- fin-"id=listado" -->

				<div id="nuevo-submenu" class="col s12">
    		 
		<div class="row nuevo-submenu">    

		    <div class="col s12 section-body">

		

			<form class="form-horizontal" id="form-submenu-nuevo" method="post" enctype="multipart/form-data">
			    
				<div class="row">
					<div class="input-field col s6">	
					
						 <select class="select-submenu"  id="select-menu-nuevo-submenu">
										
						</select>
						<label>Menu</label>
					 </div>
					 
					
		
					  <div class="input-field col s6">
						
						 <select class="select-estado" id="select-estado-item-nuevo-submenu">
							 
						</select>
						<label>Estado</label>
					 </div>
					
					
				
				</div>
				<div class="row">
					<div class="input-field col s12 has-feedback">            
						<textarea name="titulo-nuevo-submenu" class="materialize-textarea" id="titulo-nuevo-submenu"></textarea>
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>
						<label for="titulo-nuevo-submenu">Titulo del Submenu</label>
					</div>
				  
					<div class="input-field col s12 has-feedback">         
					      <textarea name="descripcion-nuevo-submenu" class="materialize-textarea" id="descripcion-nuevo-submenu"></textarea>
					      <span id="descripcion_error_icon-nuevo-submenu" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
					      <span id="helpBlockDescripcion-nuevo-submenu" class="help-block"></span>
					      <label for="descripcion-nuevo-submenu">Descripción</label>
					 </div>
					<div class="col s6 m6 l3">
						<div class="row">
							<div class="file-field input-field col s12">
								<div class="btn">
									<span>Imagen</span>
									<input name="btnSeleccionar-nuevo-submenu" id="btnSeleccionar-nuevo-submenu"  type="file"  value="" />
								</div>
								<div class="file-path-wrapper hidden">
									<input id="file-path-nuevo-submenu" class="file-path validate" type="text">
								</div>
							</div>
							<div class="col s12">
								<div class="switch">
									<label>
									Off
									<input type="checkbox" id="quiero-foto-nuevo-submenu">
									<span class="lever"></span>
									On
									</label>
								</div>
							</div>
							
							
							
						</div>
					</div>
					
					
					
					<div class="input-field col s6 m6 l9">
          				      <input id="filenameFoto-nuevo-submenu" name="filenameFoto-nuevo-submenu" type="hidden" class="validate" value="">   
						<img id="fotoForm-nuevo-submenu" class="materialboxed pull-left" width="120"  src="img/sinimagen.jpg">
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>						
					</div>
				
				
					<div class="input-field col s12">		
								<hr>
								<input name="chk-word-submenu" type="checkbox" id="chk-word-submenu" value="0"/>
								<label for="chk-word-submenu">Quiero habilitar version Word</label>						
							</div>
				
				<div class="input-field col s12">		
										<hr>
										<input name="portada" type="checkbox" id="chk-portada" value="0"/>
										<label for="chk-portada">Quiero esta tarjeta en la pagina principal</label>						
							</div>
							
				<div class="input-field col s12">		
										<hr>
										<input name="portada-edit" type="checkbox" id="chk-fecha-submenu" value="0"/>
										<label for="chk-fecha-submenu">Quiero mostrar fecha</label>						
							</div>
							<div class="input-field col s12">		
										<hr>
										<input name="portada-edit" type="checkbox" id="chk-visitas-submenu" value="0"/>
										<label for="chk-visitas-submenu">Quiero mostrar contador de visitas</label>						
							</div>
							
					
				 </div> <!--fin-row-->
				<div class="row">
					<div class="col s12 center" style="margin-top:30px;">
						<input type="submit" class="btn" name="action" value="Guardar"/>
					</div>
				</div>
			</form>

		    </div>   <!--fin-col s12 section-body-->                  

		</div> <!-- fin- row nuevo-submenu -->
 
    
    
    </div> <!--fin id="nuevo-submenu" -->
  
	
			</div>
	
	<!--****************** EDITAR NOTA**************************-->
		<div id="editar-nota" class="col s12 hidden edicion-abajo">
	
		
					
		<div class="row editar-nota">    
			<div class= "col s12" style ="margin-bottom:30px; margin-top:20px;">			
				<a class="btn-cancel-edit-nota">
					 <i class="material-icons back-icon alignleft">arrow_back</i>
				</a>		    				
						
				<h6 class="header flow-text titulo-editar aligncenter">
					Editar Nota
				</h6>
			</div>
			
		    <div class="col s12 section-body">

					

			<form class="form-horizontal" id="form-nota-edit" method="post" enctype="multipart/form-data">

			  
			  <input type="hidden" id="edit-id" name="id" value=""/>	  
			  
			    
				<div class="row">
					<div class="input-field col s3">	
					
						 <select class="select-menu" id="select-menu-edit">
										
						</select>
						<label>Menu</label>
					 </div>
					 
					 <div class="input-field col s3">
							
						 <select class="select-notas-submenu" id="select-submenu-edit">
							 
						</select>
						<label>Submenu</label>
					 </div>
					
					  <div class="input-field col s3">
						
						 <select class="select-estado" id="select-estado-item-edit">
							 
						</select>
						<label>Estado</label>
					 </div>
					
					 <div class="col s3">				
						 <label>Vistas</label>
						<p class="range-field">
						    <input type="range" id="input-vistas-edit" min="0" max="10000" value=""/>
						 </p>														 
						<div class="number-input">
						  <button id ="btn-minus-edit"></button>
						  <input id="inputtext-vistas-edit" class="quantity" min="0" max="10000" name="quantity" value="1" type="number">
						  <button id ="btn-add-edit" class="plus"></button>
						</div>
					 </div>
				
				</div>
				<div class="row">
					<!-- *********************** titulo-edit ******************** -->
					<div class="input-field col s12 has-feedback">            
						<textarea name="titulo-edit" class="materialize-textarea" id="titulo-edit"></textarea>
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>
						<label for="titulo-edit">Titulo de la Nota</label>
					</div>
				    
					<!-- *********************** subtitulo-edit ******************** -->
					<div class="input-field col s12 has-feedback">         
						<textarea name="subtitulo-edit" class="materialize-textarea" id="subtitulo-edit"></textarea>
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>
						<label class="control-label col-sm-3" for="subtitulo-edit">SubTitulo de la Nota</label>
					</div>
				  
					<!-- *********************** descripcion-edit ******************** -->
					<div class="input-field col s12">       
					      <textarea name="descripcion-edit" class="materialize-textarea" id="descripcion-edit"></textarea>
					      
					      <!--<span id="descripcion_error_icon-edit" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
					      <span id="helpBlockDescripcion-edit" class="help-block"></span>-->
					      <label for="descripcion-edit">Descripción</label>
					 </div>
					 
					 <!-- *********************** fuente-edit ******************** -->
					 <div class="input-field col s12">         
					      
					      <textarea name="autor-edit" class="materialize-textarea" id="autor-edit"></textarea>
					      
					      <!--<span id="descripcion_error_icon-edit" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
					      <span id="helpBlockDescripcion-edit" class="help-block"></span>-->
					      <label for="autor-edit">Fuente</label>
					 </div>
					
					<!-- *********************** imagen-edit ******************** -->
					<div class="input-field col s12">								
						<input name="chk-imagen-edit" type="checkbox" id="chk-imagen-edit" value="0"/>
						<label for="chk-imagen-edit">Quiero agregar una imagen</label>						
					</div>
							<!-- ******** imagen-local-edit ******** -->
					  <div class="input-field col s12 imagen-fila-edit hidden">								
						<p>
							<input class="with-gap" name="chkImagenEdit" type="radio" id="chk-local-edit" checked="true"/>
							 <label for="chk-local-edit">Local</label>
						</p>							
					</div>
				
					<div class= "col s12 col-local-edit imagen-fila-edit hidden"> 
						<div class="row">	
							<div class="col s6 m6 l3">
								<div class="row">
									<div class="file-field input-field col s12">
										<div class="btn565">
											<span></span>
											<input name="btnSeleccionar-edit" id="btnSeleccionar-edit" type="file"  value="" />
										</div>
										<div class="file-path-wrapper hidden">
											<input id="file-path-edit" class="file-path validate" type="text">
										</div>
									</div>
									<div class="col s12">
										<div class="switch">
											<label>
											Off
											<input type="checkbox" id="quiero-foto-edit">
											<span class="lever"></span>
											On
											</label>
										</div>
									</div>
								</div>
							</div>
											
							<div class="input-field col s6 m6 l9">					
								  <input id="filenameFoto-edit" name="filenameFoto-edit" type="hidden" class="form-control notic" value="">   					
								<img id="fotoForm-edit" class="materialboxed pull-left" width="120"  src="">
								<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				
					<!-- *********************** imagen-baul-edit ******************** -->
					<div class="input-field col s12 imagen-fila-edit hidden">						
						<p>
						  <input class="with-gap" name="chkImagenEdit" type="radio" id="chk-baul-edit"  />
						  <label for="chk-baul-edit">Baul</label>
						</p>								
					</div>
					
					<div class="col s12 col-baul-edit hidden">
						<div class="fixed-action-btn" style="bottom: 80px; right: 12px;">
							<a class="btn-floating btn-large red" id="btn-cerrar-gallery-edit">
							  <i class="large material-icons">close</i>
							</a>		    
						</div>
						
						<div class="row">
							<div class="col s6 m6 l3 options-gallery" style="padding-left:40px">
								
								<p>
									  <input class="with-gap" name="chkBaulEdit" type="radio" id="chk-baul-submenu-edit" checked="true" />
									  <label for="chk-baul-submenu-edit">Mismo submenu</label>
								</p>
								<p>
									<input class="with-gap" name="chkBaulEdit" type="radio" id="chk-baul-menu-edit" />
									 <label for="chk-baul-menu-edit">Mismo menu</label>
								</p>
								
								<p>
									  <input class="with-gap" name="chkBaulEdit" type="radio" id="chk-baul-todas-edit"  />
									  <label for="chk-baul-todas-edit">Todas</label>
								</p>
							</div>
							<div class="col s6 m6 l9 input-field">
								 <input id="filenameFoto-edit-from-gallery" name="filenameFoto-edit-from-gallery" type="hidden" class="validate" value="">   
								<img id="fotoForm-edit-from-gallery" class="materialboxed pull-left" width="120"  src="img/sinimagen.jpg">
								<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
								<span class="help-block"></span>						
							</div>
							
							<div class="col s12 demo-gallery" id="demo-edit">
								<ul id="lightgallery-edit" class="list-unstyled row">
								</ul>
							</div> 
						</div>
					</div>
					
				<!-- ********** imagenpor-edit ********* -->					
				<div class="col s12 imagen-fila-edit hidden"> 
					<div class="row" style="margin-top:40px;">
						<div class="input-field col s12 has-feedback"> 								
							<textarea name="imagenpor-edit" class="materialize-textarea" id="imagenpor-edit"></textarea>														  
							<span id="imagenpor_error_icon-edit" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
							<span id="helpBlockImagenporEdit" class="help-block"></span>
							<label for="imagenpor-edit">Imagen Por</label>
						</div>											
					</div>	
				</div>
				<!-- *********************** tweet-edit ******************** -->
							
				<div class="input-field col s12">		
					<div class="divider" style="margin-top:30px;margin-bottom:20px;"></div>
					<input name="chk-tweet-edit" type="checkbox" id="chk-tweet-edit" value="0"/>
					<label for="chk-tweet-edit">Quiero agregar tweet</label>						
				</div>
				
				
				<div class="col s12 tweet-fila-edit hidden" style="margin-top:10px">
					<div class="row">
						<div class="col s12 m6 l6">
							<div class="row" style="margin-bottom:50px">
								<div class="input-field col s12 has-feedback"> 
									<textarea name="tweet-status-edit" class="materialize-textarea" id="tweet-status-edit"></textarea>														  
									<span id="video_error_icon-edit" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
									<span id="helpBlockVideoEdit" class="help-block"></span>
									<label for="tweet-status-edit">STATUS</label>
								</div>											
							
								<div class="col s6">
									<div class="input-field" style="margin-top:0">
										<input name="chk-tweetennota-edit" type="checkbox" checked id="chk-tweetennota-edit" value="1"/>
										<label for="chk-tweetennota-edit">En Nota</label>						
									</div>
									<div class="input-field">														
										<input name="chk-tweetenhome-edit" type="checkbox" id="chk-tweetenhome-edit" value="0"/>
										<label for="chk-tweetenhome-edit">En Home</label>						
									</div>
								</div>
								<div class="col s6">											
									<div class="input-field" style="margin-top:0">
										<input name="chk-tweetconversation-edit" type="checkbox" id="chk-tweetconversation-edit" value="0"/>
										<label for="chk-tweetconversation-edit">Conversacion</label>						
									</div>											
									<div class="input-field">														
										<input name="chk-tweetcards-edit" type="checkbox" id="chk-tweetcards-edit" value="0"/>
										<label for="chk-tweetcards-edit">Mostrar Foto/Video</label>						
									</div>
								</div>
							</div>
							
							<div class="row" style="margin-bottom:0">
								<div class="col s12">
									<a id="btn-probar-tweet-edit" class="waves-effect waves-light btn">Probar</a>
								</div>
							</div>
						</div>
						<div class="col s12 m6 l6">														
							<div id ="tweetDIVedit" class="hidden">
								
							</div>   
						</div>
					</div>
				</div>
				<!-- *********************** video-edit ******************** -->
				
				<div class="input-field col s12">		
					<div class="divider" style="margin-top:30px;margin-bottom:20px;"></div>
					<input name="chk-video-edit" type="checkbox" id="chk-video-edit" value="0"/>
					<label for="chk-video-edit">Quiero agregar video de youtube</label>						
				</div>
				
				
				<div class="col s12 video-fila-edit hidden" style="margin-top:10px">
					<div class="row">
						<div class="col s12 m3 l6">
							<div class="row">
								<div class="input-field col s12 has-feedback"> 
									<textarea name="video-edit" class="materialize-textarea" id="video-edit"></textarea>														  
									<span id="video_error_icon-edit" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
									<span id="helpBlockVideoEdit" class="help-block"></span>
									<label for="video-edit">ID</label>
								</div>
								<div class="col s12">
									<a id="btn-probar-video-edit" class="waves-effect waves-light btn">Probar</a>
								</div>
							</div>
						</div>
						<div class="col s12 m9 l6">														
							<div class="codegena codegena-edit hidden">
								<iframe id="src-youtube-edit" width='426' height='251' src="" frameborder="0">
								</iframe>
							</div>   
						</div>
					</div>
				</div>
				
				<!-- *********************** fecha-edit ******************** -->
					
					
					
					
				<div class="col s12 inner clearfix" style="margin-top:30px;">
								<div class="divider" style="margin-bottom:30px;"></div>
								<section id="main-content2" ng-controller="testCtrl">														
									<time-date-picker id="datetime-edit-nota" ng-model="date" autosave="true"  display-twentyfour="true" data-display-mode="full" orientation="{{vertmode}}" class="modal-content"></time-date-picker>									
								</section>
      
				</div>
					
				<!-- *********************** quiero-carrusel-edit ******************** -->
				<div class="input-field col s12">		
					<div class="divider" style="margin-top:30px; margin-bottom:20px;"></div>			
					<input name="chk-carrusel-edit" type="checkbox" id="chk-carrusel-edit" value="0"/>
					<label for="chk-carrusel-edit">Quiero esta nota en el carrusel</label>						
				</div>
				
				<!-- *********************** quiero-word-edit ******************** -->
				<div class="input-field col s12" id="fila-chk-word-edit">		
							<div class="divider" style="margin-top:30px; margin-bottom:20px;"></div>
							<input name="chk-word-edit" type="checkbox" id="chk-word-edit" value="0"/>
							<label for="chk-word-edit">Quiero esta nota version Word</label>						
				</div>
					
				 </div> <!--fin-row-->
				<div class="row" style="margin-top:30px;">
					<div class="col s6">
						<button class="btn waves-effect waves-light right btn-cancel-edit-nota" type="text" name="cancel">Cancelar<i class="material-icons left">arrow_back</i>
						</button>
					</div>
					<div class="col s6">
						<button class="btn waves-effect waves-light" type="submit" name="action">Enviar<i class="material-icons right">arrow_forward</i>
						</button>
					</div>
				</div>
			</form>

		    </div>   <!--fin-col s12 section-body-->                  

		</div> <!-- fin- row edit-nota -->
 
    
    
    </div> <!--fin id="edit-nota" -->
	
	<!--****************** EDITAR MENU**************************-->
	
		<div id="editar-menu" class="col s12 hidden edicion-abajo">
					
	
		<div class="row editar-menu">    
			
			<div class= "col s12" style ="margin-bottom:30px; margin-top:20px;">			
				<a class="btn-cancel-edit-menu">
					 <i class="material-icons back-icon alignleft">arrow_back</i>
				</a>		    				
						
				<h6 class="header flow-text titulo-editar aligncenter">
					Editar Menu
				</h6>
			</div>
			
		    <div class="col s12 section-body">

						

			<form class="form-horizontal" id="form-menu-edit" method="post" enctype="multipart/form-data">

			  
			  <input type="hidden" id="edit-id-menu" name="edit-id-menu" value=""/>	  
			  
			    
				<div class="row">
					
					
					  <div class="input-field col s12">
						
						 <select class="select-estado" id="select-estado-item-edit-menu">
							 
						</select>
						<label>Estado</label>
					 </div>
					
					 
				
				</div>
				<div class="row">
					<div class="input-field col s12 has-feedback">            
						<textarea name="titulo-edit-menu" class="materialize-textarea" id="titulo-edit-menu"></textarea>
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>
						<label for="titulo-edit-menu">Titulo del Menu</label>
					</div>
				  
					<div class="col s6 m6 l3">
						<div class="row">
							<div class="file-field input-field col s12">
								<div class="btn">
									<span>Imagen</span>
									<input name="btnSeleccionar-edit-menu" id="btnSeleccionar-edit-menu" type="file"  value="" />
								</div>
								<div class="file-path-wrapper hidden">
									<input id="file-path-edit-menu" class="file-path validate" type="text">
								</div>
							</div>
							<div class="col s12">
								<div class="switch">
									<label>
									Off
									<input type="checkbox" id="quiero-foto-edit-menu">
									<span class="lever"></span>
									On
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="input-field col s6 m6 l9">					
					      <input id="filenameFoto-edit-menu" name="filenameFoto-edit-menu" type="hidden" class="form-control notic" value="">   					
						<img id="fotoForm-edit-menu" class="materialboxed pull-left" width="120"  src="">
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>
					</div>
					
					
					
				 </div> <!--fin-row-->
				<div class="row margin-top:30px;">
					<div class="col s6">
						<button class="btn waves-effect waves-light right btn-cancel-edit-menu" type="text" name="cancel">Cancelar<i class="material-icons left">arrow_back</i>
						</button>
					</div>
					<div class="col s6">
						<button class="btn waves-effect waves-light" type="submit" name="action">Enviar<i class="material-icons right">arrow_forward</i>
						</button>
					</div>
				</div>
			</form>

		    </div>   <!--fin-col s12 section-body-->                  

		</div> <!-- fin- row editar-menu -->
 
    
    
    </div> <!--fin id="editar-menu" -->
	
	<!--****************** EDITAR SUBMENU**************************-->
	
				<div id="editar-submenu" class="col s12 hidden edicion-abajo">
	
				
		<div class="row editar-submenu">    

			<div class= "col s12" style ="margin-bottom:30px; margin-top:20px;">			
				<a class="btn-cancel-edit-submenu">
					 <i class="material-icons back-icon alignleft">arrow_back</i>
				</a>		    				
						
				<h6 class="header flow-text titulo-editar aligncenter">
					Editar Submenu
				</h6>
			</div>
			
		    <div class="col s12 section-body">

						

			<form class="form-horizontal" id="form-submenu-edit" method="post" enctype="multipart/form-data">

			  
			  <input type="hidden" id="edit-id-submenu" name="edit-id-submenu" value=""/>	  
			  
			    
				<div class="row">
					<div class="input-field col s6">	
					
						 <select  class="select-submenu"  id="select-menu-edit-submenu">
										
						</select>
						<label>Menu</label>
					 </div>
					 
					 
					
					  <div class="input-field col s6">
						
						 <select class="select-estado" id="select-estado-item-edit-submenu">
							 
						</select>
						<label>Estado</label>
					 </div>
					
					
				
				</div>
				<div class="row">
					<div class="input-field col s12 has-feedback">            
						<textarea name="titulo-edit-submenu" class="materialize-textarea" id="titulo-edit-submenu"></textarea>
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>
						<label for="titulo-edit-submenu">Titulo del Submenu</label>
					</div>
				    
				
				  
					<div class="input-field col s12">         
					      
					      <textarea name="descripcion-edit-submenu" class="materialize-textarea" id="descripcion-edit-submenu"></textarea>
					      
					      <!--<span id="descripcion_error_icon-edit" class="hide glyphicon glyphicon-remove form-control-feedback"></span>
					      <span id="helpBlockDescripcion-edit" class="help-block"></span>-->
					      <label for="descripcion-edit-submenu">Descripción</label>
					 </div>

					<div class="col s6 m6 l3">
						<div class="row">
							<div class="file-field input-field col s12">
								<div class="btn">
									<span>Imagen</span>
									<input name="btnSeleccionar-edit-submenu" id="btnSeleccionar-edit-submenu" type="file"  value="" />
								</div>
								<div class="file-path-wrapper hidden">
									<input id="file-path-edit-submenu" class="file-path validate" type="text">
								</div>
							</div>
							<div class="col s12">
								<div class="switch">
									<label>
									Off
									<input type="checkbox" id="quiero-foto-edit-submenu">
									<span class="lever"></span>
									On
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="input-field col s6 m6 l9">					
					      <input id="filenameFoto-edit-submenu" name="filenameFoto-edit-submenu" type="hidden" class="form-control notic" value="">   					
						<img id="fotoForm-edit-submenu" class="materialboxed pull-left" width="120"  src="">
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>
					</div>
					
					<div class="input-field col s12">		
								<hr>
								<input name="chk-word-submenu-edit" type="checkbox" id="chk-word-submenu-edit" value="0"/>
								<label for="chk-word-submenu-edit">Quiero habilitar version Word</label>						
							</div>
					
					<div class="input-field col s12">		
										<hr>
										<input name="portada-edit" type="checkbox" id="chk-portada-edit" value="0"/>
										<label for="chk-portada-edit">Quiero esta tarjeta en la pagina principal</label>						
							</div>
							<div class="input-field col s12">		
										<hr>
										<input name="portada-edit" type="checkbox" id="chk-fecha-submenu-edit" value="0"/>
										<label for="chk-fecha-submenu-edit">Quiero mostrar fecha</label>						
							</div>
							<div class="input-field col s12">		
										<hr>
										<input name="portada-edit" type="checkbox" id="chk-visitas-submenu-edit" value="0"/>
										<label for="chk-visitas-submenu-edit">Quiero mostrar contador de visitas</label>						
							</div>
							
					
				 </div> <!--fin-row-->
				<div class="row margin-top:30px;">
					<div class="col s6">
						<button class="btn waves-effect waves-light right btn-cancel-edit-submenu" type="text" name="cancel">Cancelar<i class="material-icons left">arrow_back</i>
						</button>
					</div>
					<div class="col s6">
						<button class="btn waves-effect waves-light" type="submit" name="action">Enviar<i class="material-icons right">arrow_forward</i>
						</button>
					</div>
				</div>
			</form>

		    </div>   <!--fin-col s12 section-body-->                  

		</div> <!-- fin- row editar-submenu -->
 
    
    
    </div> <!--fin id="editar-submenu" -->
	<!--*************** FIN - edicion **************************-->
	
	</div> <!--container  admin -->

<!-- Modal Structure -->
  <div id="modalEliminarPubli" class="modal">
    <div class="modal-content center">
	<span><a><i id="close-eliminar-publi" class="right material-icons right" style="color: black;">close</i></a></span>
      <h4 class="center">Eliminar Publicidad</h4>
	  <input name ="id-eliminar-publi" id="id-eliminar-publi" type="hidden" value="">	  
      <p></p>
	  <div>
	  <object class="materialboxedd center" data=""></object>
	  </div>
    </div>
    <div class="modal-footer">
      <a class="waves-effect waves-light btn" id="confirmar-eliminar-publi">Confirmar</a>
	   
    </div>
  </div>

<!-- Modal Structure -->
  <div id="modalNuevaPubli" class="modal">
    <div class="modal-content center">
	<span><a><i id="close-nueva-publi" class="right material-icons right" style="color: black;">close</i></a></span>
      <h4 class="center">Nueva Publicidad</h4>	  	  
       <div class="row">
		<form class="col s12" id="form-publi-nueva">			
			<input name ="id-nueva-publi-menu" id="id-nueva-publi-menu" type="hidden" value="">
			<div class="row">				
				<div class="input-field col s12">				  
				  <input id="http_nueva_publi" type="text" class="validate valid" value="http://">
				  <label for="http_nueva_publi">URL</label>
				</div>
				
				
				<div class="file-field input-field col s3">
					<div class="btn">
						<span>Imagen</span>
						<input name="btnSeleccionar-nueva-publi" id="btnSeleccionar-nueva-publi"  type="file"  value="" />
					</div>
					<div class="file-path-wrapper hidden">
						<input id="file-path-nueva-publi" class="file-path validate" type="text">
					</div>
				</div>
				<div class="input-field col s9">					
					    <input id="filenameFoto-nueva-publi" name="filenameFoto-nueva-publi" type="hidden" class="form-control notic" value="">   											
						<object id="fotoForm-nueva-publi" class="materialboxedd center" data="img/sinimagen.jpg">
						</object>
						<span class="hide glyphicon glyphicon-remove form-control-feedback"></span>
						<span class="help-block"></span>
				</div>
				
				<div class="col s12 center" style="margin-top:30px;">
					<input type="submit" class="btn" name="action" value="Guardar"/>
				</div>
			</div>
		</form>
	  </div>
	  
    </div>
    
  </div>    
  
  

<!-- Modal Structure -->
  <div id="modalEditarPubli" class="modal">
    <div class="modal-content center">
	<span><a><i id="close-editar-publi" class="right material-icons right" style="color: black;">close</i></a></span>
      <h4 class="center">Editar Publicidad</h4>	  	  
       <div class="row">
		<form class="col s12" id="form-publi-edit">
			<input name ="id-editar-publi" id="id-editar-publi" type="hidden" value="">
			<!--<input name ="id-editar-publi-menu" id="id-editar-publi-menu" type="hidden" value="">-->
			<input name ="lugarPubli-modal-edit" id="lugarPubli-modal-edit" type="hidden" value="">
			<div class="row">				
				<div class="input-field col s12">				  
				  <input id="http_editar_publi" type="text" class="validate valid">
				  <label for="http_editar_publi">URL</label>
				</div>
				
				
				<div class="file-field input-field col s3">
					<div class="btn">
						<span>Imagen</span>
						<input name="btnSeleccionar-edit-publi" id="btnSeleccionar-edit-publi"  type="file"  value="" />
					</div>
					<div class="file-path-wrapper hidden">
						<input id="file-path-edit-publi" class="file-path validate" type="text">
					</div>
				</div>
				<div class="input-field col s9">
						<div style="width:100%">
							<input id="filenameFoto-edit-publi" name="filenameFoto-edit-publi" type="hidden" class="form-control notic" value="">   					
							<object id="fotoForm-edit-publi" class="materialboxedd center"   data="">
							
							</object>
						</div>
				</div>
				
				
				
				<div class="col s12 center" style="margin-top:30px;">
					<input type="submit" class="btn" name="action" value="Guardar"/>
				</div>
			</div>
		</form>
	  </div>
	  
	
    </div>
    
  </div>  

<!-- Modal Structure -->
  <div id="modalEliminarMenu" class="modal">
    <div class="modal-content center">
	<span><a><i id="close-eliminar-menu" class="right material-icons right" style="color: black;">close</i></a></span>
      <h4 class="center">Eliminar Menu</h4>
	  <input name ="id-eliminar-menu" id="id-eliminar-menu" type="hidden" value="">	  
      <p></p>
	  <div>
	  <img width="300" src="">
	  </div>
    </div>
    <div class="modal-footer">
      <a class="waves-effect waves-light btn" id="confirmar-eliminar-menu">Confirmar</a>
	   
    </div>
  </div>
  
  <!-- Modal Structure -->
  <div id="modalEliminarSubmenu" class="modal">
    <div class="modal-content center">
	<span><a><i id="close-eliminar-submenu" class="right material-icons right" style="color: black;">close</i></a></span>
      <h4 class="center">Eliminar Submenu</h4>
	  <input name ="id-eliminar-submenu" id="id-eliminar-submenu" type="hidden" value="">	  
      <p></p>
	  <div>
	  <img width="200" src="">
	  </div>
    </div>
    <div class="modal-footer">
      <a class="waves-effect waves-light btn" id="confirmar-eliminar-submenu">Confirmar</a>
	   
    </div>
  </div>

  <!-- Modal Structure -->
  <div id="modalEliminar" class="modal">
    <div class="modal-content center">
	<span><a><i id="close-eliminar" class="right material-icons right" style="color: black;">close</i></a></span>
      <h4 class="center">Eliminar Nota</h4>
	  <input name ="id-eliminar" id="id-eliminar" type="hidden" value="">	  
      <p></p>
	  <div>
	  <img width="300" src="">
	  </div>
    </div>
    <div class="modal-footer">
      <a class="waves-effect waves-light btn" id="confirmar-eliminar">Confirmar</a>
	   
    </div>
  </div>
  
  <!-- Modal Structure -->
  <div id="modalConfirmarImagenBaul" class="modal">
    <div class="modal-content center">
	<span><a><i id="close-confirmar-imagen-baul" class="right material-icons right" style="color: black;">close</i></a></span>
      <h4 class="center">Imagen Seleccionada</h4>
	  <input name ="id-confirmar-imagen-baul" id="id-confirmar-imagen-baul" type="hidden" value="">	  
      <p></p>
	  <div>
	  <img width="300" src="">
	  </div>
    </div>
    <div class="modal-footer">
      <a class="waves-effect waves-light btn" id="btn-confirmar-imagen-baul">Confirmar</a>
	   
    </div>
  </div>
  
  <!-- Modal Structure -->
  <div id="modalConfirmarImagenBaulEdit" class="modal">
    <div class="modal-content center">
	<span><a><i id="close-confirmar-imagen-baul-edit" class="right material-icons right" style="color: black;">close</i></a></span>
      <h4 class="center">Imagen Seleccionada</h4>
	  <input name ="id-confirmar-imagen-baul-edit" id="id-confirmar-imagen-baul-edit" type="hidden" value="">	  
      <p></p>
	  <div>
	  <img width="300" src="">
	  </div>
    </div>
    <div class="modal-footer">
      <a class="waves-effect waves-light btn" id="btn-confirmar-imagen-baul-edit">Confirmar</a>
	   
    </div>
  </div>
  

		
		
</main>
<script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery-2.1.3.min.js?v=20200916"></script>
<script type="text/javascript" src="js/jquery-ui.min.js?v=20200916"></script>
 <script type="text/javascript" src="js/materialize.js?v=20200916"></script> 
  <script type="text/javascript" src="js/angular.min.js?v=20200916"></script>
  <script type="text/javascript" src="js/angular-locale_es-ar.js?v=20200916"></script>
  <script type="text/javascript" src="js/angular-animate.min.js?v=20200916"></script>
  <script type="text/javascript" src="js/angular-aria.min.js?v=20200916"></script>
  <script type="text/javascript" src="js/angular-material.min.js?v=20200916"></script>
  <script type="text/javascript" src="js/sc-date-time.js?v=20200916"></script>
  <script type="text/javascript" src="js/material-ng.js?v=20200916"></script>
 <script src="js/handlebars-v3.0.3.js?v=20200916"></script>
 <script src="gallery/dist/js/picturefill.min.js?v=20200916"></script>
<script src="gallery/dist/js/lightgallery.js?v=20200916"></script>
<script src="gallery/dist/js/lg-fullscreen.js?v=20200916"></script>
<script src="gallery/dist/js/lg-thumbnail.js?v=20200916"></script>
<script src="gallery/dist/js/lg-video.js?v=20200916"></script>
<script src="gallery/dist/js/lg-autoplay.js?v=20200916"></script>
<script src="gallery/dist/js/lg-zoom.js?v=20200916"></script>
<script src="gallery/dist/js/lg-hash.js?v=20200916"></script>
<script src="gallery/dist/js/lg-pager.js?v=20200916"></script>
<script src="gallery/lib/jquery.mousewheel.min.js?v=20200916"></script>
<script src="js/swfobject.js?v=20200916"></script>
 <script src="js/listado.js?v=20200916"></script>
	
<?php require("footer-admin.php"); ?>