<template>
    <div>
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2><b>Person Details</b></h2></div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(person, index) in persons" :key="index">
                        <td>{{person.firstname}} {{person.lastname}}</td>
                        <td>{{person.address}}</td>
                        <td>{{person.created_at}}</td>
                        <td>
                            <a href="#" class="p-2"><i class="fas fa-user-edit"></i></a>
                            <a href="#" class="p-2"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapState, mapMutations} from 'vuex';

export default {
    name: "Grid",

    mounted() {
        this.getPersons().catch(response => {
            console.log(response);
        });
    },

    computed: {
        ...mapState({
            persons: state => state.persons.persons
        })
    },

    methods: {
        ...mapActions([
            "getPersons"
        ]),
        ...mapMutations({
            setPersons: 'SET_PERSONS'
        }),
    }
}
</script>

<style scoped>

</style>
