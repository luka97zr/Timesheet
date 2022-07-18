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
                            <a class="alphabet__button" :class="{'alphabet__button--disabled' : !checkClientName(letter)}" href="javascript:;" @click.prevent="generateAlphabet(letter)" >{{letter}}</a>
                        </li>
                    </ul>
                </div>
                <client-accordion v-for="(client, index) in clientCopy" :key="index" :client-obj="client" ></client-accordion>
            </div>
            <div class="pagination" v-if="clientCopy.length>0">
                <ul class="pagination__navigation">
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;" @click.prevent="prevPage()">Previous</a>
                    </li>
                    <li class="pagination__list" v-for="(page, index) in numOfPages" :key="index">
                        <a class="pagination__button pagination__button--active" href="javascript:;">{{page}}</a>
                    </li>
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;" @click.prevent="nextPage()">Next</a>
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
            clientsAcc: [],
            perPage: 3,
            currentPage: 1,
            clientCopy: []
        }
    },
    created() {
        this.getClients();
    },
    computed: {
        getAlphabet() {
           return [...Array(26)].map((_,i) => String.fromCharCode(i + 65))
        },
        numOfPages() {
            return Math.ceil(this.clientsAcc.length / this.perPage);
        },
        startPage() {
            return (this.currentPage - 1) * this.perPage;
        },
        endPage() {
            return this.startPage + this.perPage;
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
                this.generateAlphabet(Object.keys(this.clients)[0]);
            }catch(error) {

            }
        },
        checkClientName(letter) {
            return Object.keys(this.clients).some(el => el === letter);
        },
        generateAlphabet(letter) {
            if(!this.clients[letter]) return;
            this.currentPage = 1;
            this.clientsAcc = Object.values(this.clients[letter])
            this.clientCopy = this.clientsAcc
            console.log(this.clientCopy)
            this.buildPage()
        },
        buildPage() {
            this.clientCopy = this.clientsAcc.slice(this.startPage, this.endPage);
        },
        nextPage() {
            if (this.currentPage >= this.numOfPages) return
            this.currentPage++;
            this.buildPage()
        },
        prevPage() {
            if (this.currentPage <= 1) return
            this.currentPage--;
            this.buildPage()
        },
    }
}
</script>

<style>

</style>