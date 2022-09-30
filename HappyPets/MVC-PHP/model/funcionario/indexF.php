<?php
    session_start();
    require_once("../../db/connection.php");
	include("../../controller/validarSesion.php");
	$sql = "SELECT * FROM usuario, tipo_usuario WHERE email = '".$_SESSION['usuario']."' AND usuario.id_tipousu = tipo_usuario.id_tipousu";
	$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
	$usua = mysqli_fetch_assoc($usuarios);
	$idusuario = $usua['id_usu'];
    $idvisita        ="";
    $idveterinario   =  "";
    $idmascota       =  "";
    $idestado        =  "";
    $temp            =  "";
    $peso            = "";
    $fr_res          =  "";
    $fr_card         = "";
    $recomendaciones =  ""; 
    $fechavisita     =  "";
    $costo           = ""; 
    $idvisita = "";
    $idmascotab = "";

    if ((isset($_POST["MM_buscar"])) && ($_POST["MM_buscar"] == "form1")) 
    {
        /*   consulta tipo de usurio */
        $idmascotab = $_POST['id_mascota'];
        if ($idmascotab == "" )
        {
            $idvisita        ="";
            $idveterinario   =  "";
            $idmascota       =  "";
            $idestado        =  "";
            $temp            =  "";
            $peso            = "";
            $fr_res          =  "";
            $fr_card         = "";
            $recomendaciones =  ""; 
            $fechavisita     =  "";
            $costo           = ""; 
            $idvisita = "";
            
                echo '<script>alert (" Datos Vacios");</script>';
        }
        else
        {
            $sql7 = "SELECT 
               M.id_vet AS Id_Veterinario, M.id_mascli AS Id_Mascota, M.nombre AS Nombre_Mascota FROM mascota_cliente M, usuario U 
             WHERE M.id_vet = U.id_usu AND M.id_mascli = '$idmascotab' AND U.id_usu = '$idusuario'";
            $datos = mysqli_query($mysqli, $sql7) or die(mysqli_error());
            $usu = mysqli_fetch_assoc($datos);

            if ($usu)
            {
                $idveterinario   = $usu['Id_Veterinario'] ;
                $idmascota       =  $usu['Id_Mascota'];
                $idestado        =  "";
                $temp            =  "";
                $peso            = "";
                $fr_res          =  "";
                $fr_card         = "";
                $recomendaciones =  ""; 
                $fechavisita    =  "";
                $costo           = ""; 
                $idvisita       = "";
            }

        }
    }

    if ((isset($_POST["insertar"])) && ($_POST["MM_insertar"] == "form4"))
    {


    if (($_POST['10']== "" )||($_POST['1']== "" )||($_POST['3']== "" )||($_POST['4']== "" )  // Valida si vienen campos vacios
    ||($_POST['5']== "" )||($_POST['6']== "" )||($_POST['7']== "" )||($_POST['9']== "" )||($_POST['2']== "")||($_POST['8']== ""))
    {
                     
                echo '<script>alert (" Datos Vacios. No se puede actualizar");</script>';
    }
    else
    {
            $idvisita        =  $_POST['11'];
            $idveterinario   =  $_POST['1'];
            $idmascota =  $_POST['2'];
            $idestado   =  $_POST['3'];
            $temp =  $_POST['4'];
            $peso     =  $_POST['5'];
            $fr_res  =  $_POST['6'];
            $fr_card     =  $_POST['7'];
            $recomendaciones   =  $_POST['8']; 
            $fechavisita    =  $_POST['9'];
            $costo      = $_POST['10']; 
            
      

                $sql7 = "INSERT INTO visitas 
                 (id_vet, id_mascli, id_est, temperatura, peso, fre_res, fre_car, recomendaciones, fecha_vis, costo_visita)
                 values ('$idveterinario',  '$idmascota',  '$idestado', '$temp',  '$peso', '$fr_res', '$fr_card' , '$recomendaciones', '$fechavisita', '$costo' )";
                mysqli_query($mysqli, $sql7) or die(mysqli_error($mysqli));
                echo '<script>alert (" Visita Creada");</script>';
        
        /*



      

        $sql7 = "SELECT * FROM visitas 
                WHERE id_mascli = '$idmascota' AND id_vet = '$idusuario'";
        $datos = mysqli_query($mysqli, $sql7) or die(mysqli_error());
        $usu = mysqli_fetch_assoc($datos);
        if ($usu)
        {
            $idvisita        = $usu['id_vis'];
            $idveterinario   = $usu['id_vet'];
            $idmascota       =  $usu['id_mascli'];
            $idestado        =  $usu['id_est'];
            $temp            =  $usu['temperatura'] ;
            $peso            = $usu['peso'];
            $fr_res          =  $usu['fre_res'];
            $fr_card         = $usu['fre_car'];;
            $recomendaciones = $usu['recomendaciones'];; 
            $fechavisita     =  $usu['fecha_vis'];;
            $costo           = $usu['costo_visita'];; 
        }

          */

    }
    }

    if(isset($_POST['btncerrar']))
    {
        session_destroy();
        header('location: ../../index.html');
    }
    if ((isset($_POST["buscar"])) && isset($_POST["MM_buscar"])=="")
    {
        $idvisita       = "";
        $idveterinario   =  "";
        $idmascota       =  "";
        $idestado        =  "";
        $temp            =  "";
        $peso            = "";
        $fr_res          =  "";
        $fr_card         = "";
        $recomendaciones =  ""; 
        $fechavisita     =  "";
        $costo           = ""; 
        $idmascotab      ="";
        
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
    <title>Modulo Funcionario - Gestión de Visitas</title>
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
                <td align="left"><h1 >&nbsp&nbsp&nbsp&nbspMÓDULO FUNCIONARIO - GESTIÓN DE VISITAS</h1></th>                
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
                <tr align="left">   <!---           BÚSQUEDA POR USUARIO  ---->
                    <th width="40%"><label for="first_name" class="required">Búsquedas</label></th>
                    <th width="30%" align ="right"><label for="first_name" class="required"></label></th>
                </tr>
                <tr>
                    <th width="40%">
                        <div class="form-input">
                            <label for="first_name" class="required">Mascotas Por cliente </label>
                            <input type="text" name="id_mascota" id="id_mascota" hidden  />
                            <?php
                                $sql10 = "SELECT 
                                    M.id_vet AS Id_Veterinario, 
                                    M.id_mascli AS Id_Mascota, 
                                    M.nombre AS Nombre_Mascota,
                                concat(P.Nombres, ' ', P.Apellidos) AS Propietario 
                                FROM mascota_cliente M, usuario U, usuario P
                               WHERE M.id_vet = U.id_usu AND M.id_usu = P.id_usu AND U.id_usu = '$idusuario' ";
                                $tipo = mysqli_query($mysqli, $sql10) or die(mysqli_error());
                                $id = array();
                                $nom_mascota = array();
                                $nom_prop = array();
                                $nom = "";
                                $i = 0;
                                $val = 0;
                                    while ($tip = mysqli_fetch_assoc($tipo))
                                    {
                                        $id[$i] =$tip['Id_Mascota'];
                                        $nom_mascota[$i] = $tip['Nombre_Mascota'];   
                                        $nom_prop[$i] = $tip['Propietario'];                                                          
                                        $i = $i +1;                                            
                                    }                                                                          
                            ?> 
                                <select class = "seleccion" id="seleccion" name= "seleccion" >
                                    <option value ="0" selected  disabled="">-- Selecciona --</option>
                                    <?php
                                            for ($n = 0; $n<$i; $n++)
                                            {
                                                $ot = $n+1;
                                                if ( $ot == $val)
                                                { 
                                                    echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'" selected >'.$nom_prop[$n].' - '.$nom_mascota[$n].' </option>';
                                                }
                                                else
                                                    echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'">'.$nom_prop[$n].' - '.$nom_mascota[$n].' </option>';
                                            }
                                        ?>               
                                            <input type = "hidden" id = "h" name="8" style="width : 80px; heigth : 1px" placeholder = "H"  value= "<?php echo $idusuario?>" />                                           
                                </select>
                    <script type="text/javascript">
                        $(document).on('change', 'select.seleccion', function() 
                        {
                            var a = $('select.seleccion option[value="'+$(this).val()+'"]').attr("data-typeid")
                            document.getElementById('id_mascota').value = a
                        });
                    </script>       

   
                            <input type="submit" name="buscar" id="buscar" value="Buscar mascota"  onclick="tipo();"/>
                            <input type="hidden" name="operacion" value="1" />
                            <input type="hidden" name="MM_buscar" value="form1" />
                        </div>                                
        </form>                                                                  
                    </th>               
                    <th>                                
                        
                    </th>
                    <th>
                        <table  id="form3" width="100%" border ="0" >
                            <tr>
                                
                            </tr>
                        </table>                          
        <!---           FORM 4   ---  INSERTAR, MODIFICAR Y ELIMINAR USUARIO  ---->
        <form method="POST" name="form4"  id="form4">                              
                        <div class="form-control">
                                
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
                <tr align = "center">
                    <th colspan="2" scope="rowgroup" align = "center">
                        <h2 align="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Insertar Visita
                        </h2>
                    </th>
                </tr>
                <tr>
                    <table class="t3" border="1" cellspacing="2" cellpadding="2" >
                        <tr>
                            
                            <th><font face="Arial"> Id Veterinario</font></th>
                            <th><font face="Arial"> Id Mascota </font></th>
                            <th><font face="Arial"> Id Estado </font></th>
                            <th><font face="Arial"> Temp </font></th>
                            <th><font face="Arial"> Peso </font></th>
                            <th><font face="Arial"> Fr Respi </font></th>
                            <th><font face="Arial"> Fr Car </font></th>
                            <th><font face="Arial"> Recomendaciones</font></th>
                            <th><font face="Arial"> Fecha Visita</font></th>
                            <th><font face="Arial"> Costo Visita</font></th>
                        </tr>
                        <tr font-size="1">          
                            <div style="visibility: hidden">
                                <div class="form-control" style="visibility: hidden">           
                                        <input type = "hidden" id = "j" name="11" style="width : 100px; heigth : 1px" value= "<?php echo $idvisita ?>" />
                                        <td><input type = "text" id = "a" name="1" style="width : 100px; heigth : 1px" value= "<?php echo $idveterinario ?>" /></td>
                                        <td><input type = "text" id = "b" name="2" style="width : 80px; heigth : 1px" value= "<?php echo $idmascota?>" /></td>

                                        
                                            <?php
                                                $sql10 = "SELECT * FROM estado";
                                                $tipo = mysqli_query($mysqli, $sql10) or die(mysqli_error());
                                                $id = array();
                                                $nom_estado = array();
                                                $nom = "";
                                                $i = 0;
                                                $val = 0;
                                                    while ($tip = mysqli_fetch_assoc($tipo))
                                                    {
                                                        $id[$i] =$tip['id_est'];
                                                        $nom_estado[$i] = $tip['estado'];                                                            
                                                        $i = $i +1;                                            
                                                    } 
                                                    
                                                $sqlCosto = "SELECT * FROM afiliacion WHERE id_mascli = '$idmascota'";
                                                $resultado = mysqli_query($mysqli, $sqlCosto) or die(mysqli_error());
                                                $afiliado = mysqli_fetch_assoc($resultado); 

                                                if ($afiliado)
                                                {
                                                    $cobro = 0;        
                                                } 
                                                else
                                                {
                                                     $costo = 1;   
                                                }

                                            ?> 
                                                <input type = "hidden" id = "costo" name="costo" style="width : 80px; heigth : 1px" value= "<?php echo $costo?>" />


                                        </td>
                                            </td>
                                            <td>
                                                <input type = "text" hidden  id = "c" name="3" required style="width : 30px; heigth : 1px" value= "<?php echo $idestado ?>" />
                                                <select class = "estado" id="estado" name= "estado" >
                                                    <option value ="0" selected  disabled="">-- Selecciona --</option>
                                                    <?php
                                                            for ($n = 0; $n<$i; $n++)
                                                            {
                                                              if ($n>1)
                                                              {
                                                                $ot = $n+1;
                                                                if ( $ot == $val)
                                                                { 
                                                                    echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'" selected >'.$nom_estado[$n].' </option>';
                                                                }
                                                                else
                                                                    echo '<option data-typeid="'.$id[$n].'" value="'.$id[$n].'">'.$nom_estado[$n].' </option>';
                                                              }
                                                            }
                                                        ?>                  
                                                        </select>
                                             
                                                        <script type="text/javascript"> 
                                                            $(document).on('change', 'select.estado', function()  
                                                            {
                                                                var a = $('select.estado option[value="'+$(this).val()+'"]').attr("data-typeid")                    
                                                                document.getElementById('c').value = a

                                                                var b = document.getElementById('costo').value
                                                                if(b == 0)
                                                                {
                                                                    document.getElementById('i').value = 0
                                                                    document.getElementById('i').readOnly = true                                                                   

                                                                }
                                                                else
                                                                {
                                                                    document.getElementById('i').readOnly = false   
                                                                }
                                                            });
                                                        </script>                        
                                            </td>
                                            <td><input type = "text" id = "d" name="4" required style="width : 30px; heigth : 1px" value= "<?php echo $temp?>"/></td>
                                            <td><input type = "text" id = "e" name="5" required  style="width : 30px; heigth : 1px" value= "<?php echo $peso?>" /></td>
                                            <td><input type = "text" id = "f" name="6" required style="width : 30px; heigth : 1px" value= "<?php echo $fr_res?>" /></td>
                                            <td><input type = "text" id = "g" name="7" required style="width : 30px; heigth : 1px" value= "<?php echo $fr_card?>" /></td>
                                            <td><input type = "text" id = "h" name="8" required style="width : 350px; heigth : 1px" value= "<?php echo $recomendaciones?>" /></td>
                                            <td><input type = "date" id = "h" name="9" required style="width : 80px; heigth : 1px" value= "<?php echo $fechavisita?>" /></td>
                                            <td><input type = "text" id = "i" name="10" required style="width : 80px; heigth : 1px" value= "<?php echo $costo?>" /></td>                                          
                                    </div>
                                </div>          
                            </div>
                        </tr>
                    </table>                  
                </tr>
            </table>
        
     </div>    
    <div class = "encabezado">
        <h2 align="center">
            <h2 align="center">
                <input type = "submit" name="insertar" id="insertar" value="Insertar Visita" /> 
            </h2>   
            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>  
                <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>   
        </h2>
        <h2 align="center">Listado de Visitas <label id="mensaje"></label></h2>     
    </div>
    </form>
    </div>            
    <div class = "general">   
        <div class = "marco1"> 
            <table class="t3" border="1" cellspacing="2" cellpadding="2" >
                <thead   width:"100%">
                <tr>
                             
                             <th><font face="Arial"> No Visita </font></th>
                             <th><font face="Arial"> Nombre Veterinario </font></th>
                             <th><font face="Arial"> Id Mascota</font></th>
                             <th><font face="Arial"> Estado Mascota </font></th>
                             <th><font face="Arial"> temperatura </font></th>
                             <th><font face="Arial"> peso</font></th>
                             <th><font face="Arial"> Fre Respiratoria </font></th>
                             <th><font face="Arial"> Fre Cardiaca </font></th>
                             <th><font face="Arial"> Recomendaciones </font></th>
                             <th><font face="Arial"> Fecha Visita </font></th>
                             <th><font face="Arial"> costo visita </font></th>     
                             <th><font face="Arial"> Medicamentos </font></th>            
                         </tr>
                     </thead>
                     <tbody> 
                 <?php
                  if ($idmascotab =="")
                   {
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
                             E.estado AS Estado_Mascota
                              FROM visitas V, usuario U, estado E WHERE V.id_vet = U.id_usu AND V.id_est = E.id_est AND V.id_vet = '$idusuario'  ";
                   }
                   if ($idmascotab !="")
                   {
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
                             E.estado AS Estado_Mascota
                              FROM visitas V, usuario U, estado E WHERE V.id_vet = U.id_usu AND V.id_est = E.id_est AND V.id_mascli = '$idmascotab' AND V.id_vet = '$idusuario'  ";

                   }
                       // echo $sql2;
                             $pet = mysqli_query($mysqli, $sql2) or die(mysqli_error());                          
                            
                             while ($rows = mysqli_fetch_assoc($pet))	
                             {
                                 
                         ?>
                    <tr>  
                        <td><font face="Arial"><?php echo $rows['No_Visita']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Nombre_Veterinario']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Id_Mascota']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Estado_Mascota']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Temp']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Peso']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Fre_Respiratoria']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Fre_Cardiaca']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Recomendaciones']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Fecha_Visita']; ?></font></td>
                        <td><font face="Arial"><?php echo $rows['Costo']; ?></font></td> 
                        <td>
                            <button type="button" class ="consulta"  name=""  id="<?php echo $rows['No_Visita']; ?>" >Consultar</button>
                            <button type="button" class ="inp"  name=""  id="<?php echo $rows['No_Visita']; ?>" >Asignar</button>  </td>                         
                    <?php
                        }
                    ?>    

                    <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                    </tbody>
            </table>
            <script src="~/Scripts/jquery.unobtrusive-ajax.min.js"></script>
			<script type="text/javascript">
               var botones = document.getElementsByClassName('inp');
				for(var i = 0; i < botones.length; i++){
				botones[i].addEventListener('click', capturar);
				}
					function capturar(){
					var a = this.id;
                    var enlace = "asignar_medicamento.php?idvisita="+a;
                    window.open(enlace,"Insertar Medicamento","width=1120,height=100,scrollbars=NO","top =10", "left=10"); 
				}
			</script>
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
    </div>                     
</body>
</html>

