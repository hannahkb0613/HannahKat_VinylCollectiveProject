#get_table_sizes.sql
#---------------------------------------------
SELECT TABLE_NAME, TABLE_ROWS
FROM   information_schema.tables
WHERE  table_schema='hannah-kats-vinyl-collective';
