<template>
  <div class="wrapper">
        <section class="content">
            <div class="main-content">
                <h2 class="main-content__title">Clients</h2>
                <div class="table-navigation">
                    <a href="javascript:;" class="table-navigation__create btn-modal" @click.prevent="openModal()"><span>Create new client</span></a>
                    <form class="table-navigation__input-container" action="javascript:;">
                        <input type="text" class="table-navigation__search">
                        <button type="submit" class="icon__search"></button>
                    </form>
                </div>
                <div class="alphabet">
                    <ul class="alphabet__navigation">
                        <li class="alphabet__list" v-for="(letter,index) in getAlphabet" :key="index">
                            <a class="alphabet__button" :class="{'alphabet__button--disabled' : !checkClientName(letter)}" href="javascript:;" @click.prevent="generatePagination(letter)">{{letter}}</a>
                        </li>
                    </ul>
                </div>
                <client-accordion v-for="(client, index) in clientsAcc" :key="index" :client-obj="client"></client-accordion>
            </div>
            <div class="pagination">
                <ul class="pagination__navigation">
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;">Previous</a>
                    </li>
                    <li class="pagination__list">
                        <a class="pagination__button pagination__button--active" href="javascript:;">1</a>
                    </li>
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;">2</a>
                    </li>
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;">3</a>
                    </li>
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;">4</a>
                    </li>
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;">Next</a>
                    </li>
                </ul>
            </div>
        </section>
        <modal-clients
            :showModal="showNewModal"
            @closed="this.showNewModal = false"
            @closeModal="closeModal()"
        >
        </modal-clients>
    </div>
</template>

<script>
import ModalClients from '../../components/Modal/ModalClients.vue'
import ClientAccordion from './ClientAccordion.vue'
export default {
    components: {
        ModalClients,
        ClientAccordion
    },
    data() {
        return {
            showNewModal: false,
            clients: {},
            clientsAcc: []
        }
    },
    created() {
        this.getClients();
    },
    computed: {
        getAlphabet() {
           return [...Array(26)].map((_,i) => String.fromCharCode(i + 65))
        }
    },
    methods: {
        openModal() {
            this.showNewModal = true;
        },
        closeModal() {
            this.showNewModal = false
        },
        async getClients() {
            try {
                const data = await axios.get('/api/client');
                this.clients = data.data;
            }catch(error) {

            }
        },
        checkClientName(letter) {
            return Object.keys(this.clients).some(el => el === letter);
        },
        generatePagination(letter) {
            if(!letter) return
            this.clientsAcc = Object.values(this.clients[letter])
        }
    }
}
</script>

<style>

</style>