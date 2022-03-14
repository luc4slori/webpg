
	<input type="hidden" id="rootDir" value='<?=$rootDir?>'>	

<!-- ****** footer ****** -->
		<div class="row">
			<div class="col s12" style="max-height:100px; text-align:center; display: inline-table;">								
					<div class="row" style="max-height: 80% !important ;overflow-y: hidden !important ;">
						<div class="col s12" id="col-footer-publi" style="overflow-y: hidden !important ; padding:0px !important;">
							<?php 
								$footerPublis = $publ->getFooterPubli();
								$qPublis = sizeof($footerPublis);
								if ($qPublis>0){			
									$indiceRandom = rand(0,$qPublis-1);				
									$strPath = $rootDir.'/'.$footerPublis[$indiceRandom]["pathFoto"].'/'.$footerPublis[$indiceRandom]["id"].'/'.$footerPublis[$indiceRandom]["filenameFoto"];
									
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
	   <footer class="page-footer">
           	<div class="fixed-action-btn btn-up hide-on-small-only">
				<a id="back-to-top" class="btn-floating  btn-super-large">
					<i class="large material-icons">keyboard_arrow_up
					</i>
				</a>		
			</div>
			
			<div class="container">
				<div class="row">
				
					<div class="col l4 s12">
						<h5 class="white-text">Proyecto Geo</h5>
						<p class="grey-text text-lighten-4">Es ecología, animales, naturaleza, un zoológico virtual, todas las especies: tigres, elefantes, caballos, insectos y toda la ecología.</p>
					
						<a class="modal-trigger btn waves-effect waves-light blue lighten-3" target="_blank" href="#modal-login">Ingresar</a>
					</div>
					  <div class="col l4 s12">
						<h5 class="white-text">Contactanos</h5>
						<p class="grey-text text-lighten-4">Tenemos un gran compromiso con los parques nacionales del mundo, con los perros y gatos y todas las mascotas, con la vida al aire libre.</p>
						<a class="modal-trigger btn waves-effect waves-light blue lighten-3" target="_blank" href="#modal-contact">Contactar</a>
					</div>
					<div class="col l4 s12" style="overflow: hidden;">
						<h5 class="white-text">Redes Sociales</h5>
						<div class="row">
							<div class="col s3">
								
								<a  style="width:100%;" href="https://es-la.facebook.com/Proyectogeo-168110877219/"><img src="<?=$rootDir.'/img/psd/facebook.png'?>" style="width:100%" alt="" class="responsive-img"></a>
							</div>
							<div class="col s3">
								<a  style="width:100%;" href="https://twitter.com/estebanmirol"><img src="<?=$rootDir.'/img/psd/twitter.png'?>" style="width:100%" alt="" class="responsive-img"></a>								
							</div>
							<div class="col s3">
								<a  style="width:100%;" href="#"><img src="<?=$rootDir.'/img/psd/googleplus.png'?>" style="width:100%" alt="" class="responsive-img"></a>																
							</div>
							<div class="col s3">
								<a  style="width:100%;" href="#"><img src="<?=$rootDir.'/img/psd/youtube.png'?>" style="width:100%" alt="" class="responsive-img"></a>																
							</div>
						</div>				   
							
					</div>
				  
				</div>
			</div>
      <div class="footer-copyright">
        <div class="container">
        © 2015 Proyecto Geo, Todos los derechos reservados.
        <a id="footer-sualf" class="grey-text text-lighten-4 right">Alfano & Suarez - Website Design and  Development Solution</a>
        </div>
      </div>
    </footer>      	 
	  <script src="https://apis.google.com/js/api:client.js"></script>
	 
	  <script type="text/javascript" src="<?=$rootDir.'/js/init.js'?>"></script>
	  <script type="text/javascript" src="<?=$rootDir.'/js/notes.js'?>"></script>
	  <script type="text/javascript" src="<?=$rootDir.'/js/scroll.js'?>"></script>
	  <script type="text/javascript" src="<?=$rootDir.'/js/register.js'?>"></script>
		<script>		
			function prepareRecaptcha () {
				$('.error-recaptcha').addClass("hidden");
			}
		</script>
</body>
</html>