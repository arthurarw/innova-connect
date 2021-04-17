<template>
    <div>
        <div class="container mt-5">

            <div
                v-if="response.message"
                :class="`alert ${response.color}`"
            >
                {{ response.message }}
            </div>


            <div v-if="!response.message">
                <div style="margin-bottom: 80px">
                    <h4>
                        {{ persons.firstname }} {{ persons.lastname }} Information
                    </h4>
                    <div class="row">
                        <div class="col">
                            <label for="firstname" class="form-label">First name</label>
                            <input type="text" id="firstname" class="form-control" v-model="firstname"
                                   placeholder="First name" aria-label="First name">
                        </div>
                        <div class="col">
                            <label for="lastname" class="form-label">Last name</label>
                            <input type="text" id="lastname" v-model="lastname" class="form-control"
                                   placeholder="Last name"
                                   aria-label="Last name">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="firstname" class="form-label">Zipcode</label>
                            <input type="text" id="zipcode" class="form-control" v-model="zipcode"
                                   placeholder="Zipcode" aria-label="Zipcode" v-mask="'#####-###'">
                        </div>
                        <div class="col">
                            <label for="lastname" class="form-label">Address Street</label>
                            <input type="text" id="adsStreet" v-model="adsStreet" class="form-control"
                                   placeholder="Address Street" aria-label="Address Street">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="firstname" class="form-label">Address Number</label>
                            <input type="text" id="adsNumber" class="form-control" v-model="adsNumber"
                                   placeholder="Address Number" aria-label="Address Number">
                        </div>
                        <div class="col">
                            <label for="lastname" class="form-label">Address Neighborhood</label>
                            <input type="text" id="adsNeighborhood" v-model="adsNeighborhood" class="form-control"
                                   placeholder="Address Neighborhood" aria-label="Address Neighborhood">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="firstname" class="form-label">Address City</label>
                            <input type="text" id="adsCity" class="form-control" v-model="adsCity"
                                   placeholder="Address City" aria-label="Address City">
                        </div>
                        <div class="col">
                            <label for="lastname" class="form-label">Address State</label>
                            <input type="text" id="adsState" v-model="adsState" class="form-control"
                                   placeholder="Address State" aria-label="Address State">
                        </div>
                    </div>

                    <div class="float-end mt-2">
                        <button @click.prevent="updateUser" type="button" class="btn btn-primary"><i
                            class="far fa-save"></i>
                            Save
                        </button>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row mb-2">
                        <div class="col">
                            <h4>
                                Contacts
                            </h4>
                        </div>
                        <div class="col offset-9" style="margin-right: -5px">
                            <button type="button" class="btn btn-success" @click.prevent="openModalContact">
                                <i class="fas fa-plus-circle"></i> Add Contact
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-wrapper">
                            <div v-if="!hasContact">
                                <div class="alert alert-warning" role="alert">
                                    No contacts registered.
                                </div>
                            </div>

                            <table class="table table-bordered" v-if="hasContact">
                                <thead>
                                <tr>
                                    <th>Contact Type</th>
                                    <th>Contact</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(contact, index) in persons.contacts" :key="index">
                                    <td>{{ contact.contact_type }}</td>
                                    <td>{{ contact.contact }}</td>
                                    <td>{{ contact.created_at }}</td>
                                    <td>
                                        <a href="#" class="p-2 text-warning"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="p-2 text-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" @click.prevent="goIndex"><i
                class="fas fa-arrow-left"></i> Back
            </button>
        </div>


        <modal-contact v-if="showModalContact" @close="closeModalContact"/>

    </div>
</template>

<script>
import {mapActions, mapState, mapMutations} from 'vuex';
import ModalContact from "../components/ModalContact";
import messages from '../utils/messages';

export default {
    name: "Person",

    components: {
        ModalContact
    },

    data() {
        return {
            firstname: '',
            lastname: '',
            zipcode: '',
            adsStreet: '',
            adsNumber: '',
            adsNeighborhood: '',
            adsCity: '',
            adsState: '',
            response: {
                color: '',
                message: ''
            },
            showModalContact: false
        }
    },


    computed: {
        ...mapState({
            persons: state => state.persons.persons
        }),

        hasContact() {
            return this.persons?.contacts?.length > 0;
        }
    },

    async created() {
        await this.fetchUser();
        this.payloadUser();
    },

    methods: {
        ...mapActions([
            "showPerson",
            "updatePerson"
        ]),
        ...mapMutations({
            setPersons: 'SET_PERSONS'
        }),

        async fetchUser() {
            await this.showPerson(this.$route.params.id).catch((e) => {
                const errorCode = e?.response?.data?.error || 'ServerError';
                this.response.message = messages[errorCode];
                this.$vToastify.error(this.response.message, "Tivemos um problema!");
            });
        },

        async updateUser() {
            const payload = {
                firstname: this.firstname,
                lastname: this.lastname,
                ads_zipcode: this.zipcode,
                ads_street: this.adsStreet,
                ads_number: this.adsNumber,
                ads_neighborhood: this.adsNeighborhood,
                ads_city: this.adsCity,
                ads_state: this.adsState,
                person_id: this.persons.id
            }

            await this.updatePerson(payload).then(response => {
                this.$vToastify.success('Pessoa atualizada com sucesso.', 'Parabéns!');
                this.fetchUser();
            }).catch((e) => {
                const errorCode = e?.response?.data?.error || 'ServerError';
                this.response.message = messages[errorCode];
                this.$vToastify.error(this.response.message, "Tivemos um problema!");
            });
        },

        payloadUser() {
            this.firstname = this.persons.firstname;
            this.lastname = this.persons.lastname;
            this.zipcode = this.persons.ads_zipcode;
            this.adsStreet = this.persons.ads_street;
            this.adsNumber = this.persons.ads_number;
            this.adsNeighborhood = this.persons.ads_neighborhood;
            this.adsState = this.persons.ads_state;
            this.adsCity = this.persons.ads_city;
        },

        openModalContact() {
            this.showModalContact = true;
        },

        closeModalContact() {
            this.showModalContact = false;
            this.fetchUser();
        },

        goIndex() {
            this.$router.push({name: 'index'});
        }
    },
}
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css');
</style>
