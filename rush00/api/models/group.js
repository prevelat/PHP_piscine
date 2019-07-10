const mongoose = require('mongoose');

let schema = new mongoose.Schema({
    items: { type: mongoose.Schema.Types.ObjectId, ref: 'item' }
});

module.exports = mongoose.model('group', schema);
