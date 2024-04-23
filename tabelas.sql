CREATE TABLE Pessoa (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(100) NOT NULL,
    Sexo ENUM('Masculino', 'Feminino', 'Outro'),
    Email VARCHAR(100),
    Telefone VARCHAR(20)
);

CREATE TABLE Funcionario (
    Codigo INT PRIMARY KEY,
    DataContrato DATE,
    Salario DECIMAL(10,2),
    SenhaHash VARCHAR(100) NOT NULL,
    FOREIGN KEY (Codigo) REFERENCES Pessoa(Codigo)
);

CREATE TABLE Medico (
    Codigo INT PRIMARY KEY,
    Especialidade VARCHAR(100),
    CRM VARCHAR(20),
    FOREIGN KEY (Codigo) REFERENCES Funcionario(Codigo)
);

CREATE TABLE Paciente (
    Codigo INT PRIMARY KEY,
    Peso DECIMAL(5,2),
    Altura DECIMAL(5,2),
    TipoSanguineo VARCHAR(5),
    FOREIGN KEY (Codigo) REFERENCES Pessoa(Codigo)
);

CREATE TABLE Endereco(
    CEP VARCHAR(9),
    Logradouro VARCHAR(200),
    Cidade VARCHAR(100),
    Estado VARCHAR(50)
);

CREATE TABLE Agenda (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Data DATE,
    Horario TIME,
    Nome VARCHAR(100),
    Sexo ENUM('Masculino', 'Feminino', 'Outro'),
    Email VARCHAR(100),
    CodigoMedico INT,
    FOREIGN KEY (CodigoMedico) REFERENCES Medico(Codigo)
);