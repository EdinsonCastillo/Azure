<?php
    session_start();
    require_once("../../db/connection.php");
	include("../../controller/validarSesion.php");
	$sql = "SELECT * FROM usuario, tipo_usuario WHERE email = '".$_SESSION['usuario']."' AND usuario.id_tipousu = tipo_usuario.id_tipousu";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
	$idusuario = $usua['id_usu'];
    if ((isset($_POST["MM_buscar"])) && ($_POST["MM_buscar"] == "form1")) 
    {
        /*   consulta tipo de usurio */
        $sql3 = "SELECT * FROM tipo_usuario";
        $tipou = mysqli_query($mysqli, $sql3) or die(mysqli_error());
        /*  */
        $usubus = $_POST['id_usuario'];
        if ($_POST['id_usuario']== "" )  // Si id de usuario vacía
        {
            $idusu = "";
            $nombre=   "";
            $apellido=  "";
            $direccion=  "";
            $email  =   "";
            $tipousu=   "";
            $telefono=   "";
            $tarjeta=  "";
            $clave=     "";
            $estado=   "";
            $idtipousuario =   "";
            $tipousuario =    "";
            $estad= "";
                echo '<script>alert (" Datos Vacios no ingreso la Clave");</script>';
        }
        else     // Si id de usuario con infornación
        {
            $sql1 = "SELECT * FROM usuario, tipo_usuario WHERE usuario.id_tipousu = tipo_usuario.id_tipousu 
                        AND usuario.id_usu = '$usubus'";                    
            // Consulta de tabla usuario por Id usuario
            $usuario = mysqli_query($mysqli, $sql1) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($usuario);	
            if ($usu)
            {
                $idusu = $usu['id_usu'];
                $nombre=    $usu['Nombres'];
                $apellido=  $usu['Apellidos'];
                $direccion=  $usu['Direccion'];
                $email  =   $usu['email'];
                $telefono=   $usu['Telefono'];
                $tarjeta=   $usu['tp'];
                $clave=     $usu['clave'];
                $estado=    $usu['id_est'];
                $idtipousuario =    $usu['id_tipousu'];
                $tipousuario =    $usu['tipousu'];
                if ( $estado == 1 )
                    $estad = "Activo";
                else if ( $estado == 2 )
                    $estad= "Inactivo";
                else 
                    $estad= "";
            }
            else
            {
                $idusu = "";
                $nombre=   "";
                $apellido=  "";
                $direccion=  "";
                $email  =   "";
                $tipousu=   "";
                $telefono=   "";
                $tarjeta=  "";
                $clave=     "";
                $estado=   "";
                $idtipousuario =   "";
                $tipousuario =    "";
                $estad= "";
            }     
        }
    }
    elseif ((isset($_POST["insertar"])) && ($_POST["MM_insertar"] == "form4"))
    {
        if (($_POST['1']== "" )||($_POST['2']== "" )||($_POST['3']== "" )||($_POST['4']== "" )  // Valida si vienen campos vacios
            ||($_POST['5']== "" )||($_POST['6']== "" )||($_POST['8']== "" )||($_POST['10']== "" )||($_POST['12']== "" ))
        {
            $idusu = "";
            $nombre=   "";
            $apellido=  "";
            $direccion=  "";
            $email  =   "";
            $tipousu=   "";
            $telefono=   "";
            $tarjeta=  "";
            $clave=     "";
            $estado=   "";
            $idtipousuario =   "";
            $tipousuario =    "";
            $estad= "";   
            echo '<script>alert (" Datos Vacios. No se puede insertar registros");</script>';
        }
        else
        {
            $sql8 = "SELECT * FROM usuario WHERE id_usu  = '".$_POST['1']."' OR email = '".$_POST['5']."'"; //Valida si id usuario o Email existen
            $usuar = mysqli_query($mysqli, $sql8) or die(mysqli_error());
            $total = mysqli_num_rows($usuar);
            if ($total !=0)
            {
                echo '<script>alert (" Usuario o Email ya existen. Favor cambie estos campos");</script>';
            }
            else
            {                
                $idusu = $_POST['1']; 
                $nombre=   $_POST['2'];
                $apellido=  $_POST['3'];
                $direccion=  $_POST['4'];
                $email  =   $_POST['5'];
                $tipousuario=   $_POST['7'];
                $idtipousuario=   $_POST['8'];
                $telefono=   $_POST['6'];
                $tarjeta=  $_POST['9'];
                $clave=     $_POST['10'];
                $estad=   $_POST['11']; 
                $estado=   $_POST['12'];          
                $sql7 = "INSERT INTO usuario (id_usu, Nombres, Apellidos, Direccion, email, id_tipousu, Telefono, tp, clave, id_est) 
                         VALUES ('$idusu', '$nombre', '$apellido', '$direccion', '$email', $idtipousuario, $telefono, '$tarjeta',$clave, $estado )";
                mysqli_query($mysqli, $sql7) or die(mysqli_error());
                echo '<script>alert (" Usuario Insertado);</script>';          
             }
         }
    }
         // Opción de edición de registros //
    if ((isset($_POST["editar"])) && ($_POST["MM_editar"] == "form4")) 
    {      
        echo " nombre ".$_POST['2']." apellido ". $_POST['3']." direccion ".$_POST['4']." correo ". 
        $_POST['5']." telefono ".$_POST['6']." Tpo_usuario letras ".$_POST['7']." Tpo_usuario ".$_POST['8']." tarjeta ". $_POST['9']." clave ".$_POST['10']."  tipo estado letras ".$_POST['11']."  estado ".$_POST['12'];    
        //   consulta tipo de usurio //
        if (($_POST['1']== "" )||($_POST['2']== "" )||($_POST['3']== "" )||($_POST['4']== "" )  // Valida si vienen campos vacios
            ||($_POST['5']== "" )||($_POST['6']== "" )||($_POST['8']== "" )||($_POST['10']== "" )||($_POST['12']== "" ))
        {
            $idusu = "";
            $nombre=   "";
            $apellido=  "";
            $direccion=  "";
            $email  =   "";
            $tipousu=   "";
            $telefono=   "";
            $tarjeta=  "";
            $clave=     "";
            $estado=   "";
            $idtipousuario =   "";
            $tipousuario =    "";
            $estad= "";   
                echo '<script>alert (" Datos Vacios. No se puede actualizar");</script>';
        }
        else
        {
            $idusu = $_POST['1']; 
            $nombre=   $_POST['2'];
            $apellido=  $_POST['3'];
            $direccion=  $_POST['4'];
            $email  =   $_POST['5'];
            $tipousuario=   $_POST['7'];
            $idtipousuario=   $_POST['8'];
            $telefono=   $_POST['6'];
            $tarjeta=  $_POST['9'];
            $clave=     $_POST['10'];
            $estad=   $_POST['11']; 
            $estado=   $_POST['12'];; 
           // $producto=$_POST['seleccion'];
                $sql7 = "UPDATE usuario SET Nombres = '$nombre', Apellidos = '$apellido', Direccion = '$direccion', email = '$email',  id_tipousu = '$idtipousuario',Telefono = '$telefono', tp ='$tarjeta',
                     clave = '$clave', id_est = '$estado' WHERE usuario.id_usu ='$idusu'";//." Seleccion Tipo U: ".$producto;
                mysqli_query($mysqli, $sql7) or die(mysqli_error($mysqli));
                echo '<script>alert (" Usuario Actualizado");</script>';
        }
    }
  // Opción de eliminación de registros //
    if ((isset($_POST["eliminar"])) && ($_POST["MM_eliminar"] == "form4")) 
    {
        //  consulta tipo de usurio    
        $usubus = $_POST['1'];
        if ($_POST['1']== "" )
        {
                echo '<script>alert ("No ingresó el documento del usuario");</script>';
        }
        else
        {
            $sql3 = "SELECT * FROM usuario WHERE id_usu = '$usubus'";
            $tipou = mysqli_query($mysqli, $sql3) or die(mysqli_error());
            $total = mysqli_num_rows($tipou);
            if ($total !=0)
            {
                $sql1 = "DELETE FROM usuario WHERE id_usu ='$usubus'";
                $usuario = mysqli_query($mysqli, $sql1) or die(mysqli_error());	
                echo '<script>alert ("Usuario Eliminado");</script>';
            }
            else
            {
                echo '<script>alert ("No existe documento del usuario");</script>';
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
        $idusu = "";
        $nombre=   "";
        $apellido=  "";
        $direccion=  "";
        $email  =   "";
        $tipousu=   "";
        $telefono=   "";
        $tarjeta=  "";
        $clave=     "";
        $estado=   "";
        $idtipousuario =   "";
        $tipousuario =    "";
        $estad= "";
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
    
    <script type="text/javascript" src="tablecloth/tablecloth.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Modulo Administrador - Gestión de Usuarios</title>
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
                <td align="left"><h1 >&nbsp&nbsp&nbsp&nbspMÓDULO ADMINISTRADOR - GESTIÓN DE USUARIOS</h1></th>
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
                    <th width="40%"><label for="first_name" class="required">Búsquedas</label></th>
                    <th width="30%" align ="right"><label for="first_name" class="required">Operaciones</label></th>
                </tr>
                <tr>
                    <th width="40%">
                        <div class="form-input">
                            <label for="first_name" class="required">Por Id Usuario </label>
                            <input type="text" name="id_usuario" id="first_name" placeholder="Id Usuario"/>
                            <input type="submit" name="buscar" id="buscar" value="Buscar" />
                            <input type="hidden" name="operacion" value="1" />
                            <input type="hidden" name="MM_buscar" value="form1" />
                        </div>                                     
        </form>                                                                  
                    </th>               
                    <th>                                
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

                            if (a == 1)  // Editar
                            {
                                document.getElementById('editar').disabled = false
                                document.getElementById('insertar').disabled = true
                                document.getElementById('eliminar').disabled = true
                                document.getElementById('a').readOnly = true
                                document.getElementById('seleccion').style.display = "inline"
                                document.getElementById('g').style.display = "none";
                                document.getElementById('k').style.display = "none"
                                document.getElementById('l').style.display = "none"
                                document.getElementById('estado').style.display = "inline";
                            }
                            else if(a == 2) //Eliminar
                            {
                                //$("#11").val(document.getElementById('a').value)
                                document.getElementById('editar').disabled = true
                                document.getElementById('insertar').disabled = true
                                document.getElementById('eliminar').disabled = false
                                document.getElementById('a').disabled = false
                                document.getElementById('a').readOnly = true
                            }
                            else if (a==3)  // Insertar
                            {  
                                document.getElementById('form4').reset()
                                document.getElementById('insertar').disabled = false 
                                document.getElementById('editar').disabled = true
                                document.getElementById('eliminar').disabled = true
                                document.getElementById('a').disabled = false
                                document.getElementById('a').readOnly = false
                                document.getElementById('k').style.display = "none"
                                document.getElementById('l').style.display = "none"
                                document.getElementById('seleccion').style.display = "inline"                                 
                                document.getElementById('g').style.display = "none";
                                document.getElementById('estado').style.display = "inline";
                                $("#a").val(""); $("#b").val(""); $("#c").val(""); $("#d").val(""); $("#e").val(""); $("#f").val(""); 
                                $("#g").val(""); $("#h").val(""); $("#i").val(""); $("#j").val(""); $("#k").val(""); $("#l").val("");
                                document.getElementById('seleccion').value = "0"
                                document.getElementById('estado').value = "0"
                                }                          
                            });
                        </script>
                    </th>
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
                                <input type = "submit" name="editar" id="editar" value="Editar" disabled ="true" class="form-control"/>
                                <label for="first_name" class="required">&nbsp&nbsp</label>
                                <input type = "submit" name="eliminar" id="eliminar" value="Eliminar" disabled ="true" class="form-control"/>
                                <label for="first_name" class="required">&nbsp&nbsp</label>
                                <input type = "submit" name="insertar" id="insertar" value="insertar" disabled ="true"/>
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
                        $("#e").on("change" ,function()
                        {
                            var todo_correcto = true
                            alert('Algunos campos no están correctos, vuelva a revisarlos');
                            var expresion = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;
                            var email = document.getElementById('e').value
                            if (!expresion.test(email)){
                                todo_correcto = false;
                            }
                            if(!todo_correcto){
                                alert('Algunos campos no están correctos, vuelva a revisarlos');
                            }
                            return todo_correcto;
                        });
                    </script>
                <tr align = "center">
                    <th colspan="2" scope="rowgroup" align = "center">
                        <h2 align="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Usuario
                        </h2>
                    </th>
                </tr>
                <tr>
                    <table class="t3" border="1" cellspacing="2" cellpadding="2" >
                        <tr>
                            <th><font face="Arial"> Id Usuario </font></th>
                            <th><font face="Arial"> Nombres </font></th>
                            <th><font face="Arial"> Apellidos </font></th>
                            <th><font face="Arial"> Dirección </font></th>
                            <th><font face="Arial"> Email </font></th>
                            <th><font face="Arial"> Teléfono </font></th>
                            <th><font face="Arial"> Tipo Usuario </font></th>
                            <th><font face="Arial"> T P </font></th>
                            <th><font face="Arial"> Clave </font</th>
                            <th><font face="Arial"> Estado </font></th>
                        </tr>
                        <tr font-size="1">    
                            <?php
                            $sql10 = "SELECT * FROM tipo_usuario";
                            $tipo = mysqli_query($mysqli, $sql10) or die(mysqli_error());
                            $id = array();
                            $nom_tipousuario = array();
                            $nom = "";
                            $i = 0;
                            $val = 0;
                                while ($tip = mysqli_fetch_assoc($tipo))
                                {
                                    $id[$i] =$tip['id_tipousu'];
                                    $nom_tipousuario[$i] = $tip['tipousu'];
                                    if ( $tip['tipousu'] == $tipousuario )
                                        $val = $tip['id_tipousu'];
                                    $i = $i +1;                                            
                                }                                         
                                $arreglo = array("Activo","Inactivo");
                            ?>       
                            <div style="visibility: hidden">
                                <div class="form-control" style="visibility: hidden">           
                                    <td><input type = "text" id = "a" name="1" style="width : 80px; heigth : 1px" value= "<?php echo $idusu;?>" /></td>
                                    <td><input type = "text" id = "b" name="2" style="width : 150px; heigth : 1px" value= "<?php echo $nombre?>" /></td>
                                    <td><input type = "text" id = "c" name="3" style="width : 150px; heigth : 1px" value= "<?php echo $apellido?>" /></td>
                                    <td><input type = "text" id = "d" name="4" style="width : 150px; heigth : 1px" value= "<?php echo $direccion?>" /></td>
                                    <td><input type = "email" id = "e" name="5" style="width : 130px; heigth : 1px" value= "<?php echo $email?>" /></td>
                                    <td><input type = "text" id = "f" name="6" style="width : 80px; heigth : 1px" value= "<?php echo $telefono?>" /></td>
                                    <td><input type = "text" id = "g" name="7" style="width : 80px; heigth : 1px" placeholder = "" value= "<?php echo $tipousuario?>" />
                                    <select class = "seleccion" id="seleccion" name= "seleccion" hidden>
                                    <option value ="0" selected  disabled="">-- Selecciona --</option>
                                    <?php
                                            for ($n = 0; $n<$i; $n++)
                                            {
                                                $ot = $n+1;
                                                if ( $ot == $val)
                                                { 
                                                    echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'" selected >'.$id[$n].' - '.$nom_tipousuario[$n].' </option>';
                                                }
                                                else
                                                    echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'">'.$id[$n].' - '.$nom_tipousuario[$n].' </option>';
                                            }
                                        ?>               
                                            <input type = "hidden" id = "h" name="8" style="width : 80px; heigth : 1px" placeholder = "H"  value= "<?php echo $idtipousuario?>" />                                           
                                    </td>
                                    <td><input type = "text" id = "i" name="9" style= "width : 80px; heigth : 1px" value= "<?php echo $tarjeta?>" /></td>
                                    <td><input type = "password" id = "j" name="10" style="width : 80px; heigth : 1px" value= "<?php echo $clave?>" /></td> 
                                    <div class="select-list">
                                        <td><select class = "estado"  hidden id="estado">
                                            <option value ="0" disabled="">-- Selecciona --</option>
                                            <?php                                                  
                                                $ots = 0;
                                                for ($j = 0; $j<2; $j++)
                                                    {
                                                        $ots = $j+1;
                                                        if ( $ots == $estado)
                                                        { 
                                                            echo '<option data-typeid="' .$ots.'" value="'.$ots.'" selected > '.$ots.' - '.$arreglo[$j].' </option>';
                                                        }
                                                        else
                                                        echo '<option data-typeid="'.$ots.'" value="'.$ots.'">'.$ots.' - '.$arreglo[$j].' </option>';
                                                    }
                                        ?>
                                            </select>
                                            <input type = "text" id = "k" name="11" style="width : 80px; heigth : 1px" placeholder="" value= "<?php echo $estad?>" />
                                            <input type = "hidden" id = "l" name="12" style="width : 80px; heigth : 1px" placeholder="" value= "<?php echo $estado?>" />
                                        </td>
                                    </div>
                                </div>
                                <script type="text/javascript"> 
                                    $(document).on('change', 'select.seleccion', function()  
                                    {
                                        var a = $('select.seleccion option[value="'+$(this).val()+'"]').attr("data-typeid")
                                        $("#h").val(a)
                                        if(a != 3)
                                            document.getElementById('h').readOnly = false
                                            document.getElementById('k').attributes["required"] = ""
                                        else
                                        {
                                            document.getElementById('h').disabled = false 
                                            document.getElementById('k').attributes["required"] = "required"
                                        }
                                    });
                                    $(document).on('change', 'select.estado', function() 
                                    {
                                        var b = $('select.estado option[value="'+$(this).val()+'"]').attr("data-typeid")                                      
                                        $("#l").val(b)     
                                        $("#12").val(b)
                                        document.getElementById('h').disabled = false                            
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
            <div class = "encabezado">
                <h2 align="center">
                    <div class = "e">
                        <input type = "submit" name="BGsubmit" id="BGsubmit" value="BGsubmit" hidden/>
                        <input type = "hidden" name="MM_BGsubmit" value="formBG" />
                        <input type="text" name="sq" id="sq"  value ="1" hidden/>
                        <input type="text" name="msj" id="msj"  value ="" hidden/>
                        <input type="text" name="sql" id="sql"  value ="1" hidden/>
                        <label>Búsquedas Generales</label>
                        <select class="form-cont">
                            <option selected="" disabled="">-- Selecciona --</option>
                            <option data-typeid="1" value="1">Tipo Usuario</option>
                            <option data-typeid="2" value="2">Estado</option>
                            <option data-typeid="3" value="3">General</option>
                        </select>
                        <?php
                        $sql10 = "SELECT * FROM tipo_usuario";
                        $tipo = mysqli_query($mysqli, $sql10) or die(mysqli_error());
                        $id = array();
                        $nom_tipousuario = array();
                        $nom = "";
                        $i = 0;
                        $val = 0;
                        while ($tip = mysqli_fetch_assoc($tipo))
                        {
                            $id[$i] =$tip['id_tipousu'];
                            $nom_tipousuario[$i] = $tip['tipousu'];
                            if ( $tip['tipousu'] == $tipousuario )
                                $val = $tip['id_tipousu'];
                            $i = $i +1;                                            
                        }                     
                        $arreglo = array("Activo","Inactivo");                    
                        ?>                                          
                        <div class="select-list">
                            <select class = "seleccion1" id="seleccion1" hidden>
                                <option selected  disabled="">-- Selecciona --</option>
                                <?php
                                    for ($n = 0; $n<$i; $n++)
                                    {
                                        $ot = $n+1;
                                        if ( $ot == $val)
                                        { 
                                            echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'" selected >'.$id[$n].' - '.$nom_tipousuario[$n].' </option>';
                                        }
                                        else
                                        echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'">'.$id[$n].' - '.$nom_tipousuario[$n].' </option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="select-list">
                            <select class = "estado1"  hidden id="estado1">
                                <option disabled="" selected>-- Selecciona --</option>
                                <?php                                                  
                                    $ots = 0;
                                    for ($j = 0; $j<2; $j++)
                                    {
                                        $ots = $j+1;
                                        echo '<option data-typeid="'.$ots.'" value="'.$ots.'">'.$ots.' - '.$arreglo[$j].' </option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <script type="text/javascript">
                            $(document).on('change', 'select.seleccion1', function() 
                            {
                                var a = $('select.seleccion1 option[value="'+$(this).val()+'"]').attr("data-typeid")
                                $("#tipou").val(a)
                                document.getElementById('sql').value = "SELECT * FROM usuario where id_tipousu = "+ document.getElementById('tipou').value;
                                document.getElementById('BGsubmit').style.display = "inline";
                                $("#BGsubmit").click();                
                            });
                        </script>
                    </div>
                    <script type="text/javascript">
                        $(document).on('change', 'select.estado1', function() 
                        {
                            var b = $('select.estado1 option[value="'+$(this).val()+'"]').attr("data-typeid")                                      
                            $("#tipou").val(b)
                            document.getElementById('sql').value = "SELECT * FROM usuario where id_est = "+ document.getElementById('tipou').value;
                            document.getElementById('BGsubmit').style.display = "inline";
                            $("#BGsubmit").click();                      
                        });
                    </script>
                        <input type="text" name="tipou" id="tipou" value = ""placeholder="Tipo de Usuario, Estado" hidden/>                      
                        <button type="button" id="Bsubmit" hidden>Buscar</button> 
                </h2>
                <h2 align="center">Listado de Usuarios <label id="mensaje"></label></h2>     
            </div>
        </form>
        <script type="text/javascript">
            $(document).on('change', 'select.form-cont', function() 
            {
                var a = $('select.form-cont option[value="'+$(this).val()+'"]').attr("data-typeid")
                if (a == 1) 
                {
                    document.getElementById('seleccion1').style.display = "inline";
                    document.getElementById('estado1').style.display = "none";
                }
                else if (a==2)
                {
                    document.getElementById('estado1').style.display = "inline";
                    document.getElementById('seleccion1').style.display = "none";
                }
                else
                {
                    document.getElementById('estado1').style.display = "none";
                    document.getElementById('seleccion1').style.display = "none";
                    document.getElementById('sql').value = "SELECT * FROM usuario"
                    $("#BGsubmit").click();  
                }
            });
        </script>
    </div>            
    <div class = "general">   
        <div class = "marco1"> 
            <table class="t3" border="1" cellspacing="2" cellpadding="2" >
                <thead   width:"100%">
                    <tr>

                        <th><font face="Arial"> Id Usuario </font></th>
                        <th><font face="Arial"> Nombres </font></th>
                        <th><font face="Arial"> Apellidos </font></th>
                        <th><font face="Arial"> Dirección </font></th>
                        <th><font face="Arial"> Email </font></th>
                        <th><font face="Arial"> Teléfono </font></th>
                        <th><font face="Arial"> Tipo Usuario </font></th>
                        <th><font face="Arial"> T P </font></th>
                        <th><font face="Arial"> Estado </font></th>
                    </tr>
                </thead>
                <tbody> 
                
                    <?php
                        $sql2 = "SELECT * FROM usuario, tipo_usuario WHERE usuario.id_tipousu = tipo_usuario.id_tipousu";
                        
                        if ((isset($_POST["MM_BGsubmit"])) && ($_POST["MM_BGsubmit"]=="formBG"))
                        {                           
                            $sql2 = $_POST['sql']; 
                        }
                        else
                            $sql2 = "SELECT * FROM usuario";
                        $user = mysqli_query($mysqli, $sql2) or die(mysqli_error());
                        while ($rows = mysqli_fetch_assoc($user))	
                        {
                            $sql4 = "SELECT * FROM tipo_usuario";
                            $tipou = mysqli_query($mysqli, $sql4) or die(mysqli_error());

                            while ($valor = mysqli_fetch_assoc($tipou))
                                {
                                    if($valor['id_tipousu'] == $rows['id_tipousu'])
                                        $tipousuario= $valor['tipousu'];
                                }
                            if($rows['id_est']== 1)
                                $estado= "Activo";
                            else
                                $estado= "Inactivo";
                    ?>
                    <tr>  
                        <td><font face="Arial"><?php echo $rows['id_usu']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Nombres']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Apellidos']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Direccion']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['email']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Telefono']; ?></font></td>
                        <td><font face="Arial"><?php echo  $tipousuario; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['tp']; ?></font></td>
                        <td><font face="Arial"><?php echo $estado; ?></font></td>
                    </tr> 
                    <?php
                        }
                    ?>     
                    <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                    </tbody>
            </table>
        </div>
    </div>                     
</body>
</html>

