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
        /*  ==================================== $tipo = mysqli_fetch_assoc($tipou);*/
            $usubus = $_POST['id_usuario'];
            if ($_POST['id_usuario']== "" )
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
                    echo '<script>alert (" Datos Vacios no ingreso la Clave");</script>';
            }
            else
            {
                    $sql1 = "SELECT * FROM usuario WHERE id_usu ='$usubus'";
                    $usuario = mysqli_query($mysqli, $sql1) or die(mysqli_error());
                    $usu = mysqli_fetch_assoc($usuario);	
                    if ($usu)
                    {
                        $idusu = $usu['id_usu'];
                        $nombre=    $usu['Nombres'];
                        $apellido=  $usu['Apellidos'];
                        $direccion=  $usu['Direccion'];
                        $email  =   $usu['email'];
                        while ($valor = mysqli_fetch_assoc($tipou))
                        {
                            if($valor['id_tipousu'] == $usu['id_tipousu'])
                                $tipousu= $valor['tipousu'];
                        }
                        $telefono=   $usu['Telefono'];
                        $tarjeta=   $usu['tp'];
                        $clave=     $usu['clave'];
                        if($usu['id_est']== 1)
                        $estado= "Activo";
                        else
                        $estado= "Inactivo";

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
                    }     
            }
        


    }

    if ((isset($_POST["MM_editar"])) && ($_POST["MM_editar"] == "form2")) 
    {      
        /*   consulta tipo de usurio */
        $sql3 = "SELECT * FROM tipo_usuario";
        $tipou = mysqli_query($mysqli, $sql3) or die(mysqli_error());
        if (($_POST['10']== "" )||($_POST['2']== "" )||($_POST['3']== "" )||($_POST['4']== "" )
            ||($_POST['5']== "" )||($_POST['6']== "" )||($_POST['7']== "" )||($_POST['9']== "" ))
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
                    echo '<script>alert (" Datos Vacios. No se puede actualizar");</script>';
        }
        else
        {
                $idusu = $_POST['1'];
                $nombre=   $_POST['2'];
                $apellido=  $_POST['3'];
                $direccion=  $_POST['4'];
                $email  =   $_POST['5'];
                $tipousu=   $_POST['7'];
                $telefono=   $_POST['6'];
                $tarjeta=  $_POST['8'];
                $clave=     $_POST['9'];
                $estado=   $_POST['10'];  
                $sql7 = "UPDATE usuario SET Nombres = '$nombre', Apellidos = '$apellido', Direccion = '$direccion', email = '$email',  Telefono = '$telefono', tp ='$tarjeta',
                     clave = '$clave', id_est = '$estado' WHERE usuario.id_usu ='$idusu'";
                mysqli_query($mysqli, $sql7) or die(mysqli_error($mysqli));
                if(mysqli_error($mysqli))
                    {
                        echo '<script>alert (" Error en consulta");</script>';
                    }
                    else
                    {
                      echo '<script>alert (" Usuario Actualizado");</script>';
                    }
        }
    }
    
    elseif ((isset($_POST["MM_insertar"])) && ($_POST["MM_insertar"] == "form4"))
    {
        $sql3 = "SELECT * FROM tipo_usuario";
        $tipou = mysqli_query($mysqli, $sql3) or die(mysqli_error());
        if (($_POST['1']== "" )||($_POST['2']== "" )||($_POST['3']== "" )||($_POST['4']== "" )
            ||($_POST['5']== "" )||($_POST['6']== "" )||($_POST['7']== "" )||($_POST['9']== "" )||($_POST['10']== "" ))
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
                    echo '<script>alert (" Datos Vacios. No se puede insertar registros");</script>';
         }
        else
        {
            $sql8 = "SELECT * FROM usuario WHERE id_usu  = '".$_POST['1']."' OR email = '".$_POST['5']."'";
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
                $tipousu=   $_POST['7'];
                $telefono=   $_POST['6'];
                $tarjeta=  $_POST['8'];
                $clave=     $_POST['9'];
                $estado=   $_POST['10'];                  
                $sql7 = "INSERT INTO usuario (id_usu, Nombres, Apellidos, Direccion, email, id_tipousu, Telefono, tp, clave, id_est) 
                VALUES ('$idusu', '$nombre', '$apellido', '$direccion', '$email', $tipousu, $telefono, '$tarjeta',$clave, $estado )";
                mysqli_query($mysqli, $sql7) or die(mysqli_error($mysqli));
                if(mysqli_error($mysqli))
                {
                        echo '<script>alert (" Error en consulta");</script>';
                }
                else
                {
                      echo '<script>alert (" Usuario Insertado);</script>';
                }
             }
         }
    }

/*



*/

if ((isset($_POST["MM_eliminar"])) && ($_POST["MM_eliminar"] == "form3")) 
{
    /*   consulta tipo de usurio */
   
    /*  ==================================== $tipo = mysqli_fetch_assoc($tipou);*/
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
    }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilospan.css">
    <script type="text/javascript" src="tablecloth/tablecloth.js"></script>
    <title>Modulo Administrador - Gestión de Usuarios</title>
</head>
    <body backgroud="#4444">
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
                <td align="right" width ="40%" ><h2><a  href="indexA.php">Regresar&nbsp&nbsp&nbsp&nbsp&nbsp</a></h2></th>
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
                        <th width="40%"><label for="first_name" class="required">Búsqueda de usuario por Documento</label></th>
                        <th width="40%" align ="right"><label for="first_name" class="required">Operaciones</label></th>
                    </tr>
                    <tr>
                        <th width="40%">
                            <div class="form-input">
                                <label for="first_name" class="required">Id Usuario </label>
                                <input type="text" name="id_usuario" id="first_name" />
                                <input type="submit" name="buscar" id="buscar" value="Buscar" onclick="tipo();"/>
                                <input type="hidden" name="operacion" value="1" />
                                <input type="hidden" name="MM_buscar" value="form1" />
                            </div>
            </form>                
                        </th>               
                        <th>
        <!---       AJAX --->           
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
                                    $("#1").val(document.getElementById('a').value)
                                    $("#2").val(document.getElementById('b').value)
                                    $("#3").val(document.getElementById('c').value)
                                    $("#4").val(document.getElementById('d').value)
                                    $("#5").val(document.getElementById('e').value)
                                    $("#6").val(document.getElementById('f').value)
                                    $("#7").val(document.getElementById('g').value)
                                    $("#8").val(document.getElementById('h').value)
                                    $("#9").val(document.getElementById('i').value)
                                    $("#10").val(document.getElementById('j').value)
                                    document.getElementById('insertar').disabled = true
                                      document.getElementById('editar').disabled = false
                                      document.getElementById('eliminar').disabled = true
                                      document.getElementById('a').disabled = true
                                      document.getElementById('g').style.display = "inline"
                                      document.getElementById('seleccion').style.display = "inline"
                                      document.getElementById('g').style.display = "inline";
                                    document.getElementById('seleccion').style.display = "inline"
                                    var elemento = document.getElementById('7').value
                                    var combo = document.getElementById('seleccion')
                                    var cantidad = combo.length;
                                    constant arreglo = ['sele','Administrador','Enfermera', 'Veterinario', 'Propietario']
                                    var j = 0
                                    for (i = 0; i < cantidad; i++) 
                                    {
                                        alert(arreglo[i])
                                        if (arreglo[i] == elemento) {
                                            j=i+1;
                                        } 
                                    }
                                    for (i = 0; i < cantidad; i++) 
                                    {
                                        alert(j)
                                        if (combo[i].value == j) {
                                            combo[i].selected = true;
                                        } 
                                    }
                                    value = combo.options[combo.selectedIndex].text;
                                }
                                else if (a==3) 
                                    {
                                    
                                    $("#1").val("")
                                    $("#2").val("")
                                    $("#3").val("")
                                    $("#4").val("")
                                    $("#5").val("")
                                    $("#6").val("")
                                    $("#7").val("")
                                    $("#8").val("")
                                    $("#9").val("")
                                    $("#10").val("")
                                    $("#a").val("")
                                    $("#b").val("")
                                    $("#c").val("")
                                    $("#d").val("")
                                    $("#e").val("")
                                    $("#f").val("")
                                    $("#g").val("")
                                    $("#h").val("")
                                    $("#i").val("")
                                    $("#j").val("")
                                    document.getElementById('insertar').disabled = false
                                    document.getElementById('editar').disabled = true
                                    document.getElementById('eliminar').disabled = true
                                    document.getElementById('a').disabled = true
                                    document.getElementById('g').style.display = "none"
                                    document.getElementById('seleccion').style.display = "inline"                                 
                                    document.getElementById('g').style.display = "none";
                                    document.getElementById('seleccion').style.display = "inline"
                                 }
                                else if(a == 2)
                                {
                                    $("#11").val(document.getElementById('a').value)
                                    document.getElementById('eliminar').disabled = false
                                    document.getElementById('insertar').disabled = true
                                    document.getElementById('editar').disabled = true
                                }
                                document.getElementById('j').style.display = "none";
                                document.getElementById('estado').style.display = "inline";
                                });
                            </script>
                        </th>
        <!---       AJAX --->  

                        <th>
                            <table  id="form3" width="100%" border ="0" >
                                <tr>
        <!---           FORM 2   ---  EDITAR USUARIO  ---->
                                    <form method="POST" name="form2"  id="form2">    
                                     <div class="form-control">
                                        <input type = "hidden" id = "1" name="1" value= "<?php echo $idusu;?>" />
                                        <input type = "hidden" id = "2" name="2" value= "<?php echo $nombre?>" />
                                        <input type = "hidden" id = "3" name="3" value= "<?php echo $apellido?>" />
                                        <input type = "hidden" id = "4" name="4" value= "<?php echo $direccion?>" />
                                        <input type = "hidden" id = "5" name="5"  value= "<?php echo $email?>" />
                                        <input type = "hidden" id = "6" name="6"  value= "<?php echo $telefono?>" />
                                        <input type = "hidden" id = "7" name="7"  value= "<?php echo $tipousu?>" />
                                        <input type = "hidden" id = "8" name="8"  value= "<?php echo $tarjeta?>" />
                                        <input type = "hidden" id = "9" name="9"  value= "<?php echo $clave?>" />
                                        <input type = "hidden" id = "10" name="10"  value= "<?php echo $estado?>" /> 
                                        <input type = "hidden" id = "11" name="11"  value= "<?php echo $estado?>" /> 
                                        <div class="form-input" align = "center">   
                                            <label for="first_name" class="required">Editar&nbsp&nbsp</label>
                                            <input type = "submit" name="editar" id="editar" value="Editar" disabled ="true" class="form-control"/>
                                            <input type = "hidden" name="MM_editar" value="form2" />
                                            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>                                                                         
                                        </div> 
                                     </div>
                                    </form> 
                                </tr>
                            </table>
                            <table  id="form4" width="100%" border ="0" >
                                <tr>
        <!---           FORM 3   ---  ELIMINAR USUARIO  ---->
                                    <form method="POST" name="form3"  id="form3">         
                                        <input type = "hidden" name="1"  value= "<?php echo $idusu;?>" />
                                        <div class="form-input" align = "center">   
                                            <label for="first_name" class="required">Eliminar&nbsp&nbsp</label>
                                            <input type = "hidden" name="MM_eliminar" value="form3" />
                                            <input type = "submit" name="eliminar" id="eliminar" value="Eliminar" disabled ="true" class="form-control"/>
                                            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>                                                                         
                                        </div> 
                                    </form> 
                                </tr>
                            </table>

        <!---           FORM 4   ---  INSERTAR USUARIO  ---->
            <form method="POST" name="form4"  id="form4">   
                            
                            <div class="form-control">
                                   
                                    <label for="first_name" class="required">Insertar&nbsp&nbsp</label>
                                    <input type = "hidden" name="MM_insertar" value="form4" />
                                    <input type = "submit" name="insertar" id="insertar" value="insertar" disabled ="true"/>
                                    <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                            </div> 
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" scope="rowgroup"><label for="first_name">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUsuario</label></th>
                    </tr>
                    <tr>
                        <table class="t2" border="1" cellspacing="2" cellpadding="2" >
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
                                    <div style="visibility: hidden">
                                        <div class="form-control" style="visibility: hidden">           
                                            <td><input type = "text" id = "a" name="1" style="width : 80px; heigth : 1px" value= "<?php echo $idusu;?>" /></td>
                                            <td><input type = "text" id = "b" name="2" style="width : 150px; heigth : 1px" value= "<?php echo $nombre?>" /></td>
                                            <td><input type = "text" id = "c" name="3" style="width : 150px; heigth : 1px" value= "<?php echo $apellido?>" /></td>
                                            <td><input type = "text" id = "d" name="4" style="width : 150px; heigth : 1px" value= "<?php echo $direccion?>" /></td>
                                            <td><input type = "email" id = "e" name="5" style="width : 130px; heigth : 1px" value= "<?php echo $email?>" /></td>
                                            <td><input type = "text" id = "f" name="6" style="width : 80px; heigth : 1px" value= "<?php echo $telefono?>" /></td>
                                           <?php
                                            $sql10 = "SELECT * FROM tipo_usuario";
                                            $tipo = mysqli_query($mysqli, $sql10) or die(mysqli_error());
                                            $id = array();
                                            $nom_tipousuario = array();
                                            $nom = "";
                                            $i = 0;
                                            while ($tip = mysqli_fetch_assoc($tipo))
                                            {
                                                $id[$i] =$tip['id_tipousu'];
                                                $nom_tipousuario[$i] = $tip['tipousu'];
                                                $i = $i +1;
                                            }
                                           ?>                                          
                                            <div class="select-list">
                                            <td><select class = "seleccion" id="seleccion" hidden>
                                                   <option selected="" disabled="">-- Selecciona --</option>
                                                    <?php
                                                    for ($n = 0; $n<$i; $n++)
                                                    {
                                                        echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'">'.$id[$n].' - '.$nom_tipousuario[$n].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                                <input type = "text" id = "g" name="7" style="width : 80px; heigth : 1px" value= "<?php echo $tipousu?>" /></td>
                                            <td><input type = "text" id = "h" name="8" style= "width : 80px; heigth : 1px" value= "<?php echo $tarjeta?>" /></td>
                                            <td><input type = "text" id = "i" name="9" style="width : 80px; heigth : 1px" value= "<?php echo $clave?>" /></td>
                                            <div class="select-list">
                                            <td><select class = "estado"  hidden id="estado">
                                                    <option selected="" disabled="">-- Selecciona --</option>
                                                    <option data-typeid="1" value="1">Activo</option>
                                                    <option data-typeid="2" value="2">Inactivo</option>
                                                </select>
                                            </div>
                                                <input type = "text" id = "j" name="10" style="width : 80px; heigth : 1px" value= "<?php echo $estado?>" />
                                            </td>
                                        </div>
                                        <script type="text/javascript">
                                            $(document).on('change', 'select.seleccion', function() 
                                            {
                                              var a = $('select.seleccion option[value="'+$(this).val()+'"]').attr("data-typeid")
                                              $("#g").val(a)
                                              if(document.getElementById('g').value != "3")
                                                 document.getElementById('h').disabled = true
                                              else
                                                 document.getElementById('h').disabled = false 
                                            });
                                        </script>
                                            </div>
                                         <script type="text/javascript">
                                            $(document).on('change', 'select.estado', function() 
                                            {
                                              var a = $('select.estado option[value="'+$(this).val()+'"]').attr("data-typeid")                                      
                                              $("#j").val(a)     
                                              $("#10").val(a)
                                              $("#10").val(document.getElementById('j').value) 
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
        <div class = "encabezado">
          <h2 align="center">Listado de Usuarios</h2> 
        </div>
        <div class = "general">   
            <div class = "marco1"> 
                <table class="t2" border="1" cellspacing="2" cellpadding="2" >
                    <thead   width:"100%">
                        <tr>
                            <th><font face="Arial"> Editar </font></th>    
                            <th><font face="Arial"> Id Usuario </font></th>
                            <th><font face="Arial"> Nombres </font></th>
                            <th><font face="Arial"> Apellidos </font></th>
                            <th><font face="Arial"> Dirección </font></th>
                            <th><font face="Arial"> Email </font></th>
                            <th><font face="Arial"> Teléfono </font></th>
                            <th><font face="Arial"> Tipo Usuario </font></th>
                            <th><font face="Arial"> T P </font></th>
                            <th><font face="Arial"> Clave </font></th>
                            <th><font face="Arial"> Estado </font></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
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
                            <td><font face="Arial">
                            <td><font face="Arial"><?php echo $rows['id_usu']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['Nombres']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['Apellidos']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['Direccion']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['email']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['Telefono']; ?></font></td>
                            <td><font face="Arial"><?php echo $tipousuario; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['tp']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['clave']; ?></font></td>
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

