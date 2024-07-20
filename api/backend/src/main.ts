/**
 * This is not a production server yet!
 * This is only a minimal backend to get started.
 */

import express from 'express';
import * as path from 'path';
import bodyParser from 'body-parser';
import { db_connection } from './db_connection';
import userRouter from './controllers/userRouter';

const app = express();
app.use(bodyParser.json({limit: "100mb"}));
app.use(bodyParser.urlencoded({limit:"50mb", extended: true}));

app.use('/assets', express.static(path.join(__dirname, 'assets')));

app.get('/api', (req, res) => {
    res.send({ message: 'Welcome to backend!' });
});

app.use('/user', userRouter);

const port = process.env['PORT'] || 3333;
const server = app.listen(port, () => {
    console.log(`Listening at http://localhost:${port}/api`);
});
server.on('error', console.error);

db_connection.connect((err) => {
    if(!err) {
        console.log(`Database is connected`);
    } else {
        console.log(err);
    }
});