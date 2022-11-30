CREATE TABLE users(
user_id SERIAL PRIMARY KEY,
u_name VARCHAR(30),
u_email VARCHAR(75),
u_password VARCHAR(255),
u_date DATE,
author INT,
date_created TIMESTAMP DEFAULT Now(),
u_status int DEFAULT 0);

CREATE TABLE category(
category_id SERIAL PRIMARY KEY,
category_name VARCHAR(30));

CREATE TABLE genre(
genre_id SERIAL PRIMARY KEY,
genre_name VARCHAR(30));

CREATE TABLE pictures(
pic_id SERIAL PRIMARY KEY,
pic_name VARCHAR(30),
author_id INT,
category_id INT,
genre_id INT,
year_taken INT,
date_posted TIMESTAMP DEFAULT Now(),
FOREIGN KEY (author_id) REFERENCES users (user_id) ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (category_id) REFERENCES category (category_id) ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (genre_id) REFERENCES genre (genre_id) ON UPDATE CASCADE ON DELETE RESTRICT);

INSERT INTO users(u_name, u_email, u_password, author)
VALUES('Tom Brady', 'tom_brady@gmail.com', 'password_1', 1), ('Drew Brees', 'drew_brees@aol.com', 'password_2', 1),
('Aaron Rodgers', 'aaron_rodgers@yahoo.com', 'password_3', 1), ('Peyton Manning', 'peyton_manning@ya.ru', 'password_4', 1);

INSERT INTO category(category_name)
VALUES('Photo'), ('Painting'), ('Drawing');

INSERT INTO genre(genre_name)
VALUES('People'), ('Nature'), ('Animals'), ('Characters'), ('History'),
('Architecture'), ('Other');

INSERT INTO pictures(pic_name, author_id, category_id, genre_id, year_taken)
VALUES('Sunset Tree', 1, 1, 2, 2017), ('Eiffel Tower', 2, 1, 6, 2019), ('Struggle', 3, 1, 1, 2020),
('Two Puppies', 2, 1, 3, 2014), ('Faith', 3, 1, 1, 2018), ('Giraffe on Elephant', 2, 1, 3, 2015),
('Dandelion', 4, 1, 2, 2016), ('Belive', 3, 1, 1, 2019), ('Under the stars', 1, 1, 2, 2010),
('Friendship', 2, 1, 7, 2020), ('Lake from above', 4, 1, 2, 2017), ('Lake from ground', 4, 1, 2, 2021),
('The Scream', 1, 2, 1, 1893), ('Colorful Trees', 2, 2, 2, 2022), ('Lava and Blue Lake', 3, 2, 2, 2019),
('Alcohol Ink', 2, 2, 7, 2021), ('Fall Tree', 3, 2, 2, 2017), ('The Death of Socrates', 2, 2, 5, 1787),
('Wet Dog', 4, 3, 3, 2020), ('Sharecropper', 3, 3, 5, 1952), ('Spide-rman', 1, 3, 4, 2019),
('Spring', 2, 3, 2, 2017), ('Vishnu pandit', 4, 3, 2, 2015), ('River and Forest', 4, 3, 2, 2020);

CREATE TABLE administrators(
adm_id SERIAL PRIMARY KEY,
adm_name VARCHAR(30),
adm_email VARCHAR(75),
adm_password VARCHAR(255),
adm_date DATE,
date_created TIMESTAMP DEFAULT Now());
