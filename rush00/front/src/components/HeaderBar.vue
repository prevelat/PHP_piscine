<template>
    <div class="header-bar">
        <div class="content">
            <router-link to="/" class="left">Home</router-link>
            <router-link v-if="!user" to="/login" class="right">
                Sign In
            </router-link>
            <router-link
                v-else
                to="/logout"
                class="right"
                v-on:click.native="logout"
            >
                Logout
            </router-link>
            <router-link to="/cart" class="right">Cart({{ this.$store.getters.cartLength }})</router-link>
            <router-link v-if="user" to="/profile" class="right">
                Profile
            </router-link>
            <router-link v-if="user && user.admin" to="/admin" class="right">
                Admin
            </router-link>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "HeaderBar",
    data() {
        return {};
    },
    methods: {
        logout(e) {
            e.preventDefault();
            this.$store.commit("user", null);
        }
    },
    computed: {
        ...mapState(["user"])
    }
};
</script>

<style scoped>
.header-bar {
    height: 50px;
    line-height: 50px;
    background: rgb(29, 41, 53);
}
.header-bar > .content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2em;
}

.header-bar > .content > .left {
    color: white;
    text-decoration: none;
    float: left;
    text-align: center;
}

.header-bar > .content > .right {
    color: white;
    float: right;
    padding: 0px 16px;
    text-decoration: none;
}
</style>
