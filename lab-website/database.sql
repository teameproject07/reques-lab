CREATE TABLE User (
    ID INT PRIMARY KEY,
    First_name VARCHAR(100),
    Last_name VARCHAR(100),
    Gender VARCHAR(10),
    Subject VARCHAR(100),
    Photo VARCHAR(255),
    Type ENUM('user', 'admin'),
    Username VARCHAR(50) UNIQUE,
    Email VARCHAR(100) UNIQUE,
    Password VARCHAR(255),
    Date_time DATETIME
);

CREATE TABLE Feedback (
    ID INT PRIMARY KEY,
    User_id INT,
    Comments TEXT,
    Date_time DATETIME,
    FOREIGN KEY (User_id) REFERENCES User(ID)
);

CREATE TABLE Codes (
    ID INT PRIMARY KEY,
    User_id INT,
    Email VARCHAR(100),
    Code VARCHAR(100),
    Expire DATETIME,
    FOREIGN KEY (User_id) REFERENCES User(ID)
);

CREATE TABLE Lab (
    ID INT PRIMARY KEY,
    Name_lab VARCHAR(100),
    Time TIME
);

CREATE TABLE Session (
    ID INT PRIMARY KEY,
    Sessions VARCHAR(100),
    Number_Sessions INT,
    Time TIME
);

CREATE TABLE Information (
    ID INT PRIMARY KEY,
    User_id INT,
    Date DATE,
    Lab_id INT,
    Generation VARCHAR(50),
    Session_id INT,
    App VARCHAR(100),
    Number_students INT,
    Subject VARCHAR(100),
    Other TEXT,
    FOREIGN KEY (User_id) REFERENCES User(ID),
    FOREIGN KEY (Lab_id) REFERENCES Lab(ID),
    FOREIGN KEY (Session_id) REFERENCES Session(ID)
);
