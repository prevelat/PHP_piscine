<template>
    <div>
        <div>
            <h1>Login</h1>
            <ul v-if="loginErrors.length" class="login-errors">
                <li v-for="error in loginErrors" v-bind:key="error">
                    {{ error }}
                </li>
            </ul>
            <form @submit.prevent="onLoginSubmit">
                <input type="email" v-model="email" />
                <input type="password" v-model="password" />
                <input type="submit" value="Sign in" />
            </form>
            <router-link to="/register">Sign up</router-link>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Login",
    data() {
        return {
            register: false,
            email: null,
            password: null,
            loginErrors: []
        };
    },
    methods: {
        onLoginSubmit() {
            this.loginErrors = [];
            if (this.email && this.password) {
                let user = {
                    email: this.email,
                    password: this.password
                };

                axios
                    .post("/api/auth/login", user)
                    .then(res => {
                        // Login OK
                        this.$store.commit("user", res.data);
                        if (this.$store.state.user) {
                            if ("redirect" in this.$route.query)
                                this.$router.push(this.$route.query.redirect);
                            else this.$router.push("/");
                        }
                    })
                    .catch(err => {
                        if (err.response && err.response.status == 401)
                            this.loginErrors.push("Invalid credentials");
                        else this.loginErrors.push(err.toString());
                    });
            } else {
                if (
                    !this.email &&
                    this.loginErrors.indexOf("Email required.") == -1
                )
                    this.loginErrors.push("Email required.");
                if (
                    !this.password &&
                    this.loginErrors.indexOf("Password required.") == -1
                )
                    this.loginErrors.push("Password required.");
            }
        }
    }
};
</script>
