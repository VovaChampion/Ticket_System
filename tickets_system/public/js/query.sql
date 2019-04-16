-- insert into two tables with foreign key 
-- https://dev.mysql.com/doc/refman/8.0/en/getting-unique-id.html
-- !!!! last_insert_id()

INSERT INTO Tickets.orders (customer_name, customer_email, order_date) VALUES ('Test', 'test@gmail.com', '2019-04-08');
INSERT INTO Tickets.orders_items (order_id, ticket_id, valid_date, used_ticket) VALUES (last_insert_id(), 2, '2019-05-08','no');


-- insert into two tables with foreign key
DECLARE @OrderId int
INSERT INTO Tickets.orders (customer_name, customer_email, order_data) VALUES ('Test', 'test@gmail.com', '2019-04-08');
SET @orderId = SCOPE_IDENTITY()
INSERT INTO Tickets.orders_items (order_id, ticket_id, valid_date, used_ticket) VALUES (@OrderId, 2, '2019-05-08','no');
