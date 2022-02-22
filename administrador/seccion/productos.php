<!-- interface crud de libros -->
<?php include("../template/cabecera.php");  ?>

<?php
    
    /* Validar formulario */
    $tnombre=(isset($_POST['tnombre']))?$_POST['tnombre']:""; 
    $tid=(isset($_POST['id']))?$_POST['id']:"";
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

        case "Modificar":
                $sentanciaSQL= $conexion->prepare("UPDATE libros SET tnombre=:tnombre, tautor=:tautor, tprecio=:tprecio WHERE id=:id");
                $sentanciaSQL->bindParam(':tnombre',$txtNombre);
                $sentanciaSQL->bindParam(':tautor',$txtAutor);
                $sentanciaSQL->bindParam(':tprecio',$txtPrecio);
                $sentanciaSQL->bindParam(':id',$tid);
                $sentanciaSQL->execute();
                break;

        case "Eliminar":
            echo "eliminar producto";
            break;

        case "Seleccionar":
                $sentanciaSQL= $conexion->prepare("SELECT * FROM libros WHERE id=:id");
                $sentanciaSQL->bindParam(':id',$tid);
                $sentanciaSQL->execute();
                //cargar los datos 1 a 1
                $libro=$sentanciaSQL->fetch(PDO::FETCH_LAZY);

                $txtNombre=$libro['tnombre'];
                $txtAutor=$libro['tautor'];
                $txtPrecio=$libro['tprecio'];
                // $txtImagen=$libro['timagen'];
                break;
        
        case "Borrar":
                $sentanciaSQL= $conexion->prepare("DELETE FROM libros WHERE id=:id");
                $sentanciaSQL->bindParam(':id',$tid);
                $sentanciaSQL->execute();
                break;
    }

    $sentanciaSQL= $conexion->prepare("SELECT * FROM libros");
    $sentanciaSQL->execute();
    $listarLibros=$sentanciaSQL->fetchAll(PDO::FETCH_ASSOC);

    
?>

 <div class="col-md-5">
     <div class="card">
         <h1 class="text-center">Datos de libro</h1>
         <div class="card-body">
         <h3 class="text-center">Agregar Producto</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class = "form-group">
                <label for="">Nombre de libro</label>
                <input type="text" class="form-control" id="tnombre" name="tnombre" value="<?php echo $txtNombre; ?>"  placeholder="Enter Name">
                </div>
                <div class = "form-group">
                <label for="">Autor</label>
                <input type="text" class="form-control" id="tautor" name="tautor" value="<?php echo $txtAutor; ?>"  placeholder="Enter Autor">
                </div>
                <div class = "form-group">
                <label">Costo</label>
                <input type="number" class="form-control" id="tprecio" name="tprecio" value="<?php echo $txtPrecio; ?>" placeholder="Enter Price">
                </div>
                <div class = "form-group">
                <label">Imagen</label>
                
                <input type="file" class="form-control" id="timagen" name="timagen" placeholder="Enter Price">
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-primary">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-secondary">Modificar</button>
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
             <?php foreach($listarLibros as $libro) { ?>
             <tr>
                 <td><?php echo $libro['id']; ?></td>
                 <td><?php echo $libro['tnombre']; ?></td>
                 <td><?php echo $libro['tautor']; ?></td>
                 <td><?php echo $libro['tprecio']; ?></td>
                 <td><?php echo $libro['timagen']; ?></td>
                 <td>
                     <form action="" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo $libro['id']; ?>">
                        <input type="submit" class="btn btn-primary" name="accion" value="Seleccionar">
                        <input type="submit" class="btn btn-danger" name="accion" value="Borrar">
                     </form>
                 </td>
             </tr>
             <?php } ?>
         </tbody>
     </table>
 </div>
 
    
<?php include("../template/pie.php");  ?>