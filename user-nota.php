<?php
	require("header.php");   
	require("models/lectura.php");
	require("utils/common.php");
    
	$publ = new Publi();
	
    $idNota = isset($_GET["id"]) ? $_GET["id"] : null;
	$menu_get = isset($_GET["menu"]) ? $_GET["menu"] : null;
	$submenu_get = isset($_GET["submenu"]) ? $_GET["submenu"] : null;
	$nota_get = isset($_GET["nota"]) ? $_GET["nota"] : null;
    if (empty($idNota) || empty($menu_get) || empty($submenu_get) || empty($nota_get)){
        redirect("/404.html");
		exit();
    }
    
	
	$n = new Nota();
    if($nota = $n->get($idNota)){
		
		if ($nota["tituloMenu_ami"]!=$menu_get || $nota["tituloSubmenu_ami"]!=$submenu_get || $nota["titulo_ami"]!=$nota_get){			
			redirect("/404.html");
			exit();		
		}
	
		if (!empty($nota["filenameFoto"])){
			$srcImagen = $rootDir."/".$nota["pathFoto"]."/".$idNota."/".$nota["filenameFoto"];
		} else {
			$srcImagen = "";		
		}
		
		if (!empty($nota["video"])){
			$srcVideo = "https://www.youtube.com/embed/".$nota['video']."?&autohide=2&modestbranding=1&showinfo=0&rel=0";
		} else {
			$srcVideo = "";		
		}
		
	 
		$word = ($nota['word'] == true) ? '1': null;
		
		if (!empty($id)){		
			$lectura = array();
			$l = new Lectura();
			
			if (!$lectura = $l->getPorIdNotaIdUser($idNota,$id)){			
				$lectura = $l->create(array(
					"nota_id" => $idNota,
					"user_id" => $id
				));
			}
		}
		
		$txtComment = isset($_SESSION['comentarioActual']) ? $_SESSION['comentarioActual']  : null;
		if (!$n->addVista($idNota)){
			redirect("/404.html");
			exit();
		}
		
	} else {
			redirect("/404.html");
			exit();
	}
?>
<main>

<div class="row user-nota">
		
		<div class="col l3 hide-on-med-and-down">
			 <div class="row">
				  <div class="col s12">
					<h2 class="flow-text header">Estas Leyendo</h2>
					<ul class="collection">
					  <li class="collection-item avatar">
						<img id="leyendo-src" src="<?= $srcImagen ?>" alt="" class="circle materialboxed hidden">
						<p id="leyendo-titulo" style="padding-right: 20px;" class="title"><?= $nota["titulo"]; ?></p>						
						<a style="cursor:auto" class="secondary-content"><i class="material-icons">send</i></a>
					  </li>                           
					</ul>
				   </div> <!-- fin col s12 -->
			</div> <!-- fin class="row" -->
			<div class="row">
				  <div class="col s12">
					<h2 class="flow-text header">Otras Lecturas</h2>
					<input type="hidden" name="submenu_id" id="submenu_id" value='<?= $nota["submenu_id"]; ?>'>
					<ul class="collection" id="otras-lecturas-collection">
					  
					</ul>
				   </div> <!-- fin col s12 -->
		   </div> <!-- fin class="row" -->
	   </div> <!-- class="col s4 m3 l3" -->
		
		<div class="col s12 m10 l7" id="col-medio-index" style="background-color:rgb(251, 247, 243)";>
			<div class="row hidden" id="menus-user-nota">
			</div>
			<div class="row">
				<div class="col s6">
					<h2 class="header flow-text">
						<a href="<?=$rootDir."/".$nota['menu_id']?>-<?=$nota['tituloMenu_ami']?>" class="waves-effect waves-teal btn-flat encabezado-nota"><?=$nota['tituloMenu']?></a>  
						<span> > </span> 
						<a href="<?=$rootDir."/".$nota['tituloMenu_ami']?>/<?=$nota['submenu_id']?>-<?=$nota['tituloSubmenu_ami']?>" class="waves-effect waves-teal btn-flat encabezado-nota"><?=$nota['tituloSubmenu']?></a>  
					</h2>
				</div>
				<div class="col s6" style="text-align:right; padding-top:8px;">
					<?php if ($nota["fechavisible"]){
						echo('<h2 id="encabezado-fecha-nota" class="header flow-text encabezado-nota">'.$nota["fechaNotaUser"].'</h2>');
					} else {
						echo('<h2 id="encabezado-fecha-nota" class="header flow-text encabezado-nota"></h2>');
					}
					?>
				</div>
				
				<div class="col s12">
					<div class="divider"></div>
					<h2 id="nota-medio-titulo" class="flow-text header header-contenido center"><?= $nota["titulo"]; ?></h2>
					<img id="nota-medio-src"class="materialboxed img-nota hidden" width="100%" src="<?= $srcImagen ?>">
					<strong id="nota-medio-subtitulo"><?=$nota["subtitulo"]?></strong> 
								
					<p id="nota-medio-descripcion" class="caption caption-nota"><?=$nota["descripcion"]?></p>
					
					<?php
					if ($nota["twitter"] && $nota["twitter_ennota"]){
						$twitter_cards = ($nota["twitter_cards"] == 1) ? "visible" : "hidden";
						$twitter_conversation = ($nota["twitter_conversation"] == 1) ? "all" : "none";
						echo('<div class="col s12 m12 " style="padding-top: 10px; padding-bottom:10px;">
							<blockquote class="twitter-tweet" 
								data-lang="es"
								data-conversation = "'.$twitter_conversation.'"
								data-cards = "'.$twitter_cards.'"
								data-align = "right"
							>
								<a href="https://twitter.com/x/status/'.$nota["twitter_status"].'"></a>
							</blockquote>
						</div>');
					}
					?>
					
					<div class="codegena <?= empty($srcVideo) ? 'hidden' : '' ?>">
								<iframe id="src-youtube-u-n" width='426' height='251' src="<?= $srcVideo ?>" frameborder="0">
								</iframe>
					</div> 
					
					<p id="label-nota-medio-autor" class="caption bold <?= empty($nota['autor']) ? 'hidden' : '' ?>">Fuente: <span id="nota-medio-autor" class="blue-osni"><?= !empty($nota['autor']) ? $nota['autor'] : '' ?></span></p>
					<p id="label-nota-medio-imagenpor" class="caption-chico <?= empty($nota['imagenpor']) ? 'hidden' : '' ?>">Imagen por: <span id="nota-medio-imagenpor" class="blue-osni" ><?= !empty($nota['imagenpor']) ? $nota['imagenpor'] : '' ?></span></p>
					
					
					
					<a id="btn-download-word" href='/files/nota/<?=$nota["id"]?>/<?=$nota["fechaNotaUser"].".docx"?>' style="background-color: #3B5998;" class="waves-effect waves-light btn-large <?= empty($word) ? 'hidden' : '' ?>"><i class="material-icons right">file_download</i>Descargar Word</a>
					
					<hr/>
				
					<form id="form-comentarios" class="comments" style="background-color: rgba(233,240,238,1);">			  
					  <div class="row row-comments">
						<!--
						<div class="col s12 right" id="lbl-user-comentario">				
							<h6 id="nomyape_user_nota"><?= !empty($id) ? ($nombre.' '.$apellido):'' ?>  <span class="label label-info"><?= !empty($id) ? 'online' : '' ?></span></h6>
						</div>				
						 -->
						<input type="hidden" id="nota_id_user_nota" name="nota_id" value="<?= $idNota ?>">
						<input type="hidden" id="user_id_user_nota" name="user_id" value="<?= !empty($id) ? $id : '' ?>">
						<input type="hidden" id="btn_publicar_apretado_user_nota" name="btn_publicar_apretado" value="0">
					  </div>
					 
										
					<div class="row row-comments">						
						
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<textarea id= "txtComentario" style ="margin-top:15px" name="descripcion" class="materialize-textarea" ><?= !empty($txtComment) ? $txtComment : '' ?></textarea>   							
							<label for="txtComentario"><span><h6 id="nomyape_user_nota"><?= !empty($id) ? ($nombre.' '.$apellido):'Debes estar logueado para comentar' ?>  <span class="label label-info"><?= !empty($id) ? 'online' : '' ?></span></h6></span></label>
							<span class="help-block"></span>
						</div>
						<div class="input-field col s12">						  
						  <span style="color:red" id="error-publicar-comment"></span>					  
						  <button id="btn-publicar-comment" type="submit" class="btn">Publicar</button>
						</div>
					 </div> 
					</form>
					
					</hr>
			   
			
					<div id="lista-comentarios" class="comments" style="background-color: rgba(221,224,204,1);">            
					</div>		
       
				</div>
			</div>
			<div class="row row-publi-enNota">
				
					
				
			</div>
		</div>
		
		<?php  $_SESSION['comentarioActual']  =null;?>
		
		<?php require('rightcol.php')?>
     
</div>     

 <!-- Modal Structure -->
  <div id="modalEliminarComment" class="modal">
    <div class="modal-content center">
	<span><a><i id="close-eliminar-comment" class="right material-icons right" style="color: black;">close</i></a></span>
      <h4 class="center">Eliminar Comentario</h4>
	  <input name ="id-eliminar-comment" id="id-eliminar-comment" type="hidden" value="">	  
      <p></p>
	 
    <div class="modal-footer">
      <a class="waves-effect waves-light btn" id="confirmar-eliminar-comment">Confirmar</a>
	   
    </div>
  </div>
	</div>
</main>
<script async defer src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script src="<?=$rootDir.'/js/jquery-2.1.3.min.js?v=20200916'?>"></script>
<script type="text/javascript" src="<?=$rootDir.'/js/materialize.js?v=20200916'?>"></script> 
<script type="text/javascript" src="<?=$rootDir.'/js/handlebars-v3.0.3.js?v=20200916'?>"></script>
<script type="text/javascript" src="<?=$rootDir.'/js/user-nota-fill.js?v=20200916'?>"></script> 
<!--
<script src="assets/js/main.js?v=20200916"></script>
<script src="assets/js/comentarios.js?v=20200916"></script>
-->
<?php require("footer.php"); ?>