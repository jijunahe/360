<?php
// Clase para la seccion content
class ClassFile
{
	// Funciopn para subir un video y cambiarlo de formato en el servidor
	public static function UploadVideoFile($name_input_file="", $carpeta="", $raiz_nuevo_nombre="", $th_img_video="")
	{
		$path = "../$carpeta";

		if($_FILES[$name_input_file]['name']){
			$file_size = $_FILES[$name_input_file]['size'];
			$ext = strrchr($_FILES[$name_input_file]['name'],'.');
			$limitedext = array( ".avi", ".flv", ".mpg", ".mpeg", ".mp4", ".mov");
			
			if(in_array(strtolower($ext),$limitedext)){
				$nombre_archivo = $_FILES[$name_input_file]['name'];
				if (is_uploaded_file($_FILES[$name_input_file]['tmp_name'])){
					// Nuevo nombre Imgaen
					$nombre = $raiz_nuevo_nombre.$ext;
					move_uploaded_file($_FILES[$name_input_file]['tmp_name'], "$path/$nombre");
					@chmod("$path/$nombre", 0777);
					
					//Cambiar el formato del archivo en caso de no ser FLV
					if(strtolower($ext)!=".flv"){
						$new_name = $raiz_nuevo_nombre.".flv";
						$new_name = "$path/$new_name";
						shell_exec('ffmpeg -i '."$path/$nombre".' -aspect 1.777777 -ar 22050 -ab 32 -f flv -s 320x240 '.$new_name);
						$ext = ".flv";
						$nombre = $raiz_nuevo_nombre.".flv";
					}
					
					//Generar la thub del video
					$nombre_thumb = $th_img_video.".jpg";
					shell_exec("ffmpeg -i $path/$nombre -an -ss 00:00:02 -s 140x100 $path/$nombre_thumb");
					
					// Para sitios multisitios
					if(isset($_SESSION['carpeta_sitio'])){
						$path = str_replace($_SESSION['carpeta_sitio']."/","",$path);
					}
		  
					//Retorno array con los parametros basicos necesaros
					return array("Status" => "Uploader", "Mensaje" => "Se subio el Archivo ".$nombre_archivo, "Ext" => $ext, "NameOriginal" => $nombre_archivo, "NameFile" => $nombre, "SizeFile" => $_FILES[$name_input_file]['size'], "URL" => "$path/$nombre", "Thumb" => "$path/$nombre_thumb");
				}else{
					return array("Status" => "Error", "Error" => "Problemas con la carpeta de upload del file");
				}
			}else{
				return array("Status" => "Error", "Error" => "La extencion del archivo no es valida");
			}
		}else{
			return array("Status" => "Error", "Error" => "No selected file");
		}
	}
	
	
	// Funciopn para subir un audio al servidor
	public static function UploadAudioFile($name_input_file="", $carpeta="", $raiz_nuevo_nombre="")
	{
		$path = "../$carpeta";

		if($_FILES[$name_input_file]['name']){
			$file_size = $_FILES[$name_input_file]['size'];
			$ext = strrchr($_FILES[$name_input_file]['name'],'.');
			$limitedext = array( ".mp3");
			
			if(in_array(strtolower($ext),$limitedext)){
				$nombre_archivo = $_FILES[$name_input_file]['name'];
				if (is_uploaded_file($_FILES[$name_input_file]['tmp_name'])){
					// Nuevo nombre Imgaen
					$nombre = $raiz_nuevo_nombre.$ext;
					move_uploaded_file($_FILES[$name_input_file]['tmp_name'], "$path/$nombre");
					@chmod("$path/$nombre", 0777);
					
					// Para sitios multisitios
					if(isset($_SESSION['carpeta_sitio'])){
						$path = str_replace($_SESSION['carpeta_sitio']."/","",$path);
					}
					
					//Retorno array con los parametros basicos necesaros
					return array("Status" => "Uploader", "Mensaje" => "Se subio el Archivo ".$nombre_archivo, "Ext" => $ext, "NameOriginal" => $nombre_archivo, "NameFile" => $nombre, "SizeFile" => $_FILES[$name_input_file]['size'], "URL" => "$path/$nombre", "Thumb" => "");
				}else{
					return array("Status" => "Error", "Error" => "Problemas con la carpeta de upload del file");
				}
			}else{
				return array("Status" => "Error", "Error" => "La extencion del archivo no es valida");
			}
		}else{
			return array("Status" => "Error", "Error" => "No selected file");
		}
	}
	
	
	// Funciopn para subir un arhivo al servidor
	public static function UploadDescargaFile($name_input_file="", $carpeta="", $raiz_nuevo_nombre="")
	{
		$path = "../$carpeta";

		if($_FILES[$name_input_file]['name']){
			$file_size = $_FILES[$name_input_file]['size'];
			$ext = strrchr($_FILES[$name_input_file]['name'],'.');
			$nombre_archivo = $_FILES[$name_input_file]['name'];
			
			if (is_uploaded_file($_FILES[$name_input_file]['tmp_name'])){
				// Nuevo nombre Imgaen
				$nombre = $raiz_nuevo_nombre.$ext;
				move_uploaded_file($_FILES[$name_input_file]['tmp_name'], "$path/$nombre");
				@chmod("$path/$nombre", 0777);
				
				// Para sitios multisitios
				if(isset($_SESSION['carpeta_sitio'])){
					$path = str_replace($_SESSION['carpeta_sitio']."/","",$path);
				}
					
				//Retorno array con los parametros basicos necesaros
				return array("Status" => "Uploader", "Mensaje" => "Se subio el Archivo ".$nombre_archivo, "Ext" => $ext, "NameOriginal" => $nombre_archivo, "NameFile" => $nombre, "SizeFile" => $_FILES[$name_input_file]['size'], "URL" => "$path/$nombre", "Thumb" => "");
			}else{
				return array("Status" => "Error", "Error" => "Problemas con la carpeta de upload del file");
			}

		}else{
			return array("Status" => "Error", "Error" => "No selected file");
		}
	}
	
	// Funciopn para subir una imagen al servidor
	public static function UploadSwfFile($name_input_file="", $carpeta="", $raiz_nuevo_nombre="")
	{
		$path = "../$carpeta";

		if($_FILES[$name_input_file]['name']){
			$file_size = $_FILES[$name_input_file]['size'];
			$ext = strrchr($_FILES[$name_input_file]['name'],'.');
			$limitedext = array( ".swf");
			
			if(in_array(strtolower($ext),$limitedext)){
				$nombre_archivo = $_FILES[$name_input_file]['name'];
				if (is_uploaded_file($_FILES[$name_input_file]['tmp_name'])){
					// Nuevo nombre Imgaen
					$nombre = $raiz_nuevo_nombre.$ext;
					move_uploaded_file($_FILES[$name_input_file]['tmp_name'], "$path/$nombre");
					@chmod("$path/$nombre", 0777);
					
					// Para sitios multisitios
					if(isset($_SESSION['carpeta_sitio'])){
						$path = str_replace($_SESSION['carpeta_sitio']."/","",$path);
					}
					
					//Retorno array con los parametros basicos necesaros
					return array("Status" => "Uploader", "Mensaje" => "Se subio el Archivo ".$nombre_archivo, "Ext" => $ext, "NameOriginal" => $nombre_archivo, "NameFile" => $nombre, "SizeFile" => $_FILES[$name_input_file]['size'], "URL" => "$path/$nombre", "Thumb" => "N/A");
				}else{
					return array("Status" => "Error", "Error" => "Problemas con la carpeta de upload del file");
				}
			}else{
				return array("Status" => "Error", "Error" => "La extencion del archivo no es valida");
			}
		}else{
			return array("Status" => "Error", "Error" => "No selected file");
		}
	}
	
	// Funciopn para subir una imagen al servidor
	public static function UploadImagenFileImg($name_input_file="", $carpeta="", $raiz_nuevo_nombre="", $th_img_imagen="", $width=0, $height=0)
	{
		$path = "../$carpeta";

		if($_FILES[$name_input_file]['name']){
			$file_size = $_FILES[$name_input_file]['size'];
			$ext = strrchr($_FILES[$name_input_file]['name'],'.');
			$limitedext = array( ".jpg", ".png", ".gif", ".jpeg");
			
			if(in_array(strtolower($ext),$limitedext)){
				$nombre_archivo = $_FILES[$name_input_file]['name'];
				if (is_uploaded_file($_FILES[$name_input_file]['tmp_name'])){
					// Nuevo nombre Imgaen
					$nombre = $raiz_nuevo_nombre.$ext;
					move_uploaded_file($_FILES[$name_input_file]['tmp_name'], "$path/$nombre");
					@chmod("$path/$nombre", 0777);
					
					
					//generamos la Thumb de la imagen
					$thumb = PhpThumbFactory::create( "$path/$nombre" );
					$thumb->resize( 385,515 );
					if(strtolower($ext)=='.png' || strtolower($ext)=='.PNG'){
					  $thumb->save( "$path/".$th_img_imagen.'.png', 'png' );
					}else if(strtolower($ext)=='.jpg' || strtolower($ext)=='.jpeg' || strtolower($ext)=='.JPG' || strtolower($ext)=='.JPEG'){
					  $thumb->save( "$path/".$th_img_imagen.'.jpg', 'jpg' );
					}else if(strtolower($ext)=='.gif' || strtolower($ext)=='.GIF'){
					  $thumb->save( "$path/".$th_img_imagen.'.gif', 'gif' );
					}
					
 					
					// Para sitios multisitios
					if(isset($_SESSION['carpeta_sitio'])){
						$path = str_replace($_SESSION['carpeta_sitio']."/","",$path);
					}
					
					//Retorno array con los parametros basicos necesaros
					return array("Status" => "Uploader", "Mensaje" => "Se subio el Archivo ".$nombre_archivo, "Ext" => $ext, "NameOriginal" => $nombre_archivo, "NameFile" => $nombre, "SizeFile" => $_FILES[$name_input_file]['size'], "URL" => "$path/$nombre", "Thumb" => $th_img_imagen.$ext);
				}else{
					return array("Status" => "Error", "Error" => "Problemas con la carpeta de upload del file");
				}
			}else{
				return array("Status" => "Error", "Error" => "La extencion del archivo no es valida");
			}
		}else{
			return array("Status" => "Error", "Error" => "No selected file");
		}
	}
	
	
	// Funciopn para subir una imagen al servidor
	public static function UploadImagenFileLookBook($name_input_file="", $carpeta="", $raiz_nuevo_nombre="", $th_img_imagen="", $width=0, $height=0)
	{
		$path = "../$carpeta";

		if($_FILES[$name_input_file]['name']){
			$file_size = $_FILES[$name_input_file]['size'];
			$ext = strrchr($_FILES[$name_input_file]['name'],'.');
			$limitedext = array( ".jpg", ".png", ".gif", ".jpeg");
			
			if(in_array(strtolower($ext),$limitedext)){
				$nombre_archivo = $_FILES[$name_input_file]['name'];
				if (is_uploaded_file($_FILES[$name_input_file]['tmp_name'])){
					// Nuevo nombre Imgaen
					$nombre = $raiz_nuevo_nombre.$ext;
					move_uploaded_file($_FILES[$name_input_file]['tmp_name'], "$path/$nombre");
					@chmod("$path/$nombre", 0777);
					
					
					//generamos la Thumb de la imagen
					$thumb = PhpThumbFactory::create( "$path/$nombre" );
					$thumb->adaptiveResize( 385,515 );
					if(strtolower($ext)=='.png' || strtolower($ext)=='.PNG'){
					  $thumb->save( "$path/385_".$th_img_imagen.'.png', 'png' );
					}else if(strtolower($ext)=='.jpg' || strtolower($ext)=='.jpeg' || strtolower($ext)=='.JPG' || strtolower($ext)=='.JPEG'){
					  $thumb->save( "$path/385_".$th_img_imagen.'.jpg', 'jpg' );
					}else if(strtolower($ext)=='.gif' || strtolower($ext)=='.GIF'){
					  $thumb->save( "$path/385_".$th_img_imagen.'.gif', 'gif' );
					}
					
					$thumb = PhpThumbFactory::create( "$path/$nombre" );
					$thumb->adaptiveResize( 140, 186 );
					if(strtolower($ext)=='.png' || strtolower($ext)=='.PNG'){
					  $thumb->save( "$path/140_".$th_img_imagen.'.png', 'png' );
					}else if(strtolower($ext)=='.jpg' || strtolower($ext)=='.jpeg' || strtolower($ext)=='.JPG' || strtolower($ext)=='.JPEG'){
					  $thumb->save( "$path/140_".$th_img_imagen.'.jpg', 'jpg' );
					}else if(strtolower($ext)=='.gif' || strtolower($ext)=='.GIF'){
					  $thumb->save( "$path/140_".$th_img_imagen.'.gif', 'gif' );
					}
					
					
					$thumb = PhpThumbFactory::create( "$path/$nombre" );
					$thumb->adaptiveResize( 117, 155 );
					if(strtolower($ext)=='.png' || strtolower($ext)=='.PNG'){
					  $thumb->save( "$path/117_".$th_img_imagen.'.png', 'png' );
					}else if(strtolower($ext)=='.jpg' || strtolower($ext)=='.jpeg' || strtolower($ext)=='.JPG' || strtolower($ext)=='.JPEG'){
					  $thumb->save( "$path/117_".$th_img_imagen.'.jpg', 'jpg' );
					}else if(strtolower($ext)=='.gif' || strtolower($ext)=='.GIF'){
					  $thumb->save( "$path/117_".$th_img_imagen.'.gif', 'gif' );
					}
					
					
					$thumb = PhpThumbFactory::create( "$path/$nombre" );
					$thumb->adaptiveResize( 56, 76 );
					if(strtolower($ext)=='.png' || strtolower($ext)=='.PNG'){
					  $thumb->save( "$path/56_".$th_img_imagen.'.png', 'png' );
					}else if(strtolower($ext)=='.jpg' || strtolower($ext)=='.jpeg' || strtolower($ext)=='.JPG' || strtolower($ext)=='.JPEG'){
					  $thumb->save( "$path/56_".$th_img_imagen.'.jpg', 'jpg' );
					}else if(strtolower($ext)=='.gif' || strtolower($ext)=='.GIF'){
					  $thumb->save( "$path/56_".$th_img_imagen.'.gif', 'gif' );
					}
					
					
					// Para sitios multisitios
					if(isset($_SESSION['carpeta_sitio'])){
						$path = str_replace($_SESSION['carpeta_sitio']."/","",$path);
					}
					
					//Retorno array con los parametros basicos necesaros
					return array("Status" => "Uploader", "Mensaje" => "Se subio el Archivo ".$nombre_archivo, "Ext" => $ext, "NameOriginal" => $nombre_archivo, "NameFile" => $nombre, "SizeFile" => $_FILES[$name_input_file]['size'], "URL" => "$path/$nombre", "Thumb" => $th_img_imagen.$ext);
				}else{
					return array("Status" => "Error", "Error" => "Problemas con la carpeta de upload del file");
				}
			}else{
				return array("Status" => "Error", "Error" => "La extencion del archivo no es valida");
			}
		}else{
			return array("Status" => "Error", "Error" => "No selected file");
		}
	}
	
	
	
	// Funciopn para subir una imagen al servidor
	public static function UploadImagenFile($name_input_file="", $carpeta="", $raiz_nuevo_nombre="", $th_img_imagen="", $width=0, $height=0)
	{
		$path = "../$carpeta";

		if($_FILES[$name_input_file]['name']){
			$file_size = $_FILES[$name_input_file]['size'];
			$ext = strrchr($_FILES[$name_input_file]['name'],'.');
			$limitedext = array( ".jpg", ".png", ".gif", ".jpeg");
			
			if(in_array(strtolower($ext),$limitedext)){
				$nombre_archivo = $_FILES[$name_input_file]['name'];
				if (is_uploaded_file($_FILES[$name_input_file]['tmp_name'])){
					// Nuevo nombre Imgaen
					$nombre = $raiz_nuevo_nombre.$ext;
					move_uploaded_file($_FILES[$name_input_file]['tmp_name'], "$path/$nombre");
					@chmod("$path/$nombre", 0777);
					
					
					//generamos la Thumb de la imagen
					$thumb = PhpThumbFactory::create( "$path/$nombre" );
					$thumb->adaptiveResize( $width, $height );
					if(strtolower($ext)=='.png' || strtolower($ext)=='.PNG'){
					  $thumb->save( "$path/".$th_img_imagen.'.png', 'png' );
					}else if(strtolower($ext)=='.jpg' || strtolower($ext)=='.jpeg' || strtolower($ext)=='.JPG' || strtolower($ext)=='.JPEG'){
					  $thumb->save( "$path/".$th_img_imagen.'.jpg', 'jpg' );
					}else if(strtolower($ext)=='.gif' || strtolower($ext)=='.GIF'){
					  $thumb->save( "$path/".$th_img_imagen.'.gif', 'gif' );
					}
					
					
					// Para sitios multisitios
					if(isset($_SESSION['carpeta_sitio'])){
						$path = str_replace($_SESSION['carpeta_sitio']."/","",$path);
					}
					
					//Retorno array con los parametros basicos necesaros
					return array("Status" => "Uploader", "Mensaje" => "Se subio el Archivo ".$nombre_archivo, "Ext" => $ext, "NameOriginal" => $nombre_archivo, "NameFile" => $nombre, "SizeFile" => $_FILES[$name_input_file]['size'], "URL" => "$path/$nombre", "Thumb" => $th_img_imagen.$ext);
				}else{
					return array("Status" => "Error", "Error" => "Problemas con la carpeta de upload del file");
				}
			}else{
				return array("Status" => "Error", "Error" => "La extencion del archivo no es valida");
			}
		}else{
			return array("Status" => "Error", "Error" => "No selected file");
		}
	}
	
	
	// Funcion para subir un audio al servidor
	public static function GenerarImagenWH( $imagen="", $nuevaImagen="", $ext="", $width=0, $height=0)
	{
		$varReturn = false;
		//Generamos la nueva imagen
		$thumb = PhpThumbFactory::create( $imagen );
		$thumb->adaptiveResize( $width, $height);
		if(strtolower($ext)=='.png'){
			$thumb->save( $nuevaImagen, 'png' );
			$varReturn = $nuevaImagen;
		}else if(strtolower($ext)=='.jpg' || strtolower($ext)=='.jpeg'){
			$thumb->save( $nuevaImagen, 'jpg' );
			$varReturn = $nuevaImagen;
		}else if(strtolower($ext)=='.gif'){
			$thumb->save( $nuevaImagen, 'gif' );
			$varReturn = $nuevaImagen;
		}
		return $varReturn;
	}
	
	
	
	
	
	
}
?>