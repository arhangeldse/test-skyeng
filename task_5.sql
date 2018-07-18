CREATE TABLE test (
  id INT NOT NULL PRIMARY KEY
);

INSERT INTO test (id) VALUES (1), (2), (3), (6), (8), (9), (12);



SELECT id as "FROM", next_id as "TO"
FROM(
      SELECT id, LEAD(id) OVER (ORDER BY id) AS next_id
      FROM test
    )T
WHERE id + 1 <> next_id