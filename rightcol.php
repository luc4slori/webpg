<div class="col l2 hide-on-med-and-down col-der">
    <div class="row">
        <div class="col m12 l12" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 27px 24px 0px, rgba(0, 0, 0, 0.219608) 0px 40px 77px 0px;padding-top: 4px; margin-top: 20px; background-color: rgb(226, 226, 226);">
            <div class="happer">

                  <div class="section table-of-contents center" id="publi-derecha">
						<?php
						$publis = $publ->getAllAll();
						foreach($publis as $publi){
							$href = $publi['href'];
							$onmousedown="window.location.href= '".$href."'";
							echo('<div class="vergini" onmousedown="'.$onmousedown.'">');	
								   echo('<object width="100%" style="padding-bottom:10px;height:100%;min-height:180px;" class=""  data="'.$rootDir.'/'.$publi["pathFoto"].'/'.$publi["id"].'/'.$publi["filenameFoto"].'">
										<param name="wmode" value="transparent" />			
								   </object>  
							</div>');
						}
						?>
                  </div>

            </div>
        </div>
    </div>
</div>