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
                    <h4 v-if="">
                        {{ persons.firstname }} {{ persons.lastname }} Information
                    </h4>
                    <ValidationObserver
                        ref="registerForm"
                        tag="form"
                        @submit.stop.prevent="handleUser()"
                    >
                        <div class="row">
                            <ValidationProvider v-slot="{errors}" rules="required" name="First name">
                                <div class="col">
                                    <label for="firstname" class="form-label">First name</label>
                                    <input type="text" id="firstname" class="form-control" v-model="firstname"
                                           placeholder="First name" aria-label="First name">
                                </div>
                                <div v-if="!!errors[0]" class="text-danger">
                                    {{ errors[0] }}
                                </div>
                            </ValidationProvider>
                            <ValidationProvider v-slot="{errors}" rules="required" name="First name">
                                <div class="col">
                                    <label for="lastname" class="form-label">Last name</label>
                                    <input type="text" id="lastname" v-model="lastname" class="form-control"
                                           placeholder="Last name"
                                           aria-label="Last name">
                                </div>
                                <div v-if="!!errors[0]" class="text-danger">
                                    {{ errors[0] }}
                                </div>
                            </ValidationProvider>

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
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-save"></i> Save
                            </button>
                        </div>
                    </ValidationObserver>
                </div>


                <div class="mt-5" v-if="persons.id">
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
                                    <td>{{ contactType(contact.contact_type) }}</td>
                                    <td>{{ contact.contact }}</td>
                                    <td>{{ contact.created_at }}</td>
                                    <td>
                                        <a href="#" class="p-2 text-warning"
                                           @click.prevent="modalEditContact(contact.id)"><i
                                            class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="p-2 text-danger" @click.prevent="modalDelete(contact.id)"><i
                                            class="fas fa-trash-alt"></i></a>
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

        <modal-contact v-if="showModalContact" @close="closeModalContact" :id="contactId"/>
    </div>
</template>

<script>
import {mapActions, mapMutations, mapState} from 'vuex';
import ModalContact from "../components/ModalContact";
import messages from '../utils/messages';
import {ValidationObserver, ValidationProvider} from 'vee-validate';

export default {
    name: "FormPerson",

    components: {
        ModalContact,
        ValidationProvider,
        ValidationObserver
    },


    props: {
        person: Object
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
            showModalContact: false,
            editing: false,
            contactId: 0,
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
        if ("id" in this.$route.params) {
            if (this.$route.params.id === 'create') {
                this.unsetUser();
                this.editing = false;
            } else {
                await this.fetchUser();
                await this.payloadUser();
                this.editing = true;
            }
        }
    },

    methods: {
        ...mapActions([
            "showPerson",
            "updatePerson",
            "storePerson",
            "destroyContact"
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

        async handleUser() {
            const validator = await this.$refs.registerForm.validate();
            if (!validator) {
                return;
            }

            this.resetResponse();

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

            if (!payload.person_id) {
                await this.storePerson(payload).then(response => {
                    this.$vToastify.success('Pessoa cadastrada com sucesso.', 'Parabéns!');
                    this.$refs.registerForm.reset();
                    this.unsetUser();
                }).catch((e) => {
                    const errorCode = e?.response?.data?.error || 'ServerError';
                    this.response.message = messages[errorCode];
                    this.$vToastify.error(this.response.message, "Tivemos um problema!");
                });
            } else {
                await this.updatePerson(payload).then(response => {
                    this.$vToastify.success('Pessoa atualizada com sucesso.', 'Parabéns!');
                    this.fetchUser();
                }).catch((e) => {
                    const errorCode = e?.response?.data?.error || 'ServerError';
                    this.response.message = messages[errorCode];
                    this.$vToastify.error(this.response.message, "Tivemos um problema!");
                });
            }

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

        unsetUser() {
            this.firstname = '';
            this.lastname = '';
            this.zipcode = '';
            this.adsStreet = '';
            this.adsNumber = '';
            this.adsNeighborhood = '';
            this.adsState = '';
            this.adsCity = '';
            this.$refs.registerForm.reset();
        },

        resetResponse() {
            this.response.color = '';
            this.response.message = '';
        },

        openModalContact() {
            this.showModalContact = true;
        },

        closeModalContact() {
            this.showModalContact = false;
            this.contactId = 0;
            this.fetchUser();
        },

        goIndex() {
            this.$router.push({name: 'index'});
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
                    this.deleteContact(id);
                }
            });
        },

        async deleteContact(id) {
            await this.destroyContact(id).then(response => {
                this.$vToastify.success('Contato deletado com sucesso.', 'Parabéns!');
                this.fetchUser();
            }).catch((e) => {
                const errorCode = e?.response?.data?.error || 'ServerError';
                this.response.message = messages[errorCode];
                this.$vToastify.error(this.response.message, "Tivemos um problema!");
            });
        },

        modalEditContact(id) {
            this.contactId = id;
            this.showModalContact = true;
        },

        contactType(id) {
            let contactsType = {
                1: 'WhatsApp',
                2: 'Telefone',
                3: 'E-mail'
            }

            return contactsType[id];
        }
    },

    watch: {
        '$route': 'unsetUser'
    }
}
</script>

<style scoped>

</style>
