<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipo_usuario WHERE email = '".$_SESSION['usuario']."' AND usuario.id_tipousu = tipo_usuario.id_tipousu";
$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
$usua = mysqli_fetch_assoc($usuarios);
//$idusuario = $usua['id_usu'];


    $control = "SELECT * From usuario WHERE id_usu = '".$_GET['user']."'";
    $query=mysqli_query($mysqli,$control);
    $fila=mysqli_fetch_assoc($query);
    if ($fila)
    {
        $idusu=     $fila['id_usu'];
        $nombre=    $fila['Nombres'];
        $apellido=  $fila['Apellidos'];
        $direccion=  $fila['Direccion'];
        $email   =   $fila['email'];
        $telefono=   $fila['Telefono'];
        $clave=     $fila['clave'];
    }

if ((isset($_POST["MM_edit"]))&&($_POST["MM_edit"]=="formreg"))
    {   
        $idusu=     $_POST['idusuario'];
        $nombre=    $_POST['Nombres'];
        $apellido=  $_POST['Apellidos'];
        $direccion=  $_POST['Direccion'];
        $email   =   $_POST['email'];
        $telefono=   $_POST['telefono'];
        $clave=     $_POST['clave'];
        $editsql="UPDATE usuario SET  Direccion = '$direccion', email = '$email',  Telefono = '$telefono', clave = '$clave' 
                  WHERE usuario.id_usu ='$idusu'";//." Seleccion Tipo U: ".$producto;
        mysqli_query($mysqli, $editsql) or die(mysqli_error($mysqli));
        echo '<script>alert (" Usuario Actualizado");</script>';
    }

     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <link rel="stylesheet" href="css/style1.css"> 
    <title>Actualización datos - Propietarios de Mascotas</title>
</head>
<body style="background-image: url('img/enfermera.jpg');">
      <a href="javascript: history.go(-1)">Volver</a>
    <div class="login-box">
        <img src="img/logo1.png" class="avatar" alt="Imagen Avar">
        <form method="POST" name="formreg" autocomplete="off" id="formreg">
            <h1 for="usuario"> ACTUALIZACIÓN DE USUARIO </h1> 
            <table id= "tabla"  cellspacing="10" cellpadding="2"  >
                <tr aling="center" >
                    <td><input type="text" id= "tipo" name="tipo"  value= "Documento: " Readonly></td>
                    <td><input type="number" name="idusuario" value = "<?php echo $idusu?>" Readonly></td>
                </tr>
                <tr aling="center">
                    <td><input type="text" name="Nombres" value = "<?php echo $nombre?>" Readonly></td>
                    <td><input type="text" name="Apellidos" value = "<?php echo $apellido?>" Readonly></td>
                </tr>
                <tr aling="center">
                    <td><input type="text" name="Direccion" placeholder="Ingrese la dirección de residencia" value = "<?php echo $direccion?>"></td>
                    <td><input type="number" name="telefono" placeholder="Ingrese el teléfono"value = "<?php echo $telefono?>"></td>
                </tr>
                <tr aling="center">
                    <td> <input id= "email" type="text" name="email" placeholder="Ingrese un email válido" Readonly value = "<?php echo $email?>"></td>
                    <td><input type="password" name="clave" placeholder="Ingrese una clave"  value = "<?php echo $clave?>"></td>    
                </tr>
            </table>
            <input type="submit" name="validar" value="Actualizar Datos" >
            <input type="hidden" name="MM_edit" value="formreg">
        </form>
    </div>
</body>
</html>