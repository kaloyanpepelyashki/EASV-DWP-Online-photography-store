CREATE VIEW notDelivered AS
SELECT * FROM orders
WHERE orders.done=false;