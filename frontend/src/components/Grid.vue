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
                    <tr v-for="(person, index) in persons" :key="index">
                        <td>{{person.firstname}} {{person.lastname}}</td>
                        <td>{{person.address}}</td>
                        <td>{{person.created_at}}</td>
                        <td>
                            <a href="#" @click.prevent="goPerson(person)" class="p-2 text-warning"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" @click.prevent="modalDelete(person.id)" class="p-2 text-danger"><i class="fas fa-trash-alt"></i></a>
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
import messages from "../utils/messages";

export default {
    name: "Grid",

    mounted() {
        this.fetchPersons();
    },

    computed: {
        ...mapState({
            persons: state => state.persons.persons
        })
    },

    methods: {
        ...mapActions([
            "getPersons",
            "destroyPerson"
        ]),

        ...mapMutations({
            setPersons: 'SET_PERSONS'
        }),

        fetchPersons() {
            this.getPersons().catch(response => {
                console.log(response);
            });
        },

        goPerson(person) {
            this.setPersons(person);
            this.$router.push({name: 'person-edit', params: {id: person.id}});
        },

        modalDelete(id) {
            this.$swal({
                title: 'Você tem certeza?',
                text: "Você não pode reverter essa ação!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok, deletar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deletePerson(id);
                }
            });
        },

        async deletePerson(id) {
            await this.destroyPerson(id).then(response => {
                console.log(response);
                this.$vToastify.success('Pessoa deletada com sucesso.', 'Parabéns!');
                this.fetchPersons();
            }).catch((e) => {
                const errorCode = e?.response?.data?.error || 'ServerError';
                this.response.message = messages[errorCode];
                this.$vToastify.error(this.response.message, "Tivemos um problema!");
            });
        }
    }
}
</script>

<style scoped>

</style>
