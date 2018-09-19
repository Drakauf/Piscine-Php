SELECT COUNT(id_sub) AS nb_susc, FLOOR(AVG(price)) av_susc, SUM(duration_sub) % 42 AS ft
FROM subscription;
