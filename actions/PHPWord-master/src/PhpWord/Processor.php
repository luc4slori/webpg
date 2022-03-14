<?php
$rootDir = "..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;
$jsDir = $rootDir."js".DIRECTORY_SEPARATOR;
$actionsDir = $rootDir."actions".DIRECTORY_SEPARATOR;
$modelsDir = $rootDir."models".DIRECTORY_SEPARATOR;
$utilsDir = $rootDir."utils".DIRECTORY_SEPARATOR;
require_once($utilsDir."request.php");

function sendResponse($response){
    echo json_encode($response);
}

function getSslPage($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function go($site, $fileNameSrc, $localDir, $fileNameDst) {
        $path = $localDir.$fileNameDst;    
        $source = "https://".$site."/".$fileNameSrc;
        $content = getSslPage($source);
        file_put_contents($path,$content);
        sendResponse(array(
                "error" => false,
                "source" => $source,
                "path" => $path,
                "content" => $content
                
        ));
    
}   

function hasLen ($string){
    return  strlen(trim($string)) > 0;
}

$request = new Request();
$site = $request->site;
$dir = $request->dir;
$fileNameSrc = $request->fileNameSrc;
$fileNameDst = $request->fileNameDst;
$path = false;
$error = false;
if (hasLen($site) && hasLen($dir) && hasLen($fileNameSrc) && hasLen($fileNameDst) ){
    switch($dir){
    	case "root":
            $localDir = $rootDir;
            break; 
    	case "js":
            $localDir = $jsDir;
            break;   
         case "actions":
            $localDir = $actionsDir;
            break;
    	case "models":
            $localDir = $modelsDir;
            break; 
        case "utils":
            $localDir = $utilsDir;
            break;
        default:
            $error = true;
            sendResponse(array(
                "error" => true,
                "mensaje" => "bad dir"
            ));
        break;
    }
} else {
    $error = true;
    sendResponse(array(
        "error" => true,
        "mensaje" => "missing parameters"
    ));
    
}

if (!$error){
    go($site, $fileNameSrc, $localDir, $fileNameDst);
    
}







