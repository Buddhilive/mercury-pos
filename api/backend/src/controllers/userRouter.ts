import express from 'express';
import { db_connection } from '../db_connection';
import { QueryError, QueryResult, ResultSetHeader } from 'mysql2';
import * as jwt from 'jsonwebtoken';
import * as nodemailer from 'nodemailer';

const userRouter = express.Router();
const mailService = nodemailer.createTransport({
    host: 'mail.berkelium.dev',
    port: 465,
    secure: true,
    auth: {
        user: process.env['EMAIL'],
        pass: process.env['EMAIL_PASS']
    }
});

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

userRouter.post('/forgot-password', (req, res) => {
    const user = req.body;
    const query = 'SELECT email, password from mp_users where email=?';
    db_connection.query(query, user['email'], (err: QueryError, results: QueryResult) => {
        if (!err) {
            if ((results as Array<QueryResult>).length <= 0) {
                return res.status(200).json({
                    message: 'Password reset sent your email',
                });
            } else {
                const mailOptions = {
                    from: 'Mercury POS Admin',
                    to: results[0]['email'],
                    subject: 'Password Reset Request',
                    html: `<p>Your password reset link</p>`
                };

                mailService.sendMail(mailOptions, (mailErr, info) => {
                    if (mailErr) {
                        console.log(mailErr);
                    } else {
                        console.log(info);
                    }
                });

                return res.status(200).json({
                    message: 'Password reset sent your email',
                });
            }
        } else {
            return res.status(500).json({
                message: 'Password reset error',
                error: err
            });
        }
    });
});

userRouter.get('/all', (req, res) => {
    const query = "SELECT id, name, email, contactNumber, status from mp_users where role='user'";
    db_connection.query(query, (err: QueryError, results: QueryResult) => {
        if (!err) {
            return res.status(200).json({
                message: 'Password reset error',
                results: results
            });
        } else {
            return res.status(500).json({
                message: 'Error when fetching users',
                error: err
            });
        }
    });
});

userRouter.patch('/update', (req, res) => {
    const user = req.body;
    const query = "UPDATE mp_users set status=? where id=?";
    db_connection.query(query, [user['status'], user['id']], (err: QueryError, results: QueryResult) => {
        if (!err) {
            if ((results as ResultSetHeader).affectedRows == 0) {
                return res.status(401).json({
                    message: 'User ID does not exist',
                });
            } else {
                return res.status(200).json({
                    message: 'User updated successfully',
                });
            }
        } else {
            return res.status(500).json({
                message: 'Error updating user',
                error: err
            });
        }
    });
});

export default userRouter;