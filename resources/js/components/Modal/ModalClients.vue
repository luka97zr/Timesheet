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
                    </li>
                </ul>
                <div class="btn-wrap">
                    <button type="submit" class="btn btn--green"><span>Save changes</span></button>
                    <button type="button" class="btn btn--red"><span>Delete</span></button>
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
            clientName: ''
        }
    },
    created() {
    },
    methods: {
        closeModal() {
            this.$emit('closeModal')
        },
    }

}
</script>

<style>

</style>