const mongoose = require('mongoose');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');

let schema = new mongoose.Schema({
    email: { type : String },
    password: { type: String },
    admin: { type: Boolean, default: false }
});

schema.statics.hashPassword = (password) => {
    return new Promise((resolve, reject) => {
        bcrypt.hash(password, 10, (err, hash) => {
            if (err) return reject(err);
            resolve(hash);
        });
    });
};

schema.methods.comparePassword = function(password) {
    return new Promise((resolve, reject) => {
        bcrypt.compare(password, this.password, (err, match) => {
            if (err) return reject(err);
            resolve(match);
        })
    });
};

schema.methods.getToken = function() {
    return jwt.sign({
        _id: this._id
    }, process.env.JWT_KEY);
};

module.exports = mongoose.model('user', schema);
