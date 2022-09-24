
<?php
    session_start();
    require_once("../../db/connection.php");
	include("../../controller/validarSesion.php");
	$sql = "SELECT * FROM usuario, tipo_usuario WHERE email = '".$_SESSION['usuario']."' AND usuario.id_tipousu = tipo_usuario.id_tipousu";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
	$idusuario = $usua['id_usu'];


?>
<form method="POST">

        <table class="t1" id="tabla" cellspacing="1" cellpadding="2"   width="100%" >
		        <td aling="center"   width="10%" >
		           <span id="button-menu" class="fa fa-bars">  </span>	
                   <img src="img/iconpp.png" width=30>	
		        </td>
				<td aling="center"  width="60%"  > <h1>HAPPYPETS - Patitas sanas y colitas felices</h1></td>
					<span class="usuario">
				<td aling="center"   width="5%"><span class="usuario"> <?php echo $usua['Nombres']?></span></td>
				
				<td aling="center" width="5%" > 
						<span class="usuario"> 
							<?php echo $usua['tipousu']?>
						</span>
				</td>
				<td aling="center"   width="5%"><span class="usuario"> 
						<a href="../../controller/salir.php"><img src="../../controller/image/salir.png" width=30></a>
					</span>
				</td>	
		
		</table>
 <!--   <tr>
        <td colspan='2' align="center"><?php echo $usua['Nombres']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">    background="img/fondo1.jpg"
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="../index.php" value="Regresar" />
    </tr>
-->
</form>

<?php 

if(isset($_POST['btncerrar']))
{
	session_destroy();

   
    header('location: ../../index.html');
}
	
?>

</div>

</div>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilospan.css">
    <title>Modulo Administrador</title>
</head>
    <body>
        <section class="title" >
            <h1>ADMINISTRADOR - MENÚ PRINCIPAL</h1>
        </section>
    
        <nav class="navegacion">
           
            <ul class="menu wrapper" >
    
                <li class="first-item">
                    <a href="gestion_usuarios.php">
                        <img src="img/analisis.png" alt="" class="imagen">
                        <span class="text-item">GESTIÓN DE USUARIOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="gestion_mascotas.php">
                        <img src="img/ejecucion.png" alt="" class="imagen">
                        <span class="text-item">GESTIÓN DE MASCOTAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
               
    
                <li>
                    <a href="gestion_medicamentos.php">
                        <img src="img/planear.png" alt="" class="imagen">
                        <span class="text-item">GESTIÓN DE MEDICAMENTOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="gestion_afiliaciones.php">
                        <img src="img/header4.png" alt="" class="imagen">
                        <span class="text-item">GESTIÓN DE AFILIACIONES</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li class="first-item">
                    <a href="gestion_tipomascotas.php">
                        <img src="img/tipomas.jpg" alt="" class="imagen">
                        <span class="text-item">GESTIÓN DE TIPOS DE MASCOTAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
                <li>
                    <a href="../../controller/salir.php">
                        <img src="img/implementar.jpg" alt="" class="imagen">
                        <span class="text-item">SALIR</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    <!--
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 7</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 8</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 9</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 10</span>
                        <span class="down-item"></span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 11</span>
                        <span class="down-item"></span>
                    </a>
                </li>
-->
            </ul>
            
        </nav>
    </body>
</html>