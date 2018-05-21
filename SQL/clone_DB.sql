CREATE DATABASE clone_DB;
CREATE TABLE clone_DB.users_data (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
    user_name VARCHAR(255),
    user_id VARCHAR(255),
    user_pw VARCHAR(255),
    information VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE clone_DB.posts_data (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
    posts VARCHAR (255),
    users_id INT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE clone_DB.follows_data (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
    users_id INT,
    follows_id INT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
