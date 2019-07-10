
<template>
    <div>
        <div class="delete-user">
            <h2>Delete User</h2>

            <p class="success" v-if="deleteUserMessage">{{ deleteUserMessage }}</p>
            <p class="" v-if="deleteUserError">{{ deleteUserError }}</p>

            <button
                @click="deleteUser">
                Delete User
            </button>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: "Profile",
    data() {
        return {
            deleteUserMessage: null,
            deleteUserError: null
        }
    },
    mounted() {
        axios.defaults.headers.common['Authorization'] =
            `Bearer ${this.$store.state.user.token}`;
    },
    methods: {
        deleteUser() {
            this.deleteUserMessage = null;
            this.deleteUserError = null;
            axios
                .post("/api/auth/self_delete/")
                .then(res => {
                    this.logout();
                })
                .catch(err => {
                    console.error(err);
                    if (err.response && err.response.data)
                        this.deleteUserError = err.resopnse.data.error;
                });
        },
        logout() {
            this.$store.commit("user", null);
            this.$router.push("/");
        }
    }
}
</script>
