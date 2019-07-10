const router = require('express').Router();
const User = require('../models/user');
const guard = require('../modules/guard');
const { reqparams, notEmpty } = require('../modules/reqparams');

const loginParams = {
    email: { validate: (val) => {
        return /\S+@\S+\.\S+/.test(val);
    }},
    password: { validate: notEmpty }
}

router.post('/login', reqparams(loginParams), async (req, res) => {
    try {
        let user = await User.findOne({ email: req.body.email });

        if (!user || !await user.comparePassword(req.body.password))
            return res.status(401).json({ error: 'INVALID_CREDENTIALS' });

        let payload = {
            token: user.getToken()
        };

        if (user.admin)
            payload['admin'] = true;

        return res.json(payload);
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

router.post('/register', reqparams(loginParams), async (req, res) => {
    try {
        let user = await User.findOne({ email: req.body.email });

        if (user) return res.status(409).json({ error: 'EMAIL_IN_USE' });

        user = new User({
            email: req.body.email,
            password: await User.hashPassword(req.body.password)
        });

        await user.save();

        return res.json({
            token: user.getToken()
        });
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

router.post('/self_delete', guard, async (req, res) => {
    try {
        return res.status(200).json({
            deleted: !(!await User.findByIdAndDelete(req.user._id))
        });
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

module.exports = router;
