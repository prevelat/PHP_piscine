SELECT DATEDIFF(MAX(member.date_last_film), MIN(member_history.date)) AS uptime FROM member JOIN member_history;
