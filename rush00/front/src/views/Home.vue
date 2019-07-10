<template>
    <div class="content">
        <ProductsTab :categories="categories" />
    </div>
</template>

<script>
// @ is an alias to /src
import ProductsTab from "@/components/ProductsTab.vue";
import axios from "axios";

export default {
    name: "home",
    components: {
        ProductsTab
    },
    data() {
        return {
            categories: {}
        };
    },
    mounted() {
        axios
            .get("/api/view")
            .then(res => {
                for (const item of res.data.items) {
                    for (const cat of item.categories) {
                        if (!(cat in this.categories))
                            this.categories[cat] = [];
                        this.categories[cat].push(item);
                    }
                }
                console.log(this.categories);
            })
            .catch(err => console.error(err));
    }
};
</script>

<style scoped>
.content {
    padding: 3em 2em;
}
</style>
