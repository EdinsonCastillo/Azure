
<?php
    session_start();
    require_once("../../db/connection.php");
	include("../../controller/validarSesion.php");
	$sql = "SELECT * FROM usuario, tipo_usuario WHERE email = '".$_SESSION['usuario']."' AND usuario.id_tipousu = tipo_usuario.id_tipousu";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
	$idusuario = $usua['id_usu'];
    $idvisita = $_GET['idvisita'];
    $idmedicamento = "";


    if ((isset($_POST["MM_buscar"])) && ($_POST["MM_buscar"] == "form1")) 
    {
        /*   consulta tipo de usurio */
        $idmedicamento = $_POST['id_medi'];
        if ($idmedicamento== "" )
        {
                echo '<script>alert (" Datos Vacios");</script>';
        }
        else
        {
            $sql2 = "SELECT * FROM recibos_medicina WHERE id_med ='$idmedicamento' AND id_vis = '$idvisita'";
            $datos = mysqli_query($mysqli, $sql2) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($datos);	
            if ($usu)
            {
                echo '<script>alert (" El medicamento ya fué asignado a esta visita");</script>';
            }
            else
            {
                $sql7 = "INSERT INTO recibos_medicina (id_med, id_vis)
                        values ($idmedicamento,$idvisita)";
                $datos = mysqli_query($mysqli, $sql7) or die(mysqli_error());
                echo '<script>alert (" Insertado");</script>';
            }
        }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Modulo Funcionario- Asignar Medicamento</title>
</head>
    <body>
    <div class ="ing">
        <!---           FORM 1   ---  BUSCAR USUARIO  ---->
        <form method="POST" name="form1"  id="form1" autocomplete="off" >
            <table class="t1" id="tabla" cellspacing="1" cellpadding="2" width="100%" border ="0" >
                <tr align="left">   <!---           BÚSQUEDA POR USUARIO  ---->
                    <th width="40%"><label for="first_name" class="required">Insertar Medicamentos</label></th>
                    <th width="30%" align ="right"><label for="first_name" ></label></th>
                </tr>
                <tr>
                    <th width="40%">
                        <div class="form-input">
                            <label for="first_name" >Escoja Medicamento </label>
                            <input type="hidden" name="id_medi" id="id_medi"  />
                            <?php
                                $sql10 = "SELECT *  FROM medicamentos";
                                $tipo = mysqli_query($mysqli, $sql10) or die(mysqli_error());
                                $id = array();
                                $nom_medicamento = array();
                                $nom = "";
                                $i = 0;
                                $val = 0;
                                while ($tip = mysqli_fetch_assoc($tipo))
                                {
                                    $id[$i] =$tip['id_med'];
                                    $nom_medicamento[$i] = $tip['nombre_med'];                                                         
                                    $i = $i +1;                                            
                                }                                                                          
                            ?> 
                                <select class = "med" id="med" name= "med" >
                                    <option value ="0" selected  disabled="">-- Selecciona --</option>
                                    <?php
                                        for ($n = 0; $n<$i; $n++)
                                        {
                                                echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'">'.$id[$n].' - '.$nom_medicamento[$n].' </option>';
                                        }
                                    ?>              
                                </select>
                                <script type="text/javascript">
                                    $(document).on('change', 'select.med', function() 
                                    {
                                        var a = $('select.med option[value="'+$(this).val()+'"]').attr("data-typeid")
                                        document.getElementById('id_medi').value = a
                                    });
                                </script> 
                            <input type="submit" name="buscar" id="buscar" value="Asignar Medicamento"/>
                            <input type="hidden" name="operacion" value="1" />
                            <input type="hidden" name="MM_buscar" value="form1" />
                        </div>  
                    </th>
                </tr>
            </table>                              
        </form>  
                     
    </body>
</html>