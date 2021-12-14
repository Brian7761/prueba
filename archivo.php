<?php

 $nombre = $_POST["nombre"];        
 $apellido = $_POST["apellido"];        
 $edad  = $_POST["edad"];    
 $finalName = $_FILES['imagen']['name']; 
 
 if($finalName === ''){
  $finalName="default.png";
  }    
  if($nombre === '' || $apellido === '' || !preg_match('/\.(jpg|png|webp|gif)$/i', $finalName)){
    echo json_encode('error');
    exit;
}else{
  $array = array("nombre" => $nombre, "apellido" => $apellido, "edad" => $edad, "finalName" => $finalName);
  echo json_encode('Correcto: <br> '.$nombre.', su archivo se creo satisfatoriamente');
}
 

 
 if(file_exists("personas.json")){
     $contenido = file_get_contents("personas.json");
     $data = json_decode($contenido);
       array_push($data, $array);
     file_put_contents("personas.json", json_encode($data));
 }else {
     $data = array();
     array_push($data, $array);
     $f = fopen("personas.json", "w");
     fwrite($f, json_encode($data));
      fclose($f);
 }

 crearMinitura($_FILES['imagen']['name']);

function crearMinitura($nombreArchivo){
    $finalWidth = 177;
    $dirFullImage = 'imagenes/full/';
    $dirMini = 'imagenes/mini/';
    $tmpName = $_FILES['imagen']['tmp_name'];
    $finalName = $dirFullImage . $_FILES['imagen']['name'];
    //copair imag a la carpeta full
    copiarImagen($tmpName, $finalName);

    $im = null;

    if(preg_match('/[.](jpg)$/', $nombreArchivo)){
       $im = imagecreatefromjpeg($finalName);
    }else if(preg_match('/[.](gif)$/', $nombreArchivo)){
       $im = imagecreatefromgif($finalName);
    }else if(preg_match('/[.](webp)$/', $nombreArchivo)){
       $im = imagecreatefromwebp($finalName);
    }else if(preg_match('/[.](png)$/', $nombreArchivo)){
       $im = imagecreatefrompng($finalName);
    }   
     if(!file_exists($dirMini)){
        if(!mkdir($dirMini)){
            die("Hubo un error con la img");
        }
    }
else{
         error_reporting(0);
    $width = imagesx($im);
    $height = imagesy($im);

    $minWidth = $finalWidth;
    $minHeight = floor($height * ($finalWidth / $width));

    $imageTrueColor = imagecreatetruecolor($minWidth, $minHeight);
    imagecopyresized($imageTrueColor, $im, 0, 0, 0, 0, $minWidth, $minHeight, $width, $height);

    } imagejpeg($imageTrueColor, $dirMini . $nombreArchivo);
}
function copiarImagen($origen, $destino){
    move_uploaded_file($origen, $destino);
}
$urlActual = getcwd();
$url = $urlActual.'/imagenes/full';
$arrayArchivos = scandir($url);

for($i=0; $i < count($arrayArchivos); $i++ ){
    $urlArchivo = $url.'/'.$arrayArchivos[$i];
    if (file_exists($urlArchivo) &&  $arrayArchivos[$i]!='.' && $arrayArchivos[$i]!='..' ) {
        $success = unlink($urlArchivo);
    }

}