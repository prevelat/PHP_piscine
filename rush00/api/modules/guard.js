const jwt = require('jsonwebtoken');
const assert = require('assert');
const User = require('../models/user');

module.exports = async (req, res, next) => {
    console.log('Here in guard');
    try {
        let bearer = req.headers['authorization'].split(' ')[1];
        let tk = jwt.verify(bearer, process.env.JWT_KEY);
        assert(tk);
        let user = await User.findById(tk._id).select('-password');
        assert(user);
        req.user = user;
        next();
    } catch {
        res.status(401).json({ error: 'INVALID_TOKEN' });
    }
};
