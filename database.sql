CREATE
DATABASE adatbazis_neve;
USE
DB;

CREATE TABLE persons
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE addresses
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    person_id  BIGINT UNSIGNED,
    address    VARCHAR(255) NOT NULL,
    type       VARCHAR(50)  NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (person_id) REFERENCES persons (id) ON DELETE CASCADE
);

CREATE TABLE contacts
(
    id           BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    person_id    BIGINT UNSIGNED,
    contact_type VARCHAR(50)  NOT NULL,
    contact      VARCHAR(255) NOT NULL,
    created_at   TIMESTAMP NULL,
    updated_at   TIMESTAMP NULL,
    FOREIGN KEY (person_id) REFERENCES persons (id) ON DELETE CASCADE
);
