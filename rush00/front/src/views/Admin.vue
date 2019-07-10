<template>
    <div>
        <div>
            <div
                class="tab"
                :class="{ activeTab: selectedTab === tab }"
                v-for="(tab, index) in tabs"
                :key="index"
                @click="selectedTab = tab"
            >
                {{ tab }}
            </div>
        </div>

        <div v-show="selectedTab === 'Modify'">
            <div class="modify-item">
                <h2>Modify item</h2>

                <p class="success" v-if="modifyMessage">{{ modifyMessage }}</p>
                <p class="" v-if="modifyError">{{ modifyError }}</p>

                <label for="item-select">Item: </label>
                <select
                    id="item-select"
                    v-model="selectedModifyId"
                    @change="onModifySelected"
                >
                    <option :value="null" default></option>
                    <option
                        v-for="item of items"
                        :value="item._id"
                        :key="item._id"
                    >
                        {{ item.name }}
                    </option>
                </select>

                <div v-if="selectedModifyItem">
                    <div>
                        <label for="">Name: </label>
                        <input type="text" v-model="selectedModifyItem.name">
                    </div>
                    <div>
                        <label for="">Price: </label>
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            v-model="selectedModifyItem.price" />
                    </div>
                    <div>
                        <label for="">Quantity: </label>
                        <input
                            type="number"
                            min="-1"
                            v-model="selectedModifyItem.quantity" />
                    </div>
                    <div>
                        <label for="">Categories: </label>
                        <textarea
                            cols="30"
                            rows="4"
                            v-model="selectedModifyItem.categories"
                        >
                        </textarea>
                        <p>
                            <small>
                                Important note: categories are comma separated
                            </small>
                        </p>
                    </div>
                    <div>
                        <label for="">Media URLs: </label>
                        <textarea
                            cols="30"
                            rows="4"
                            v-model="selectedModifyItem.media"
                        >
                        </textarea>
                        <p>
                            <small>
                                Important note: media URLs are comma separated
                            </small>
                        </p>
                    </div>
                </div>
                <div>
                    <button
                        @click="submitModifications">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
        <div v-show="selectedTab === 'Create'">
            <div class="create-item">
                <h2>Create item</h2>

                <p class="success" v-if="createMessage">{{ createMessage }}</p>
                <p class="" v-if="createError">{{ createError }}</p>

                <div>
                    <label for="">Name: </label>
                    <input type="text" v-model="createItem.name">
                </div>
                <div>
                    <label for="">Price: </label>
                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        v-model="createItem.price" />
                </div>
                <div>
                    <label for="">Quantity: </label>
                    <input
                        type="number"
                        min="-1"
                        v-model="createItem.quantity" />
                </div>
                <div>
                    <label for="">Categories: </label>
                    <textarea
                        cols="30"
                        rows="4"
                        v-model="createItem.categories"
                    >
                    </textarea>
                    <p>
                        <small>
                            Important note: categories are comma separated
                        </small>
                    </p>
                </div>
                <div>
                    <label for="">Media URLs: </label>
                    <textarea
                        cols="30"
                        rows="4"
                        v-model="createItem.media"
                    >
                    </textarea>
                    <p>
                        <small>
                            Important note: media URLs are comma separated
                        </small>
                    </p>
                </div>
                <button
                    @click="submitCreateItem">
                    Create item
                </button>
            </div>
        </div>
        <div v-show="selectedTab === 'History'">
            <div>
                <span
                    v-for="h in history"
                    :key="h._id"
                    style="display: block; padding: 1em;"
                >
                    Purchase '{{ h._id }}' made by user '{{ h.user_id }}'
                </span>
            </div>
        </div>
        <div v-show="selectedTab === 'Manage Accounts'">
            <div>
                <div class="delete-user">
                    <h2>Delete User</h2>

                    <p class="success" v-if="deleteUserMessage">{{ deleteUserMessage }}</p>
                    <p class="" v-if="deleteUserError">{{ deleteUserError }}</p>

                    <label for="item-select">User: </label>
                    <select
                        id="item-select"
                        v-model="selectedDeleteUserId"
                    >
                        <option :value="null" default></option>
                        <option
                            v-for="item of users"
                            :value="item._id"
                            :key="item._id"
                        >
                            {{ item.email }}
                        </option>
                    </select>
                    <button
                        @click="deleteUser">
                        Delete User
                    </button>
                </div>
                <div class="create-user">
                    <h2>Create User</h2>

                    <p class="success" v-if="createUserMessage">{{ createUserMessage }}</p>
                    <p class="" v-if="createUserError">{{ createUserError }}</p>

                    <div>
                        <label for="">Email: </label>
                        <input type="email" v-model="createUser.email">
                    </div>
                    <div>
                        <label for="">Password: </label>
                        <input type="password" v-model="createUser.password">
                    </div>
                    <button
                        @click="onCreateUser">
                        Create User
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Admin",
    data() {
        return {
            items: [],
            selectedModifyId: null,
            selectedModifyItem: null,
            selectedDeleteUserId: null,
            deleteUserMessage: null,
            deleteUserError: null,
            createUser: {
                email: null,
                password: null
            },
            createUserMessage: null,
            createUserError: null,
            modifyMessage: null,
            modifyError: null,
            createMessage: null,
            createError: null,
            createItem: {
                name: null,
                price: 0,
                quantity: 0,
                media: null,
                categories: null
            },
            history: [],
            users: [],
            tabs: ['Modify', 'Create', 'History', 'Manage Accounts'],
            selectedTab: 'Modify'
        };
    },
    mounted() {
        axios.defaults.headers.common['Authorization'] =
            `Bearer ${this.$store.state.user.token}`;
        axios
            .get("/api/view")
            .then(res => {
                for (const item of res.data.items) this.items.push(item);
            })
            .catch(err => {
                console.error(err);
            });
        axios
            .get("/api/admin/get_purchases")
            .then(res => {
                for (const item of res.data.purchases) this.history.push(item);
            })
            .catch(err => {
                console.error(err);
            });
        axios
            .get("/api/admin/get_users")
            .then(res => {
                for (const user of res.data.users) this.users.push(user);
            })
            .catch(err => {
                console.error(err);
            });
    },
    methods: {
        onModifySelected() {
            this.selectedModifyItem = null;
            for (const it of this.items) {
                if (it._id == this.selectedModifyId) {
                    this.selectedModifyItem = it;
                    break;
                }
            }
        },
        submitModifications() {
            if (!this.selectedModifyItem)
                return;

            if (!(this.selectedModifyItem.categories instanceof Array))
                this.selectedModifyItem.categories =
                    this.selectedModifyItem.categories.split(",");

            if (!(this.selectedModifyItem.media instanceof Array))
                this.selectedModifyItem.media =
                    this.selectedModifyItem.media.split(",");

            let payload = {...this.selectedModifyItem};
            delete payload['_id'];

            this.modifyMessage = null;
            this.modifyError = null;

            axios
                .post("/api/admin/modify_item/" +
                      this.selectedModifyItem._id,
                    payload)
                .then(() => {
                    this.modifyMessage = "Modified successfully";
                })
                .catch(err => {
                    if (err.response && err.response.data)
                        this.modifyError = `Error: ${err.response.data.error}`;
                    else
                        this.modifyError = `Unknown error.`
                });
        },
        submitCreateItem() {
            this.createMessage = null;
            this.createError = null;

            if (!(this.createItem.categories instanceof Array))
                this.createItem.categories =
                    this.createItem.categories.split(",");

            if (!(this.createItem.media instanceof Array))
                this.createItem.media =
                    this.createItem.media.split(",");

            axios
                .post("/api/admin/add_item/",
                    this.createItem)
                .then(() => {
                    this.createMessage = "Created successfully";
                    this.createItem = {
                        name: null,
                        price: 0,
                        quantity: 0,
                        media: null,
                        categories: null
                    };
                })
                .catch(err => {
                    if (err.response && err.response.data)
                        this.createError = `Error: ${err.response.data.error}`;
                    else
                        this.createError = `Unknown error.`
                });
        },
        deleteUser() {
            if (!this.selectedDeleteUserId)
                return;
            this.deleteUserMessage = null;
            this.deleteUserError = null;
            axios
                .post("/api/admin/delete_user/" +
                    this.selectedDeleteUserId)
                .then(res => {
                    this.deleteUserMessage = "Deleted user sucessfully";
                    if (this.selectedDeleteUserId == this.$store.state.user._id)
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
        },
        onCreateUser() {
            this.createUserMessage = null;
            this.createUserError = null;
            axios
                .post("/api/auth/register/",
                    this.createUser)
                .then(res => {
                    this.createUserMessage = "User created sucessfully";
                })
                .catch(err => {
                    console.error(err);
                    if (err.response && err.response.data)
                        this.createUserError = err.resopnse.data.error;
                });
        }
    }
};
</script>
<style scoped>
.modify-item,
.create-item,
.delete-user,
.create-user {
    padding: 2em;
    max-width: 800px;
    margin: 0 auto;
}

.tab {
    padding: 20px 0px 15px 50px ;
    display: inline-block;
    margin: 0 0.25em;
    cursor: pointer;
    font-size: 20pt;
    font-weight: 300;
    text-transform: capitalize;
}
.activeTab {
    color: #16c0b0;
    text-decoration: underline;
}

.success {
    color: #16c0b0;
    font-weight: bold;
    font-size: small;
}

.error {
    color: red;
    font-weight: bold;
    font-size: small;
}
</style>
