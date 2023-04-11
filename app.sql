CREATE DATABASE IF NOT EXISTS comp_1006_200368110_200527317;
USE comp_1006_200368110_200527317;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(256) NOT NULL  
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

CREATE TABLE emails (
	email_id
		INT
        AUTO_INCREMENT
        PRIMARY KEY,
	user_id
		INT,
        FOREIGN KEY (user_id) REFERENCES users(id),
	message
		VARCHAR(300)
);