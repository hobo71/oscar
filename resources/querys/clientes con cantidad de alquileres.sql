select 
clientes.id,clientes.dni,concat(clientes.nombre, ' ',clientes.apellido) as nombre, clientes.email, count(alquileres.id) as cantidad 
from clientes 
inner join alquileres on alquileres.cliente_id = clientes.id
group by clientes.id
order by nombre