
class ReqParams {
    /**
     * @param {Object} params Object with required keys
     */
    reqparams(params) {
        return (req, res, next) => {
            for (let k in params) {
                if (!(k in req.body) && !params[k].optional)
                    return res.status(400).json({
                        error: 'MISSING_PARAM',
                        msg: params[k].msg || `Missing '${k}' param.`
                    });
                if (params[k].validate && !params[k].validate(req.body[k]))
                    return res.status(400).json({
                        error: 'INVALID_PARAM',
                        msg: params[k].msg || `Invalid value for '${k}'.`
                    });
            }
            next();
        };
    }

    /**
     * @param {Object} params Object with required keys
     */
    reqquery(params) {
        return (req, res, next) => {
            for (let k in params) {
                if (!(k in req.query) && !params[k].optional)
                    return res.status(400).end(
                        params[k].msg || `Param '${k}' missing.`
                    );
                if (params[k].validate && !params[k].validate(req.query[k]))
                    return res.status(400).end(
                        params[k].msg || `Invalid param '${k}'.`
                    );
            }
            next();
        };
    }

    notEmpty(str) {
        return (!/^\s*$/.test(str));
    }
}

module.exports = new ReqParams();
