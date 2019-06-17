<?php
require 'sesion.php';
$target_dir = "img/users/";
$target_filedefault = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_filedefault, PATHINFO_EXTENSION);
$target_file = "$target_dir$nombreUsuario$codUsuario.png";
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no tiene un formato de imagen soportado";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "El archivo ya existe en el servidor.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "La imagen es demasiado grande.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Sólo se permiten imágenes del tipo JPG, JPEG, PNG y/o GIF";
    $uploadOk = 0;
}
if ($uploadOk = 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        header('location:perfil.php');
    }
} else {
    echo "Se ha producido un error al subir la imagen.";
}
?>
