<template>
    <form-person v-if="!existPerson" />
    <form-person v-else :person="person" />
</template>

<script>
import {mapState} from 'vuex';
import FormPerson from "../components/FormPerson";

export default {
    name: "Person",

    components: {
        FormPerson
    },

    data() {
        return {
            person: this.persons
        };
    },

    computed: {
        ...mapState({
            persons: state => state.persons.persons
        }),
    },

    methods: {
        existPerson() {
            return this.person;
        }
    }

}
</script>
