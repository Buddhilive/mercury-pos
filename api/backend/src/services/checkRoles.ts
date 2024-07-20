import { NextFunction, Request, Response } from "express";

export function checkRole(req: Request, res: Response, next: NextFunction) {
    if(res.locals['role'] == 'user') {
        res.sendStatus(401);
    } else {
        next();
    }
}