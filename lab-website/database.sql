CREATE DATABASE request_lab;
CREATE TABLE users (
    ID INT PRIMARY KEY NOT NULL ,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    gender VARCHAR(10),
    subject VARCHAR(100),
    photo VARCHAR(255),
    type ENUM('user', 'admin'),
    username VARCHAR(50),
    email VARCHAR(100) ,
    password VARCHAR(255),
    date_time DATETIME,
    phone VARCHAR(255),
);

CREATE TABLE Feedback (
    ID INT PRIMARY KEY NOT NULL ,
    user_id INT,
    comments TEXT,
    date_time DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(ID)
);

CREATE TABLE Codes (
    ID INT PRIMARY KEY NOT NULL ,
    email VARCHAR(100) UNIQUE,
    code VARCHAR(100) UNIQUE,
    expire DATETIME UNIQUE
);

CREATE TABLE Lab (
    ID INT PRIMARY KEY NOT NULL ,
    name_lab VARCHAR(100),
    time TIME
);

CREATE TABLE Session (
    ID INT PRIMARY KEY NOT NULL ,
    sessions VARCHAR(100),
    number_Sessions INT,
    time TIME
);

CREATE TABLE Information (
    ID INT PRIMARY KEY NOT NULL ,
    user_id INT,
    date DATE,
    lab_id INT,
    generation VARCHAR(50),
    session_id INT,
    app VARCHAR(100),
    number_students INT,
    subject VARCHAR(100),
    other TEXT,
    FOREIGN KEY (user_id) REFERENCES users(ID),
    FOREIGN KEY (lab_id) REFERENCES lab(ID),
    FOREIGN KEY (session_id) REFERENCES session(ID)
);
