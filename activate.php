<?php @session_start();
    require("models/user.php"); 
    require("utils/common.php");
    require("header-partial.php"); 
    
    
	if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email'])) {
	    $email = $_GET['email'];
	}
	if (isset($_GET['key']) && (strlen($_GET['key']) == 32)){
	    $key = $_GET['key'];
	}


	if (isset($email) && isset($key)) {
		$user = array();
		$u = new User();
		if ($user = $u->getConfirmation($email, $key)){
			if ($user["estadoCuenta_id"]==1){
				if ($u->setConfirmation($user)){
					$activado=1;
					$message = "cuenta activada";
					$_SESSION['id']=$user['id'];            
					$_SESSION['nombre']=$user['nombre'];
					$_SESSION['apellido']=$user['apellido'];
					$_SESSION['tipo']='user';
					$_SESSION['email']=$user['email'];
				}
				else {
					/*$activado=0;*/
					$message = "El sistema ha fallado"; /*error al updatear el estadoCuenta*/
				}
			}
			else {
				/*$activado=0;*/
				$message = "su cuenta se encontraba registrada con anterioridad";
			}
		}	
		else{
			/*$activado=0;*/
			$message = "verifique el link de activacion"; //no coincide (mail o hash)
		}
	}
	else {
		/*$activado=0;*/
		$message = "verifique el link de activacion"; // link malformado
	}
	
    
?>
	<div class="container" style="padding-bottom:100px;">
		<div class="row center">
			<div class="col s12"  style="<?= empty($activado) ? 'display:none;':''?>" >
				<h1 class="flow-text header">FELICITACIONES</h1>
				<p>Te has registrado correctamente</p>
				<a href="index.php" class="btn">Ingresar<a>
			</div>
			<div class="col s12" style="<?= !empty($activado) ? 'display:none;':''?>" >
				<h1 class="flow-text header" style="color:red">OOPS ha ocurrido un error</h1>
				<p><?=$message?></p>
				<a href="index.php" class="btn">Inicio<a>
			</div>
		</div>
	</div>
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
  <script type="text/javascript" src="js/materialize.js"></script> 
<?php require("footer-admin.php"); ?>

