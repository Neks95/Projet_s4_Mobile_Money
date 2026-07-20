
CREATE TABLE operateur(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT
);

CREATE TABLE prefixe(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date_creation DATE,
    id_operateur INTEGER,
    valeur TEXT,
    FOREIGN KEY (id_operateur) REFERENCES operateur(id)
);

CREATE TABLE client(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT,
    prenom TEXT,
    numero_telephone TEXT,
    id_prefixe INTEGER,
    solde REAL,
    FOREIGN KEY (id_prefixe) REFERENCES prefixe(id)
);

CREATE TABLE type_operation(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT
);

CREATE TABLE bareme_frais(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    montant_min REAL,
    montant_max REAL,
    frais REAL,
    id_type_operation INTEGER,
    FOREIGN KEY (id_type_operation) REFERENCES type_operation(id)
);

CREATE TABLE operation(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_client1 INTEGER,
    id_client2 INTEGER,
    id_type_operation INTEGER,
    date_operation TEXT,
    montant REAL,
    frais_applique REAL ,
    description REAL ,
    FOREIGN KEY (id_client1) REFERENCES client(id),
    FOREIGN KEY (id_client2) REFERENCES client(id),
    FOREIGN KEY (id_type_operation) REFERENCES type_operation(id)
);

CREATE TABLE conf_transfert(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_operateur INTEGER,
    comission REAL,
    FOREIGN KEY (id_operateur) REFERENCES operateur(id)
);

