DROP TABLE IF EXISTS transportadora;
CREATE TABLE transportadora(
	id_transportadora MEDIUMINT AUTO_INCREMENT NOT NULL,
	nome VARCHAR(100) NOT NULL UNIQUE,
	ativa int(1) NOT NULL,
	PRIMARY KEY(id_transportadora)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS faixa_entrega;
CREATE TABLE faixa_entrega(
	id_faixa_entrega MEDIUMINT AUTO_INCREMENT NOT NULL,
	cep_inicial CHAR(8) NOT NULL,
	cep_final CHAR(8) NOT NULL,
	peso_minimo FLOAT NOT NULL, 
	peso_maximo FLOAT NOT NULL,
	preco FLOAT NOT NULL,
	id_transportadora MEDIUMINT NOT NULL,
	PRIMARY KEY(id_faixa_entrega),
	UNIQUE (cep_inicial,cep_final,peso_minimo,peso_maximo,id_transportadora),
	FOREIGN KEY (id_transportadora) REFERENCES transportadora (id_transportadora) ON DELETE RESTRICT
) ENGINE=InnoDB;

DELIMITER ;;
CREATE TRIGGER integridade_transportadora BEFORE INSERT ON transportadora 
FOR EACH ROW
IF (NEW.nome = '') THEN
  	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Dados invalidos, nome da transportadora nao pode ser vazio.';
ELSEIF NOT (NEW.ativa = 1 OR NEW.ativa = 0) THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Dados invalidos, flag de transportadora ativa aceita apenas 1 ou 0';
END IF;;
DELIMITER ;

DELIMITER ;;
CREATE TRIGGER integridade_faixa_entrega BEFORE INSERT ON faixa_entrega
FOR EACH ROW
IF NOT (NEW.peso_minimo > 0 AND NEW.peso_maximo > 0) THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Dados invalidos, pesos com valores iguais ou menores que 0';
ELSEIF NOT (LENGTH(NEW.cep_inicial) = 8 AND LENGTH(NEW.cep_final) = 8) THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Dados invalidos, CEP com numero de algarismos incorreto';
ELSEIF NOT (NEW.preco > 0) THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Dados invalidos, preco incorreto';
END IF;;
DELIMITER ;