<template>
    <div class="accordion" @click="openAccordion()">
        <div class="accordion__intro">
            <h4 class="accordion__title">{{clientObj.name}}</h4>
        </div>
        <form class="accordion__content" action="javascript:;" :class="{'accorion-open' : isOpened}" @click="openAccordion()">
            <div class="info">
                <div class="info__form">
                    <ul class="info__wrapper">
                        <li class="info__list">
                            <label class="info__label">Client name:</label>
                            <input type="text" class="in-text" v-model="clientName">
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
                            <option :value="null">All</option>
                            <option :value="country.id" v-for="(country, index) in $store.state.countries" :key="index" >{{country.country}}</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn-wrap">
                <button type="submit" class="btn btn--green" @click="updateClient()"><span>Save changes</span></button>
                <button type="button" class="btn btn--red"><span>Delete</span></button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props:['clientObj'],
    data() {
        return {
            isOpened: false,
            countryId: this.clientObj.country.id,
            clientName: this.clientObj.name
        }
    },
    methods: {
        openAccordion() {
            this.isOpened = !this.isOpened
        },
        isSelected(country) {
            console.log(country);
        },
        async updateClient() {
            try {
                await axios.put(`/api/client/${this.clientObj.id}`,{
                    data: 'test',
                });
            }catch(error) {
                console.log(error)
            }
        }
    }
}
</script>

<style scoped>
.accorion-open {
    display: block;
}
</style>