const router = require('express').Router();

module.exports = () => {
    const routes = [
        { url: '/auth', path: 'auth' },
        { url: '/view', path: 'view' },
        { url: '/admin', path: 'admin' },
        { url: '/checkout', path: 'checkout' }
    ];

    for (const r of routes) {
        console.log(`Endpoint ${r.url} connected.`);
        router.use(r.url, require(`../routes/${r.path}`));
    }

    return router;
};
