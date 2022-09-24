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
        $usubus = $_POST['id_usuario'];
        $mascusu = $_POST['id_mascota'];
        $idm = "";
        $idafi = "";
        $tipom = "";
        $nombre = "";
        $fecha = "";
        $obs =  "";
        $nombrep = "";
        $doc = "";
        if ($_POST['id_mascota']== "" )  // Si id de mascota vacía
        {
            $sql1 = "SELECT * FROM usuario WHERE id_usu = '$usubus'"; 
            $mascota = mysqli_query($mysqli, $sql1) or die(mysqli_error());  
            $mascresult = mysqli_fetch_assoc($mascota);
            if ($mascresult) 
            {               
                $sql2 = "SELECT * FROM mascota_cliente WHERE id_usu = '$usubus'"; 
                $mascota = mysqli_query($mysqli, $sql2) or die(mysqli_error());
                $i = 0;
                $total = mysqli_num_rows($mascota);
                if ($total ==0)
                {
                    $idm = $mascusu;
                    $tipom = $tipom;
                    $nombre = "";
                    $nombrep = "";
                    $fecha = "";
                    $obs =  "";
                    $idafi = "";
                    $doc = "";
                    echo '<script>alert (" Propietario no tiene Mascotas asociadas");</script>';
                }
                else
                {
                    $nom_tipousuario = array();
                    while ($tip = mysqli_fetch_assoc($mascota))
                    {
                        $id[$i] =$tip['id_mascli'];
                        $nom_mascota[$i] = $tip['nombre'];
                        $i = $i +1;                                                                     
                    }
                }
            }
            else echo '<script>alert (" Propietario no existe");</script>';
        }
        else     // Si id de mascota con información
        {
            $sql1 = "SELECT     
                        M.id_mascli AS ID,
                        T.tipomas AS TIPO_MASCOTA,
                        M.nombre AS NOMBRE_MASCOTA, 
                        U.id_usu AS DOCUMENTO,
                        concat(U.Nombres,' ', U.Apellidos) AS NOMBRE_PROPIETARIO,
                        A.id_afi AS ID_AFILIACION,
                        A.fecha_reg AS FECHA_REGISTRO,
                        A.Obs AS OBSERVACION
                    FROM mascota_cliente M, afiliacion A, tipo_mascota T, usuario U 
                    WHERE  M.id_mascli =  A.id_mascli AND M.id_tipomas = T.id_tipomas AND M.id_usu = U.id_usu AND  M.id_mascli =  '".$mascusu."' AND M.id_usu  = '".$usubus."'"; 
                        
            // Consulta de tablas usuario, tipo_mascota y afiliacion por Id de mascota y id de id de usuario (propietario)
            $mascota = mysqli_query($mysqli, $sql1) or die(mysqli_error());
            $mascresult = mysqli_fetch_assoc($mascota);
            if ($mascresult) 
            {
                $idm = $mascresult['ID'];
                $idafi = $mascresult['ID_AFILIACION'];
                $tipom = $mascresult['TIPO_MASCOTA'];
                $doc   = $mascresult['DOCUMENTO'];
                $nombre = $mascresult['NOMBRE_MASCOTA'];
                $nombrep = $mascresult['NOMBRE_PROPIETARIO'];
                $fecha = $mascresult['FECHA_REGISTRO'];
                $obs =  $mascresult['OBSERVACION'];
            }
            else
            {
                $sql2 = "SELECT T.tipomas as tipo, M.nombre AS nombre, concat(U.Nombres,' ', U.Apellidos)  AS propietario
                        from   tipo_mascota T, mascota_cliente M, usuario U 
                        where M.id_usu = U.id_usu AND M.id_tipomas = T.id_tipomas and M.id_mascli = '".$mascusu."'";
                $mascota = mysqli_query($mysqli, $sql2) or die(mysqli_error());
                $mascresult = mysqli_fetch_assoc($mascota);
                $idm = $mascusu;
                if($mascresult)
                {  
                    $tipom =$mascresult['tipo'];
                    $nombre = $mascresult['nombre'];
                    $nombrep = $mascresult['propietario'];
                    $fecha = "";
                    $obs =  "";
                    $idafi = "";
                    echo '<script>alert (" Mascota sin afiliar..");</script>';
                }
            }
            
        }
    }

    elseif ((isset($_POST["insertar"])) && ($_POST["MM_insertar"] == "form4"))
    {
        if (($_POST['1']== "" )||($_POST['4']== "" )) // Valida si vienen campos vacios
        {   
            echo '<script>alert (" Datos Vacios. No se puede insertar registros");</script>';
        }
        else
        {
            $idm = $_POST['1'];
            $fecha = $_POST['4'];
            $obs =  $_POST['5'];
            $sql7 = "INSERT INTO afiliacion (id_mascli, fecha_reg, Obs) VALUES ('$idm', '$fecha', '$obs')";
            mysqli_query($mysqli, $sql7) or die(mysqli_error());
            echo '<script>alert ("Se realizó la afiliación correctamente");</script>';   
        }
    }
         // Opción de edición de registros //
    if ((isset($_POST["editar"])) && ($_POST["MM_editar"] == "form4")) 
    {      
        if (($_POST['1']== "" )||($_POST['4']== "" )) // Valida si vienen campos vacios
        {
            $fecha = "";
            $obs =  "";  
            echo '<script>alert (" Datos Vacios. No se puede actualizar");</script>';
        }
        else
        {
            $idm = $_POST['1'];
            $fecha = $_POST['4'];
            $obs =  $_POST['5'];
            $idafi =  $_POST['6'];          
            $sql7 = "UPDATE afiliacion SET fecha_reg = '$fecha', Obs = '$obs' where id_afi = '$idafi'";
            mysqli_query($mysqli, $sql7) or die(mysqli_error($mysqli));
            echo '<script>alert (" Afiliación Actualizada");</script>';
        }
    }
  // Opción de eliminación de registros //
    if ((isset($_POST["eliminar"])) && ($_POST["MM_eliminar"] == "form4")) 
    {
        //  consulta 
    
        $idafi =  $_POST['6'];
        
        $sql7 = "DELETE  FROM afiliacion WHERE id_afi = '$idafi'";
        echo $sql7;
        mysqli_query($mysqli, $sql7) or die(mysqli_error($mysqli));
        echo '<script>alert (" Mascota desafiliada");</script>';
    }
    if(isset($_POST['btncerrar']))
    {
        session_destroy();
        header('location: ../../index.html');
    }
    if (isset($_POST["MM_buscar"])=="")
    {
        $idm = "";
        $tipom = "";
        $nombre = "";
        $fecha = "";
        $obs =  "";
        $idafi = "";
        $nombrep = "";
        $doc = "";
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
    <title>Modulo Administrador - Gestión de Afiliaciones</title>
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
                <td align="left"><h1 >&nbsp&nbsp&nbsp&nbspMÓDULO ADMINISTRADOR - GESTIÓN DE AFILIACIONES</h1></th>
                <td align="right" width ="40%" ><h2><a id= "regresar" href="indexA.php">Regresar&nbsp&nbsp&nbsp&nbsp&nbsp</a></h2></th>
            </tr>
        </table>       
    </section>
    <nav class="barra">
      <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label> 
    </nav>
        <div class ="ingreso">
        <!---           FORM 1   ---  BUSCAR USUARIO  ---->
            <form method="POST" name="form1"  id="form1" autocomplete="off" >
                <table class="t1" id="tabla" cellspacing="1" cellpadding="2" width="100%" border ="0" >
                    <tr align="left">   <!---           FBÚSQUEDA POR USUARIO  ---->
                        <th width="40%"><label for="first_name" class="required">Búsqueda Mascota</label></th>
                        <th width="30%" align ="right"><label for="first_name" class="required">Operaciones</label></th>
                    </tr>
                    <tr>
                        <th width="40%">
                            <div class="form-input">
                                <label for="first_name" class="required">Documento </label>
                                <input type="number" name="id_usuario" id="first_name" placeholder="Id Usuario" required value= "<?php echo $usubus?>"/>
                                <input type="hidden" name="id_mascota" id="idmas" placeholder=" ID MASC" />
                                <input type="submit" name="buscar" id="buscar" value="Buscar" />
                                <div class="select-list">
                                <label for="first_name" class="required">Mascota </label>
                                <?php                                  
                                    $nom = "";   
                                    $i = sizeof($id);;                            
                                    ?>                                          
                                    
                                        <select class = "mascsel" id="mascsel" >
                                            <option selected  disabled="">-- Selecciona --</option>
                                            <?php
                                                for ($n = 0; $n<$i; $n++)
                                                {
                                                    if ( $id[$n] == $mascusu)
                                                            { 
                                                                echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'" selected >'.$id[$n].' - '.$nom_mascota[$n].' </option>';
                                                            }
                                                    else
                                                    echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'">'.$id[$n].' - '.$nom_mascota[$n].' </option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                <input type="hidden" name="operacion" value="1" />
                                <input type="hidden" name="MM_buscar" value="form1" />
                            </div>                                       
            </form>        
                            <script type="text/javascript">
                                $(document).on('change', 'select.mascsel', function() 
                                {
                                    var a = $('select.mascsel option[value="'+$(this).val()+'"]').attr("data-typeid")
                                    document.getElementById('idmas').value= a
                                    $('#buscar').click()
                                });
                            </script>
                        </th>               
                        <th>
        <!---       AJAX --->           
                        
                            <div class="select-list">
                                <label (id ="label" for="mascota" class="required">Escoger operación: </label>
                                
                                <select class="form-control">
                                    <option selected="" disabled="">-- Selecciona --</option>
                                    <option data-typeid="1" value="1">Editar Afiliación</option>
                                    <option data-typeid="2" value="2">Eliminar Afiliación</option>
                                    <option data-typeid="3" value="3">Afiliar Mascota</option>
                                </select>
                            </div>
                            <script type="text/javascript">
                                $(document).on('change', 'select.form-control', function() 
                                {
                                var a = $('select.form-control option[value="'+$(this).val()+'"]').attr("data-typeid")

                                if (a == 1)  // Editar
                                {
                                    document.getElementById('editar').disabled = false
                                    document.getElementById('insertar').disabled = true
                                    document.getElementById('eliminar').disabled = true
                                    document.getElementById('a').readOnly = true
                                    document.getElementById('b').readOnly = true
                                    document.getElementById('c').readOnly = true
                                    document.getElementById('g').readOnly = true
                                    if (document.getElementById('f').value == "")
                                    {
                                     alert("La mascota no está afiliada... Debe afiliarla")
                                     document.getElementById('a').readOnly = false
                                     document.getElementById('editar').disabled = true
                                    }
                                    
                                    document.getElementById('seleccion').style.display = "inline"
                                    //document.getElementById('estado').style.display = "inline";
                                }
                                else if(a == 2) //Eliminar
                                {
                                    //$("#11").val(document.getElementById('a').value)
                                    document.getElementById('editar').disabled = true
                                    document.getElementById('insertar').disabled = true
                                    document.getElementById('eliminar').disabled = false
                                    document.getElementById('a').readOnly = true
                                    document.getElementById('b').readOnly = true
                                    document.getElementById('c').readOnly = true
                                    document.getElementById('g').readOnly = true
                                    if (document.getElementById('f').value == "")
                                    {
                                     alert("La mascota no está afiliada... Debe afiliarla")
                                     document.getElementById('a').readOnly = false
                                     document.getElementById('eliminar').disabled = true
                                    }
                                }
                                else if (a==3)  // Insertar
                                {  
                                    document.getElementById('form4').reset()
                                    document.getElementById('insertar').disabled = false 
                                    document.getElementById('editar').disabled = true
                                    document.getElementById('eliminar').disabled = true
                                    document.getElementById('a').disabled = false
                                    document.getElementById('a').readOnly = false
                                    document.getElementById('b').readOnly = true
                                    document.getElementById('c').readOnly = true
                                    document.getElementById('g').readOnly = true
                                    document.getElementById('seleccion').style.display = "inline"                                 
                                    document.getElementById('g').style.display = "none";
                                    $("#d").val(""); $("#e").val(""); 
                                    document.getElementById('seleccion').value = "0"
                                 }
        
                                //document.getElementById('j').style.display = "none";
                               
                                });
                            </script>
                        </th>
        <!---       AJAX --->  
                        <th>
                            <table  id="form3" width="100%" border ="0" >
                                <tr>
                                    <script type="text/javascript">
                                        $("#btnEd").on("click" ,function()
                                        {

                                            $("#insertar").click();
                                        });
                                    </script>
                                        </tr>
                            </table>
                           
        <!---           FORM 4   ---  INSERTAR, MODIFICAR Y ELIMINAR USUARIO  ---->
            <form method="POST" name="form4"  id="form4">   
                            
                            <div class="form-control">
                                   
                                    

                                    <input type = "submit" name="editar" id="editar" value="Editar Afiliación" disabled ="true" class="form-control"/>
                                    <label for="first_name" class="required">&nbsp&nbsp</label>
                                    <input type = "submit" name="eliminar" id="eliminar" value="Eliminar Afiliación" disabled ="true" class="form-control"/>
                                    <label for="first_name" class="required">&nbsp&nbsp</label>
                                    <input type = "submit" name="insertar" id="insertar" value="Afiliar Mascota" disabled ="true"/>
                                    <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                    <!-- <button type="button" id="btnin">Insertar</button>  -->
                            </div> 
                            <div class="form-control">

                                        <div class="form-input" align = "center">   
                                            <input type = "hidden" name="MM_insertar" value="form4" />
                                            <input type = "hidden" name="MM_editar" value="form4" />
                                            <input type = "hidden" name="MM_eliminar" value="form4" />
                                            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                        </div> 
                                     </div>
                        </th>
                    </tr>
                                    <script type="text/javascript">
                                        $("#btnin").on("click" ,function()
                                        {
                                            $("#insertar").click();
                                        });
                                    </script>
                    <tr align = "center">
                        <th colspan="2" scope="rowgroup" align = "center">
                            <h2 align="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp AFILIACIÓN A PROCESAR</h2></th>
                    </tr>
                    <tr>
                        <table class="t3" border="1" cellspacing="2" cellpadding="2" >
                                <tr>
                                    <th><font face="Arial"> Documento </font></th>
                                    <th><font face="Arial"> Propietario </font></th>
                                    <th><font face="Arial"> Id Mascota </font></th>
                                    <th><font face="Arial"> Tipo Mascota</font></th>
                                    <th><font face="Arial"> Nombre Mascota </font></th>
                                    <th><font face="Arial"> Fecha Registro</font></th>
                                    <th><font face="Arial"> Observación</font></th>                                
                                </tr>
                                <tr font-size="1">    
                                    <div style="visibility: hidden">
                                        <div class="form-control" style="visibility: hidden">  
                                            <td><input type = "text" id = "g" name="7" style="width : 150px; heigth : 1px" value= "<?php echo "$doc"?>" /></td>     
                                            <td><input type = "text" id = "h" name="8" style="width : 150px; heigth : 1px" value= "<?php echo "$nombrep"?>" /></td>    
                                            <td><input type = "text" id = "a" name="1" style="width : 80px; heigth : 1px" value= "<?php echo "$idm"?>" /></td>
                                            <td><input type = "text" id = "b" name="2" style="width : 150px; heigth : 1px" value= "<?php echo "$tipom"?>" /></td>
                                            <td><input type = "text" id = "c" name="3" style="width : 150px; heigth : 1px" value= "<?php echo "$nombre"?>" /></td>
                                            <td><input type = "date" id = "d" name="4" style="width : 150px; heigth : 1px" value= "<?php echo "$fecha"?>" /></td>
                                            <td><input type = "text" id = "e" name="5" style="width : 130px; heigth : 1px" value= "<?php echo "$obs"?>" /></td>
                                            <td><input type = "hidden" id = "f" name="6" style="width : 150px; heigth : 1px" value= "<?php echo "$idafi"?>" /></td>
                                        </div>
                                         <script type="text/javascript">
                                             $(document).on('change', 'select.seleccion', function()  
                                            {
                                              var a = $('select.seleccion option[value="'+$(this).val()+'"]').attr("data-typeid")
                                              $("#h").val(a)
                                             // $("#12").val(a)
                                              if(a != 3)
                                                
                                              else
                                              {

                                                 
                                                 //$("#h").val(" ")
                                              }
                                            });
                                        </script>
                                    </div>
                                </tr>
                        </table>
                    </tr>
                </table>
            </form>
        </div>     

        <form method="POST" name="formBG"  id="formBG">
        <div class = "encabezado_izq">
          <h2 align="center">
                <div class = "e">
                            <input type = "submit" name="BGsubmit" id="BGsubmit" value="BGsubmit" hidden/>
                            <input type = "hidden" name="MM_BGsubmit" value="formBG" />
                            <input type="text" name="sq" id="sq"  value ="1" hidden/>
                            <input type="text" name="msj" id="msj"  value ="" hidden/>
                            <input type="text" name="sql" id="sql"  value ="1" hidden/>
                            <label>Listado de Afiliaciones</label>
                </div>
        </form>
        </div>
        <div class = "general_izq">   
            <div class = "marco1_izq"> 
                <table class="t3" border="1" cellspacing="2" cellpadding="2" >
                    <thead   width:"100%">
                        <tr>
                            <th><font face="Arial"> Documento </font></th>
                            <th><font face="Arial"> Nombre Propietario </font></th>
                            <th><font face="Arial"> Id Mascota </font></th>
                            <th><font face="Arial"> Tipo Mascota</font></th>
                            <th><font face="Arial"> Nombre Mascota </font></th>
                            <th><font face="Arial"> Fecha Registro</font></th>
                            <th><font face="Arial"> Observación</font></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                    <?php                   
                            $sqlg = "SELECT     
                                M.id_mascli AS ID,
                                T.tipomas AS TIPO_MASCOTA,
                                M.nombre AS NOMBRE_MASCOTA, 
                                A.id_afi AS ID_AFILIACION,
                                U.id_usu AS DOCUMENTO,
                                A.fecha_reg AS FECHA_REGISTRO,
                                concat(U.Nombres,' ', U.Apellidos) AS NOMBRE_PROPIETARIO,
                                A.Obs AS OBSERVACION
                            FROM mascota_cliente M, afiliacion A, tipo_mascota T, usuario U
                            WHERE  M.id_mascli =  A.id_mascli AND M.id_tipomas = T.id_tipomas AND M.id_usu = U.id_usu"; 
                            $afiliacion = mysqli_query($mysqli, $sqlg) or die(mysqli_error());
                            //$rows = mysqli_fetch_assoc($afiliacion);
                        while ($rows = mysqli_fetch_assoc($afiliacion))	
                        {
                    ?>
                            <td><font face="Arial"><?php echo $rows['DOCUMENTO'] ?></font></td>
                            <td><font face="Arial"><?php echo $rows['NOMBRE_PROPIETARIO'] ?></font></td>
                            <td><font face="Arial"><?php echo  $rows['ID']?></font></td>
                            <td><font face="Arial"><?php echo $rows['TIPO_MASCOTA']?></font></td>
                            <td><font face="Arial"><?php echo $rows['NOMBRE_MASCOTA'] ?></font></td> 
                            <td><font face="Arial"><?php echo $rows['FECHA_REGISTRO']?></font></td>
                            <td><font face="Arial"><?php echo $rows['OBSERVACION']?></font></td>
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
            <img src="img/pets1.jpg" width=100%>
    </div>                     
</body>

</html>

