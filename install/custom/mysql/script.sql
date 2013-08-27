SELECT
CONCAT('ALTER TABLE ',db,'.',old_tblname,' RENAME ',db,'.',new_tblname,';')
FROM
(
    SELECT
        table_schema db,
        table_name old_tblname,
        substr(table_name,5) new_tblname
    FROM
        information_schema.tables
    WHERE
        SUBSTR(table_name,1,4)='pol_'
        AND table_schema = 'police_demo_splash'
) A;