<template>
    <Layout/>
    <div class="container mx-auto">
        <router-view/>
    </div>
</template>
<script>
import Layout from "./Layout/Layout.vue";

export default {
    components: {Layout},
}
</script>
