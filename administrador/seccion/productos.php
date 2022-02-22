<!-- interface crud de libros -->
<?php include("../template/cabecera.php");  ?>

<?php
    
    /* Validar formulario */
    $tnombre=(isset($_POST['tnombre']))?$_POST['tnombre']:""; 
    $tautor=(isset($_POST['tautor']))?$_POST['tautor']:"";
    $tprecio=(isset($_POST['tprecio']))?$_POST['tprecio']:"";
    $timagen=(isset($_FILES['timagen']['name']))?$_FILES['timagen']['name']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    /* Incluimos la base de datos */
    include("../config/bd.php");

    
    switch($accion){
        case "Agregar":

            $sentanciaSQL = $conexion->prepare("INSERT INTO libros (tnombre,tautor,tprecio,timagen) VALUES (:nombre,:autor,:precio,:imagen);");
            $sentanciaSQL->bindParam(':nombre',$tnombre);
            $sentanciaSQL->bindParam(':autor',$tautor);
            $sentanciaSQL->bindParam(':precio',$tprecio);
            $sentanciaSQL->bindParam(':imagen',$timagen);
            $sentanciaSQL->execute();
            break;

        case "Editar":
            echo "editar producto";
            break;

        case "Eliminar":
            echo "eliminar producto";
            break;
    }

    

    
?>

 <div class="col-md-5">
     <div class="card">
         <h1 class="text-center">Datos de libro</h1>
         <div class="card-body">
         <h3 class="text-center">Agregar Producto</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class = "form-group">
                <label for="">Nombre de libro</label>
                <input type="text" class="form-control" id="tnombre" name="tnombre"  placeholder="Enter Name">
                </div>
                <div class = "form-group">
                <label for="">Autor</label>
                <input type="text" class="form-control" id="tautor" name="tautor"  placeholder="Enter Autor">
                </div>
                <div class = "form-group">
                <label">Costo</label>
                <input type="number" class="form-control" id="tprecio" name="tprecio" placeholder="Enter Price">
                </div>
                <div class = "form-group">
                <label">Imagen</label>
                <input type="file" class="form-control" id="timagen" name="timagen" placeholder="Enter Price">
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-primary">Agregar</button>
                    <button type="submit" name="accion" value="Editar" class="btn btn-secondary">Editar</button>
                    <button type="submit" name="accion" value="Eliminar" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
         </div>
     </div> 
 </div>
 <div class="col-md-7">
     <table class="table table-bordered">
         <thead>
             <tr>
                 <th>ID</th>
                 <th>Nombre de libro</th>
                 <th>Autor</th>
                 <th>Costo</th>
                 <th>Imagen</th>
                 <th>Acciones</th>
             </tr>
         </thead>
         <tbody>
             <?php ?>
             <tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
             </tr>
         </tbody>
     </table>
 </div>
 
    
<?php include("../template/pie.php");  ?>