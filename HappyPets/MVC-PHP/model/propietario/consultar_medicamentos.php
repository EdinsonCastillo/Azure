
<?php
    session_start();
    require_once("../../db/connection.php");
	include("../../controller/validarSesion.php");
	$sql = "SELECT * FROM usuario, tipo_usuario WHERE email = '".$_SESSION['usuario']."' AND usuario.id_tipousu = tipo_usuario.id_tipousu";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
	$idusuario = $usua['id_usu'];
    $idvisita = $_GET['idvisita'];
    
?>
<form method="POST">

        <table id="tabla" class="t1" cellspacing="1" cellpadding="2"   width="100%" >
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
						
					</span>
				</td>	
		
		</table>

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
    <script type="text/javascript" src="tablecloth/tablecloth.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Modulo Funcionario- Asignar Medicamento</title>
</head>
    <body>
    <div >
        <table class="t3" id="tabla" cellspacing="1" cellpadding="2" width="100%" border ="0" >
            <thead   width:"100%">
            <tr align="left"> 
                <th width="40%" colspan="3"><label for="first_name" class="required">Medicamentos  Asignados</label></th>
            </tr>
                <tr>        
                    <th><font face="Arial"> Codigo</font></th>
                    <th><font face="Arial"> Nombre Medicamento </font></th>
                    <th><font face="Arial"> Especificaciones</font></th>        
                </tr>
            </thead>
                <?php
                $sql2 = "SELECT * FROM recibos_medicina, medicamentos 
                          WHERE recibos_medicina.id_med = medicamentos.id_med AND recibos_medicina.id_vis = '$idvisita'";
                $medicamento = mysqli_query($mysqli, $sql2) or die(mysqli_error());                          
                while ($rows = mysqli_fetch_assoc($medicamento))	
                {           
            ?>
                <tr>  
                    <td><font face="Arial"><?php echo $rows['id_med']; ?></font></td>
                    <td><font face="Arial"><?php echo $rows['nombre_med']; ?></font></td>
                    <td><font face="Arial"><?php echo $rows['Especificaciones']; ?></font></td>                     
            <?php
                }
            ?>    
        </table>                                         
    </body>
</html>