<template>
    <router-link :to="`/view/${id}`" class="card d-4">
        <img :src="this.source" :alt="this.name" />
        <div class="card-name">{{ this.name }}</div>
    </router-link>
</template>
<script>
export default {
    name: "Card",
    props: {
        name: {
            type: String,
            required: true
        },
        source: {
            type: String,
            required: true
        },
        id: {
            type: String,
            required: true
        }
    }
};
</script>
<style scoped>
.card {
    box-sizing: content-box;
    display: inline-block;
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-radius: 5px;
    margin: 0.5em;
    text-decoration: none;
}
.card img {
    max-height: 100%;
    max-width: 100%;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}
.card-name {
    padding: 0.75em 1em;
    font-size: 12pt;
    color: #232323;
}
</style>
