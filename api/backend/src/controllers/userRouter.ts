import express from 'express';
import { db_connection } from '../db_connection';
import { QueryError, QueryResult } from 'mysql2';
import * as jwt from 'jsonwebtoken';

const userRouter = express.Router();

userRouter.post('/signup', (req, res) => {
    const user = req.body;
    let query = 'select email, password, role, status from mp_users where email=?';
    db_connection.query(query, [user['email']], (err: QueryError, results: QueryResult) => {
        if (!err) {
            if ((results as Array<QueryResult>).length <= 0) {
                query = 'insert into mp_users (name,contactNumber,email,password,status,role) values(?,?,?,?,"false","user")';
                return db_connection.query(query, [user['name'], user['contactNumber'], user['email'], user['password']], (err: QueryError) => {
                    if (!err) {
                        return res.status(200).json({
                            message: "User registered successfully"
                        });
                    } else {
                        return res.status(500).json({
                            message: 'Error in user registration',
                            error: err
                        });
                    }
                });
            } else {
                return res.status(400).json({ message: 'User already exist!' })
            }
        } else {
            return res.status(500).json({
                message: 'Error in signup',
                error: err
            });
        }
    });
});

userRouter.post('/login', (req, res) => {
    const user = req.body;
    const query = "SELECT email, password, role, status from mp_users where email=?";
    db_connection.query(query, user['email'], (err: QueryError, results: QueryResult) => {
        if (!err) {
            if ((results as Array<QueryResult>).length <= 0 || results[0]['password'] != user['password']) {
                return res.status(401).json({
                    message: 'Incorrect username or password'
                });
            } else if (results[0]['status'] === 'false') {
                return res.status(401).json({
                    message: 'Account not approved by Admin'
                });
            } else if (results[0]['password'] === user['password']) {
                const response = { email: results[0]['email'], role: results[0]['role'] };
                const accessToken = jwt.sign(response, process.env['ACCESS_TOKEN'], { expiresIn: '8h' });
                return res.status(200).json({
                    message: 'Login success',
                    token: accessToken
                });
            } else {
                return res.status(400).json({
                    message: 'Login unsuccessful. Please try again later.',
                    error: err
                });
            }
        } else {
            return res.status(500).json({
                message: 'Login error',
                error: err
            });
        }
    });
});

export default userRouter;