DROP VIEW IF EXISTS
    `questions_view`;

CREATE ALGORITHM = MERGE VIEW `questions_view` AS
    SELECT
        `questions`.*
    FROM
        `questions` AS `questions`
   UNION SELECT * from `questions_base`;


CREATE VIEW `extensions` AS SELECT * FROM `data`.`extensions`;
CREATE VIEW `files_containers` AS SELECT * FROM `data`.`files_containers`;