<template>
    <div>
        <div>
            <div
                class="tab"
                :class="{ activeTab: selectedTab === category }"
                v-for="(category, index) in Object.keys(categories)"
                :key="index"
                @click="selectedTab = category"
            >
                {{ category }}
            </div>
        </div>
        <div v-for="(category, index) in Object.keys(categories)" :key="index">
            <Card
                v-show="selectedTab === category || selectedTab === 'all'"
                v-for="item in categories[category]"
                :key="item._id"
                :source="item.media[0]"
                :name="item.name"
                :id="item._id"
            />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Card from "./Card";

export default {
    name: "ProductsTab",
    components: {
        Card
    },
    data() {
        return {
            categories: { all: [] },
            selectedTab: "all"
        };
    },
    mounted() {
        axios
            .get("/api/view")
            .then(res => {
                console.log("Before", this.categories);
                for (const item of res.data.items) {
                    for (const cat of item.categories) {
                        if (!(cat in this.categories))
                            this.$set(this.categories, cat, []);
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
.tab {
    display: inline-block;
    margin: 0 0.25em;
    cursor: pointer;
    font-size: 14pt;
    font-weight: 300;
    text-transform: capitalize;
}
.activeTab {
    color: #16c0b0;
    text-decoration: underline;
}
</style>
