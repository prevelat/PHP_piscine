SELECT last_name, first_name FROM user_card WHERE (first_name LIKE '_% %_' OR first_name LIKE '_%-%_' OR last_name LIKE '_% %_' OR last_name LIKE '_%-%_') ORDER BY last_name, first_name;
