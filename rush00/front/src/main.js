import Vue from "vue";
import Vuex from "vuex";
import App from "./App.vue";
// import router from "./router";

Vue.config.productionTip = false;

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user: JSON.parse(localStorage.getItem("user")) || null,
        cart: JSON.parse(localStorage.getItem("cart")) || {}
    },
    getters: {
        cartLength: state => {
            let len = 0;
            for (const k in state.cart)
                len += state.cart[k];
            return len;
        }
    },
    mutations: {
        user: (state, val) => {
            localStorage.setItem("user", JSON.stringify(val));
            state.user = val;
        },
        cartSetItem: (state, val) => {
            if (val[0] in state.cart) {
                if (state.cart[val[0]] + val[1] == 0) {
                    let dum = {...state.cart};
                    delete dum[val[0]];
                    Vue.set(state, 'cart', dum);
                } else
                    Vue.set(state.cart, val[0], state.cart[val[0]] + val[1]);
            } else
                Vue.set(state.cart, val[0], val[1]);
            localStorage.setItem("cart", JSON.stringify(state.cart));
        },
        cartAbsoluteSetItem: (state, val) => {
            if (val[1] == 0) {
                let dum = {...state.cart};
                delete dum[val[0]];
                Vue.set(state, 'cart', dum);
            } else
                Vue.set(state.cart, val[0], val[1]);
            localStorage.setItem("cart", JSON.stringify(state.cart));
        },
        cartRemove: (state, val) => {
            let dum = {...state.cart};
            delete dum[val];
            Vue.set(state, 'cart', dum);
            localStorage.setItem("cart", JSON.stringify(state.cart));
        },
        cartClear: state => {
            Vue.set(state, 'cart', {});
            localStorage.setItem("cart", JSON.stringify(state.cart));
        }
    }
});

import Router from "vue-router";
import Home from "./views/Home.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import Product from "./views/Product.vue";
import Admin from "./views/Admin.vue";
import Cart from "./views/Cart.vue";
import Profile from "./views/Profile.vue";
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
            path: "/register",
            name: "register",
            component: Register
        },
        {
            path: "/cart",
            name: "cart",
            component: Cart
        },
        {
            path: "/profile",
            name: "profile",
            component: Profile
        },
        {
            path: "/admin",
            component: Admin,
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
        if (!store.state.user) {
            return next({
                path: "/login",
                query: {
                    redirect: to.fullPath
                }
            });
        }
    }
    if (to.matched.some(rec => rec.meta.requiresAdmin)) {
        // Check if the user is logged in
        if (!store.state.user || !store.state.user.admin) {
            return next({
                path: "/404"
            });
        }
    }
    // If route requires admin
    next();
});

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount("#app");
