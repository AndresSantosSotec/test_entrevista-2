<?php
include 'conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //se verificara si es ina sinsecion o actualizacion del registro 

    if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente'])) {

        $id_cliente = $_POST['id_cliente'];
        $Nombre = $_POST['Nombre'];
        $Celular = $_POST['numero'];
        $Direccion = $_POST['correo'];

        $sql = "UPDATE tb_clientes SET Nombre=?, Celular=?,Direccion=? where id_cliente=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssi", $Nombre, $Celular, $Direccion, $id_cliente);

        if ($stmt->execute()) {
            header("location: index.php?status=update");
            exit;
        } else {
            echo "Error al actualizar registro: " . $con->error;
        }
    } else {
        //en caso no exista se creara un nuevo registro 
        $Nombre = $_POST['Nombre'];
        $Celular = $_POST['numero'];
        $Direccion = $_POST['correo'];

        $sql = "INSERT INTO tb_clientes (Nombre,Celular,Direccion) Values (?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $Nombre, $Celular, $Direccion);

        if ($stmt->execute()) {
            header("location: index.php?status=added");
            exit;
        } else {
            echo "Error al actualizar registro: " . $con->error;
        }
    }
} elseif (isset($_GET['id_cliente']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id_cliente = $_GET['id_cliente'];

    $sql = "DELETE FROM tb_clientes where id_cliente=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id_cliente);
    if ($stmt->execute()) {

        header("location: index.php?status=deleted");
        exit;
    } else {
        echo "Error al eliminar registro: " . $con->error;
    }
}

$con->close();
