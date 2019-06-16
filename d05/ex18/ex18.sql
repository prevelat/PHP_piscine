SELECT * FROM distrib WHERE id_distrib = 42 OR (id_distrib > 61 AND id_distrib < 72) OR (id_distrib > 87 AND id_distrib < 91) OR LOWER(name) LIKE '%y%y%' LIMIT 3,5;
