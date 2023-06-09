<?php

    class AnimalModel {

        private static $_table = "animals";

        public static function findAll() 
        {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * 
            FROM {$table}
            JOIN breeds
            ON animals.breed_id = breeds.breed_id";

            $animals = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $animals;
        }

        public static function find($id) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table}
            JOIN breeds
            ON animals.breed_id = breeds.breed_id
            WHERE animal_id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $animals = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $animals;
        }

        public static function create($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                breed_id,
                animal_name,
                animal_age
                
            ) VALUES (
                :breed_id,
                :animal_name,
                :animal_age
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":breed_id", $package["breed_id"], PDO::PARAM_INT);
            $stmt->bindParam(":animal_name", $package["animal_name"], PDO::PARAM_STR);
            $stmt->bindParam(":animal_age", $package["animal_age"], PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;


        }

        public static function update($package) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "UPDATE {$table} SET
                breed_id = :breed_id,
                animal_name = :animal_name,
                animal_age = :animal_age
            WHERE animal_id = :animal_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":breed_id", $package['breed_id'], PDO::PARAM_INT);
            $stmt->bindParam(":animal_name", $package['animal_name'], PDO::PARAM_STR);
            $stmt->bindParam(":animal_age", $package['animal_age'], PDO::PARAM_INT);
            $stmt->bindParam(":animal_id", $package['animal_id'], PDO::PARAM_INT);
            
            $stmt->execute();
            $conn = null;

        }

        public static function delete($id) {

            $table = self::$_table;
            $conn = get_connection();
            $sql = "DELETE FROM {$table} WHERE animal_id = :animal_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":animal_id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

    }

?>