<!DOCTYPE html>
<html>
<head>
    <title>Asignación de Caso - FELCC</title>
    <style>
        .content {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            padding: 10px;
        }
        .header img {
            max-width: 150px;
        }
        .body {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            margin: 20px;
        }
        .footer {
            text-align: center;
            font-size: 0.9em;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://scontent.fvvi1-2.fna.fbcdn.net/v/t39.30808-6/428674075_379636971478964_6971924156545335690_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=1tnfE0SJiAUQ7kNvgEidjm2&_nc_ht=scontent.fvvi1-2.fna&oh=00_AYAcr_c7_6ERrjknTHXPhkm26IRg7CX80zZeLBg_wKzJEQ&oe=6693839E" alt="FELCC Logo">
    </div>
    <div class="body content">
        <p>Hola {{ $notifiable->name }},</p>
        <p>Usted ha sido asignado al siguiente caso:</p>
        <p><strong>Número de Caso:</strong> {{ $denuncia->caso }}</p>
        <p>Investigador asignado: {{ $oficial->nombre_completo }}</p>
        <p>Fiscal asignado: {{ $fiscal->nombre_completo }}</p>
        <p>Por favor, acérquese a las oficinas de la FELCC para firmar su denuncia y realizar el seguimiento correspondiente.</p>
        <p>Gracias por su atención.</p>
        <p>Saludos,<br>FELCC</p>
    </div>
    <div class="footer">
        <p>Este es un mensaje automático. Por favor, no responda a este correo.</p>
    </div>
</body>
</html>
