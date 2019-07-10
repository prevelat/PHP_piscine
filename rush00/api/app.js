const router = require('express').Router();

router.use(require('./modules/router')());

module.exports = router;
