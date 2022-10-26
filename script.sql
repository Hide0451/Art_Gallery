CREATE TABLE users(
user_id INT PRIMARY KEY,
u_name VARCHAR(30),
u_email VARCHAR(30),
u_password VARCHAR(30),
author VARCHAR(1));

CREATE TABLE category(
category_id INT PRIMARY KEY,
category_name VARCHAR(30));

CREATE TABLE genre(
genre_id INT PRIMARY KEY,
genre_name VARCHAR(30));

CREATE TABLE pictures(
pic_id INT PRIMARY KEY,
pic_name VARCHAR(30),
author_id INT,
category_id INT,
genre_id INT,
year_taken INT,
FOREIGN KEY (author_id) REFERENCES users (user_id) ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (category_id) REFERENCES category (category_id) ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (genre_id) REFERENCES genre (genre_id) ON UPDATE CASCADE ON DELETE RESTRICT);

INSERT INTO users
VALUES(1, 'Tom Brady', 'tom_brady@gmail.com', 'password_1', 1), (2, 'Drew Brees', 'drew_brees@aol.com', 'password_2', 1),
(3, 'Aaron Rodgers', 'aaron_rodgers@yahoo.com', 'password_3', 1), (4, 'Peyton Manning', 'peyton_manning@ya.ru', 'password_4', 1);

INSERT INTO category
VALUES(1, 'Photo'), (2, 'Painting'), (3, 'Drawing');

INSERT INTO genre
VALUES(1, 'People'), (2, 'Nature'), (3, 'Animals'), (4, 'Characters'), (5, 'History'),
(6, 'Architecture'), (7, 'Other');

INSERT INTO pictures
VALUES(1, 'Sunset Tree', 1, 1, 2, 2017), (2, 'Eiffel Tower', 2, 1, 6, 2019), (3, 'Struggle', 3, 1, 1, 2020),
(4, 'Two puppies', 2, 1, 3, 2014), (5, 'Faith', 3, 1, 1, 2018), (6, 'Giraffe on Elephant', 2, 1, 3, 2015),
(7, 'Dandelion', 4, 1, 2, 2016), (8, 'Belive', 3, 1, 1, 2019), (9, 'Under the stars', 1, 1, 2, 2010),
(10, 'Friendship', 2, 1, 7, 2020), (11, 'Lake from above', 4, 1, 2, 2017), (12, 'Lake from ground', 4, 1, 2, 2021),
(13, 'The Scream', 1, 2, 1, 1893), (14, 'Colorful Trees', 2, 2, 2, 2022), (15, 'Lava and Blue Lake', 3, 2, 2, 2019),
(16, 'Alcohol Ink', 2, 2, 7, 2021), (17, 'Fall Tree', 3, 2, 2, 2017), (18, 'The Death of Socrates', 2, 2, 5, 1787),
(19, 'Wet Dog', 4, 3, 3, 2020), (20, 'Sharecropper', 3, 3, 5, 1952), (21, 'Spide-rman', 1, 3, 4, 2019),
(22, 'Spring', 2, 3, 2, 2017), (23, 'Vishnu pandit', 4, 3, 2, 2015), (24, 'River and Forest', 4, 3, 2, 2020);
