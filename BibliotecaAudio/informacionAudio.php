<?php
include('/xampp/htdocs/Audify/conexion.php');

//Se obtiene por post el id del audio
$id = $_POST['id'];

$query = "SELECT * FROM audiosaudify WHERE id = '$id'";

$resultado = $conex->prepare($query);

$resultado->execute();

//Se obtiene la información del audio
$resul = $resultado->fetch(PDO::FETCH_ASSOC);

//Se devuelve la ventana emergente con la información del audio

echo "<div class=\"modal fade\" id=\"InformacionAudio\">
                <div class=\"modal-dialog\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h3 class=\"modal-title\">Información de audio</h3>
                        </div>
                        <div class=\"modal-body\">
                        
                        <ul>
                        <li> Id: $resul[id]</li>
                        <li> Nombre: $resul[nombre]</li>
                        <li>Tipo: $resul[tipo]</li>
                        <li>Tamaño : $resul[size]</li>
                        <li>Fecha de subida : $resul[fechaSubida]</li>
                        </ul>
                        
                        </div>
                        <div class=\"modal-footer\">
                        <button type='button' class='closed btn-primary' data-dismiss = \"modal\">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>";

