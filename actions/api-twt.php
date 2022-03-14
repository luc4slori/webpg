<?php
include_once("../models/config.php");
include_once("../models/inc/twitteroauth.php");
require("../utils/request.php");

function sendResponse($response){
    echo json_encode($response);
}

function login($request){
session_start();

//just simple session reset on logout click
if(isset($_GET["reset"]) && $_GET["reset"]==1){
	session_destroy();
	header('Location: ./index.php');
}

// Include config file and twitter PHP Library by Abraham Williams (abraham@abrah.am)

	

	if(isset($_SESSION['status']) && $_SESSION['status']=='verified'){	
			sendResponse(array(
				"error" => false,
				"mensaje" => "ok",
				"data" => $_SESSION
			));
		
	} elseif (isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {
		
			sendResponse(array(
				"error" => true,
				"mensaje" => "token viejo"				
			));
	}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {
		
		// everything looks good, request access token
		//successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
		if($connection->http_code=='200'){
			//redirect user to twitter
			$_SESSION['status'] = 'verified';
			$_SESSION['request_vars'] = $access_token;
			
			// unset no longer needed request tokens
			unset($_SESSION['token']);
			unset($_SESSION['token_secret']);
			
			sendResponse(array(
				"error" => false,
				"mensaje" => "ok2",
				"data" => $_SESSION
			));
			
		}else{
			sendResponse(array(
				"error" => false,
				"mensaje" => "intente mas tarde"				
			));
		}
		
    }elseif(isset($_GET["denied"])){
				sendResponse(array(
					"error" => true,
					"mensaje" => "denegado"            
				));			
	} else {
			//fresh authentication
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
			
			//received token info from twitter
			$_SESSION['token'] 			= $request_token['oauth_token'];
			$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
			
			// any value other than 200 is failure, so continue only if http code is 200
			if($connection->http_code=='200'){
				//redirect user to twitter
				$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
				//header('Location: ' . $twitter_url); 
				sendResponse(array(
					"error" => false,
					"mensaje" => "ok3",
					"location" => $twitter_url,
					"data" => $_SESSION
				));
			}else{
			sendResponse(array(
					"error" => true,
					"mensaje" => "error"            
				));
			}
			
		}
	
}



function listar($request){
    require("../models/estado-item.php");
    $n = new EstadoItem();
    if($estadosItems = $n->get($request->id)){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $estadosItems
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener un estado item"
        ));
    }
}

function listarAll(){
    require("../models/estado-item.php");
    $n = new EstadoItem();
    if($estadosItems = $n->getAll()){
        sendResponse(array(
            "error" => false,
            "mensaje" => "",
            "data" => $estadosItems
        ));
    }else{
        sendResponse(array(
            "error" => true,
            "mensaje" => "Error al obtener los estados items"
        ));
    }
}

$request = new Request();
$action = $request->action;
switch($action){
     case "listar":
        listar($request);
        break; 
    case "listarAll":
        listarAll();
        break;	 
	case "login":
		login($request);
		break;
    default:
        sendResponse(array(
            "error" => true,
            "mensaje" => "Request mal formade"
        ));
        break;
}
