<?php

//require_once 'config.php';


class YouTubeModel {
    private $apiKey;
    private $channelId;

    public function __construct() {
        //$this->apiKey = API_KEY; 
        //$this->channelId = CHANNEL_ID;
        $this->apiKey = "unavez";
        $this->channelId ="canal";
    }

    public function get_dat_videos(){
        // URL de las imágenes y descripciones
        $idvid = "12546398";
        $imageUrl = "https://placehold.co/560x315/ccddee/FFF";
        $description = "Esta es una descripción de la imagen.";
        $duracion = "14:23";
        $titulo = "HOY SE COME";
        $fecha = "12/02/2022";
        $vistas = 18888;
        $likes = 12;
        $coment = 25;
        $idvid2 = "4546398";
        $imageUrl2 = "https://placehold.co/560x315/00cc00/FFF";
        $description2 = "Segunda descripción de la imagen.";
        $duracion2 = "10:57";
        $titulo2 = "NUNVCA MAAASS";
        $fecha2 = "08/02/2021";
        $vistas2 = 18;
        $likes2 = 1;
        $coment2 = 10;
        $idvid3 = "78046398";
        $imageUrl3 = "https://placehold.co/560x315/bbcc00/FFF";
        $description3 = "Tercera descripción de la imagen.";
        $duracion3 = "07:15";
        $titulo3 = "UN DIA MAS";
        $fecha3 = "22/05/2018";
        $vistas3 = 1758;
        $likes3 = 25;
        $coment3 = 27;

        $responses = [];
        // Convertir a JSON para manejar con JS
        for ($i = 0; $i < 5; $i++) {
            $responses[] = ["thumbnail" => $imageUrl, "description" => $description, "id" => $idvid, "duration" => $duracion, "title" => $titulo, "publishedAt" => $fecha, "views" => $vistas, "likes" => $likes, "comments" => $coment];
            $responses[] = ["thumbnail" => $imageUrl2, "description" => $description2, "id" => $idvid2, "duration" => $duracion2, "title" => $titulo2, "publishedAt" => $fecha2, "views" => $vistas2, "likes" => $likes2, "comments" => $coment2];
            $responses[] = ["thumbnail" => $imageUrl3, "description" => $description3, "id" => $idvid3, "duration" => $duracion3, "title" => $titulo3, "publishedAt" => $fecha3, "views" => $vistas3, "likes" => $likes3, "comments" => $coment3];
            $responses[] = ["thumbnail" => $imageUrl2, "description" => $description2, "id" => $idvid2, "duration" => $duracion2, "title" => $titulo2, "publishedAt" => $fecha2, "views" => $vistas2, "likes" => $likes2, "comments" => $coment2];
            $responses[] = ["thumbnail" => $imageUrl, "description" => $description, "id" => $idvid, "duration" => $duracion, "title" => $titulo, "publishedAt" => $fecha, "views" => $vistas, "likes" => $likes, "comments" => $coment];
        }

        return json_encode($responses);
    }

    public function get_profile(){        
        $datosper = [];
        $idcan = "125483325";
        $nombre = "YORDICIIITO";
        $img_per = "https://placehold.co/560x560/bb05aa/FFF";
        $subs = 152;
        $canvid = 12;
        $canvis = 10002;
        $portada ="https://placehold.co/1060x560/5522aa/FFF";
        $datosper[] = ["id_canal" => $idcan, "nom_can" => $nombre, "img_perfil" => $img_per, "suscriptores" => $subs, "cant_videos" => $canvid, "cant_vistas" => $canvis, "img_portada" => $portada];

        return json_encode($datosper);
    }
    private function formatYouTubeDuration($duration) {
        preg_match('/PT(\d+H)?(\d+M)?(\d+S)?/', $duration, $matches);
        $hours = isset($matches[1]) ? (int) rtrim($matches[1], 'H') : 0;
        $minutes = isset($matches[2]) ? (int) rtrim($matches[2], 'M') : 0;
        $seconds = isset($matches[3]) ? (int) rtrim($matches[3], 'S') : 0;
    
        return ($hours ? $hours . ":" : "") . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
    }

    public function redondeo($dato){
        if($dato >=  10000000){
            return round($dato / 1000000, 1) . 'M';
        }elseif($dato < 10000000 && $dato >= 1000000){
            return number_format($dato / 1000000, 2) . 'M';
        }elseif($dato < 1000000 && $dato >= 1000){
            return round($dato / 1000, 1) . 'K';
        }else{
            return $dato;
        }
    }
} 