<template>
    <div>
        <table v-if="items.length">
            <thead>
                <tr>
                    <td>Item</td>
                    <td>Amount</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tr
                v-for="item of items"
                :key="item._id"
            >
                <td>{{ item.name }}</td>
                <td>
                    <input
                        type="number"
                        min="0"
                        :data-id="item._id"
                        @change="onChange"
                        v-model.number="item.qty" />
                    &nbsp;<small>${{ item.price }} ea.</small>
                </td>
                <td>
                    ${{ item.price * item.qty }}
                </td>
            </tr>
            <tfoot>
                <tr>
                    <td></td>
                    <td style="text-align: right">Total: </td>
                    <td>${{ total }}</td>
                </tr>
            </tfoot>
        </table>
        <div v-if="this.$store.state.user"
        style="text-align: right; margin: 0 auto; max-width: 700px;">
            <button v-if="items.length" @click="onBuy">
                Purchase
            </button>
        </div>
        <div v-else style="text-align: right; margin: 0 auto; max-width: 700px;">
            <router-link v-if="!this.$store.state.user" to="/login?redirect=%2Fcart">
                Sign In to Buy
            </router-link>
        </div>
        <div v-if="message" class="message">
            <span>{{message}}</span>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Cart",
    data() {
        return {
            items: [],
            message: null
        };
    },
    computed: {
        total: function() {
            let t = 0;
            for (const it of this.items)
                t += it.qty * it.price;
            return t;
        }
    },
    watch: {
        items: {
            handler(val) {
                console.log(val);
            },
            deep: true
        }
    },
    mounted() {
        if (this.$store.state.user)
            axios.defaults.headers.common['Authorization'] =
                `Bearer ${this.$store.state.user.token}`;
        for (const k in this.$store.state.cart) {
            axios
                .get(`/api/view/${k}`)
                .then(res => {
                    console.log(res.data);
                    let ob = {
                        qty: this.$store.state.cart[k],
                        media: res.data.item.media,
                        name: res.data.item.name,
                        price: res.data.item.price,
                        _id: res.data.item._id
                    };
                    this.items.push(ob);
                })
                .catch(err => {
                    console.error(err);
                });
        }
    },
    methods: {
        onBuy() {
            let payload = this.items.map(el => {
                return {
                    _id: el._id,
                    qty: el.qty
                };
            });
            this.message = null;
            axios
                .post(`/api/checkout`,
                    { items: payload })
                .then(res => {
                    this.message = "Purchase sucessfull.";
                    this.items = [];
                    this.$store.commit("cartClear");
                })
                .catch(err => {
                    console.error(err);
                    if (err.response && err.response.data)
                        this.message = `Error ${err.response.data.error}`;
                });
        },
        onChange(e) {
            this.$store.commit("cartAbsoluteSetItem", [
                e.target.dataset.id,
                Number(e.target.value)
            ]);
        }
    }
};
</script>

<style scoped>
table {
    border-collapse: collapse;
    width: 60%;
    margin: 2em auto;
}

table tr td {
    border: 1px solid darkgrey;
    border-left: 0;
    border-right: 0;
    padding: 1em 2em;
}

table thead td,
table tfoot td {
    border: 0;
}

small {
    color: grey;
    font-size: 8pt;
}

.message {
    padding: 2em;
    padding-top: 4em;
}
</style>
