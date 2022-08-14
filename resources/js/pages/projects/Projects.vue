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
                        <a class="alphabet__button" :class="{'alphabet__button--disabled' : !checkProjectName(letter)}" href="javascript:;" @click.prevent="searchProjects(letter)" >{{letter}}</a>
                    </li>
                </ul>
            </div>
            <project-accordion v-for="(project, index) in projects" :key="index" :project="project" @resend="refreshData()" @updated="updatedSuccessfuly()"></project-accordion>
            <alert v-if="isSuccess" :message="'Project Successfully updated'"></alert>
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
        @created="createdSuccessfuly()"
        @resend="refreshData()">
    </modal-project>
    <v-overlay value="overlay" v-if="!isLoaded" opacity=".85">
        <v-progress-circular
            indeterminate
            size="64"
        ></v-progress-circular>
    </v-overlay>
    <alert v-if="isCreated" :message="'Project created successfuly'"></alert>
</div>
</template>

<script>
import ModalProject from '../../components/Modal/ModalProjects.vue';
import ProjectAccordion from './ProjectAccordion.vue';
import Alert from '../../components/vuetify/Alert.vue'
import getAlphabetMixin from '../../mixins/getAlphabetMixin';
import toggleModal from '../../mixins/toggleModalMixin';
import timeoutMixin from '../../mixins/timeoutMixin';
import succesMessage from '../../mixins/successMessageMixin';

export default {
       components: {
        ModalProject,
        ProjectAccordion,
        Alert
    },
    mixins: [getAlphabetMixin, toggleModal, timeoutMixin, succesMessage],
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
            isCreated: false,
            search: '',
            typingTimer: null
        }
    },
    created() {
         if(this.$store.state.projectsAlphabet.length <= 0) this.getProjectsAlphabet();
        this.getProjects();
        this.checkClients();
        this.checkLeads();
    },
    methods: {
        checkProjectName(letter) {
             return (this.$store.state.projectsAlphabet.includes(letter))? true : false;
        },
        nextPage() {
            if (this.currentPage >= this.numOfPages) return
            this.currentPage++;
            this.getProjects();
        },
        prevPage() {
            if (this.currentPage <= 1) return
            this.currentPage--;
            this.getProjects();
        },
        goToPage(page) {
            this.currentPage = page;
            this.getProjects();
        },
        checkClients() {
            if(this.$store.state.clients.length <= 0)
            this.$store.dispatch('getClients');
        },
        checkLeads() {
            if(this.$store.state.leads.length <= 0)
            this.$store.dispatch('getLeads');
        },
        refreshData() {
            this.getProjectsAlphabet();
            this.getProjects();
        },
        async getProjectsAlphabet() {
            try {
                this.isLoaded = false
                this.projectsAlphabet = ( await axios.get(`/api/project/alphabet`)).data;
                this.isLoaded = true
                this.$store.commit('setProjectsAlphabet', this.projectsAlphabet)
            }catch(error) {
                console.log(error)
            }
        },
        async getProjects() {
            try {
                this.isLoaded = false
                const data = (await axios.get(`/api/project/?page=${this.currentPage}`)).data;
                this.isLoaded = true
                this.projects = data.data;
                this.numOfPages = data.meta.last_page;
            }catch(error) {
                console.log(error)
            }
        },
        async searchProjects(term) {
            try {
                this.currentPage = 1;
                this.isLoaded = false
                await this.timeout(500);
                const data = (await axios.get(`/api/project/${term}?page=${this.currentPage}`)).data;
                this.projects = data.data;
                this.isLoaded = true;
                this.numOfPages = data.meta.last_page;
            }catch(error) {
                console.log(error);
            }
        }
    },
    watch: {
        search: {
            handler() {
               this.searchProjects(this.search)
            }
        },
    }
}
</script>

<style>

</style>