const router = require('express').Router();
const guard = require('../modules/guard');
const Item = require('../models/item');
const Group = require('../models/group');
const Purchase = require('../models/purchase');
const User = require('../models/user');
const { reqparams, reqquery, notEmpty } = require('../modules/reqparams');

router.use('*', guard, (req, res, next) => {
    if (!req.user.admin) {
        console.log('Not admin', req.user);
        return res.status(404).end();
    }
    next();
});

const addItemParams = {
    name: { validate: notEmpty },
    price: { validate: (val) => val >= 0 },
    quantity: { validate: (val) => {
        return (val >= -1);
    }},
    media: { validate: (val) => {
        return (val instanceof Array && val.length > 0);
    }},
    categories: { validate: (val) => {
        return (val instanceof Array && val.length > 0);
    }}
};

router.post('/add_item', reqparams(addItemParams), async (req, res) => {
    try {
        if (await Item.findOne({ name: req.body.name }))
            return res.status(409).json({
                error: 'ITEM_NAME_IN_USE'
            });

        let group = req.body.group || null;

        if (group && !await Group.findById(group))
            group = null;

        let item = new Item({
            group
        });

        for (const p in req.body) {
            if (p == 'group')
                continue;

            if (p in Item.schema.obj) {
                item[p] = req.body[p];
            }
        }

        await item.save();

        return res.json({
            item
        });
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

router.delete('/item/:id', async (req, res) => {
    try {
        if (await Item.findByIdAndDelete(req.params.id))
            return res.json({});
        else
            return res.status(404).json({
                error: 'ITEM_NOT_FOUND'
            });
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

router.post('/modify_item/:id', async (req, res) => {
    try {
        let item = await Item.findById(req.params.id);
        if (!item)
            return res.status(404).json({
                error: 'ITEM_NOT_FOUND'
            });

        for (const p in req.body) {
            if (p == 'name' && req.body.name != item.name &&
                await Item.findOne({ name: req.body.name }))
                return res.status(409).json({
                    error: 'ITEM_NAME_IN_USE'
                });

            if (p in Item.schema.obj) {
                item[p] = req.body[p];
            }
        }

        await item.save();

        return res.json({
            item
        });
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

router.get('/get_users', async (req, res) => {
    try {
        let users = await User.find().select('-password');
        res.status(200).json({
            users
        });
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

router.get('/get_purchases', async (req, res) => {
    try {
        let purs = await Purchase.find();
        res.status(200).json({
            purchases: purs
        });
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

router.post('/delete_user/:id', async (req, res) => {
    try {
        let user = await User.findByIdAndDelete(req.params.id);
        res.status(200).json({
            deleted: !(!user)
        });
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

module.exports = router;
