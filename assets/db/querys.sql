CREATE TABLE to_do_app.to_do_list (
	id INT auto_increment NOT NULL,
	`task_name` TEXT NULL,
	CONSTRAINT to_do_list_pk PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;