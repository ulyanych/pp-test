## SQL

    Select u.id, CONCAT_WS(' ', u.first_name, u.last_name) as name, b.author,  GROUP_CONCAT(DISTINCT(b.name) separator ', ') as books, count(b.id) as count_books From user_books u_b
    Inner Join books b On u_b.book_id = b.id
    Inner Join users u On u_b.user_id = u.id
    Where u.age >= 7 AND u.age <= 17
    Group by u.id, b.author
    Having count_books = 2;

## API
    GET /api/v1?method=rates&currency=USD,RUB
    POST /api/v1?method=convert
      POST params:
        ["currency_from":"BTC","currency_to":"USD","value":"1"]