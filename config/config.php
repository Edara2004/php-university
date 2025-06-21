<?php 

    
    class ConnectionsDatabase {
        private $db_user = "root";
        private $db_password = "";
        private $db_name = "useraccounts";
        private $localhost = "localhost";

        public function connect(){
            try {
                $db ="mysql:host=localhost;dbname={$this->db_name}";
                /* $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); */
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,

                ];
                return new PDO($db, $this->db_user, $this->db_password, $options);
            } catch(\Throwable $th){
                echo "Error en la conexión" . $th->getMessage();
                exit();                
            }
        }
    }
?>