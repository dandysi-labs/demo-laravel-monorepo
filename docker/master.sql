
CREATE DATABASE IF NOT EXISTS blog;

USE blog;

CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at datetime not null,
    updated_at datetime null,
    headline VARCHAR(100) NOT NULL,
    content VARCHAR(1000) NOT NULL,
    status VARCHAR(10) NOT NULL,
    category VARCHAR(10) NOT NULL,
    author VARCHAR(10) NOT NULL,
    priority SMALLINT NOT NULL,
    created_by VARCHAR(20) NOT NULL,
    num_views int not null default '0'
);
