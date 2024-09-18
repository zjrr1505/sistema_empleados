<?php
include("../../db.php");

if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
  $sentencia->bindParam(":id", $txtID);
  $sentencia->execute();

  $registro = $sentencia->fetch(PDO::FETCH_LAZY);

  $usuario = $registro["usuario"];
  $password = $registro["password"];
  $correo = $registro["correo"];
}

if ($_POST) {
  // Recolectamos los datos del método POST
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
  $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
  $password = (isset($_POST["password"]) ? $_POST["password"] : "");

  //Preparar la inserción de los datos
  $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET 
    usuario = :usuario,
    password = :password,
    correo = :correo
    WHERE id = :id
  ");

  //Asignando los valores que vienen del método POST (los que vienen del formulario)
  $sentencia->bindParam(":id", $txtID);
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
        <label for="txtID" class="form-label">ID:</label>
        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"
          aria-describedby="helpId" placeholder="ID">
      </div>
      <div class="mb-3">
        <label for="usuario" class="form-label">Nombre del usuario:</label>
        <input type="text" value="<?php echo $usuario; ?>" class="form-control" name="usuario" id="usuario"
          aria-describedby="helpId" placeholder="Nombre del usuario">
      </div>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="email" value="<?php echo $correo; ?>" class="form-control" name="correo" id="correo"
          aria-describedby="helpId" placeholder="Correo">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" value="<?php echo $password; ?>" class="form-control" name="password" id="password"
          aria-describedby="helpId" placeholder="Contraseña">
      </div>
      <button type="submit" class="btn btn-success">Actualizar</button>
      <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
  </div>
  <div class="card-footer text-muted">
  </div>
</div>

<?php include("../../templates/footer.php"); ?>