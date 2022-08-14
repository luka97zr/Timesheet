<template>
    <div class="accordion" @click="openAccordion()">
        <div class="accordion__intro">
            <h4 class="accordion__title">{{clientObj.name}}</h4>
        </div>
        <form class="accordion__content" action="javascript:;" :class="{'accorion-open' : isOpened}" @click="openAccordion()">
            <div>
                <div class="info__form">
                    <ul class="info__wrapper">
                        <li class="info__list">
                            <label class="info__label">Client name:</label>
                            <input type="text" class="in-text" v-model="clientName">
                            <span v-if="errors && errors.name">{{errors.name[0]}}</span>
                        </li>
                        <li class="info__list">
                            <label class="report__label">Address:</label>
                            <input type="text" class="in-text">
                        </li>
                        <li class="info__list">
                            <label class="report__label">City:</label>
                            <input type="text" class="in-text">
                        </li>
                        <li class="info__list">
                            <label class="report__label">Zip/Postal code:</label>
                            <input type="text" class="in-text">
                        </li>
                        <li class="info__list">
                            <label class="report__label">Country:</label>
                            <select class="info__select" v-model="countryId">
                                <option :value="null" disabled>All</option>
                                <option :value="country.id" v-for="(country, index) in $store.state.countries" :key="index" >{{country.country}}</option>
                            </select>
                            <span v-if="errors && errors.country_id">{{errors.country_id[0]}}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn-wrap">
                <button type="submit" class="btn btn--green" @click.prevent="updateClient()" :disabled="isValidated"><span>Save changes</span></button>
                <button type="button" class="btn btn--red" @click="deleteModal = !deleteModal"><span>Delete</span></button>
            </div>
        </form>
    <ModalDelete v-if="deleteModal" :isOpen="deleteModal" @delete="deleteClient()"/>
    </div>
</template>

<script>
import isValidatedClientMixin from '../../mixins/isValidatedMixin'
export default {
    props:['clientObj'],
    data() {
        return {
            isOpened: false,
            countryId: null,
            clientName: null,
            deleteModal: false,
            errors: null
        }
    },
    methods: {
        openAccordion() {
            this.isOpened = !this.isOpened;
        },
        showName() {
            this.clientName = this.clientObj.name;
        },
        showCountry() {
            this.countryId = this.clientObj.country.id;
        },
        async updateClient() {
            try {
                await axios.put(`/api/client/${this.clientObj.id}`,{
                    country_id: this.countryId,
                    name: this.clientName
                });
                this.$emit('resend');
                this.$emit('updated');
                this.openAccordion();
            }catch(error) {
                this.errors = error.response.data.errors;
            }
        },
        async deleteClient() {
            try {
                await axios.delete(`/api/client/${this.clientObj.id}`);
                this.$emit('resend');
                this.deleteModal = false;
            } catch(error) {
                this.errors = error.response.data.errors;
            }
        },
        confirmationModal() {
            this.deleteModal = !this.deleteModal;
        }
    },
    mixins: [isValidatedClientMixin],
    watch: {
        clientObj: {
            handler() {
                this.showName();
                this.showCountry();
            },
            immediate: true
        }
    }
}
</script>

<style lang="scss">
.accorion-open {
    display: block;
}
</style>