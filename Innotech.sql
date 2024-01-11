DROP DATABASE INNOTECH;
CREATE DATABASE INNOTECH;

use INNOTECH;

CREATE TABLE Usuarios(
    ID int not null AUTO_INCREMENT,
    rm VARCHAR(5),
    nome VARCHAR(100) NOT NULL,
    curso VARCHAR(100),
    status VARCHAR(50) DEFAULT 'ativado',
    -- Definindo o valor padrão como 'ativado'
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    type VARCHAR(25),
    CONSTRAINT Usuarios PRIMARY KEY (ID),
    UNIQUE(rm, email)
);

INSERT INTO
    Usuarios (
        nome,
        email,
        senha,
        type)
VALUES
    (

        'Administrador ETECIA',
        'admin@gmail.com',
        'Teste@12345',
        'adm'
    ),

CREATE TABLE Armarios_Aluguel (
    IDs INT NOT NULL AUTO_INCREMENT,
    letra VARCHAR(1),
    numero INT(25),
    status VARCHAR(100),
    curso VARCHAR(100),
    nome VARCHAR(100),
    rm int(5),
    pagamento VARCHAR(100),
    statusAluguel VARCHAR(100),
    ID int,
    PRIMARY KEY(IDs),
    FOREIGN KEY (ID) REFERENCES Usuarios(ID)
);

INSERT INTO
    Armarios_Aluguel (
        letra,
        numero,
        status,
        curso,
        nome,
        rm,
        pagamento,
        statusAluguel
    )
VALUES
    (
        'B',
        '01',
        'ativado',
        'Desenvolvimento de Sistemas',
        'Gui',
        '21583',
        'pix',
        'pendente'
    ),
    (
        'B',
        '02',
        'ativado',
        'Desenvolvimento de Sistemas',
        'Gui',
        '21583',
        'pix',
        'pendente'
    ),
    (
        'B',
        '03',
        'desativado',
        'Desenvolvimento de Sistemas',
        'Gui',
        '21523',
        'cartao',
        'aprovado'
    ),
    (
        'B',
        '04',
        'desativado',
        'Desenvolvimento de Sistemas',
        'Gui',
        '21583',
        'pix',
        'negado'
    );

CREATE TABLE GerenciamentoGeral (
    ID_Gerenciar INT AUTO_INCREMENT PRIMARY KEY,
    armarios_disponiveis INT,
    armarios_reservados INT,
    armarios_alugados INT,
    armarios_inativos INT,
    pagamentos_pendentes INT,
    valor_total DECIMAL(10, 2),
    total_administradores INT,
    total_alunos INT,
    total_alunos_bloqueados INT IDs INT,
    FOREIGN KEY (IDs) REFERENCES Armarios_Aluguel (IDs)
);

INSERT INTO
    Armarios (nome, rm, ID)
SELECT
    nome,
    rm,
    ID
FROM
    Usuarios
WHERE
    type = "Aluno";

INSERT INTO
    alugueis (nome, rm, curso, pagamento, status, Arm_ID)
SELECT
    statusAluguel,
    nome,
    rm,
    curso,
    pagamento,
    Arm_ID
FROM
    Armarios
WHERE
    status = "em andamento";
