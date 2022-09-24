
<?php
    session_start();
    require_once("../../db/connection.php");
	include("../../controller/validarSesion.php");
	$sql = "SELECT * FROM usuario, tipo_usuario WHERE email = '".$_SESSION['usuario']."' AND usuario.id_tipousu = tipo_usuario.id_tipousu";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
	$idusuario = $usua['id_usu'];
    $usubus = "";   
    $id = array();

    if ((isset($_POST["MM_buscar"])) && ($_POST["MM_buscar"] == "form1")) 
    {
        $idbus = $_POST['idmed'];
        if ($idbus== "" )
        {
                    $idmed = "";
                    $nombremedicamentos="";
                    $Especificaciones="";
                echo '<script>alert (" Datos Vacios no ingreso la Clave");</script>';
        }
        else
        {
            $sql3 = "SELECT * FROM medicamentos WHERE id_med ='$idbus'";
            $tipou = mysqli_query($mysqli, $sql3) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($tipou);	
                if ($usu)
                {
                    $idmed = $usu['id_med'];
                    $nombremedicamentos=  $usu['nombre_med'];
                    $Especificaciones= $usu['Especificaciones'];
                }   
                else 
                {
                    $idmed = "";
                    $nombremedicamentos= ""; 
                    $Especificaciones="";

                    echo '<script>alert (" El nombre de medicamentos no existe en la base de datos");</script>';                 
                }     
        }
    }

    elseif ((isset($_POST["insertar"])) && ($_POST["MM_insertar"] == "form4"))
    {
        if (($_POST['1']== "" )||($_POST['2']== "" )) // Valida si vienen campos vacios
        {   
            echo '<script>alert (" Datos Vacios. No se puede insertar registros");</script>';
        }
        else
        {
            $idmed= $_POST['1'];
            $nombremedicamentos = $_POST['2'];
            $Especificaciones=  $_POST['3'];
            $sql8 = "SELECT * FROM medicamentos WHERE id_med='$idmed'";
            $tipou= mysqli_query($mysqli, $sql8) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($tipou);
            if ($usu)
            {
            echo '<script>alert ("El id del medicamento ya existe");</script>'; 
            }
            else
            {


            $sql7 = "INSERT INTO medicamentos (id_med, nombre_med,Especificaciones) VALUES ('$idmed', '$nombremedicamentos','$Especificaciones')";
            mysqli_query($mysqli, $sql7) or die(mysqli_error());
           echo '<script>alert ("Se realizó la inserción correctamente");</script>';
            }   
        }
    }
         // Opción de edición de registros //
    if ((isset($_POST["editar"])) && ($_POST["MM_editar"] == "form4")) 
    {      
        if (($_POST['1']== "" )||($_POST['2']== "" ))
        {
            $idmed = "";
            $nombremedicamentos= ""; 
            $Especificaciones="";
            echo '<script>alert (" Datos Vacios. No se puede actualizar");</script>';
        }
        else
        {
            $idmed= $_POST['1'];
            $nombremedicamentos = $_POST['2'];
            $Especificaciones=  $_POST['3'];
            $sql8 = "SELECT * FROM medicamentos WHERE id_med='$idmed'";
            $tipou= mysqli_query($mysqli, $sql8) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($tipou);
            if ($usu)
            {

                
                $sql7 = "UPDATE medicamentos  SET nombre_med  = '$nombremedicamentos', Especificaciones ='$Especificaciones' WHERE id_med ='$idmed'";
                mysqli_query($mysqli, $sql7) or die(mysqli_error($mysqli));             
                echo '<script>alert (" Nombre de Medicamentos Actualizada");</script>';                   
            }
        }
    }

  // Opción de eliminación de registros //
    if ((isset($_POST["eliminar"])) && ($_POST["MM_eliminar"] == "form4")) 
    {
        //  consulta 
        if (($_POST['1']== "" )||($_POST['2']== "" ))
        {
            $idmed = "";
            $nombremedicamentos= ""; 
            $Especificaciones="";
            echo '<script>alert (" Datos Vacios. No se puede eliminar");</script>';
        }
        else
        {
            $idmed= $_POST['1'];
            $sql8 = "SELECT * FROM medicamentos WHERE id_med='$idmed'";
            $tipou= mysqli_query($mysqli, $sql8) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($tipou);
            if ($usu)
            {
        
                $sql7 = "DELETE  FROM medicamentos WHERE id_med = '$idmed'";
                mysqli_query($mysqli, $sql7) or die(mysqli_error($mysqli));
                if (mysqli_error($mysqli))
                {
                    echo '<script>alert (mysqli_error($mysqli));</script>';

                }
                echo '<script>alert (" Nombre de Medicamentos eliminado");</script>';
            }
        }
    }


    if(isset($_POST['btncerrar']))
    {
        session_destroy();
        header('location: ../../index.html');
    }
    if (isset($_POST["MM_buscar"])=="")
    {
        $idmed = "";
        $nombremedicamentos= ""; 
        $Especificaciones="";
    }      
?>
<!-- /*      FIN DE CONSULTAS EN PHP   */  -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilospan.css">
    <link rel="stylesheet" href="css/general.css">
    <script type="text/javascript" src="tablecloth/tablecloth.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Modulo Administrador - Gestión de Medicamentos</title>
</head>
    <body backgroud="#4444">
    <!-- Banner de login y credenciales  -->
    <table class="t1" id="tabla" cellspacing="1" cellpadding="2" width="100%">
        <td aling="center" width="10%">
            <span id="button-menu" class="fa fa-bars"> 
            <img src="img/iconpp.png" width=30>
            </span>
        </td>
        <td aling="center" width="60%">
            <h1>HAPPYPETS - Patitas sanas y colitas felices</h1>
        </td>
        <span class="usuario">
            <td aling="center" width="5%"><span class="usuario"> <?php echo $usua['Nombres']?></span></td>
            <td aling="center" width="5%">
                <span class="usuario">
                    <?php echo $usua['tipousu']?>
                </span>
            </td>
            <td aling="center" width="5%"><span class="usuario">
                    <a href="../../controller/salir.php"><img src="../../controller/image/salir.png" width=30></a>
                </span>
            </td>
    </table>
    <section class="title" >
       <table id="tablan" cellspacing="1" cellpadding="2" width="100%" >
            <tr>
                <td align="left"><h1 >&nbsp&nbsp&nbsp&nbspMÓDULO ADMINISTRADOR - GESTIÓN DE MEDICAMENTOS </h1></th>
                <td align="right" width ="40%" ><h2><a id= "regresar" href="indexA.php">Regresar&nbsp&nbsp&nbsp&nbsp&nbsp</a></h2></th>
            </tr>
        </table>       
    </section>
    <nav class="barra">
      <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label> 
    </nav>
    <div class ="ingreso">
            <!---           FORM 1   ---  BUSCAR TIPO USUARIO  ---->
        <table class="t1" id="tabla" cellspacing="1" cellpadding="2" width="100%" border ="0" >
            <form method="POST" name="form1"  id="form1" autocomplete="off" >
                <tr align="left">   <!---           FBÚSQUEDA POR TIPO USUARIO  <th width="40%" align ="right"></th>---->
                    <th width="30%"><label for="first_name" class="required">Búsqueda Por id  medicamento</label></th>
                    <th width="70%" align ="right"><label for="first_name" class="required">Operaciones</label></th>
                    
                </tr>
                <tr>
                    <th width="40%">
                        <div class="form-input">
                            <label for="first_name" class="required">Id Medicamento </label>
                            <input type="text" name="idmed" id="first_number" />
                            <input type="submit" name="buscar" id="buscar" value="Buscar"/>
                            <input type="hidden" name="operacion" value="1" />
                            <input type="hidden" name="MM_buscar" value="form1" />
                        </div>     
                    </th>
            </form> 
                    <th>         
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <div class="select-list">
                            <label (id ="label" for="mascota" class="required">Escoger operación: </label>  
                            <select class="form-control">
                                <option selected="" disabled="">-- Selecciona --</option>
                                <option data-typeid="1" value="1">Editar</option>
                                <option data-typeid="2" value="2">Eliminar</option>
                                <option data-typeid="3" value="3">Insertar</option>
                            </select>
                        </div>
                        <script type="text/javascript">
                            $(document).on('change', 'select.form-control', function() 
                            {
                            var a = $('select.form-control option[value="'+$(this).val()+'"]').attr("data-typeid")
                                if (a == 1) 
                                {
                                    document.getElementById('insertar').disabled = true
                                    document.getElementById('editar').disabled = false
                                    document.getElementById('eliminar').disabled = true
                                    document.getElementById('a').readOnly = true                                 
                                }
                                else if (a==3) 
                                {    
                                    document.getElementById('insertar').disabled = false
                                    document.getElementById('editar').disabled = true
                                    document.getElementById('eliminar').disabled = true
                                }
                                else if(a == 2)
                                {
                                    document.getElementById('eliminar').disabled = false
                                    document.getElementById('insertar').disabled = true
                                    document.getElementById('editar').disabled = true
                                    document.getElementById('a').readOnly = true  
                                }                               
                            });
                        </script>
                <!---           FORM 4   ---  INSERTAR, MODIFICAR Y ELIMINAR USUARIO  ---->
            <form method="POST" name="form4"  id="form4">                              
                        <div class="form-control">
                                <input type = "submit" name="editar" id="editar" value="Editar" disabled ="true" class="form-control"/>
                                <label for="first_name" class="required">&nbsp&nbsp</label>
                                <input type = "submit" name="eliminar" id="eliminar" value="Eliminar" disabled ="true" class="form-control"/>
                                <label for="first_name" class="required">&nbsp&nbsp</label>
                                <input type = "submit" name="insertar" id="insertar" value="Insertar" disabled ="true"/>
                                <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                <!-- <button type="button" id="btnin">Insertar</button>  -->
                        </div> 
                        <div class="form-input" align = "center">   
                            <input type = "hidden" name="MM_insertar" value="form4" />
                            <input type = "hidden" name="MM_editar" value="form4" />
                            <input type = "hidden" name="MM_eliminar" value="form4" />
                            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                        </div>
                    </th>
                </tr>
                <tr align = "center">
                    <th colspan="2" scope="rowgroup" align = "center">
                        <h2 align="center">NOMBRE DE MEDICAMENTOS  A PROCESAR</h2>
                    </th>
                </tr>
                <tr>
                    <div>
                        <table class="t2" border="1" cellspacing="2" cellpadding="2" >
                            <tr>
                                <th  width="30%"><font face="Arial"> Id Medicamentos </font></th>
                                <th  width="50%"><font face="Arial"> Nombre de Medicamentos </font></th> 
                                <th  width="50%"><font face="Arial"> Especificaciones </font></th>                           
                            </tr>
                            <tr font-size="1">    
                                <div style="visibility: hidden">
                                    <div class="form-control" style="visibility: hidden">             
                                        <td width="20%"><input class="control" type = "number" id = "a" name="1" style="width :150px; heigth : 1px" value= "<?php echo $idmed;?>" /></td>
                                        <td width="20%"><input class="control" type = "text" id = "b" name="2" style="width : 250px; heigth : 1px" value= "<?php echo $nombremedicamentos?>" /></td>
                                        <td width="20%"><input class="control" type = "text" id = "c" name="3" style="width : 250px; heigth : 1px" value= "<?php echo $Especificaciones?>" /></td>
                                        <input type = "hidden" id = "d" name="4" style="width : 250px; heigth : 1px" value= "<?php echo $nombre?>" />
                                    </div>
                                </div>
                            </tr>
                        </table>
                    </div>
                </td>
            </form>
        </table>
    </div>     
        <div class = "encabezado_izq">
          <h2 align="center">
                <label>Listado de Medicamentos</label>
          </h2>
        </div>
        <div class = "general_izq">   
            <div class = "marco1_izq"> 
                <table class="t2" border="1" cellspacing="2" cellpadding="2" width:"100%" >
                    <thead   width:"100%">
                        <tr>
                                
                            <th width="50%"><font face="Arial"> Id medicamentos </font></th>
                            <th width="50%"><font face="Arial"> Nombre de medicamentos </font></th>
                            <th width="50%"><font face="Arial"> Especificaciones </font></th>
                            
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            $sql2 = "SELECT * FROM medicamentos";
                            $user = mysqli_query($mysqli, $sql2) or die(mysqli_error());
                            while ($rows = mysqli_fetch_assoc($user))	
                            {                              
                        ?>
                        <tr>                            
                            <td><font face="Arial"><?php echo $rows['id_med']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['nombre_med']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['Especificaciones']; ?></font></td>
                        </tr> 
                        <?php
                            }
                        ?>     
                        <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                    </tbody>
                </table>
            </div>
        </div>
    <div class = "imagen_fondo_izq"> 
            <img src="img/pets2.jpg" width=100%>
    </div>                     
</body>

</html>

