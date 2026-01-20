<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Youtube Widgets</title>
</head>
<body>
    <?php
    require_once 'app/Control/Control_funcion.php';

    $request = $_SERVER['REQUEST_URI'];

    $request = strtok($request, '?');

    if ($request == '/' || $request == '/creacion_widgets_youtube/') {
        $controller = new mostrarIndex();
        $controller->mostrarOpciones();  
        //include $_SERVER['DOCUMENT_ROOT'] . '/creacion_widgets_youtube/app/Vista/widget_1.php';
        //include $_SERVER['DOCUMENT_ROOT'] . '/creacion_widgets_youtube/app/Vista/widget_4.php';
        //include $_SERVER['DOCUMENT_ROOT'] . '/creacion_widgets_youtube/app/Vista/index.php';
        //include $_SERVER['DOCUMENT_ROOT'] . '/creacion_widgets_youtube/app/Vista/widget_3.php';
        //include $_SERVER['DOCUMENT_ROOT'] . '/creacion_widgets_youtube/app/Vista/widget_2.php';
        //$controller = new VideoController();
        //$controller->showVideos();  
    } else {
        http_response_code(404);
        echo "Página no encontrada";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
