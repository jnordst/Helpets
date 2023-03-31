<?php

    class ResourceModel {

        private static $_table = "animals";

        public static function findAll() 
        {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table}";

            $animals = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $animals;
        }

        public static function find($id) {}

        public static function create($package) {}

        public static function update($package) {}

        public static function delete($id) {}

    }

?>