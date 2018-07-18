CREATE TABLE book (id SERIAL, title TEXT);

CREATE TABLE author (id SERIAL, name TEXT);

CREATE TABLE book_author (id SERIAL, book_id int, author_id int);

CREATE INDEX ON book_author (book_id);
CREATE INDEX ON book_author (author_id);


INSERT INTO book (title) values ('Книга 1'), ('Книга 2'), ('Книга 3'), ('Книга 4'), ('Книга 5'), ('Книга 6'), ('Книга 7'), ('Книга 8'), ('Книга 9');

INSERT INTO author (name) values ('Автор 1'), ('Автор 2'), ('Автор 3'), ('Автор 4'), ('Автор 5'), ('Автор 6'), ('Автор 7');

INSERT INTO book_author (book_id, author_id) values
	(1, 1),
    (2, 1), (2, 2),
    (3, 3), (3, 4), (3, 1),
    (4, 2), (4, 3), (4, 5), (4, 6),
    (5, 5), (5, 6),
    (6, 1), (6, 3), (6, 6),
    (7, 5),
    (8, 1), (8, 4);

SELECT book.id, MAX(book.title), COUNT(*) FROM book INNER JOIN book_author ON book.id = book_author.book_id GROUP BY book.id HAVING COUNT(*) = 3;