<?php

function sanearDatos($tags) {
    $tags = strip_tags($tags);
    $tags = stripslashes($tags);
    $tags = htmlentities($tags);
    return $tags;
}

function blow_crypt($input, $rounds = 7) {
    $salt = "";
    $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
    for ($i = 0; $i < 22; $i++) {
        $salt .= $salt_chars[array_rand($salt_chars)];
    }
    return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
}

function hashData($string) {
    $string = hash("haval224,4", md5(crypt($string, "$2a$%02d$")));
    return $string;
}

function comprobar_string_sin_especiales($string) {
    if (preg_match('/[A-Za-z]/', $string)) {
        return true;
    } else {
        return false;
    }
}


function comprobar_email($email) {
    return false;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
}

function cambiarFecha($fecha) {
    return implode("-", array_reverse(explode("-", $fecha)));
}

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function regenerarContrasena() {
    // recortamos la cadena, conseguimos nueva pass
    $pass = substr(crypt(microtime()), 1, 5);

    return "clan_" . $pass;
}

function calcularEdad($fecha) {
    return floor((time() - strtotime($fecha)) / 31556926);
}

function obtenerNombreMes($fecha) {
    $fecha = strtotime($fecha);

    switch (date('m', $fecha)) {
        case 1: $mes = "enero";
            break;
        case 2: $mes = "febrero";
            break;
        case 3: $mes = "marzo";
            break;
        case 4: $mes = "abril";
            break;
        case 5: $mes = "mayo";
            break;
        case 6: $mes = "junio";
            break;
        case 7: $mes = "julio";
            break;
        case 8: $mes = "agosto";
            break;
        case 9: $mes = "septiembre";
            break;
        case 10: $mes = "octubre";
            break;
        case 11: $mes = "noviembre";
            break;
        case 12: $mes = "diciembre";
            break;
    }
    return $mes;
}

function urlAmigable($string, $replacement = '-', $map = array()) {
    if (is_array($replacement)) {
        $map = $replacement;
        $replacement = '+';
    }
    $quotedReplacement = preg_quote($replacement, '/');

    $merge = array(
        '/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
        '/\\s+/' => $replacement,
        sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
    );

    $_transliteration = array(
        '/ä|æ|ǽ/' => 'ae',
        '/ö|œ/' => 'oe',
        '/ü/' => 'ue',
        '/Ä/' => 'Ae',
        '/Ü/' => 'Ue',
        '/Ö/' => 'Oe',
        '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
        '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
        '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
        '/ç|ć|ĉ|ċ|č/' => 'c',
        '/Ð|Ď|Đ/' => 'D',
        '/ð|ď|đ/' => 'd',
        '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
        '/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
        '/Ĝ|Ğ|Ġ|Ģ/' => 'G',
        '/ĝ|ğ|ġ|ģ/' => 'g',
        '/Ĥ|Ħ/' => 'H',
        '/ĥ|ħ/' => 'h',
        '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
        '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',
        '/Ĵ/' => 'J',
        '/ĵ/' => 'j',
        '/Ķ/' => 'K',
        '/ķ/' => 'k',
        '/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
        '/ĺ|ļ|ľ|ŀ|ł/' => 'l',
        '/Ñ|Ń|Ņ|Ň/' => 'N',
        '/ñ|ń|ņ|ň|ŉ/' => 'n',
        '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
        '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
        '/Ŕ|Ŗ|Ř/' => 'R',
        '/ŕ|ŗ|ř/' => 'r',
        '/Ś|Ŝ|Ş|Š/' => 'S',
        '/ś|ŝ|ş|š|ſ/' => 's',
        '/Ţ|Ť|Ŧ/' => 'T',
        '/ţ|ť|ŧ/' => 't',
        '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
        '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
        '/Ý|Ÿ|Ŷ/' => 'Y',
        '/ý|ÿ|ŷ/' => 'y',
        '/Ŵ/' => 'W',
        '/ŵ/' => 'w',
        '/Ź|Ż|Ž/' => 'Z',
        '/ź|ż|ž/' => 'z',
        '/Æ|Ǽ/' => 'AE',
        '/ß/' => 'ss',
        '/Ĳ/' => 'IJ',
        '/ĳ/' => 'ij',
        '/Œ/' => 'OE',
        '/ƒ/' => 'f'
    );

    $map = $map + $_transliteration + $merge;
    return preg_replace(array_keys($map), array_values($map), $string);
}

function acortar($cadena, $limite, $corte = " ", $pad = "...") {
    if (strlen($cadena) <= $limite)
        return $cadena;
    if (false !== ($breakpoint = strpos($cadena, $corte, $limite))) {
        if ($breakpoint < strlen($cadena) - 1) {
            $cadena = substr($cadena, 0, $breakpoint) . $pad;
        }
    }
    return $cadena;
}

function realizarAgregacionVideo($url, $carpeta, $id) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        switch ($carpeta) {
            case 'notaprensa':
                $sql = "INSERT INTO video_" . $carpeta . " (idNotaPrensa, nombreVideoNotaPrensa, fechaCargaVideoNotaPrensa, estadoVideoNotaPrensa)
                                VALUES(?,?,'" . date("Y-m-d H:i:s") . "','A')";
                break;
            case 'noticia':
                $sql = "INSERT INTO video_" . $carpeta . " (idNoticia, nombreVideoNoticia, fechaCargaVideoNoticia, estadoVideoNoticia)
                                VALUES(?,?,'" . date("Y-m-d H:i:s") . "','A')";
                break;
            case 'evento':
                $sql = "INSERT INTO video_" . $carpeta . " (idEvento, nombreVideoEvento, fechaCargaVideoEvento, estadoVideoEvento)
                                VALUES(?,?, '" . date("Y-m-d H:i:s") . "','A')";
                break;
        }


        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'is', $id, $url);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'is', $id, $url);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

function realizarBajaVideo($idVideo, $carpeta) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        switch ($carpeta) {
            case 'notaprensa':
                $sql = "UPDATE video_" . $carpeta . " SET fechaBajaVideoNotaPrensa = '" . date("Y-m-d H:i:s") . "', estadoVideoNotaPrensa = 'B' WHERE idVideoNotaPrensa = ?";
                break;
            case 'noticia':
                $sql = "UPDATE video_" . $carpeta . " SET fechaBajaVideoNoticia = '" . date("Y-m-d H:i:s") . "', estadoVideoNoticia = 'B' WHERE idVideoNoticia = ?";
                break;
            case 'evento':
                $sql = "UPDATE video_" . $carpeta . " SET fechaBajaVideoEvento = '" . date("Y-m-d H:i:s") . "', estadoVideoEvento = 'B' WHERE idVideoEvento = ?";
                break;
        }


        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idVideo);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idVideo);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

function realizarBajaImagen($idImagen, $carpeta) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        switch ($carpeta) {
            case 'notaprensa':
                $sql = "UPDATE imagen_" . $carpeta . " SET fechaBajaImagenNotaPrensa = '" . date("Y-m-d H:i:s") . "', estadoImagenNotaPrensa = 'B' WHERE idImagenNotaPrensa = ?";
                break;
            case 'noticia':
                $sql = "UPDATE imagen_" . $carpeta . " SET fechaBajaImagenNoticia = '" . date("Y-m-d H:i:s") . "', estadoImagenNoticia = 'B' WHERE idImagenNoticia = ?";
                break;
            case 'evento':
                $sql = "UPDATE imagen_" . $carpeta . " SET fechaBajaImagenEvento = '" . date("Y-m-d H:i:s") . "', estadoImagenEvento = 'B' WHERE idImagenEvento = ?";
                break;
        }


        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idImagen);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'i', $idImagen);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}

function agregarImagenGaleria($url, $carpeta, $id) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        switch ($carpeta) {
            case 'notaprensa':
                $sql = "INSERT INTO imagen_" . $carpeta . " (idNotaPrensa, nombreImagenNotaPrensa, fechaCargaImagenNotaPrensa, estadoImagenNotaPrensa)
                                VALUES(?,?,'" . date("Y-m-d H:i:s") . "','A')";
                break;
            case 'noticia':
                $sql = "INSERT INTO imagen_" . $carpeta . " (idNoticia, nombreImagenNoticia, fechaCargaImagenNoticia, estadoImagenNoticia)
                                VALUES(?,?,'" . date("Y-m-d H:i:s") . "','A')";
                break;
            case 'evento':
                $sql = "INSERT INTO imagen_" . $carpeta . " (idEvento, nombreImagenEvento, fechaCargaImagenEvento, estadoImagenEvento)
                                VALUES(?,?, '" . date("Y-m-d H:i:s") . "','A')";
                break;
        }


        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'is', $id, $url);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'is', $id, $url);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}



function actualizarOrden($index, $id, $carpeta)
{
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        switch ($carpeta) {
            case 'secretariado':
                $sql = "UPDATE secretariado SET ordenSecretariado = ? WHERE idSecretariado = ?";
                break;
            case 'areas':
                $sql = "UPDATE area SET ordenArea = ? WHERE idArea = ?";
                break;
        }

        //echo $sql;
        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $index, $id);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'ii', $index, $id);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}


function agregarArchivosGaleria($url, $carpeta, $id) {
    $conectActual = conectar();
    $conectMirror = conectarMirror();
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    try {

        /* Autocommit false para la transaccion */
        mysqli_autocommit($conectActual, FALSE);
        mysqli_autocommit($conectMirror, FALSE);
        $estadoConsulta = TRUE;

        $sql = "INSERT INTO archivo_" . $carpeta . " (idEvento, nombreArchivoEvento, tituloArchivoEvento, fechaCargaArchivoEvento, estadoArchivoEvento)
                                VALUES(?,?,?, '" . date("Y-m-d H:i:s") . "','A')";

        $stmt = mysqli_prepare($conectActual, $sql);
        mysqli_stmt_bind_param($stmt, 'iss', $id, $url, $url);
        if (!mysqli_stmt_execute($stmt)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt);


        $stmt2 = mysqli_prepare($conectMirror, $sql);
        mysqli_stmt_bind_param($stmt2, 'iss', $id, $url, $url);
        if (!mysqli_stmt_execute($stmt2)) {
            $estadoConsulta = FALSE;
        }
        mysqli_stmt_close($stmt2);

        /* Commit or rollback transaction */
        if ($estadoConsulta) {
            mysqli_commit($conectActual);
            desconectar($conectActual);
            mysqli_commit($conectMirror);
            desconectar($conectMirror);
            return 1;
        } else {
            mysqli_rollback($conectActual);
            desconectar($conectActual);
            mysqli_rollback($conectMirror);
            desconectar($conectMirror);
            return -1;
        }
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conectActual);
        desconectar($conectActual);
        mysqli_rollback($conectMirror);
        desconectar($conectMirror);
        return -1;
    }
}


?>
