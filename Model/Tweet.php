<?php
require_once '../Config/Database.php';

class Tweet {
    private $db;

    public function __construct() {
        global $conn;
        $this->db = $conn;
    }

    public function getAllTweets() {
        try {
            $sql = "SELECT t.*, u.username 
                    FROM tweet t 
                    JOIN user u ON t.id_user = u.id 
                    ORDER BY t.creation_date DESC";
    
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des tweets : " . $e->getMessage());
        }
    }
    
    public function createTweet($user_id, $content, $mediaPaths) {
        $media1 = $mediaPaths[0] ?? NULL;
        $media2 = $mediaPaths[1] ?? NULL;
        $media3 = $mediaPaths[2] ?? NULL;
        $media4 = $mediaPaths[3] ?? NULL;

        $sql = "INSERT INTO tweet (id_user, content, media1, media2, media3, media4) 
                VALUES (:id_user, :content, :media1, :media2, :media3, :media4)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_user' => $user_id,
            ':content' => $content,
            ':media1' => $media1,
            ':media2' => $media2,
            ':media3' => $media3,
            ':media4' => $media4
        ]);
    }
}
?>