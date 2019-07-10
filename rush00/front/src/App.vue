<template>
    <div id="app">
        <HeaderBar></HeaderBar>
        <div class="container">
            <router-view />
        </div>
        <Footer />
    </div>
</template>

<script>
import HeaderBar from "./components/HeaderBar";
import Footer from "./components/Footer";

export default {
    components: {
        HeaderBar,
        Footer
    }
};
</script>

<style>
* {
    box-sizing: border-box;
}

html,
body {
    margin: 0;
    padding: 0;
}

#app {
    font-family: Georgia, "Times New Roman", Times, serif;
    color: #232323;
}

.container {
    margin: 0 auto;
    max-width: 1200px;
}

.d-1 {
    width: calc(100% / 12);
}

.d-2 {
    width: calc(100% / 12 * 2);
}

.d-3 {
    width: calc(100% / 12 * 3);
}

.d-4 {
    width: calc(100% / 12 * 4);
}

.d-5 {
    width: calc(100% / 12 * 5);
}

.d-6 {
    width: calc(100% / 12 * 6);
}

.d-7 {
    width: calc(100% / 12 * 7);
}

.d-8 {
    width: calc(100% / 12 * 8);
}

.d-9 {
    width: calc(100% / 12 * 9);
}

.d-10 {
    width: calc(100% / 12 * 10);
}

.d-11 {
    width: calc(100% / 12 * 11);
}

.d-12 {
    width: 100%;
}
</style>
