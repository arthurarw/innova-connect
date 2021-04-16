<template>
    <div class="preloader" v-if="preloader">
        <img src="@/assets/imgs/preloader.gif" alt="Carregando...">
        <p>{{ textPreloader }}</p>
    </div>
</template>

<script>
import {mapState, mapMutations} from 'vuex';
export default {
    computed: {
        ...mapState({
            preloader: state => state.preloader,
            textPreloader: state => state.textPreloader
        }),
    }
}
</script>

<style scoped>
.preloader p {
    color: #acabab;
}
</style>