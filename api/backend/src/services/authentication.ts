import { NextFunction, response, Response } from 'express';
import * as jwt from 'jsonwebtoken';

export function authenticateToken(req: Request, res: Response, next: NextFunction) {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];

    if (token === null) {
        return res.sendStatus(401);
    }

    jwt.verify(token, process.env['ACCESS_TOKEN'], (err, resp) => {
        if (err) {
            return res.sendStatus(403)
        }

        res.locals = response;
        next();
        return res.sendStatus(200);
    });

    return true;
}