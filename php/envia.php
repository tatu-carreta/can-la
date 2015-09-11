<?php

$remitente = $_POST['email'];
$destinatario = 'mail@dominio.com.ar'; // en esta línea va el mail del destinatario, puede ser una cuenta de hotmail, yahoo, gmail, etc
if (isset($_POST['asunto']) && ($_POST['asunto'] != "")) {
    $asunto = $_POST['asunto'];
} else {
    $asunto = 'Consulta'; // acá se puede modificar el asunto del mail
}
if (!$_POST) {
    ?>

    <?php

} else {

    $cuerpo = "Nombre y Apellido: " . $_POST["nombre"] . "\r \n";
    $cuerpo .= "Email: " . $_POST["email"] . "\r \n";
    $cuerpo .= "Ciudad/País: " . $_POST["ciudad"] . "\r\n";
    $cuerpo .= "Organización: " . $_POST["organizacion"] . "\r\n";
    $cuerpo .= "Consulta: " . $_POST["consulta"] . "\r\n";
    //las líneas de arriba definen el contenido del mail. Las palabras que están dentro de $_POST[""] deben coincidir con el "name" de cada campo. 
    // Si se agrega un campo al formulario, hay que agregarlo acá.

    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/plain; charset=utf-8\n";
    $headers .= "X-Priority: 3\n";
    $headers .= "X-MSMail-Priority: Normal\n";
    $headers .= "X-Mailer: php\n";
    $headers .= "From: \"" . $_POST['nombre'] . "\" <" . $remitente . ">\n";

    mail($destinatario, $asunto, $cuerpo, $headers);
    ?>
    <script type="text/javascript">
        window.alert("El mensaje ha sido enviado.")
        javascript:history.back(1)</script>
    <?php

}
?>



