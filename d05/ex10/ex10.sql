SELECT film.title as Title, film.summary AS Summary, prod_year FROM film JOIN genre ON genre.id_genre = film.id_genre WHERE genre.name ='erotic' ORDER BY film.prod_year DESC;
