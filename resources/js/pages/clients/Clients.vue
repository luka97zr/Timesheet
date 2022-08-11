<template>
  <div class="wrapper">
        <section class="content">
            <div class="main-content">
                <h2 class="main-content__title">Clients</h2>
                <div class="table-navigation">
                    <a href="javascript:;" class="table-navigation__create btn-modal" @click.prevent="openModal()"><span>Create new client</span></a>
                    <form class="table-navigation__input-container" action="javascript:;">
                        <input type="text" class="table-navigation__search" v-model="search">
                        <button type="submit" class="icon__search"></button>
                    </form>
                </div>
                <div class="alphabet">
                    <ul class="alphabet__navigation">
                        <li class="alphabet__list" v-for="(letter,index) in getAlphabet" :key="index">
                            <a class="alphabet__button" :class="{'alphabet__button--disabled' : !checkClientName(letter)}" href="javascript:;" @click.prevent="searchClients(letter)" >{{letter}}</a>
                        </li>
                    </ul>
                </div>
                <client-accordion v-for="(client, index) in clients" :key="index" :client-obj="client" @resend="refreshData()" @updated="clientUpdatedSuccessfuly()"></client-accordion>
                    <alert :isSuccess="isSuccess"></alert>
            </div>
            <div class="pagination" v-if="clients.length>0">
                <ul class="pagination__navigation">
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;" @click.prevent="prevPage()">Previous</a>
                    </li>
                    <li class="pagination__list" v-for="(page, index) in numOfPages" :key="index">
                        <a class="pagination__button pagination__button--active" href="javascript:;" @click.prevent="goToPage(page)">{{page}}</a>
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
            @resend="refreshData()"
        >
        </modal-clients>
        <v-overlay value="overlay" v-if="!isLoaded">
            <v-progress-circular
                indeterminate
                size="64"
            ></v-progress-circular>
        </v-overlay>
    </div>
</template>

<script>
import ModalClients from '../../components/Modal/ModalClients.vue'
import ClientAccordion from './ClientAccordion.vue'
import Alert from '../../components/vuetify/Alert.vue'
export default {
    components: {
        ModalClients,
        ClientAccordion,
        Alert,
    },
    data() {
        return {
            clientsAlphabet: [],
            clientKey: null,
            checkAlphabet: false,
            numOfPages: null,
            showNewModal: false,
            clients: {},
            currentPage: 1,
            isLoaded: true,
            isSuccess: false,
            search: '',
            typingTimer: null
        }
    },
    created() {
        if(this.$store.state.clientsAlphabet.length <= 0)
        this.getClientsAlphabet();
        this.getClients();


    },
    computed: {
        getAlphabet() {
           return [...Array(26)].map((_,i) => String.fromCharCode(i + 65))
        },
    },
    methods: {
        openModal() {
            this.showNewModal = true;
        },
        closeModal() {
            this.showNewModal = false
        },
        checkClientName(letter) {
            return (this.$store.state.clientsAlphabet.includes(letter))? true : false;
        },
        nextPage() {
            if (this.currentPage >= this.numOfPages) return
            this.currentPage++;
            this.getClients();
        },
        prevPage() {
            if (this.currentPage <= 1) return
            this.currentPage--;
            this.getClients();
        },
        clientUpdatedSuccessfuly() {
            this.isSuccess = true;
            setTimeout(() => {
                this.isSuccess = false;
            }, 2000);
        },
        timeout(ms) {
            return new Promise((resolve)=> {
                clearTimeout(this.typingTimer);
                return this.typingTimer = setTimeout(()=> resolve(true), ms);
            })
        },
        goToPage(page) {
            this.currentPage = page;
            this.getClients();
        },
        refreshData() {
            this.getClientsAlphabet();
            this.getClients();
        },
        async getClientsAlphabet() {
            try {
                this.isLoaded = false
                this.clientsAlphabet = ( await axios.get(`/api/client/alphabet`)).data;
                this.isLoaded = true
                this.$store.commit('setClientsAlphabet', this.clientsAlphabet)
            }catch(error) {
                console.log(error)
            }
        },
        async getClients() {
            try {
                this.isLoaded = false
                const data =(await axios.get(`/api/client/?page=${this.currentPage}`)).data;
                this.clients = data.data;
                this.isLoaded = true
                this.numOfPages = data.meta.last_page;
            }catch(error) {
                console.log(error)
            }
        },
        async searchClients(term) {
            try {
                this.currentPage = 1;
                await this.timeout(500);
                this.isLoaded = false
                const data =(await axios.get(`/api/client/${term}?page=${this.currentPage}`)).data;
                this.clients = data.data;
                this.isLoaded = true;
                this.numOfPages = data.meta.last_page;
            }catch(error) {
                console.log(error)
            }
        }
    },
    watch: {
        search: {
            handler() {
               this.searchClients(this.search)
            }
        },
    }
}
</script>

<style lang='scss'>
.alphabet__button {
    color: #f1592a !important;
    &--disabled {
        color: #ececec !important;
    }
}
</style>