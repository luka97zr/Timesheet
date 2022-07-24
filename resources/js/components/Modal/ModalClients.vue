<template>
    <Modal :showModal="showModal">
        <div class="modal__content">
            <h2 class="heading">Create new client</h2>
            <a href="javascript:;" class="modal__close" @click.prevent="$emit('closeModal')">
            <span class="modal__icon"></span>
            </a>
            <form class="info" action="javascript:;">
                <ul class="info__form">
                    <li class="info__list">
                        <label class="info__label">Client name:</label>
                        <input type="text" class="in-text" v-model="clientName">
                        <div v-if="errors.name" class="invalid-feedback">{{errors.name[0]}}</div>
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
                        <select class="info__select" v-model="countryId">
                            <option :value="null">All</option>
                            <option :value="country.id" v-for="(country, index) in $store.state.countries" :key="index">{{country.country}}</option>
                        </select>
                        <div v-if="errors.country_id" class="invalid-feedback">{{errors.country_id[0]}}</div>
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
export default {
    props: ['showModal'],
    data() {
        return {
            countryId: null,
            postalCode: '',
            city: '',
            address: '',
            clientName: '',
            errors : []
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
          } catch(error) {
              this.errors = error.response.data.errors
          }
        },
        clearForm() {
            this.clientName=this.countryId=null
        }
    }

}
</script>

<style>
.invalid-feedback {
    color: red;
}
</style>