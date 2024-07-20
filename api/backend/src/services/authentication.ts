import { NextFunction, Request, Response } from 'express';
import * as jwt from 'jsonwebtoken';

export function authenticateToken(req: Request, res: Response, next: NextFunction) {
    const authHeader = req.headers.authorization;
    const token = authHeader && authHeader.split(' ')[1];

    if (token == null) {
        return res.sendStatus(401);
    }

    return jwt.verify(token, process.env['ACCESS_TOKEN'], (err, resp) => {
        if (err) {
            return res.sendStatus(403);
        }

        res.locals = resp as any;
        return next();
    });
}
