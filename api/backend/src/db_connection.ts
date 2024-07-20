import * as mysql from 'mysql2';

export const db_connection = mysql.createConnection({
    port: parseInt(process.env['DB_PORT']),
    host: process.env['DB_HOST'],
    user: process.env['DB_USERNAME'],
    password: process.env['DB_PASSWORD'],
    database: process.env['DB_NAME']
});