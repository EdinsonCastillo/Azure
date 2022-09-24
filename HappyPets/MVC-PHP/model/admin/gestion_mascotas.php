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
        $usubus = $_POST['id_usuario'];
        $nomas = $_POST['nombremas'];
        if ($usubus == "" && $nomas == ""  )
        {
            $tipoMas   = "";
            $idtipoMas = "";
            $id_MAS    = "";
            $idusu     = "";
            $nombremas = "";
            $color     = "";
            $especie   = "";
            $raza      = "";
            $idvet     = "";
            $nompro    = "";
            $vete      = "";
            
                echo '<script>alert (" Datos Vacios");</script>';
        }
        else
        {
                $sql1 = "SELECT     
                T.tipomas AS TIPO_MASCOTA,
                T.id_tipomas AS IDTIPO_MAS,
                M.id_mascli AS ID_MAS,
                M.id_usu AS IDUSU,
                M.nombre AS NOMBRE_MASCOTA, 
                M.color AS COLOR, 
                M.especie AS ESPECIE, 
                M.raza AS RAZA_MASCOTA,
                M.id_vet AS ID_VETERINARIO,
                concat(P.Nombres,' ', P.Apellidos) AS NOMBRE_PROPIETARIO
                FROM mascota_cliente M, tipo_mascota T, usuario P WHERE
                T.id_tipomas = M.id_tipomas AND M.id_usu = P.id_usu AND M.id_usu = '$usubus' AND M.nombre ='$nomas'";
                $mascota = mysqli_query($mysqli, $sql1) or die(mysqli_error());

                $mas = mysqli_fetch_assoc($mascota);	
                if ($mas)
                {
                    $tipoMas   = $mas['TIPO_MASCOTA'];
                    $idtipoMas = $mas['IDTIPO_MAS'];
                    $id_MAS    = $mas['ID_MAS'];
                    $idusu     = $mas['IDUSU'];
                    $nombremas = $mas['NOMBRE_MASCOTA'];  
                    $color     = $mas['COLOR'];
                    $especie   = $mas['ESPECIE'];
                    $raza      = $mas['RAZA_MASCOTA'];
                    $idvet     = $mas['ID_VETERINARIO'];                        
                    $nompro    = $mas['NOMBRE_PROPIETARIO'];

                    $sqlvet = "SELECT concat(Nombres, Apellidos) AS nombre FROM usuario WHERE id_usu = '".$idvet."'";
                    $vet = mysqli_query($mysqli, $sqlvet) or die(mysqli_error());
                    $vet1 = mysqli_fetch_assoc($vet);

                    if($vet1!= null)
                    {   
                        $vete = $vet1['nombre'];
                    }
                    else 
                        $vete = "";

                    

                }
                else
                {
                    $tipoMas   = "";
                    $idtipoMas = "";
                    $id_MAS    = "";
                    $idusu     = "";
                    $nombremas = "";
                    $color     = "";
                    $especie   = "";
                    $raza      = "";
                    $idvet     = "";
                    $nompro    = "";
                    $vete      = "";
                    

                    echo '<script>alert (" No existe la mascota");</script>';

                }     
        }
    


}

    elseif ((isset($_POST["insertar"])) && ($_POST["MM_insertar"] == "form4"))
    {
        if (($_POST['1']== "" )||($_POST['10']== "" )||($_POST['4']== "" )  // Valida si vienen campos vacios
            ||($_POST['5']== "" )||($_POST['6']== "" )||($_POST['11']== "" ))
        {
            $tipoMas   = "";
            $idtipoMas = "";
            $id_MAS    = "";
            $idusu     = "";
            $nombremas = "";
            $color     = "";
            $especie   = "";
            $raza      = "";
            $idvet     = "";
            $nompro    = "";
            $vete      = "";
            
            echo '<script>alert (" Datos Vacios. No se puede insertar registros");</script>';
        }
        else
        {
            $sqlinsermas = "SELECT * FROM mascota_cliente WHERE id_mascli  = '".$_POST['1']."'"; //Valida si mascota existe
            $insermascota = mysqli_query($mysqli, $sqlinsermas) or die(mysqli_error());
            $total = mysqli_num_rows($insermascota);
            if ($total !=0)
            {
                echo '<script>alert (" Mascota ya existe.Intenta nuevamente");</script>';
            }
            else
            {  



                $id_MAS   =  $_POST['1'];
                $idtipoMas =  $_POST['10'];
                $idusu     =  $_POST['11'];
                $nombremas =  $_POST['4'];
                $color     =  $_POST['5'];
                $especie   =  $_POST['6'];
                $raza      =  $_POST['7'];
                $idvet     =  $_POST['8'];               

       
                $sql7 = "INSERT INTO mascota_cliente (id_mascli, id_tipomas , id_usu , nombre, color, especie, raza, id_vet) 
                         VALUES ('$id_MAS', '$idtipoMas', '$idusu', '$nombremas', '$color', '$especie', '$raza', '$idvet' )";
                mysqli_query($mysqli, $sql7) or die(mysqli_error());
                echo '<script>alert (" Mascota Insertado);</script>';          
             }
         }
    }
         // Opción de edición de registros //
    if ((isset($_POST["editar"])) && ($_POST["MM_editar"] == "form4")) 
    {      
         
        //   consulta tipo de usurio //
        if (($_POST['1']== "" )||($_POST['10']== "" )||($_POST['4']== "" )  // Valida si vienen campos vacios
            ||($_POST['5']== "" )||($_POST['6']== "" )||($_POST['11']== "" ))
            
        {
            $tipoMas   = "";
            $idtipoMas = "";
            $id_MAS    = "";
            $idusu     = "";
            $nombremas = "";
            $color     = "";
            $especie   = "";
            $raza      = "";
            $idvet     = "";
            $nompro    = "";
            $vete      = "";

            echo '<script>alert (" Datos Vacios. No se puede actualizar");</script>';
        }
        else
        {
            $id_MAS   =  $_POST['1'];
            $idtipoMas =  $_POST['10'];
            $idusu     =  $_POST['11'];
            $nombremas =  $_POST['4'];
            $color     =  $_POST['5'];
            $especie   =  $_POST['6'];
            $raza      =  $_POST['7'];
            $idvet     =  $_POST['8']; 

           // $producto=$_POST['seleccion'];
                $sql7 = "UPDATE mascota_cliente SET nombre = '$nombremas', color = '$color', especie = '$especie', id_vet = '$idvet'
                 WHERE id_mascli ='$id_MAS'";
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
        $tipoMas   = "";
        $idtipoMas = "";
        $id_MAS    = "";
        $idusu     = "";
        $nombremas = "";
        $color     = "";
        $especie   = "";
        $raza      = "";
        $idvet     = "";
        $nompro    = "";
        $vete      = "";
        
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
    <title>Modulo Administrador - Gestión de Mascotas</title>
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
                <td align="left"><h1 >&nbsp&nbsp&nbsp&nbspMÓDULO ADMINISTRADOR - GESTIÓN DE MASCOTAS</h1></th>
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
                            <label for="first_name" class="required">Id Usuario </label>
                            <input type="number" name="id_usuario" id="first_name"required />

                            <label for="first_name" class="required">Nombre mascota </label>
                            <input type="text" name="nombremas" id="nomas" required />

                            <input type="submit" name="buscar" id="buscar" value="Buscar mascota" onclick="tipo();"/>
                            <input type="hidden" name="operacion" value="1" />
                            <input type="hidden" name="MM_buscar" value="form1" />
                        </div>                                
        </form>                                                                  
                    </th>               
                    <th>                                
                        <div class="select-list">
                            <label (id ="label" for="mascota" class="required">Escoger operación: </label>
                            
                            <select class="form-con">
                                <option selected="" disabled="">-- Selecciona --</option>
                                <option data-typeid="1" value="1">Editar</option>
                                <!--<option data-typeid="2" value="2">Eliminar</option>-->
                                <option data-typeid="2" value="2">Insertar</option>
                            </select>
                        </div>
                        <script type="text/javascript">
                            $(document).on('change', 'select.form-con', function() 
                            {
                                var a = $('select.form-con option[value="'+$(this).val()+'"]').attr("data-typeid")

                                if (a == 1)  // Editar
                                {
                                    document.getElementById('editar').disabled = false
                                    document.getElementById('insertar').disabled = true
                                    //document.getElementById('eliminar').disabled = true
                                    document.getElementById('a').readOnly = true
                                    document.getElementById('seleccion').style.display = "none"
                                    document.getElementById('b').style.display = "inline";
                                    document.getElementById('b').readOnly = true
                                    document.getElementById('j').style.display = "none"
                                    document.getElementById('c').style.display = "inline"
                                    document.getElementById('h').style.display = "inline"
                                    document.getElementById('c').readOnly = true
                                    document.getElementById('seleccion').style.display = "none"; 
                                    document.getElementById('i').readOnly = true
                                    document.getElementById('etiqueta').style.display = "inline"
                                    
                                }
                               /* else if(a == 2) //Eliminar
                                {
                                    //$("#11").val(document.getElementById('a').value)
                                    document.getElementById('editar').disabled = true
                                    document.getElementById('insertar').disabled = true
                                    document.getElementById('eliminar').disabled = false
                                    document.getElementById('a').disabled = false
                                    document.getElementById('a').readOnly = true
                                    document.getElementById('seleccion').style.display = "none"; 
                                }*/

                                else if (a==2)  // Insertar
                                {                                   
                                    document.getElementById('insertar').disabled = false 
                                    document.getElementById('editar').disabled = true
                                    //document.getElementById('eliminar').disabled = true
                                    document.getElementById('a').readOnly = false
                                    document.getElementById('k').style.display = "inline"
                                    document.getElementById('j').style.display = "inline"                                                                       
                                    document.getElementById('i').readOnly = true;
                                    document.getElementById('b').style.display = "none";
                                    document.getElementById('c').style.display = "none";
                                    document.getElementById('h').style.display = "inline"; 
                                    document.getElementById('i').style.display = "inline";  
                                    document.getElementById('i').readOnly = true;  
                                    document.getElementById('seleccion').style.display = "inline";                                   
                                    $("#a").val(""); $("#b").val(""); $("#c").val(""); $("#d").val(""); $("#e").val(""); $("#f").val(""); 
                                    $("#g").val(""); $("#h").val(""); $("#i").val(""); $("#j").val(""); $("#k").val("");
                                    
                                }                          
                            });
                        </script>
                    </th>
                    <th>
                        <table  id="form3" width="100%" border ="0" >
                            <tr>
                                
                            </tr>
                        </table>                          
        <!---           FORM 4   ---  INSERTAR, MODIFICAR Y ELIMINAR USUARIO  ---->
        <form method="POST" name="form4"  id="form4">                              
                        <div class="form-control">
                                <input type = "submit" name="editar" id="editar" value="Editar" disabled ="true" class="form-control"/>
                                <label for="first_name" class="required">&nbsp&nbsp</label>
                               <!-- <input type = "submit" name="eliminar" id="eliminar" value="Eliminar" disabled ="true" class="form-control"/>-->
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
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Resultado de la búsqueda
                        </h2>
                    </th>
                </tr>
                <tr>
                    <table class="t3" border="1" cellspacing="2" cellpadding="2" >
                        <tr>
                            <th><font face="Arial"> Id mascota </font></th>
                            <th><font face="Arial"> Tipo mascota </font></th>
                            <th><font face="Arial"> Nombre propietario </font></th>
                            <th><font face="Arial"> Nombre mascota </font></th>
                            <th><font face="Arial"> Color </font></th>
                            <th><font face="Arial"> Especie </font></th>
                            <th><font face="Arial"> Raza </font></th>
                            <th><font face="Arial"> Veterinario </font></th>
                        </tr>
                        <tr font-size="1">    
                           <?php
                           /*
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
                                $arreglo = array("Activo","Inactivo");*/
                            ?>       
                            <div style="visibility: hidden">
                                <div class="form-control" style="visibility: hidden">           
                                           
                                <!--
                                                                                                        $tipoMas   = $mas['TIPO_MASCOTA']; 2
                                                                                                        $idtipoMas = $mas['IDTIPO_MAS']; 10 hidden
                                                                                                        $id_MAS    = $mas['ID_MAS'];    1
                                                                                                        $idusu     = $mas['IDUSU']; 11 hidden
                                                                                                        $nombremas = $mas['NOMBRE_MASCOTA'];  4
                                                                                                        $color     = $mas['COLOR']; 5
                                                                                                        $especie   = $mas['ESPECIE'];6
                                                                                                        $raza      = $mas['RAZA_MASCOTA'];7
                                                                                                        $idvet     = $mas['ID_VETERINARIO']; 8
                                                                                                        $vete	   = $mas['NOMBRE_VETERINARIO'];
                                                                                                        $nompro    = $mas['NOMBRE_PROPIETARIO'];3	
                            -->
                                            <td><input type = "text" id = "a" name="1" style="width : 150px; heigth : 1px" value= "<?php echo $id_MAS   ?>" /></td>
                                            <td><input type = "text" hidden placeholder = "id tipo mas" id = "j" name="10" style="width : 80px; heigth : 1px" value= "<?php echo $idtipoMas?>" />
                                                <input type = "text" id = "b" name="2" style="width : 80px; heigth : 1px" value= "<?php echo  $tipoMas?>" />
                                            
                                                <?php
                                                    $sql10 = "SELECT * FROM tipo_mascota";
                                                    $tipo = mysqli_query($mysqli, $sql10) or die(mysqli_error());
                                                    $id = array();
                                                    $nom_tipomascota = array();
                                                    $nom = "";
                                                    $i = 0;
                                                    $val = 0;
                                                        while ($tip = mysqli_fetch_assoc($tipo))
                                                        {
                                                            $id[$i] =$tip['id_tipomas'];
                                                            $nom_tipomascota[$i] = $tip['tipomas'];                                                            
                                                            $i = $i +1;                                            
                                                        }                                         
                                                       
                                                ?> 




                                                <select class = "seleccion" id="seleccion" name= "seleccion" hidden>
                                    <option value ="0" selected  disabled="">-- Selecciona --</option>
                                    <?php
                                            for ($n = 0; $n<$i; $n++)
                                            {
                                                $ot = $n+1;
                                                if ( $ot == $val)
                                                { 
                                                    echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'" selected >'.$nom_tipomascota[$n].' </option>';
                                                }
                                                else
                                                    echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'">'.$nom_tipomascota[$n].' </option>';
                                            }
                                        ?>               
                                            <input type = "hidden" id = "h" name="8" style="width : 80px; heigth : 1px" placeholder = "H"  value= "<?php echo $idtipousuario?>" />                                           
                                    </td>
                                    <div class="select-list">
                                       

                                            <script type="text/javascript"> 
                                    $(document).on('change', 'select.seleccion', function()  
                                    {
                                        var a = $('select.seleccion option[value="'+$(this).val()+'"]').attr("data-typeid")
                                        $("#j").val(a)                                     
                                           
                                            document.getElementById('k').attributes["required"] = "required"
                                            document.getElementById('d').attributes["required"] = "required"
                                            document.getElementById('e').attributes["required"] = "required"
                                            document.getElementById('f').attributes["required"] = "required"
                                            document.getElementById('g').attributes["required"] = ""

                                    });

                                </script>                        

             
                                            
                                            </td>
                                            <td><input type = "text" hidden placeholder = "id usu" id = "k" name="11" style="width : 80px; heigth : 1px" value= "<?php echo $idusu?>" />
                                                <input type = "text" id = "c" name="3" style="width : 150px; heigth : 1px" value= "<?php echo $nompro?>" /></td>
                                            <td><input type = "text" id = "d" name="4" style="width : 150px; heigth : 1px" value= "<?php echo $nombremas?>" /></td>
                                            <td><input type = "text" id = "e" name="5" style="width : 130px; heigth : 1px" value= "<?php echo $color?>" /></td>
                                            <td><input type = "text" id = "f" name="6" style="width : 80px; heigth : 1px" value= "<?php echo $especie?>" /></td>
                                            <td><input type = "text" id = "g" name="7" style="width : 80px; heigth : 1px" value= "<?php echo $raza?>" /></td>
                                            <td><input type = "text" hidden placeholder = "id veterinario" id = "h" name="8" style="width : 80px; heigth : 1px" value= "<?php echo $idvet?>" />
                                            <input type = "text" id = "i" name="9" style="width : 80px; heigth : 1px" value= "<?php echo $vete?>" /></td>                                            
                                            
                                        
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

                        <input type="text" name="tipou" id="tipou" value = ""placeholder="Tipo de Usuario, Estado" hidden/>                      
                        <button type="button" id="Bsubmit" hidden>Buscar</button> 
                </h2>
                <h2 align="center">Listado de Mascotas <label id="mensaje"></label></h2>     
            </div>
        </form>
       
    </div>            
    <div class = "general">   
        <div class = "marco1"> 
            <table class="t3" border="1" cellspacing="2" cellpadding="2" >
                <thead   width:"100%">
                <tr>
                             
                             <th><font face="Arial"> Id mascota </font></th>
                             <th><font face="Arial"> Tipo Mascota </font></th>
                             <th><font face="Arial"> Nombre propietario </font></th>
                             <th><font face="Arial"> Nombre mascota </font></th>
                             <th><font face="Arial"> Color </font></th>
                             <th><font face="Arial"> Especie </font></th>
                             <th><font face="Arial"> Raza </font></th>
                             <th><font face="Arial"> Id Veterinario </font></th>
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
                             T.id_tipomas = M.id_tipomas AND M.id_usu = P.id_usu
                       ORDER BY  M.id_mascli ASC ";
 
                             $pet = mysqli_query($mysqli, $sql2) or die(mysqli_error());                          
                            
                             while ($rows = mysqli_fetch_assoc($pet))	
                             {
                                 
                         ?>
                    <tr>  
                            <td><font face="Arial"><?php echo $rows['ID']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['TIPO_MASCOTA']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['NOMBRE_PROPIETARIO']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['NOMBRE_MASCOTA']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['COLOR']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['ESPECIE']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['RAZA_MASCOTA']; ?></font></td>
                            <td><font face="Arial"><?php echo $rows['ID_VETERINARIO']; ?></font></td>
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

