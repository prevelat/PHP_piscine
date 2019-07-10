const mongoose = require('mongoose');

let schema = new mongoose.Schema({
    name: { type: String },
    price: { type: Number },
    quantity: { type: Number },
    media: [{ type: String }],
    group: { type: mongoose.Schema.Types.ObjectId, ref: 'group', default: null },
    categories: [{ type: String }]
});

module.exports = mongoose.model('item', schema);
