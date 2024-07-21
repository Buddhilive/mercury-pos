import express from 'express';
import { db_connection } from '../db_connection';
import { QueryError, QueryResult, ResultSetHeader } from 'mysql2';
import { authenticateToken } from '../services/authentication';
import { checkRole } from '../services/checkRoles';

const categoryRouter = express.Router();

categoryRouter.post('/add', authenticateToken, checkRole, (req, res) => {
    const category = req.body;
    const query = "INSERT INTO mp_category (name) values(?)";
    db_connection.query(query, [category['name']], (err: QueryError) => {
        if (!err) {
            return res.status(200).json({
                message: `Category "${category['name']}" added successfully.`,
            });
        } else {
            return res.status(500).json({
                message: `Error adding category "${category['name']}"`,
                error: err
            });
        }
    });
});

categoryRouter.get('/all', authenticateToken, (req, res) => {
    const query = "SELECT * from mp_category ORDER BY name";
    db_connection.query(query, (err: QueryError, results: QueryResult) => {
        if (!err) {
            return res.status(200).json({
                message: `Categories fetched.`,
                results: results
            });
        } else {
            return res.status(500).json({
                message: `Error fetching categories`,
                error: err
            });
        }
    });
});

categoryRouter.patch('/update', authenticateToken, checkRole, (req, res) => {
    const category = req.body;
    const query = "UPDATE mp_category SET name=? WHERE id=?";
    db_connection.query(query, [category['name'], category['id']], (err: QueryError, results: QueryResult) => {
        if (!err) {
            if ((results as ResultSetHeader).affectedRows == 0) {
                return res.status(401).json({
                    message: 'Category does not exist',
                });
            } else {
                return res.status(200).json({
                    message: 'Category updated successfully',
                });
            }
        } else {
            return res.status(500).json({
                message: `Error updating category "${category['name']}"`,
                error: err
            });
        }
    });
});

export default categoryRouter;