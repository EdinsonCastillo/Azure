
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
    $nombre = "";

    if ((isset($_POST["MM_buscar"])) && ($_POST["MM_buscar"] == "form1")) 
    {
        $idbus = $_POST['idtipom'];
        if ($idbus== "" )
        {
                    $idtipomas = "";
                    $tipomas=   "";
                echo '<script>alert (" Datos Vacios no ingreso la Clave");</script>';
        }
        else
        {
            $sql3 = "SELECT * FROM tipo_mascota WHERE id_tipomas ='$idbus'";
            $tipou = mysqli_query($mysqli, $sql3) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($tipou);	
                if ($usu)
                {
                    $idtipomas = $usu['id_tipomas'];
                    $tipomas=    $usu['tipomas'];
                }
                else 
                {
                    $idtipomas = "";
                    $tipomas=   ""; 
                    echo '<script>alert (" El tipo de mascota no existe en la base de datos");</script>';                 
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
            $idtipomas= $_POST['1'];
            $tipomas = $_POST['2'];
            $aux =  $_POST['3'];
            $sql8 = "SELECT * FROM  tipo_mascota WHERE id_tipomas='$idtipomas'";
            $tipou= mysqli_query($mysqli, $sql8) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($tipou);
            if ($usu)
            {
            echo '<script>alert ("El id del tipo de mascota ya existe");</script>'; 
            }
            else
            {


            $sql7 = "INSERT INTO tipo_mascota (id_tipomas, tipomas) VALUES ('$idtipomas', '$tipomas')";
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
            $idtipomas = "";
            $tipomas=   ""; 
            echo '<script>alert (" Datos Vacios. No se puede actualizar");</script>';
        }
        else
        {
            $idtipomas= $_POST['1'];
            $tipomas = $_POST['2'];
            $sql8 = "SELECT * FROM  tipo_mascota WHERE id_tipomas='$idtipomas'";
            $tipou= mysqli_query($mysqli, $sql8) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($tipou);
            if ($usu)
            {

                
                $sql7 = "UPDATE tipo_mascota SET tipomas = '$tipomas' WHERE id_tipomas ='$idtipomas'";
                mysqli_query($mysqli, $sql7) or die(mysqli_error($mysqli));             
                echo '<script>alert (" Tipo de Mascota Actualizada");</script>';                   
            }
        }
    }

  // Opción de eliminación de registros //
    if ((isset($_POST["eliminar"])) && ($_POST["MM_eliminar"] == "form4")) 
    {
        //  consulta 
        if (($_POST['1']== "" )||($_POST['2']== "" ))
        {
            $idtipomas = "";
            $tipomas=   "";
            echo '<script>alert (" Datos Vacios. No se puede eliminar");</script>';
        }
        else
        {
            $idtipomas= $_POST['1'];
            $tipomas = $_POST['2'];
            $sql8 = "SELECT * FROM  tipo_mascota WHERE id_tipomas='$idtipomas'";
            $tipou= mysqli_query($mysqli, $sql8) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($tipou);
            if ($usu)
            {
        
                $sql7 = "DELETE  FROM tipo_mascota WHERE id_tipomas = '$idtipomas'";
                mysqli_query($mysqli, $sql7) or die(mysqli_error($mysqli));
                if (mysqli_error($mysqli))
                {
                    echo '<script>alert (mysqli_error($mysqli));</script>';

                }
                echo '<script>alert (" Tipo de mascota eliminado");</script>';
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
        $idtipomas = "";
        $tipomas=   "";
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
    <title>Modulo Administrador - Gestión de Tipos de Mascotas</title>
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
                <td align="left"><h1 >&nbsp&nbsp&nbsp&nbspMÓDULO ADMINISTRADOR - GESTIÓN DE TIPO DE MASCOTAS</h1></th>
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
                    <th width="30%"><label for="first_name" class="required">Búsqueda de Tipo de usuario</label></th>
                    <th width="70%" align ="right"><label for="first_name" class="required">Operaciones</label></th>
                    
                </tr>
                <tr>
                    <th width="40%">
                        <div class="form-input">
                            <label for="first_name" class="required">Id Tipo De Usuario </label>
                            <input type="text" name="idtipom" id="first_number" />
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
                        <h2 align="center">TIPO DE MASCOTA A PROCESAR</h2>
                    </th>
                </tr>
                <tr>
                    <div>
                        <table class="t2" border="1" cellspacing="2" cellpadding="2" >
                            <tr>
                                <th  width="30%"><font face="Arial"> Id Tipo De Mascota </font></th>
                                <th  width="50%"><font face="Arial"> Tipo De Mascota </font></th>                                
                            </tr>
                            <tr font-size="1">    
                                <div style="visibility: hidden">
                                    <div class="form-control" style="visibility: hidden">             
                                        <td width="20%"><input class="control" type = "text" id = "a" name="1" style="width :150px; heigth : 1px" value= "<?php echo $idtipomas;?>" /></td>
                                        <td width="20%"><input class="control" type = "text" id = "b" name="2" style="width : 250px; heigth : 1px" value= "<?php echo $tipomas?>" /></td>
                                        <input type = "hidden" id = "c" name="3" style="width : 250px; heigth : 1px" value= "<?php echo $nombre?>" />
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
                <label>Listado de Afiliaciones</label>
          </h2>
        </div>
        <div class = "general_izq">   
            <div class = "marco1_izq"> 
                <table class="t2" border="1" cellspacing="2" cellpadding="2" width:"100%" >
                    <thead   width:"100%">
                        <tr>
                                
                            <th width="50%"><font face="Arial"> Id Tipo Mascota </font></th>
                            <th width="50%"><font face="Arial"> Tipo Mascota </font></th>
                            
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            $sql2 = "SELECT * FROM tipo_mascota";
                            $user = mysqli_query($mysqli, $sql2) or die(mysqli_error());
                            while ($rows = mysqli_fetch_assoc($user))	
                            {                              
                        ?>
                        <tr>                            
                            <td><font face="Arial"><?php echo $rows['id_tipomas']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['tipomas']; ?></font></td>
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
            <img src="img/img1.png" width=100%>
    </div>                     
</body>

</html>

