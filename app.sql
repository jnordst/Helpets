CREATE DATABASE IF NOT EXISTS comp_1006_200368110_200527317;
USE comp_1006_200368110_200527317;

-- YOU MUST USE THIS TABLE AS IS (or at least the 3 defined fields name, email, and password)
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(256) NOT NULL  
);

CREATE TABLE parent_resource (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE child_resource (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    parent_id INT NOT NULL,
    FOREIGN KEY (parent_id) REFERENCES parent_resource (id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS animals;
CREATE TABLE animals (
	animal_id
		INT
        NOT NULL
        AUTO_INCREMENT
        PRIMARY KEY,
	breed_id
		INT
        NOT NULL,
	animal_name
		VARCHAR(50)
        NOT NULL,
	animal_age
		INT,
	FOREIGN KEY (breed_id) REFERENCES breeds (breed_id)
);

DROP TABLE IF EXISTS breeds;
CREATE TABLE breeds (
	breed_id
		INT
        NOT NULL
        AUTO_INCREMENT
        PRIMARY KEY,
	breed_name
		VARCHAR(50)
        NOT NULL
);

INSERT INTO animals (breed_id, animal_name, animal_age)
VALUES
	(1, 'Soot', 3),
    (1, 'Smudge', 8),
    (3, 'Belle', 5),
    (3, 'Frisbee', 4);

INSERT INTO breeds (breed_name)
VALUES
	('Cat'),
    ('Dog'),
    ('Rabbit'),
    ('Hamster'),
    ('Guinea Pig'),
    ('Mouse'),
	('Rat');
    
SELECT animal_name 'Name', breed_name 'Breed', animal_age 'Age'
FROM animals
NATURAL JOIN breeds;