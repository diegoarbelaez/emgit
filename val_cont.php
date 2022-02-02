<?php
include 'conexion.php';
$num = filter_input(INPUT_POST, 'num');

if ($num != null) {
    $sentencia = "SELECT * FROM contrato WHERE numero = '$num'";
    $resultado = $conexion->query($sentencia);

    $numCookie = filter_input(INPUT_COOKIE, 'numCookie');

    if ($num == $numCookie) {
        echo '0';
    } else {
        echo $resultado->num_rows;
    }
}

$numadd = filter_input(INPUT_POST, 'numadd');

if ($numadd != null) {
    $sentencia = "SELECT * FROM contrato WHERE numero = '$numadd'";
    $resultado = $conexion->query($sentencia);
    echo $resultado->num_rows;
}

$codigo = filter_input(INPUT_POST, 'codigo');

if ($codigo != null) {
    $sentencia = "SELECT * FROM `codigos` WHERE codigo = '$codigo'";
    $resultado = $conexion->query($sentencia);
    echo $resultado->num_rows;
}

$codigo_rubro = filter_input(INPUT_POST, 'codigo_rubro');
$codigo_rubro_confirmar = filter_input(INPUT_POST, 'codigo_rubro_confirmar');
$descripcion_rubro = filter_input(INPUT_POST, 'descripcion_rubro');

if ($codigo_rubro != null && $codigo_rubro_confirmar != null && $descripcion_rubro != null) {
    if ($codigo_rubro == $codigo_rubro_confirmar) {
        // Validar que el código no exista
        $sentencia = "SELECT * FROM codigos WHERE codigo = '$codigo_rubro'";
        $resultado = $conexion->query($sentencia);

        if ($resultado->num_rows == 0) {
            $sentencia = "INSERT INTO codigos (codigo, descripcion) VALUES ('$codigo_rubro', '$descripcion_rubro')";
            $conexion->query($sentencia);
            echo 'OK';
        } else {
            echo 'El Rubro ' . $codigo_rubro . ' ya existe! <a href="' . filter_input(INPUT_SERVER, 'HTTP_REFERER') . '">Reintentar</a>';
        }
    } else {
        echo 'La confirmación del código no es válida! <a href="' . filter_input(INPUT_SERVER, 'HTTP_REFERER') . '">Reintentar</a>';
    }
}

$codigo_rubro_editar = filter_input(INPUT_POST, 'codigo_rubro_editar');
$descripcion_rubro_editar = filter_input(INPUT_POST, 'descripcion_rubro_editar');
$id_codigo_editar = base64_decode(filter_input(INPUT_POST, 'id_codigo_editar'));

if ($codigo_rubro_editar != null && $descripcion_rubro_editar != null && $id_codigo_editar != null) {
    // Validar que el código no exista
    $sentencia = "SELECT * FROM codigos WHERE codigo = '$codigo_rubro_editar'";
    $resultado = $conexion->query($sentencia);
    $total = $resultado->num_rows;

    // Ajuste para permitir edición del mismo Rubro
    $codrub = filter_input(INPUT_COOKIE, 'codrub');

    if ($codigo_rubro_editar == $codrub) {
        $total = 0;
    }
    // fin del ajuste

    if ($total == 0) {
        $sentencia = "UPDATE codigos SET codigo = '$codigo_rubro_editar', descripcion = '$descripcion_rubro_editar' WHERE id_codigo = '$id_codigo_editar'";
        $conexion->query($sentencia);
        echo 'OK';
    } else {
        echo 'El Rubro ' . $codigo_rubro_editar . ' ya existe! <a href="' . filter_input(INPUT_SERVER, 'HTTP_REFERER') . '">Reintentar</a>';
    }
}

$id_contratista = filter_input(INPUT_POST, 'id_contratista');

if ($id_contratista != null) {
    $sentencia = "SELECT * FROM contratista WHERE id_contratista = $id_contratista";
    $resultado = $conexion->query($sentencia);
    $fila = $resultado->fetch_object();
    $datos = [];

    if (empty($fila->nivel_educativo)) {
        $datos[] = 'Nivel Educativo';
    }

    if (empty($fila->nombre_pregrado)) {
        $datos[] = 'Estudio Pregrado';
    }

    if (empty($fila->proceso_pregrado)) {
        $datos[] = 'Proceso Formación Pregrado';
    }

    if (empty($fila->nombre_posgrado)) {
        $datos[] = 'Estudio Posgrado';
    }

    if (empty($fila->proceso_posgrado)) {
        $datos[] = 'Proceso Formación Posgrado';
    }

    if (empty($fila->foto)) {
        $datos[] = 'Foto actual';
    }

    if (empty($fila->fecha_expedicion)) {
        $datos[] = 'Fecha Expedición Documento';
    }

    if (empty($fila->fecha_nacimiento)) {
        $datos[] = 'Fecha de Nacimiento';
    }

    if (empty($fila->sexo)) {
        $datos[] = 'Sexo';
    }

    if (empty($fila->grupo_sanguineo)) {
        $datos[] = 'Grupo Sanguíneo';
    }

    if (empty($fila->direccion_residencia)) {
        $datos[] = 'Dirección de Residencia';
    }

    if (empty($fila->tipo_vivienda)) {
        $datos[] = 'Tenencia de Vivienda';
    }

    if (empty($fila->departamento)) {
        $datos[] = 'Departamento';
    }

    if (empty($fila->municipio)) {
        $datos[] = 'Municipio';
    }

    if (empty($fila->nombre_corregimiento)) {
        $datos[] = 'Nombre del Corregimiento o Vereda';
    }

    if (empty($fila->descripcion_ubicacion)) {
        $datos[] = 'Descripción de Ubicación';
    }

    if (empty($fila->barrio)) {
        $datos[] = 'Barrio';
    }

    if (empty($fila->estrato)) {
        $datos[] = 'Estrato';
    }

    if (empty($fila->telefono_emergencias)) {
        $datos[] = 'Teléfono Emergencias';
    }

    if (empty($fila->estado_civil)) {
        $datos[] = 'Estado Civil';
    }

    /*
    Esto al final no es requisito, dado que no se puede validar si tiene hijos o no
    if (empty($fila->numero_hijos)) {
        $datos[] = 'Número de hijos';
    }*/

    if (empty($fila->enfermedad)) {
        $datos[] = 'Alguna enfermedad';
    }

    if (empty($fila->tratamiento)) {
        $datos[] = 'Algún tratamiento';
    }

    if (empty($fila->alergias)) {
        $datos[] = 'Alguna alergia';
    }

    if (empty($fila->nombres_conyugue)) {
        $datos[] = 'Nombres del Cónyuge';
    }

    if (empty($fila->apellidos_conyugue)) {
        $datos[] = 'Apellidos del Cónyuge';
    }

    if (empty($fila->cedula_conyugue)) {
        $datos[] = 'Cédula del Cónyuge';
    }

    if (empty($fila->fecha_nacimiento_conyugue)) {
        $datos[] = 'Fecha nacimiento del Cónyuge';
    }

    if (empty($fila->nombres_padre)) {
        $datos[] = 'Nombres del padre';
    }

    if (empty($fila->apellidos_padre)) {
        $datos[] = 'Apellidos del padre';
    }

    if (empty($fila->cedula_padre)) {
        $datos[] = 'Cédula del padre';
    }

    if (empty($fila->fecha_nacimiento_padre)) {
        $datos[] = 'Cédula del padre';
    }

    if (empty($fila->nombres_madre)) {
        $datos[] = 'Nombres de la madre';
    }

    if (empty($fila->apellidos_madre)) {
        $datos[] = 'Apellidos de la madre';
    }

    if (empty($fila->cedula_madre)) {
        $datos[] = 'Cédula de la madre';
    }

    if (empty($fila->fecha_nacimiento_madre)) {
        $datos[] = 'Cédula de la madre';
    }

    if (empty($fila->eps)) {
        $datos[] = 'EPS';
    }

    if (empty($fila->arl)) {
        $datos[] = 'ARL';
    }

    if (empty($fila->caja)) {
        $datos[] = 'Caja de Compensación';
    }

    if (empty($fila->pensiones)) {
        $datos[] = 'Fondo de pensiones';
    }

    if (empty($fila->nombre_emergencia)) {
        $datos[] = 'Llamar en caso de emergencia';
    }

    if (empty($fila->numero_emergencia)) {
        $datos[] = 'Número en caso de emergencia';
    }

    if (empty($fila->actividades)) {
        $datos[] = 'Actividades que practica';
    }

    if (empty($fila->actividades)) {
        $datos[] = 'Actividades que practica';
    }

    if (empty($fila->rasgos)) {
        $datos[] = 'Rasgos físicos';
    }

    if (empty($fila->grupos)) {
        $datos[] = 'Grupo poblacional';
    }

    if (empty($fila->discapacidad)) {
        $datos[] = 'Discapacidad';
    }

    foreach ($datos as $key => $value) {
        echo ($key + 1) . '. ' . $value . '<br>';
    }
}

$cedula = filter_input(INPUT_POST, 'cedula');

if ($cedula != null) {
    $sentencia = "SELECT * FROM contratista WHERE cedula = $cedula";
    $resultado = $conexion->query($sentencia);

    $cedulaC = filter_input(INPUT_COOKIE, 'cedulaC');

    if ($cedula == $cedulaC) {
        echo '0';
    } else {
        echo $resultado->num_rows;
    }
}
