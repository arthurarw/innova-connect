<template>
    <div>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <RouterLink :to="{name: 'index'}" class="navbar-brand">
                    Innova Connect
                </RouterLink>
                <div class="d-flex">
                    <button @click.prevent="createPerson" type="button" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add Person</button>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import {mapActions, mapState, mapMutations} from 'vuex';

export default {

    methods: {
        ...mapMutations({
            setPersons: 'SET_PERSONS'
        }),

        createPerson() {
            this.setPersons(Object.assign({}));
            this.$router.push({name: 'person-create'});
        }
    }
}
</script>
