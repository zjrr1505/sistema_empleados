<?php

include("../../db.php");

if ($_POST) {
  // Recolectamos los datos del método POST
  $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
  $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
  $password = (isset($_POST["password"]) ? $_POST["password"] : "");

  //Preparar la inserción de los datos
  $sentencia = $conexion->prepare("INSERT INTO tbl_usuarios(id, usuario, password, correo) VALUES (null, :usuario, :password, :correo)");

  //Asignando los valores que vienen del método POST (los que vienen del formulario)
  $sentencia->bindParam(":usuario", $usuario);
  $sentencia->bindParam(":password", $password);
  $sentencia->bindParam(":correo", $correo);
  $sentencia->execute();

  header("Location: index.php");
}

?>
<?php include("../../templates/header.php"); ?>

<br>

<div class="card">
  <div class="card-header">
    Usuarios
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="usuario" class="form-label">Nombre del usuario:</label>
        <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId"
          placeholder="Nombre del usuario">
      </div>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId"
          placeholder="Correo">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId"
          placeholder="Contraseña">
      </div>
      <button type="submit" class="btn btn-success">Agregar</button>
      <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
  </div>
  <div class="card-footer text-muted">
  </div>
</div>

<?php include("../../templates/footer.php"); ?>