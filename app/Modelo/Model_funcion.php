<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/creacion_widgets_youtube/includes/config.php');


class YouTubeModel {
    private $apiKey;
    private $channelId;

    public function __construct($id_canal) {
        $this->apiKey = API_KEY; 
        //$this->channelId = CHANNEL_ID;
        $this->channelId =$id_canal;
    }

    public function get_dat_videos(){
        /*$idvid = "Vz6cTz3NiBw";
        $imageUrl = "https://placehold.co/560x315/ccddee/FFF";
        $description = "Esta es una descripción de la imagen tengo que agregar demasiado texto para ver que puede llegar a pasar por todo esto. tengo que agregar muchisimo mas text crj mrd";
        $duracion = "14:23";
        $titulo = "HOY SE COME, TA QUE ERA EN EL TITULO, MASW WEBON SOY";
        $fecha = "12/02/2022";
        $vistas = 18888;
        $likes = 12;
        $coment = 25;
        $idvid2 = "MitSZ9ZeZxA";
        $imageUrl2 = "https://placehold.co/560x315/00cc00/FFF";
        $description2 = "Segunda descripción de la imagen.";
        $duracion2 = "10:57";
        $titulo2 = "NUNCA MAAASS, tiene que ser un titulo muy grande para probar que pdos";
        $fecha2 = "08/02/2021";
        $vistas2 = 18;
        $likes2 = 1;
        $coment2 = 10;
        $idvid3 = "xYoYYNDheVo";
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

        return json_encode($responses);*/
        $cantidadResultados = 4; // Número de videos a obtener
        $urlVideos = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId={$this->channelId}&maxResults={$cantidadResultados}&order=date&type=video&key={$this->apiKey}";
        $responseVideos = file_get_contents($urlVideos);
        $dataVideos = json_decode($responseVideos, true);
        
        $responses = [];  // Array para almacenar los videos
        
        if (!empty($dataVideos['items'])) {
            foreach ($dataVideos['items'] as $video) {
                $idvid = $video['id']['videoId'];
                $titulo = $video['snippet']['title'];
                $imageUrl = $video['snippet']['thumbnails']['high']['url'];
                $description = $video['snippet']['description'];
                $fecha = $video['snippet']['publishedAt'];
                
                // Obtener estadísticas del video
                $urlStats = "https://www.googleapis.com/youtube/v3/videos?part=statistics,contentDetails&id={$idvid}&key={$this->apiKey}";
                $responseStats = file_get_contents($urlStats);
                $dataStats = json_decode($responseStats, true);
                
                $vistas = $likes = $coment = $duracion = "0";
                if (!empty($dataStats['items'][0])) {
                    $videoStats = $dataStats['items'][0];
                    $vistas = $this->redondeo($videoStats['statistics']['viewCount']);
                    $likes = $this->redondeo($videoStats['statistics']['likeCount'] ?? 0);
                    $coment = $this->redondeo($videoStats['statistics']['commentCount'] ?? 0);
                    $duracion = $this-> formatYouTubeDuration($videoStats['contentDetails']['duration']);
                }
                
                // Se agrega el video al array $responses con el formato solicitado
                $responses[] = [
                    "thumbnail" => $imageUrl,
                    "description" => $description,
                    "id" => $idvid,
                    "duration" => $duracion,
                    "title" => $titulo,
                    "publishedAt" => $fecha,
                    "views" => $vistas,
                    "likes" => $likes,
                    "comments" => $coment
                ];
            }
        }
        
        return json_encode($responses);
    }

    public function get_profile(){  
        $url = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics,brandingSettings&id={$this->channelId}&key={$this->apiKey}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        
        $datosper = [];  // Array para almacenar los datos del perfil
        
        if (!empty($data['items'][0])) {
            $channel = $data['items'][0];
            
            // Se asignan los valores al array $datosper con el formato solicitado
            $datosper[] = [
                "id_canal" => $this->channelId,
                "nom_can" => $channel['snippet']['title'],
                "img_perfil" => $channel['snippet']['thumbnails']['high']['url'],
                "suscriptores" => $this->redondeo($channel['statistics']['subscriberCount']),
                "cant_videos" => $this->redondeo($channel['statistics']['videoCount']),
                "cant_vistas" => $this->redondeo($channel['statistics']['viewCount']),
                "img_portada" => $channel['brandingSettings']['image']['bannerExternalUrl'] . "=w2560-fcrop64=1,00000000ffffffff-nd-c0xffffffff-rj-k-no"
            ];
        }

        return json_encode($datosper);
        /*$datosper = [];
        $idcan = "125483325";
        $nombre = "YORDICIIITO";
        $img_per = "https://placehold.co/560x560/bb05aa/FFF";
        $subs = 152;
        $canvid = 12;
        $canvis = 10002;
        $portada ="https://placehold.co/1060x560/5522aa/FFF";
        $datosper[] = ["id_canal" => $idcan, "nom_can" => $nombre, "img_perfil" => $img_per, "suscriptores" => $subs, "cant_videos" => $canvid, "cant_vistas" => $canvis, "img_portada" => $portada];

        return json_encode($datosper);*/
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