<?php

    class BreedModel {

        private static $_table = "breeds";

        public static function findAll() 
        {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table}";

            $breeds = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $breeds;
        }

        public static function find($id) 
        {
                $table = self::$_table;
                $conn = get_connection();
                $sql = "SELECT *
                FROM {$table}
                WHERE breed_id = :id";
    
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
    
                $breed = $stmt->fetch(PDO::FETCH_OBJ);
                $conn = null;
                return $breed;
            
        }

        public static function create($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                breed_name,
                breed_id
            ) VALUES (
                :breed_name,
                :breed_id
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":breed_name", $package["breed_name"], PDO::PARAM_STR);
            $stmt->bindParam(":breed_id", $package['breed_id'], PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;

        }

        public static function update($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "UPDATE {$table} SET
                breed_name = :breed_name,
            WHERE breed_id = :breed_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":breed_name", $package['breed_name'], PDO::PARAM_STR);
            $stmt->bindParam(":breed_id", $package['breed_id'], PDO::PARAM_INT);
            
            $stmt->execute();
            $conn = null;

        }

        public static function delete($id) {

            $table = self::$_table;
            $conn = get_connection();
            $sql = "DELETE FROM {$table} WHERE breed_id = :breed_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":breed_id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

    }

?>