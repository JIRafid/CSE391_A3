
USE car_workshop;

CREATE TABLE mechanics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    available_slots INT NOT NULL
);

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    address VARCHAR(100),
    phone VARCHAR(15),
    car_license VARCHAR(20),
    car_engine VARCHAR(20),
    appointment_date DATE,
    mechanic_id INT,
    FOREIGN KEY (mechanic_id) REFERENCES mechanics(id)
);

-- Sample mechanics
INSERT INTO mechanics (name, available_slots) VALUES ('Karim', 4), ('Kuddos', 4), ('Sharif', 4), ('Siddique', 4), ('Rubel', 4);
