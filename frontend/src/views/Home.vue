<template>
    <div>
        <default-template/>
        <div class="container mt-5">
            <grid />
        </div>
    </div>
</template>

<script>
import DefaultTemplate from "../layouts/DefaultTemplate";
import Grid from "../components/Grid";

export default {
    name: 'Home',
    components: {
        DefaultTemplate,
        Grid
    }
}
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css');
</style>
