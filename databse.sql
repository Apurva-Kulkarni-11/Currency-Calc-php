CREATE DATABASE db_currency;

USE db_currency;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    ip VARCHAR(50) NOT NULL
);

CREATE TABLE currencies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    currency_code VARCHAR(3) NOT NULL,
    exchange_rate FLOAT NOT NULL,
    UNIQUE(currency_code)
);
