<template>
  <div class="wrapper">
    <section class="content">
        <div class="main-content">
            <h2 class="main-content__title">Project</h2>
            <div class="table-navigation">
                <a href="javascript:;" class="table-navigation__create btn-modal" @click.prevent="openModal()"><span>Create new project</span></a>
                <form class="table-navigation__input-container" action="javascript:;">
                    <input type="text" class="table-navigation__search" v-model="search">
                    <button type="submit" class="icon__search"></button>
                </form>
            </div>
            <div class="alphabet">
                <ul class="alphabet__navigation">
                    <li class="alphabet__list" v-for="(letter,index) in getAlphabet" :key="index">
                        <a class="alphabet__button" :class="{'alphabet__button--disabled' : !checkProjectName(letter)}" href="javascript:;" @click.prevent="getProjects(letter)" >{{letter}}</a>
                    </li>
                </ul>
            </div>
            <project-accordion v-for="(project, index) in projects" :key="index" :project="project" @resend="getProjectsAlphabet()"></project-accordion>
            <vuetify-container>
                <alert :isSuccess="isSuccess"></alert>
            </vuetify-container>
        </div>
        <div class="pagination"  v-if="projects.length>0">
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
    <modal-project
        :showModal="showNewModal"
        @closeModal="closeModal()"
        @resend="getProjectsAlphabet()">
    </modal-project>
    <v-overlay value="overlay" v-if="!isLoaded">
        <v-progress-circular
            indeterminate
            size="64"
        ></v-progress-circular>
    </v-overlay>
</div>
</template>

<script>
import ModalProject from '../../components/Modal/ModalProjects.vue';
import ProjectAccordion from './ProjectAccordion.vue';
import Alert from '../../components/vuetify/Alert.vue'
export default {
       components: {
        ModalProject,
        ProjectAccordion,
        Alert
    },
     data() {
        return {
            showNewModal: false,
            projectsAlphabet: null,
            projectKey: null,
            projects: [],
            numOfPages: null,
            isLoaded: true,
            currentPage: 1,
            isSuccess: false,
            search: '',
            typingTimer: null
        }
    },
    created() {
         if(this.$store.state.projectsAlphabet.length <= 0) this.getProjectsAlphabet();
        this.checkClients();
        this.checkLeads();
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
        checkProjectName(letter) {
             return (this.$store.state.projectsAlphabet.includes(letter))? true : false;
        },
        nextPage() {
            if (this.currentPage >= this.numOfPages) return
            this.currentPage++;
        },
        prevPage() {
            if (this.currentPage <= 1) return
            this.currentPage--;
        },
        goToPage(page) {
            this.currentPage = page;
        },
        checkClients() {
            if(this.$store.state.clients.length <= 0)
            this.$store.dispatch('getClients');
        },
        checkLeads() {
            if(this.$store.state.leads.length <= 0)
            this.$store.dispatch('getLeads');
        },
        timeout(ms) {
            return new Promise((resolve)=> {
                clearTimeout(this.typingTimer);
                return this.typingTimer = setTimeout(()=> resolve(true), ms);
            })
        },
        async getProjectsAlphabet() {
            try {
                this.isLoaded = false
                this.projectsAlphabet = ( await axios.get(`/api/project`)).data;
                this.isLoaded = true
                this.$store.commit('setProjectsAlphabet', this.projectsAlphabet)
            }catch(error) {

            }
        },
        async getProjects(letter) {
            try {
                this.isLoaded = false
                this.projectKey = letter;
                const data = (await axios.get(`/api/project/${letter}?page=${this.currentPage}`)).data;
                this.isLoaded = true
                this.projects = data.data;
                this.numOfPages = data.meta.last_page;
            }catch(error) {

            }
        },
        async searchProjects() {
            try {
                if (this.search.length>0) {
                    await this.timeout(500);
                    const data = await axios.get(`/api/project/${this.search}`);
                    this.projectsAcc = data.data.data;
                   this.buildPage()
                } else {
                    await this.timeout(200);
                    this.generateAlphabet(Object.keys(this.$store.state.projects)[0]);
                }
            }catch(error) {

            }
        }
    },
    watch: {
        search: {
            handler() {
               this.searchProjects()
            }
        },
        currentPage: {
            handler() {
                this.getProjects(this.clientKey);
            }
        }
    }
}
</script>

<style>

</style>