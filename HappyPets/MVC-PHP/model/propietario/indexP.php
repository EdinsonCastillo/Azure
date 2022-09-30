
<?php
    session_start();
    require_once("../../db/connection.php");
	include("../../controller/validarSesion.php");
	$sql = "SELECT * FROM usuario, tipo_usuario WHERE email = '".$_SESSION['usuario']."' AND usuario.id_tipousu = tipo_usuario.id_tipousu";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
	$idusuario = $usua['id_usu'];

	$idvisita       = "";
	$idveterinario   =  "";
	$nombrevet       =  "";
	$idmascota       =  "";
	$idestado        =  "";
	$temp            =  "";
	$peso            = "";
	$fr_res          =  "";
	$fr_car          = "";
	$recomendaciones =  ""; 
	$fechavisita     =  "";
	$costo           = ""; 
	$idmascotab ="";

	if ((isset($_POST["MM_buscar"])) && ($_POST["MM_buscar"] == "form1")) 
    {
        $idmascotab = $_POST['idmascota'];
	}

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
					<a href="../../controller/salir.php"><img src="../../controller/image/salir.png" width=30></a>
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/estilospan.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="tablecloth/tablecloth.js"></script>
    <title>Funcionarios - Usuarios</title>
</head>
    <body style="background-image: url('img/header1.jpg');">
	    <div class = "ingreso" witdh =100%> 
			<table class="t2" border="0" cellspacing="2" cellpadding="2" >
						<tr>						
							<th  align ="left"><font face="Arial"><h2>Propietarios</h2></font></th>
							
							<th align ="right"><font face="Arial">
								<a> <?php  echo "<a href='actualizausu.php?user= $idusuario'>Actualizar datos</a>"?></a></font></th>
					</tr>
			</table>
		</div>
		<div class = "imagen" witdh =100%> 
    
		</div>
		<div class = "encabezado">   

				<table class="t3" border="0" cellspacing="2" cellpadding="2" >

					<thead   width:"100%">
						<tr width:"100%" >
				  			<td colspan="7"><h1><label id ="label" for="mascota" class="required">Mascotas</label></h1></td>
			   		    </tr>
						<tr>													
							<th><font face="Arial"> Id Mascota</font></th>
							<th><font face="Arial"> Nombre</font></th>
							<th><font face="Arial"> Color </font></th>
							<th><font face="Arial"> Especie </font></th>
							<th><font face="Arial"> Raza </font></th>
							<th><font face="Arial"> Id Veterinario </font></th>
							<th><font face="Arial">Visitas</font></th>
						</tr>
					</thead>
					<tbody> 
						<?php
							$sql2 = "SELECT     
							T.tipomas AS TIPO_MASCOTA,
							T.id_tipomas AS IDTIPO_MAS,
							M.id_mascli AS ID,
							M.id_usu AS IDUSU,
							M.nombre AS NOMBRE_MASCOTA, 
							M.color AS COLOR, 
							M.especie AS ESPECIE, 
							M.raza AS RAZA_MASCOTA,
							M.id_vet AS ID_VETERINARIO,
							concat(P.Nombres,' ', P.Apellidos) AS NOMBRE_PROPIETARIO
						
								
						FROM mascota_cliente M, tipo_mascota T, usuario P WHERE
								T.id_tipomas = M.id_tipomas AND M.id_usu = P.id_usu AND M.id_usu ='$idusuario'
						ORDER BY  M.id_mascli ASC ";                         
							$pet = mysqli_query($mysqli, $sql2) or die(mysqli_error());                          
							$i = 1;
							while ($rows = mysqli_fetch_assoc($pet))	
							{					
						?>
						<tr>    
								<td><font face="Arial"><?php echo $rows['ID']; ?></font></td>
								<td><font face="Arial"><?php echo $rows['NOMBRE_MASCOTA']; ?></font></td>
								<td><font face="Arial"><?php echo $rows['COLOR']; ?></font></td>
								<td><font face="Arial"><?php echo $rows['ESPECIE']; ?></font></td>
								<td><font face="Arial"><?php echo $rows['RAZA_MASCOTA']; ?></font></td>
								<td><font face="Arial"><?php echo $rows['ID_VETERINARIO']; ?></font></td>
								<td><font face="Arial">
			<form method="POST" name="form1"  id="form1"> 
								<?php 
								  $valor ="consulta".$i;
								?>
                                  
							<button type="button" class ="inp"  name=<?php echo $valor ?> id="<?php echo $rows['ID']; ?>" >Buscar</button>
								</td>	
						</tr> 
						<?php
						     $i++;
							}
							
						?>  
						    <input type = "hidden" name ="idmascota" id="idmascota"/>
						    <input type = "hidden" name="MM_buscar" value="form1" />
					    	<input  type="submit" name="buscar" id="buscar" value= "buscar" hidden /></font>		
							
						<label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
					</tbody>
				</table>
			</form>
			
			<script src="~/Scripts/jquery.unobtrusive-ajax.min.js"></script>
			<script type="text/javascript">
               var botones = document.getElementsByClassName('inp');
				for(var i = 0; i < botones.length; i++){
				botones[i].addEventListener('click', capturar);
				}
					function capturar(){
					var a = this.id;
					document.getElementById('idmascota').value = a;
					document.getElementById('buscar').click();
				}
			</script>
		</div>  
		<div class = "general"> 
		   
            <table class="t3" border="0" cellspacing="2" cellpadding="2" >
                <thead   width:"100%">
				<tr width:"100%" >
				  <td colspan="13"><h1><label id ="label" for="mascota" class="required">Visitas por Mascota</label></h1></td>
			    </tr>
                <tr>
						<th><font face="Arial"> No Visita </font></th>
						<th><font face="Arial"> Nombre Veterinario </font></th>
						<th><font face="Arial"> Id Mascota</font></th>
						<th><font face="Arial"> Nombre Mascota</font></th>
						<th><font face="Arial"> Estado Mascota </font></th>
						<th><font face="Arial"> Temperatura </font></th>
						<th><font face="Arial"> Peso</font></th>
						<th><font face="Arial"> Fre Respiratoria </font></th>
						<th><font face="Arial"> Fre Cardiaca </font></th>
						<th><font face="Arial"> Recomendaciones </font></th>
						<th><font face="Arial"> Fecha Visita </font></th>
						<th><font face="Arial"> Costo Visita </font></th>
						<th><font face="Arial"> Medicamentos </font></th>                
                </tr>
			<?php
				$sql2 = "SELECT 
					V.id_vis AS No_Visita,
					V.id_vet AS Id_Veterinario,
					concat (U.Nombres, ' ' , U.Apellidos) AS Nombre_Veterinario,
					V.id_mascli AS Id_Mascota,
					V.id_est AS Estado_Mascota,
					V.temperatura AS Temp,
					V.peso  AS Peso,
					V.fre_res AS Fre_Respiratoria,
					V.fre_car AS Fre_Cardiaca,
					V.recomendaciones AS Recomendaciones,
					V.fecha_vis AS Fecha_Visita,
					V.costo_visita AS Costo,
					E.estado AS Estado_Mascota,
					M.id_usu AS ID_USU,
					M.nombre AS Nombre_Mascota,
					M.id_mascli AS Id_mascliente
				FROM visitas V, usuario U, estado E, mascota_cliente M
				WHERE v.id_vet = U.id_usu AND V.id_mascli = M.id_mascli AND V.id_est = E.id_est 
				AND V.id_mascli = '$idmascotab' AND M.id_usu = '$idusuario'  ";
					$pet = mysqli_query($mysqli, $sql2) or die(mysqli_error());                          
				
					while ($rows = mysqli_fetch_assoc($pet))	
					{
					
					$idvisita = $rows['No_Visita']; 
					$nombrevet =$rows['Nombre_Veterinario']; 
					$idmascota =$rows['Id_Mascota']; 
					$nombremascota =$rows['Nombre_Mascota']; 
					$idestado  =$rows['Estado_Mascota']; 
					$temp 	   =$rows['Temp']; 
					$peso      =$rows['Peso']; 
					$fr_res    =$rows['Fre_Respiratoria']; 
					$fr_car    =$rows['Fre_Cardiaca']; 
					$recomendaciones =$rows['Recomendaciones']; 
					$fechavisita   =$rows['Fecha_Visita']; 
					$costo	   =$rows['Costo']; 
					
					?>        
                     </thead>
                     <tbody> 
                    <tr>  
                        <td><font face="Arial"><?php echo $idvisita ?></font></td>
                        <td><font face="Arial"><?php echo $nombrevet?></font></td>
                        <td><font face="Arial"><?php echo $idmascota ?></font></td>
						<td><font face="Arial"><?php echo $nombremascota ?></font></td>
                        <td><font face="Arial"><?php echo $idestado ?></font></td>
                        <td><font face="Arial"><?php echo $temp ?></font></td>
                        <td><font face="Arial"><?php echo $peso ?></font></td>
                        <td><font face="Arial"><?php echo $fr_res ?></font></td>
                        <td><font face="Arial"><?php echo $fr_car ?></font></td>
                        <td><font face="Arial"><?php echo $recomendaciones ?></font></td>
                        <td><font face="Arial"><?php echo $fechavisita ?></font></td>
                        <td><font face="Arial"><?php echo $costo ?></font></td> 
						<td><button type="button" class ="consulta"  name=""  id="<?php echo $rows['No_Visita']; ?>" >Consultar</button>
                            </td>
						
                    </tr>  
					<?php
					}
                    ?>  
                    <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                    </tbody>
            </table>

			<script src="~/Scripts/jquery.unobtrusive-ajax.min.js"></script>
			
            <script type="text/javascript">
               var botones = document.getElementsByClassName('consulta');
				for(var i = 0; i < botones.length; i++){
				botones[i].addEventListener('click', capturar);
				}
					function capturar(){
					var a = this.id;
                    var enlace = "consultar_medicamentos.php?idvisita="+a;
                    window.open(enlace,"Consultar Medicamento","width=1120,height=300,scrollbars=NO","top =10", "left=10"); 
				}
			</script>

        </div>           
    </body>
</html>