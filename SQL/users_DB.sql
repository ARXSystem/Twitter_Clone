CREATE DATABASE users_DB;
CREATE TABLE users_DB.users_data (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
    user_name VARCHAR(255),
    user_id VARCHAR(255),
    user_pw VARCHAR(255),
    information VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);