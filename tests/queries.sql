select s.id,
from orders o ,status s 
where o.id = s.source_id 
where source = 'orders'
ORDER  By s.id DESC
