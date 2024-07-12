SELECT 
delegaciones.id,
concat(nomenclatura.nomenclatura,delegaciones.num_delegaciona) as delegacion,    
delegaciones.nivel_delegaciona as nivel,
delegaciones.sede_delegaciona as sede
FROM `delegaciones-v2`.delegaciones
INNER JOIN nomenclatura on `delegaciones-v2`.delegaciones.id_nomenclatura = nomenclatura.id
ORDER BY delegacion;