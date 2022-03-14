<?php
    $idSubmenu = isset($_GET["id"]) ? $_GET["id"] : null;
	$menu_get = isset($_GET["menu"]) ? $_GET["menu"] : null;
	$submenu_get = isset($_GET["submenu"]) ? $_GET["submenu"] : null;
	
	
	if ($idSubmenu=="2020" && $menu_get=="nuevo" && $submenu_get=="viejosSonLosTrapos"){
		require_once("header-nuevo.php");		
		
		
		require_once("forecast.php");
		
		echo('
				<body class="animsition">
	
	<!-- Header -->
	<header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="topbar">
				<div class="content-topbar container h-100">
					<div class="left-topbar">
						<span class="left-topbar-item flex-wr-s-c">
							<span>'.$data->name.'</span>
							<img src="http://openweathermap.org/img/w/'.$data->weather[0]->icon.'.png"class="m-b-1 m-rl-8 weather-icon" />				
							<span class="min-temperature">'.round($data->main->temp_min,1).'&deg;C</span>');
							/*
							<span class="min-temperature ml-10 mr-10"> - </span>
							<span class="min-temperature">'.round($data->main->temp_max,1).'&deg;C</span>
							*/
						echo('</span>');
						/*
						<a href="#" class="left-topbar-item">
							About
						</a>

						<a href="#" class="left-topbar-item">
							Contact
						</a>

						<a href="#" class="left-topbar-item">
							Sing up
						</a>

						<a href="#" class="left-topbar-item">
							Log in
						</a>
						*/
					echo('</div>

					<div class="right-topbar">
						<a href="https://es-la.facebook.com/Proyectogeo-168110877219/">
							<span class="fab fa-facebook-f"></span>
						</a>

						<a href="https://twitter.com/estebanmirol">
							<span class="fab fa-twitter"></span>
						</a>

						<a href="#">
							<span class="fab fa-pinterest-p"></span>
						</a>

						<a href="#">
							<span class="fab fa-vimeo-v"></span>
						</a>

						<a href="#">
							<span class="fab fa-youtube"></span>
						</a>
					</div>
				</div>
			</div>

			<!-- Header Mobile -->
			<div class="wrap-header-mobile">
				<!-- Logo moblie -->		
				<div class="logo-mobile">
					<a href="#"><img src="'.$rootDir.'/nuevo/images/viejos.png'.'" alt="IMG-LOGO"></a>
				</div>

				<!-- Button show menu -->
				<div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>

			<!-- Menu Mobile -->
			<div class="menu-mobile">
				<ul class="topbar-mobile">
					<li class="left-topbar">
						<span class="left-topbar-item flex-wr-s-c">
							<span>'.$data->name.'</span>
							<img src="http://openweathermap.org/img/w/'.$data->weather[0]->icon.'.png"class="m-b-1 m-rl-8 weather-icon" />				
							<span class="min-temperature">'.round($data->main->temp_min,1).'&deg;C</span>');
							/*
							<span class="min-temperature ml-10 mr-10"> - </span>
							<span class="min-temperature">'.round($data->main->temp_max,1).'&deg;C</span>
							*/
						echo('</span>
					</li>');
					/*
					<li class="left-topbar">
						<a href="#" class="left-topbar-item">
							About
						</a>

						<a href="#" class="left-topbar-item">
							Contact
						</a>

						<a href="#" class="left-topbar-item">
							Sing up
						</a>

						<a href="#" class="left-topbar-item">
							Log in
						</a>
					</li>
					*/
					echo('<li class="right-topbar">
						<a href="https://es-la.facebook.com/Proyectogeo-168110877219/">
							<span class="fab fa-facebook-f"></span>
						</a>

						<a href="https://twitter.com/estebanmirol">
							<span class="fab fa-twitter"></span>
						</a>

						<a href="#">
							<span class="fab fa-pinterest-p"></span>
						</a>

						<a href="#">
							<span class="fab fa-vimeo-v"></span>
						</a>

						<a href="#">
							<span class="fab fa-youtube"></span>
						</a>
					</li>
				</ul>');
				/*
				echo('<ul class="main-menu-m">
					
						foreach ($menus as $menu) {
							$submenus = $submnu->getAll($menu["id"]);
							echo('<li>');
							echo('<a href="'.$rootDir.'/'.$menu["id"].'-'.$menu["titulo_ami"].'">'.$menu["titulo"].'</a>');
						
							echo('<ul class="sub-menu-m">');
							foreach ($submenus as $submenu){
								echo('<li><a href="'.$rootDir.'/'.$menu["titulo_ami"].'/'.$submenu["id"].'-'.$submenu["titulo_ami"].'">'.$submenu["titulo"].'</a></li>');
							}							
							echo('</ul>');
						echo('
						<span class="arrow-main-menu-m">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</span>
						</li>');
						};
				echo('</ul>');*/
			echo('</div>
			
			<!--  -->
			<div class="wrap-logo container">
				<!-- Logo desktop -->		
				<div class="logo">
					<a href="#"><img src="'.$rootDir.'/nuevo/images/viejos.png'.'" alt="LOGO"></a>
				</div>	

				<!-- Banner -->
				<div class="banner-header">
					<a href="'.$rootDir."/".'"><img src="images/geo2.png" alt="IMG"></a>
				</div>
			</div>');	 
			
			
			/*
			echo('<div class="wrap-main-nav">
				<div class="main-nav">
					<!-- Menu desktop -->
					<nav class="menu-desktop">
						<a class="logo-stick" href="#">
							<img src="'.$rootDir.'/nuevo/images/viejos.png'.'" alt="LOGO">
						</a>');
						
						
						echo('<ul class="main-menu">');
						$countMenu = 0;							
						foreach ($menus as $menu) {								
							$submenus = $submnu->getAll($menu["id"]);
							if ($countMenu==0){
								echo ('<li class="mega-menu-item main-menu-active">');									
							} else {
								echo ('<li class="mega-menu-item">');
							}
							echo('<a href="'.$rootDir.'/'.$menu["id"].'-'.$menu["titulo_ami"].'">'.$menu["titulo"].'</a>');
							echo('<div class="sub-mega-menu">');
								echo('<div class="nav flex-column nav-pills" role="tablist">');	
								$countSubmenu = 0;											
								foreach ($submenus as $submenu){
									echo('<li><a href="'.$rootDir.'/'.$menu["titulo_ami"].'/'.$submenu["id"].'-'.$submenu["titulo_ami"].'">'.$submenu["titulo"].'</a></li>');
									if ($countSubmenu==0){
										echo('<a class="nav-link active" data-toggle="pill" href="#'.$menu["titulo_ami"].'-'.$countSubmenu.'" role="tab">All</a>');
									} else {
										echo('<a class="nav-link" data-toggle="pill" href="#'.$menu["titulo_ami"].'-'.$countSubmenu.'" role="tab">All</a>');
									}
									
									$countSubmenu ++;
								}
								echo('</div>');				
								echo('<div class="tab-content">');
								$countSubmenu = 0;
								foreach ($submenus as $submenu){
									if ($countSubmenu==0){
										echo('<div class="tab-pane show active" id="'.$menu["titulo_ami"].'-'.$countSubmenu.'" role="tabpanel">');
									} else {
										echo('<div class="tab-pane" id="'.$menu["titulo_ami"].'-'.$countSubmenu.'" role="tabpanel">');
									}
									echo('<div class="row">');
									
        
										
										$notasFour = $nta->getLastFourFromSubmenu($submenu["id"]);
										foreach ($notasFour as $nota){
											echo('<div class="col-3">');
													echo('<div>');													
														echo('<a href="'.$rootDir.'/'.$menu["titulo_ami"].'/'.$submenu["titulo_ami"].'/'.$nota["id"].'-'.$nota["titulo_ami"].'" class="wrap-pic-w hov1 trans-03">');
															echo('<img src="'.$rootDir.'/'.$nota["pathFoto"].$nota["id"].'/'.$nota["filenameFoto"].'" alt="IMG">');
														echo('</a>');

														echo('<div class="p-t-10">
																<h5 class="p-b-5">');
																echo('<a href="'.$rootDir.'/'.$menu["titulo_ami"].'/'.$submenu["titulo_ami"].'/'.$nota["id"].'-'.$nota["titulo_ami"].'" class="f1-s-5 cl3 hov-cl10 trans-03">');
																	echo($nota["titulo"]);
																echo('</a>
															</h5>

															<span class="cl8">
																<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">');
																	echo($submenu["titulo"]);
																echo('</a>

																<span class="f1-s-3 m-rl-3">
																	-
																</span>

																<span class="f1-s-3">');
																	echo($nota["fechaNota"]);
																echo('</span>
															</span>
														</div>
													</div>
												</div>');
										}
									echo('</div>');
									$countSubmenu ++;
								}
								echo('</div>');
								echo('</div>');
								echo('</li>');
								$countMenu ++;
							}	
										
							
							
							

						

	
								
						echo('</ul>');
						*/
						echo('<div class="wrap-main-nav"></div>');
					echo('</nav>
				</div>
			</div>	
		</div>
	</header>
	
	<!-- Headline -->
	<div class="container">
		<div class="bg0 flex-wr-sb-c p-rl-20xxx p-tb-8">
			<div class="f2-s-1 p-r-30 size-w-0 m-tb-6 flex-wr-s-c">
				<span class="text-uppercase cl2 p-r-8">
					Tendencias:
				</span>');
				$notasTendencias = $nta->getTendencias(2);
				echo('<span class="dis-inline-block cl6 slide100-txt pos-relative size-w-0" data-in="fadeInDown" data-out="fadeOutDown">');
				foreach ($notasTendencias as $nota){
					echo('<span class="dis-inline-block slide100-txt-item animated visible-false">');
						echo($nota["titulo"]);
					echo('</span>');
				}
					
				echo('</span>
			</div>');
			/*
			<div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
				<input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search">
				<button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
					<i class="zmdi zmdi-search"></i>
				</button>
			</div>
			*/
		echo('</div>
	</div>
		
	<!-- Feature post -->
	<section class="bg0">
		<div class="container">
			<div class="row m-rl--1">');
			$idSubmenuVSLT = 2;
			$qBuscar = 4;
			$notasLast = $nta->getLastNFromSubmenu($idSubmenuVSLT, $qBuscar,0);
				
				
				echo('<div class="col-md-6 p-rl-1 p-b-2" style="background-color: #d2d2d24a;">
					<div class="bg-img1 size-a-3 how1 pos-relative" style="background-size:contain; background-image: url('."'".$rootDir.'/'.$notasLast[0]["pathFoto"].$notasLast[0]["id"].'/'.$notasLast[0]["filenameFoto"]."'".');">');
						echo('<a href="'.$rootDir.'/'.$notasLast[0]["menu_titulo_ami"].'/'.$notasLast[0]["submenu_titulo_ami"].'/'.$notasLast[0]["id"].'-'.$notasLast[0]["titulo_ami"].'" class="dis-block how1-child1 trans-03"></a>

						<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
							

							<h3 class="how1-child2 m-t-14 m-b-10">
								<a href="'.$rootDir.'/'.$notasLast[0]["menu_titulo_ami"].'/'.$notasLast[0]["submenu_titulo_ami"].'/'.$notasLast[0]["id"].'-'.$notasLast[0]["titulo_ami"].'" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
									'.$notasLast[0]["titulo"].'
								</a>
							</h3>

							<span class="how1-child2">
								<span class="f1-s-4 cl11">
									'.$notasLast[0]["autor"].'
								</span>

								<span class="f1-s-3 cl11 m-rl-3">
									-
								</span>

								<span class="f1-s-3 cl11">
									'.$notasLast[0]["fechaNota"].'
								</span>
							</span>
						</div>
					</div>
				</div>

				<div class="col-md-6 p-rl-1">
					<div class="row m-rl--1">
						<div class="col-12 p-rl-1 p-b-2">
							<div class="bg-img1 size-a-4 how1 pos-relative" style="background-image: url('."'".$rootDir.'/'.$notasLast[1]["pathFoto"].$notasLast[1]["id"].'/'.$notasLast[1]["filenameFoto"]."'".');">
								<a href="'.$rootDir.'/'.$notasLast[1]["menu_titulo_ami"].'/'.$notasLast[1]["submenu_titulo_ami"].'/'.$notasLast[1]["id"].'-'.$notasLast[1]["titulo_ami"].'" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-24">
									

									<h3 class="how1-child2 m-t-14">
										<a href="'.$rootDir.'/'.$notasLast[1]["menu_titulo_ami"].'/'.$notasLast[1]["submenu_titulo_ami"].'/'.$notasLast[1]["id"].'-'.$notasLast[1]["titulo_ami"].'" class="how-txt1 size-a-7 f1-l-2 cl0 hov-cl10 trans-03">
											'.$notasLast[1]["titulo"].'
										</a>
									</h3>
								</div>
							</div>
						</div>

						<div class="col-sm-6 p-rl-1 p-b-2">
							<div class="bg-img1 size-a-5 how1 pos-relative" style="background-image: url('."'".$rootDir.'/'.$notasLast[2]["pathFoto"].$notasLast[2]["id"].'/'.$notasLast[2]["filenameFoto"]."'".');">
								<a href="'.$rootDir.'/'.$notasLast[2]["menu_titulo_ami"].'/'.$notasLast[2]["submenu_titulo_ami"].'/'.$notasLast[2]["id"].'-'.$notasLast[2]["titulo_ami"].'" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
									

									<h3 class="how1-child2 m-t-14">
										<a href="'.$rootDir.'/'.$notasLast[2]["menu_titulo_ami"].'/'.$notasLast[2]["submenu_titulo_ami"].'/'.$notasLast[2]["id"].'-'.$notasLast[2]["titulo_ami"].'" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
											'.$notasLast[2]["titulo"].'
										</a>
									</h3>
								</div>
							</div>
						</div>

						<div class="col-sm-6 p-rl-1 p-b-2">
							<div class="bg-img1 size-a-5 how1 pos-relative" style="background-image: url('."'".$rootDir.'/'.$notasLast[3]["pathFoto"].$notasLast[3]["id"].'/'.$notasLast[3]["filenameFoto"]."'".');">
								<a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

								<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
									
									<h3 class="how1-child2 m-t-14">
										<a href="'.$rootDir.'/'.$notasLast[3]["menu_titulo_ami"].'/'.$notasLast[3]["submenu_titulo_ami"].'/'.$notasLast[3]["id"].'-'.$notasLast[3]["titulo_ami"].'" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
											'.$notasLast[3]["titulo"].'
										</a>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>');

	
	/*
	<!-- Banner -->
	<div class="container">
		<div class="flex-c-c">
			<a href="#">
				<img class="max-w-full" src="images/banner-01.jpg" alt="IMG">
			</a>
		</div>
	</div>
	*/
	echo('
	<!-- Latest -->
	<section class="bg0 p-t-60 p-b-35">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8 p-b-20">
					<div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
						<h3 class="f1-m-2 cl3 tab01-title">
							Mas Artículos
						</h3>
					</div>

					<div class="row p-t-35">');
					$qBuscar = 10;
					$offset = 4;
					$notasLast = $nta->getLastNFromSubmenu($idSubmenuVSLT, $qBuscar, $offset);
						foreach ($notasLast as $nota){
						echo('<div class="col-sm-6 p-r-25 p-r-15-sr991 notadom">
								<!-- Item latest -->	
								<div class="m-b-45">
									<a href="'.$rootDir.'/'.$nota["menu_titulo_ami"].'/'.$nota["submenu_titulo_ami"].'/'.$nota["id"].'-'.$nota["titulo_ami"].'" class="wrap-pic-w-osni hov1 trans-03">									
										<img src="'.$rootDir.'/'.$nota["pathFoto"].$nota["id"].'/'.$nota["filenameFoto"].'" alt="IMG">
									</a>

									<div class="p-t-16">
										<h5 class="p-b-5">
											<a href="'.$rootDir.'/'.$nota["menu_titulo_ami"].'/'.$nota["submenu_titulo_ami"].'/'.$nota["id"].'-'.$nota["titulo_ami"].'" class="f1-m-3 cl2 hov-cl10 trans-03">
												'.$nota["titulo"].'
											</a>
										</h5>

										<span class="cl8">
											<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
												'.$nota["autor"].'
											</a>

											<span class="f1-s-3 m-rl-3">
												-
											</span>

											<span class="f1-s-3">
												'.$nota["fechaNota"].'
											</span>
										</span>
									</div>
								</div>
							</div>');
						}
				
					
						
					echo('</div>
					<div id="masnotas-container" class="row ">');
						
					echo('</div>
					<div class="row">
						<div class="col-6 col-md-3 offset-md-3">
						<a href="#" id="btn-ver-mas" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
										Ver más
									</a>
						</div>
						<div class="col-6 col-md-3">
<a href="'.$rootDir.'/novedades/2-viejos-son-los-trapos'.'" id="btn-ver-listado" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
							Listado
						</a>				
						</div>
					</div>
				</div>

				<div class="col-md-10 col-lg-4">
					<div class="p-l-10 p-rl-0-sr991 p-b-20">
						<!-- Video -->
						<div class="p-b-55-1385">
							<div class="how2 how2-cl4 flex-s-c m-b-35">
								<h3 class="f1-m-2 cl3 tab01-title">
									Auspician
								</h3>
							</div>');							
							
							$arrPubli = $publ->getAllAll();
						    
							foreach ($arrPubli as $publi){
								echo('<div>
								<div class="wrap-pic-w pos-relative">
									<object width="100%" style="padding-bottom:10px;height:100%;min-height:180px;" class="" data="'.$rootDir.'/'.$publi["pathFoto"].$publi["id"].'/'.$publi["filenameFoto"].'">
										<param name="wmode" value="transparent">			
								   </object>

									
								</div>');
							}
								
								/*
								echo('<div class="p-tb-16 p-rl-25 bg3">
									<h5 class="p-b-5">
										<a href="#" class="f1-m-3 cl0 hov-cl10 trans-03">
											Music lorem ipsum dolor sit amet consectetur 
										</a>
									</h5>

									<span class="cl15">
										<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
											by John Alvarado
										</a>

										<span class="f1-s-3 m-rl-3">
											-
										</span>

										<span class="f1-s-3">
											Feb 18
										</span>
									</span>
								</div>
								*/
							echo('</div>');
							/*	
							<div>
								<div class="wrap-pic-w pos-relative">
									<img src="images/video-01.jpg" alt="IMG">

									<button class="s-full ab-t-l flex-c-c fs-32 cl0 hov-cl10 trans-03" data-toggle="modal" data-target="#modal-video-01">
										<span class="fab fa-youtube"></span>
									</button>
								</div>

								<div class="p-tb-16 p-rl-25 bg3">
									<h5 class="p-b-5">
										<a href="#" class="f1-m-3 cl0 hov-cl10 trans-03">
											Music lorem ipsum dolor sit amet consectetur 
										</a>
									</h5>

									<span class="cl15">
										<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
											by John Alvarado
										</a>

										<span class="f1-s-3 m-rl-3">
											-
										</span>

										<span class="f1-s-3">
											Feb 18
										</span>
									</span>
								</div>
							</div>	
							*/
						echo('</div>
							
						<!-- Subscribe -->
						<div class="bg10 p-rl-35 p-t-28 p-b-35 m-b-55">
							<h5 class="f1-m-5 cl0 p-b-10">
								Suscríbase
							</h5>

							<p class="f1-s-1 cl0 p-b-25">
								Reciba las ultimas noticias por mail
							</p>

							<form id="frm-subscribe" class="size-a-9 pos-relative" role="form">
								<input id="input-subscribe" class="s-full f1-m-6 cl6 plh9 p-l-20 p-r-55" type="mail" name="email" placeholder="Email">
								<button type="submit" class="size-a-10 flex-c-c ab-t-r fs-16 cl9 hov-cl10 trans-03">
									<i class="fa fa-arrow-right"></i>
								</button>
							</form>
						</div>
						
						<!-- Etiquetas -->
						<div class="p-b-55">
							<div class="how2 how2-cl4 flex-s-c m-b-30">
								<h3 class="f1-m-2 cl3 tab01-title">
									Etiquetas
								</h3>
							</div>

							<div class="flex-wr-s-s m-rl--5">
								<a href="'.$rootDir.'/novedades/2-viejos-son-los-trapos'.'" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Pami
								</a>

								<a href="'.$rootDir.'/novedades/2-viejos-son-los-trapos'.'" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Turismo
								</a>

								<a href="'.$rootDir.'/novedades/2-viejos-son-los-trapos'.'" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Anses
								</a>

								<a href="'.$rootDir.'/novedades/2-viejos-son-los-trapos'.'" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Alimentos
								</a>

								<a href="'.$rootDir.'/novedades/2-viejos-son-los-trapos'.'" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Vida Sana
								</a>

								<a href="'.$rootDir.'/novedades/2-viejos-son-los-trapos'.'" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Medicamentos
								</a>

								<a href="'.$rootDir.'/novedades/2-viejos-son-los-trapos'.'" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Novedades
								</a>

								<a href="'.$rootDir.'/novedades/2-viejos-son-los-trapos'.'" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Descuentos
								</a>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer>
		<div class="bg2 p-t-40 p-b-25">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 p-b-20">
						<div class="size-h-3 flex-s-c">
							<a href="index.html">
								<img class="max-s-full" src="'.$rootDir.'/nuevo/images/viejos.png'.'" alt="LOGO">
							</a>
						</div>

						<div>
							<p class="f1-s-1 cl11 p-b-16 p-l-5">
								Es parte de ProyectoGeo, sitio dedicado a la ecologia y la vida sana. Nos preocupamos por ustedes
							</p>

							<p class="f1-s-1 cl11 p-b-16 p-l-5">
								Estamos en todas las redes
							</p>

							<div class="p-t-15 p-l-5">
								<a href="https://es-la.facebook.com/Proyectogeo-168110877219/" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-facebook-f"></span>
								</a>

								<a href="https://twitter.com/estebanmirol" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-twitter"></span>
								</a>

								<a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-pinterest-p"></span>
								</a>

								<a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-vimeo-v"></span>
								</a>

								<a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
									<span class="fab fa-youtube"></span>
								</a>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-lg-4 p-b-20">
						<div class="size-h-3 flex-s-c">
							<h5 class="f1-m-7 cl0">
								Lo mas visto
							</h5>
						</div>

						<ul>');
						$cant = 3;
						$offset = 0;
						$arrMostViewd = $nta->getMostViewd($idSubmenuVSLT, $cant, $offset);
						foreach ($arrMostViewd as $notaMost){
							echo('<li class="flex-wr-sb-s p-b-20">							
								<a href="'.$rootDir.'/'.$notaMost["menu_titulo_ami"].'/'.$notaMost["submenu_titulo_ami"].'/'.$notaMost["id"].'-'.$notaMost["titulo_ami"].'" class="size-w-4 wrap-pic-w hov1 trans-03">
									<img src="'.$rootDir.'/'.$notaMost["pathFoto"].$notaMost["id"].'/'.$notaMost["filenameFoto"].'" alt="IMG">
								</a>

								<div class="size-w-5">
									<h6 class="p-b-5">
										<a href="'.$rootDir.'/'.$notaMost["menu_titulo_ami"].'/'.$notaMost["submenu_titulo_ami"].'/'.$notaMost["id"].'-'.$notaMost["titulo_ami"].'" class="f1-s-5 cl11 hov-cl10 trans-03">
											'.$notaMost["titulo"].'
										</a>
									</h6>

									<span class="f1-s-3 cl6">
										'.$notaMost["fechaNota"].'
									</span>
								</div>
							</li>');
						}
							
						echo('</ul>
					</div>

					<div class="col-sm-6 col-lg-4 p-b-20">
						<div class="size-h-3 flex-s-c">
							<h5 class="f1-m-7 cl0">
								De interes
							</h5>
						</div>

						<ul class="m-t--12">');
							$offset = 3;
							$arrMostViewd = $nta->getMostViewd($idSubmenuVSLT, $cant, $offset);
							foreach ($arrMostViewd as $notaMost){
								echo('<li class="flex-wr-sb-s p-b-20">							
									<a href="'.$rootDir.'/'.$notaMost["menu_titulo_ami"].'/'.$notaMost["submenu_titulo_ami"].'/'.$notaMost["id"].'-'.$notaMost["titulo_ami"].'" class="size-w-4 wrap-pic-w hov1 trans-03">
										<img src="'.$rootDir.'/'.$notaMost["pathFoto"].$notaMost["id"].'/'.$notaMost["filenameFoto"].'" alt="IMG">
									</a>

									<div class="size-w-5">
										<h6 class="p-b-5">
											<a href="'.$rootDir.'/'.$notaMost["menu_titulo_ami"].'/'.$notaMost["submenu_titulo_ami"].'/'.$notaMost["id"].'-'.$notaMost["titulo_ami"].'" class="f1-s-5 cl11 hov-cl10 trans-03">
												'.$notaMost["titulo"].'
											</a>
										</h6>

										<span class="f1-s-3 cl6">
											'.$notaMost["fechaNota"].'
										</span>
									</div>
								</li>');
							}
						echo('</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="bg11">
			<div class="container size-h-4 flex-c-c p-tb-15">
				<span class="f1-s-1 cl0 txt-center">
					Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | Alfano & Suarez - Desarrollo de Sistemas
				</span>
			</div>
		</div>
	</footer>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>');
	require_once("footer-nuevo.php");

echo ('</body>
</html>');
		
		
	} else {
		require("header.php");
		
		require("utils/common.php");
		if (empty($idSubmenu) || empty($menu_get) || empty($submenu_get)){
			redirect("/404.html");
			exit();
		}
		  
		$s = new Submenu();
		if ($submenu = $s->get($idSubmenu)){
		
			if ($submenu["tituloMenu_ami"]!=$menu_get || $submenu["titulo_ami"]!=$submenu_get){			
				redirect("/404.html");
				exit();		
			}
		
			if (!empty($submenu["filenameFoto"])){
				$srcImagen = $rootDir."/".$submenu["pathFoto"]."/".$idSubmenu."/".$submenu["filenameFoto"];
			} else {
				$srcImagen = "";		
			}
			
			$nota = array();    
			$n = new Nota();
			$nota = $n->getAll($idSubmenu);
		} else {
			redirect("/404.html");
				exit();		
		}
	
		echo ('
		<main>
			
			   <div class="row user-menu">
				<div class="col l3 hide-on-med-and-down">
					<div class="row">
					  <div class="col s12">
						<h2 class="flow-text header">Estas viendo</h2>
						<ul class="collection">
						  <li class="collection-item avatar">
							<img id="leyendo-src" src="'.$srcImagen.'" alt="" class="circle materialboxed hidden">
							<p id="leyendo-titulo" style="padding-right: 20px;" class="title">'.$submenu["titulo"].'</p>						
							<a style="cursor:auto" class="secondary-content"><i class="material-icons">send</i></a>
						  </li>                           
						</ul>
					   </div> 
					</div> 
					<div class="row">
					  <div class="col s12">
						<h2 class="flow-text header">Más</h2>
						<input type="hidden" id="submenu_id_user_submenu" name="submenu_id" value="'.$submenu["id"].'">
						<ul class="collection" id="otros-menus-collection">
					  
						</ul>
					   </div>
					</div> 
				</div> 
				 <div class="col s12 m10 l7" id="col-medio-u-m" style="background-color:rgb(251, 247, 243)";>
					<div class="row hidden" id="menus-user-submenu">
					</div>
				<div class="row" id="notas-user-submenu" style="margin-top: 22px;">
							<div class="col s12">
								<h6 class="center header flow-text titulo-listado-notas"></h6>
							</div>
							<div class="col s12">
							
							
							<table class="highlight centered bordered contenido-listado-notas hidden">
										<thead>
									<tr>
											  <th class="th-fecha"></th>
											  <th></th>
											  <th class="th-visitas"></th>
										  </tr>
										  <tr>
											  <th class="th-fecha" data-field="fecha">Fecha</th>
											  <th data-field="titulo">Titulo</th>
											  <th class = "th-visitas" data-field="vistas">Visitas</th>
										  </tr>
										</thead>

										<tbody id="tbodyppal">
										  
										  
										</tbody>
										 
									  </table>	
									</div>
						</div>			
										
								
									
									
							  </div> '); 
								require('rightcol.php');
			   echo ('</div> 
				   
					
		</main>
		<script src="'.$rootDir.'/js/jquery-2.1.3.min.js'.'"></script>
		<script type="text/javascript" src="'.$rootDir.'/js/materialize.js'.'"></script> 
		<script type="text/javascript" src="'.$rootDir.'/js/handlebars-v3.0.3.js'.'"></script> 
		<script type="text/javascript" src="'.$rootDir.'/js/user-submenu-fill.js'.'"></script>'); 

		require("footer.php");
	}
		
		
		