SELECT UPPER(u.last_name) AS NAME, u.first_name, s.price
FROM member AS m
INNER JOIN user_card AS u
	ON m.id_user_card = u.id_user
INNER JOIN subscription AS s
	ON m.id_sub = s.id_sub
WHERE s.price > 42
ORDER BY u.last_name ASC, u.first_name ASC;
