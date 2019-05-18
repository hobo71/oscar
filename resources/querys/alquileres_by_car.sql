select 
count(*) as cantidad, 
alquileres.vehiculo_id as vehiculo_id ,
marcas.nombre as marca_nombre,
vehiculos.modelo as modelo,
vehiculos.patente as patente,
vehiculos.marca_id as marca_id
from ((alquileres 
    INNER JOIN vehiculos ON alquileres.vehiculo_id = vehiculos.id )
    INNER JOIN marcas ON vehiculos.marca_id = marcas.id )
    group by vehiculo_id 
    order by cantidad desc 
    limit 10 



select 
count(*) as cantidad, 
alquileres.vehiculo_id as vehiculo_id , 
marcas.nombre as marca_nombre, 
vehiculos.modelo as modelo, 
vehiculos.patente as patente, 
vehiculos.marca_id as marca_id 
    from `alquileres` 
        inner join `vehiculos`  on `alquileres`.`vehiculo_id` = `vehiculos`.`id` 
        inner join `marcas`  on `vehiculos`.`marca_id` = `marcas`.`id` 
        group by `vehiculo_id` 
        order by `cantidad` desc 
        limit 10
        