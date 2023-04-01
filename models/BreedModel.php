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
            JOIN animals ON breeds.breed_id = animals.breed_id
            WHERE breeds.breed_id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $breed = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $breed;
        }

        public static function create($package) {}

        public static function update($package) {}

        public static function delete($id) {}

    }

?>