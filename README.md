1. Faça a instalação do XAMPP

2. Após iniciar o XAMPP e startar o Apache e MySQL crie um novo banco de dados chamado db_filmes e rode os seguintes comandos no MySQL para criar as tabelas:

2.1 Tabela de filmes:

CREATE TABLE `filmes` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`titulo` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`genero` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`genero_2` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`genero_3` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`sinopse` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`capa` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`trailer_url` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`data_lancamento` DATE NULL DEFAULT NULL,
	`duracao` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB

2.2 Tabela de filme_genero:

CREATE TABLE `filme_genero` (
	`filme_id` INT(11) NOT NULL,
	`genero_id` INT(11) NOT NULL,
	PRIMARY KEY (`filme_id`, `genero_id`) USING BTREE,
	INDEX `genero_id` (`genero_id`) USING BTREE,
	CONSTRAINT `filme_genero_ibfk_1` FOREIGN KEY (`filme_id`) REFERENCES `filmes` (`id`) ON UPDATE RESTRICT ON DELETE CASCADE,
	CONSTRAINT `filme_genero_ibfk_2` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON UPDATE RESTRICT ON DELETE CASCADE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

2.3 Tabela de generos:

CREATE TABLE `generos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`descricao` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

3. Extraia a pasta "api" para dentro de xampp/htdocs. Essa pasta normalmente fica no C: a nao ser que tenha trocado o caminho da instalação
