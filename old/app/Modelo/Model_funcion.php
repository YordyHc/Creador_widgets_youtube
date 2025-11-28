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

    
    function obtenerIdCanalYoutube() {
        // Crear la URL de la solicitud a la API de YouTube
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=" . urlencode($this->channelId) . "&type=channel&key=" . $this->apiKey;

        // Iniciar la sesión cURL
        $ch = curl_init();

        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Ejecutar la solicitud y obtener la respuesta
        $response = curl_exec($ch);

        // Comprobar si hubo errores en la solicitud
        if (curl_errno($ch)) {
            echo 'Error en la solicitud cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }

        // Cerrar la sesión cURL
        curl_close($ch);

        // Decodificar la respuesta JSON
        $data = json_decode($response, true);

        // Verificar si se obtuvo resultados
        if (isset($data['items'][0]['id']['channelId'])) {
            // Retornar el ID del canal
            $this -> channelId = $data['items'][0]['id']['channelId'];
            return $data['items'][0]['id']['channelId'];
        } else {
            // Si no se encontró el canal, retornar null
            return null;
        }
    }
    public function get_dat_videos(){
        $cantidadResultados = 32; // Número de videos a obtener
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