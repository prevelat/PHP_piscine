const router = require('express').Router();
const { reqparams } = require('../modules/reqparams');
const guard = require('../modules/guard');

const Item = require('../models/item');
const User = require('../models/item');
const Purchase = require('../models/purchase');

router.use(guard);

const checkReq = {
    items: {
        validate: (val) => {
            console.log(val);
            if (!(val instanceof Array))
                return false;
            let len = 0;
            for (const it of val)
                len += it.qty;
            return (len > 0);
        }
    }
};

router.post('/', reqparams(checkReq), async (req, res) => {
    try {
        let id_list = req.body.items.map(el => el._id);
        let item_list = [];

        for (const id of id_list) {
            let item = await Item.findById(id);

            if (!item)
                return res.status(401).json({
                    error: 'INVALID_ITEMS'
                });
            item_list.push(item);
        }

        let pur = new Purchase({
            user_id: req.user._id,
            items: item_list
        });

        await pur.save();

        return res.status(200).json({ purchase: pur });
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

module.exports = router;