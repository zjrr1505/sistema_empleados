<?php
include("../../db.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    
    $primernombre = $registro["primernombre"];
    $segundonombre = $registro["segundonombre"];
    $primerapellido = $registro["primerapellido"];
    $segundoapellido = $registro["segundoapellido"];

    $foto = $registro["foto"];
    $cv = $registro["cv"];

    $idpuesto = $registro["idpuesto"];
    $fechadeingreso = $registro["fechadeingreso"];

    $sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
    $sentencia->execute();
    $lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
}
?>
<?php include("../../templates/header.php"); ?>

<br>
<div class="card">
  <div class="card-header">
    Datos del empleado
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="txtID" class="form-label">ID:</label>
        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"
          aria-describedby="helpId" placeholder="ID">
      </div>

      <div class="mb-3">
        <label for="primernombre" class="form-label">Primer nombre</label>
        <input type="text" value="<?php echo $primernombre; ?>" class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId"
          placeholder="Primer nombre">
      </div>
      <div class="mb-3">
        <label for="segundonombre" class="form-label">Segundo nombre</label>
        <input type="text" value="<?php echo $segundonombre; ?>" class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId"
          placeholder="Segundo nombre">
      </div>
      <div class="mb-3">
        <label for="primerapellido" class="form-label">Primer apellido</label>
        <input type="text" value="<?php echo $primerapellido; ?>" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId"
          placeholder="Primer apellido">
      </div>
      <div class="mb-3">
        <label for="segundoapellido" class="form-label">Segundo apellido</label>
        <input type="text" value="<?php echo $segundoapellido; ?>" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId"
          placeholder="Segundo apellido">
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Foto:</label>
        "<?php echo $foto; ?>"
        <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
      </div>
      <div class="mb-3">
        <label for="cv" class="form-label">CV(PDF):</label>
        "<?php echo $cv; ?>"
        <input type="file" class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
      </div>
      <div class="mb-3">
        <label for="idpuesto" class="form-label">Puesto:</label>
        "<?php echo $idpuesto; ?>"
        <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
          <?php foreach ($lista_tbl_puestos as $registro) { ?>
            
            <option <?php echo ($idpuesto==$registro['id'])?"selected":"";?> value="<?php echo $registro['id']; ?>">
              <?php echo $registro['nombredelpuesto']; ?>
            </option>

          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
        <input type="date" value="<?php echo $fechadeingreso; ?>" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId"
          placeholder="Fecha de ingreso">
      </div>

      <button type="submit" class="btn btn-success">Agregar registro</button>
      <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
  </div>
  <div class="card-footer text-muted">
  </div>
</div>

<?php include("../../templates/footer.php"); ?>