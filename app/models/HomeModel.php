<?php

$dirWithoutController = str_replace('app\models', '', __DIR__);
require_once $dirWithoutController . 'config\database.php';

class HomeModel
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function getAreas()
    {
        $result = $this->conn->query("SELECT * FROM areas");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRoles()
    {
        $result = $this->conn->query("SELECT * FROM roles");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createEmpleado($nombre, $email, $sexo, $area, $boletin, $descripcion, $rol)
    {

        $stmt = $this->conn->prepare("INSERT INTO empleados (nombre,email,sexo,area_id,boletin,descripcion) 
                                                            VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $nombre, $email, $sexo, $area, $boletin, $descripcion);

        if ($stmt->execute()) {

            $last_id = $this->conn->insert_id;
            $result = $this->conn->prepare("INSERT INTO empleado_rol (empleado_id,rol_id) 
                                                            VALUES (?,?)");
            $result->bind_param("ss", $last_id, $rol);
            return $result->execute();
        } else {
            return false;
        }

    }

    public function getEmpleados()
    {
        $result = $this->conn->query("SELECT e.nombre,
                                             e.id,
                                             e.boletin,
                                             a.nombre area,
                                             e.email
                                      FROM empleados e
                                      INNER JOIN areas a
                                      ON e.area_id = a.id");

        $result->fetch_all(MYSQLI_ASSOC);
        $a = array();

        foreach ($result as $campo) {
            array_push($a, array(
                "id" => $campo["id"],
                "nombre" => ($campo["nombre"]),
                "boletin" => $campo["boletin"] == 0 ? "No" : "Si",
                "area" => utf8_encode($campo["area"]),
                "email" => $campo["email"]
            ));
        }

        return $a;
    }

    public function getEmpleado($id)
    {
        $result = $this->conn->query("SELECT e.nombre,
                                             e.id,
                                             e.boletin,
                                             e.area_id,
                                             e.email,
                                             e.descripcion,
                                             er.rol_id,
                                             e.sexo
                                      FROM empleados e
                                      LEFT JOIN empleado_rol er
                                      ON e.id = er.empleado_id
                                      WHERE e.id = $id");

        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function updateEmpleado($nombre, $email, $sexo, $area, $boletin, $descripcion, $rol, $id)
    {

        $stmt = $this->conn->prepare("UPDATE empleados set nombre = ?,email = ?,sexo = ?,
                                      area_id = ?,boletin = ?,descripcion = ?
                                      WHERE id = ?");

        $stmt->bind_param("sssssss", $nombre, $email, $sexo, $area, $boletin, $descripcion, $id);

        if ($stmt->execute()) {
            $result = $this->conn->prepare("UPDATE empleado_rol set rol_id = ? WHERE empleado_id = ? AND rol_id = ?");
            $result->bind_param("sss", $rol, $id, $rol);
            return $result->execute();
        } else {
            return false;
        }

    }

    public function eliminarEmpleado($id)
    {

        $result = $this->conn->prepare("DELETE FROM empleado_rol WHERE empleado_id = ?");
        $result->bind_param("i", $id);

        if ($result->execute()) {
            $stmt = $this->conn->prepare("DELETE FROM empleados WHERE id = ?");
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        } else {
            return false;
        }
    }
}
