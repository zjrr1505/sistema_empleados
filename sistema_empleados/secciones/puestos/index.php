<?php

include("../../db.php");

if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $sentencia = $conexion->prepare("DELETE FROM tbl_puestos WHERE id=:id");
  $sentencia->bindParam(":id", $txtID);
  $sentencia->execute();
  header("Location: index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../templates/header.php"); ?>

<br>

<h4>Puestos</h4>
<div class="card">
  <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
  </div>

  <div class="card-body">
    <div class="table-responsive-sm">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del puesto</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($lista_tbl_puestos as $registro) { ?>
            <tr class="">
              <td scope="row">
                <?php echo $registro['id']; ?>
              </td>
              <td>
                <?php echo $registro['nombredelpuesto']; ?>
              </td>
              <td>
                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id']; ?>" role="button">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>

      </table>
    </div>
  </div>
</div>



<?php include("../../templates/footer.php"); ?>