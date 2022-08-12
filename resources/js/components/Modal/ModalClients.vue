<template>
    <Modal :showModal="showModal">
        <div class="modal__content">
            <h2 class="heading">Create new client</h2>
            <a href="javascript:;" class="modal__close" @click.prevent="$emit('closeModal')">
            <span class="modal__icon"></span>
            </a>
            <form class="info" :class="{'was-validated' : isValidated}" action="javascript:;">
                <ul class="info__form">
                    <li class="info__list">
                        <label class="info__label">Client name:</label>
                        <input type="text" class="in-text" v-model="clientName" required>
                        <input-error v-if="errors.name" :message="errors.name[0]"></input-error>
                    </li>
                    <li class="info__list">
                        <label class="report__label">Address:</label>
                        <input type="text" class="in-text" v-model="address">
                    </li>
                    <li class="info__list">
                        <label class="report__label">City:</label>
                        <input type="text" class="in-text" v-model="city">
                    </li>
                    <li class="info__list">
                        <label class="report__label">Zip/Postal code:</label>
                        <input type="text" class="in-text" v-model="postalCode">
                    </li>
                    <li class="info__list">
                        <label class="report__label">Country:</label>
                        <select class="info__select" v-model="countryId" required>
                            <option :value="null" disabled>Select Country</option>
                            <option :value="country.id" v-for="(country, index) in $store.state.countries" :key="index">{{country.country}}</option>
                        </select>
                        <input-error v-if="errors.country_id" :message="errors.country_id[0]"></input-error>
                    </li>
                </ul>
                <div class="btn-wrap">
                    <button type="submit" class="btn btn--green" @click.prevent="createClient()"><span>Save changes</span></button>
                    <button type="button" class="btn btn--red" @click.prevent="clearForm()"><span>Delete</span></button>
                </div>
            </form>
        </div>
    </Modal>
</template>

<script>
import InputError from '../Bootstrap/InputError.vue';
export default {
  components: { InputError },
    props: ['showModal'],
    data() {
        return {
            countryId: null,
            postalCode: '',
            city: '',
            address: '',
            clientName: '',
            errors : [],
            isValidated: false
        }
    },
    created() {
    },
    methods: {
        closeModal() {
            this.$emit('closeModal')
        },
        async createClient() {
          try {
            this.errors = [];
            await axios.post('/api/client', {
                country_id: this.countryId,
                name: this.clientName
            })
            this.$emit('closeModal')
            this.$emit('resend');
            this.clearForm();
            this.$emit('success')
          } catch(error) {
            this.isValidated = true;
            this.errors = error.response.data.errors
          }
        },
        clearForm() {
            this.clientName=this.countryId=null
        }
    }

}
</script>

