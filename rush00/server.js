const express = require('express');
const app = express();
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const cors = require('cors');
const history = require('connect-history-api-fallback');

const port = process.env.PORT || 3000;

app.use(history());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(cors({ credentials: true, origin: true }));

app.use('/api', require('./api/app'));
app.use(express.static(__dirname + '/front/dist'));

mongoose.connect(process.env.db_url, { useNewUrlParser: true })
    .then(() => {
        console.log(`Mongodb connected`);
        app.listen(port, () => {
            console.log(`App listening on port ${port}`);
        });
    })
    .catch((err) => {
        console.error(err);
    });
