INSERT INTO ft_table(`group`, login, creation_date)
SELECT '3', last_name as login, birthdate as creation_date
	FROM user_card
	WHERE last_name LIKE '%a%' && CHAR_LENGTH(last_name) < 9
	ORDER BY last_name
	LIMIT 10;
