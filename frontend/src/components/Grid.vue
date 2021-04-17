<template>
    <div>
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2><b>Person Details</b></h2></div>
                    </div>
                </div>

                <div v-if="persons.length === 0">
                    <div class="alert alert-warning" role="alert">
                        No person registered.
                    </div>
                </div>


                <table class="table table-bordered" v-if="persons.length > 0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(person, index) in persons" :key="index" @click.prevent="goPerson(person)">
                        <td>{{person.firstname}} {{person.lastname}}</td>
                        <td>{{person.address}}</td>
                        <td>{{person.created_at}}</td>
                        <td>
                            <a href="#" @click.prevent="goPerson(person)" class="p-2 text-warning"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" class="p-2 text-danger"><i class="fas fa-trash-alt"></i></a>
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

        goPerson(person) {
            this.setPersons(person);
            this.$router.push({name: 'person', params: {id: person.id}});
        }
    }
}
</script>

<style scoped>

</style>
