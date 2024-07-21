CREATE TABLE
    mp_users (
        id int primary key AUTO_INCREMENT,
        name varchar(250),
        contactNumber varchar(20),
        email varchar(50),
        password varchar(250),
        status varchar(50),
        role varchar(20),
        UNIQUE (email)
    );

insert into
    mp_users (
        name,
        contactNumber,
        email,
        password,
        status,
        role
    )
values
    (
        'admin',
        '0111111111',
        'admin@example.com',
        '123456',
        'true',
        'admin'
    );

CREATE TABLE
    mp_category (
        id int primary key AUTO_INCREMENT,
        name varchar(255) NOT NULL
    );