const mongoose = require('mongoose');

let schema = new mongoose.Schema({
    user_id: { type: mongoose.Schema.Types.ObjectId, ref: 'user' },
    items: [
        {
            item: { type: mongoose.Schema.Types.ObjectId, ref: 'item' },
            quantity: { type: Number }
        }
    ]
});

module.exports = mongoose.model('purchase', schema);
