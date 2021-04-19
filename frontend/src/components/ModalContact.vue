<template>
    <div class="modal-backdrop">
        <div class="modal">
            <header class="modal-header">
                <h4 v-if="id === 0">Add Contact</h4>
                <h4 v-else>Edit Contact</h4>
                <button
                    type="button"
                    class="btn-close"
                    @click="close"
                >
                    x
                </button>
            </header>

            <section class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col">
                            <label for="contactType" class="form-label">Contact Type</label>
                            <select name="" class="form-select" id="contactType" v-model="contactType">
                                <option value="1">WhatsApp</option>
                                <option value="2">Telefone</option>
                                <option value="3">E-mail</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" id="contact" v-model="contact" class="form-control"
                                   placeholder="Contact" aria-label="Contact" v-mask="isEmail">
                        </div>
                    </div>
                </form>
            </section>

            <footer class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    @click="close"
                >
                    Close Modal
                </button>
                <button
                    type="button"
                    class="btn btn-success"
                    @click.prevent="handleContact"
                >
                    Save
                </button>
            </footer>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
import messages from "../utils/messages";

export default {
    name: 'ModalContact',

    data() {
        return {
            contactType: '',
            contact: '',
            personId: this.$route.params.id,
            response: {
                color: '',
                message: ''
            }
        }
    },

    props: {
        id: Number
    },

    computed: {
        isEmail() {
            return this.contactType === '3' ? null : '(##) #####-####';
        }
    },

    created() {
        if (this.id === 0) {
            this.unsetContact();
        } else {
            this.fetchContact(this.id);
        }
    },

    methods: {
        ...mapActions([
            "storeContacts",
            "showContact",
            "updateContact"
        ]),

        close() {
            this.unsetContact();
            this.$emit('close');
        },

        async fetchContact(id) {
            await this.showContact(id).then(response => {
                this.payloadContact(response);
            }).catch(e => {
                const errorCode = e?.response?.data?.error || 'ServerError';
                this.response.message = messages[errorCode];

                this.close();
            });
        },

        async handleContact() {
            const payload = {
                contact_type: this.contactType,
                contact: this.contact,
                person_id: this.personId
            }

            if (this.id === 0) {
                await this.storeContacts(payload).then(response => {
                    this.$vToastify.success('Contato cadastrado com sucesso.', 'Parabéns!');
                    this.close();
                }).catch(e => {
                    this.$vToastify.error('Verifique os campos novamente.', "Tivemos um problema!");
                    const errorCode = e?.response?.data?.error || 'ServerError';
                    this.response.message = messages[errorCode];
                });
            } else {
                payload.id = this.id;

                await this.updateContact(payload).then(response => {
                    this.$vToastify.success('Contato atualizado com sucesso.', 'Parabéns!');
                    this.close();
                }).catch(e => {
                    this.$vToastify.error('Verifique os campos novamente.', "Tivemos um problema!");
                    const errorCode = e?.response?.data?.error || 'ServerError';
                    this.response.message = messages[errorCode];
                });
            }
        },

        payloadContact(response) {
            this.contact = response.contact;
            this.contactType = response.contact_type;
            this.id = response.id;
        },

        unsetContact() {
            this.contact = '';
            this.contactType = '';
        }
    }
};
</script>


<style lang="css" scoped>
.modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal {
    background: #FFFFFF;
    box-shadow: 2px 2px 20px 1px;
    overflow-x: hidden;
    width: 40%;
    height: 50%;
    position: relative;
    display: flex;
    flex-direction: column;
}

.modal-header,
.modal-footer {
    padding: 15px;
    display: flex;
}

.modal-header {
    position: relative;
    border-bottom: 1px solid #eeeeee;
    color: #4AAE9B;
    justify-content: space-between;
}

.modal-footer {
    border-top: 1px solid #eeeeee;
    flex-direction: row;
    justify-content: space-between;
}

.modal-body {
    position: relative;
    padding: 20px 10px;
}

.btn-close {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    font-size: 20px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    color: #4AAE9B;
    background: transparent;
}

.btn-green {
    color: white;
    background: #4AAE9B;
    border: 1px solid #4AAE9B;
    border-radius: 2px;
}
</style>
