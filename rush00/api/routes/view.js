const router = require('express').Router();
const Item = require('../models/item');

router.get('/', async (req, res) => {
    try {
        let items = await Item.find();

        return res.json({
            items
        });
    } catch(e) {
        console.error(e);
        return res.status(500).json({
            error: 'INTERNAL_ERROR'
        });
    }
});

router.get('/:id', async (req, res) => {
    try {
        let item = await Item.findById(req.params.id);

        if (!item) return res.status(404).json({ error: 'ITEM_NOT_FOUND' });

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

module.exports = router;
