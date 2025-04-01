<?php
require_once 'app/Modelo/Model_funcion.php'; 

class mostrarIndex {

    public function mostrarOpciones() {
        $youtubeModel = new YouTubeModel();
        $videos = $youtubeModel->get_dat_videos();  
        $datos = $youtubeModel->get_profile();
        //echo $datos;
        //echo $videos;
        include $_SERVER['DOCUMENT_ROOT'] . '/creacion_widgets_youtube/app/Vista/index.php';
    }
}