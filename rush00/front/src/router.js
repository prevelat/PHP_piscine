import Vue from "vue";
import Router from "vue-router";
import Home from "./views/Home.vue";
import User from "./components/user";
import Login from "./views/Login.vue";
import Product from "./views/Product.vue";
// import Bla from "./views/Bla.vue";

Vue.use(Router);

let router = new Router({
    mode: "history",
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/view/:id",
            name: "view",
            component: Product
        },
        {
            path: "/login",
            name: "login",
            component: Login
        },
        {
            path: "/profile",
            template: "<div>Profile</div>",
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/admin",
            component: OfflineAudioCompletionEvent,
            meta: {
                requiresAdmin: true
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    // If the route requires authorization
    if (to.matched.some(rec => rec.meta.requiresAuth)) {
        // Check if the user is logged in
        if (!User.auth().currentUser) {
            return next({
                path: "/login",
                query: {
                    redirect: to.fullPath
                }
            });
        }
    }
    // If route requires admin
    next();
});

export default router;
