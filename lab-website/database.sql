CREATE TABLE users (
    ID INT PRIMARY KEY,
    First_name VARCHAR(100),
    Last_name VARCHAR(100),
    Gender VARCHAR(10),
    Subject VARCHAR(100),
    Photo VARCHAR(255),
    Type ENUM('user', 'admin'),
    Username VARCHAR(50),
    Email VARCHAR(100) ,
    Password VARCHAR(255),
    Date_time DATETIME,
    phone VARCHAR(255),
);

CREATE TABLE Feedback (
    ID INT PRIMARY KEY,
    user_id INT,
    comments TEXT,
    date_time DATETIME,
    FOREIGN KEY (user_id) REFERENCES user(ID)
);

CREATE TABLE Codes (
    ID INT PRIMARY KEY,
    user_id INT,
    email VARCHAR(100),
    code VARCHAR(100),
    expire DATETIME,
    FOREIGN KEY (user_id) REFERENCES user(ID)
);

CREATE TABLE Lab (
    ID INT PRIMARY KEY,
    name_lab VARCHAR(100),
    time TIME
);

CREATE TABLE Session (
    ID INT PRIMARY KEY,
    sessions VARCHAR(100),
    number_Sessions INT,
    time TIME
);

CREATE TABLE Information (
    ID INT PRIMARY KEY,
    user_id INT,
    date DATE,
    lab_id INT,
    generation VARCHAR(50),
    session_id INT,
    app VARCHAR(100),
    number_students INT,
    subject VARCHAR(100),
    other TEXT,
    FOREIGN KEY (user_id) REFERENCES user(ID),
    FOREIGN KEY (lab_id) REFERENCES lab(ID),
    FOREIGN KEY (session_id) REFERENCES session(ID)
);
