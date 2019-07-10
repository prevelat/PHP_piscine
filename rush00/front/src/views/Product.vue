<template>
    <div v-if="item" class="product">

        <div id="container">
            <div class="preview">
                <img :src="image" />
            </div>
            <div class="">
                <h1>{{item.name}}</h1>
                <p v-if="inStock">${{item.price}}</p>
                <p v-else :class="{ outOfStock: !inStock }">Out of Stock</p>
                <input
                    type="number"
                    min="1"
                    v-model="qty"
                    :max="item.quantity != -1 ? item.quantity : Infinity" />

                <button v-on:click="addToCart"
                :disabled="!inStock"
                :class="{ disabledButton: !inStock }">Add to Cart
                </button>
            </div>
        </div>

        <div class="product-image"></div>
        <div class="product-info"></div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "product",
    data() {
        return {
            item: null,
            qty: 1
        }
    },
    methods: {
        addToCart() {
            if (this.item) {
                this.$store.commit("cartSetItem", [this.item._id, Number(this.qty)]);
            }

            this.qty = 1;
        },
        // updateProduct(index) {
        //     this.selectedVariant = index
        // }
    },
    computed: {
        // title() {
        //     return this.product
        // },
        image() {
            if (!this.item)
                return (null);
            return this.item.media[0];
        },
        inStock() {
            if (!this.item)
                return (false);
            return (this.item.quantity > 0 || this.item.quantity == -1);
        },
        // shipping() {
        //     return this.shipping
        // }
    },
    mounted() {
        axios
            .get("/api/view/" + this.$route.params.id)
            .then(res => {
                this.item = res.data.item;
            })
            .catch(err => console.error(err));
    }
}
</script>
<style scoped>
#container {
    width: 100%;
    display: flex;
}

#container > div {
    width: 50%;
}

.preview {
    padding: 1em;
    display: flex;
    flex: 1;
    justify-content: center;
}
.preview img {
    max-width: 70%;
    max-height: 300px;
}
.color-box {
    width: 40px;
    height: 40px;
    margin-top: 5px;
}
.product-info {
    margin-top: 10px;
    width: 50%;
}
.disabledButton {
    background-color: #d8d8d8;
}
.outOfStock {
    text-decoration: line-through;
}
</style>
