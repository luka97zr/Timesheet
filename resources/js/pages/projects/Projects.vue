<template>
  <div class="wrapper">
    <section class="content">
        <div class="main-content">
            <h2 class="main-content__title">Project</h2>
            <div class="table-navigation">
                <a href="javascript:;" class="table-navigation__create btn-modal" @click.prevent="openModal()"><span>Create new project</span></a>
                <form class="table-navigation__input-container" action="javascript:;">
                    <input type="text" class="table-navigation__search">
                    <button type="submit" class="icon__search"></button>
                </form>
            </div>
            <div class="alphabet">
                <ul class="alphabet__navigation">
                    <li class="alphabet__list" v-for="(letter,index) in getAlphabet" :key="index">
                        <a class="alphabet__button" :class="{'alphabet__button--disabled' : !checkProjectName(letter)}" href="javascript:;" @click.prevent="generateAlphabet(letter)" >{{letter}}</a>
                    </li>
                </ul>
            </div>
            <project-accordion v-for="(project, index) in projectsAcc" :key="index" :project="project" @resend="getProjects()" @updated="clientUpdatedSuccessfuly()"></project-accordion>
        </div>
        <div class="pagination">
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
    <modal-project
        :showModal="showNewModal"
        @closeModal="closeModal()">
    </modal-project>
</div>
</template>

<script>
import ModalProject from '../../components/Modal/ModalProjects.vue';
import ProjectAccordion from './ProjectAccordion.vue';
export default {
       components: {
        ModalProject,
        ProjectAccordion
    },
     data() {
        return {
            showNewModal: false,
            projects: [],
            projectsAcc: [],
            isLoaded: false,
            perPage: 3,
            currentPage: 1,
            isSuccess: false,
            search: '',
            typingTimer: null
        }
    },
    created() {
        if(this.$store.state.projects.length === 0)  this.getProjects();
        this.populateProjectAcc()
        this.checkClients();
        this.checkLeads();
    },
     computed: {
        getAlphabet() {
           return [...Array(26)].map((_,i) => String.fromCharCode(i + 65))
        },
        numOfPages() {
            return Math.ceil(this.projectsAcc.length / this.perPage);
        },
        startPage() {
            return (this.currentPage - 1) * this.perPage;
        },
        endPage() {
            return this.startPage + this.perPage;
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
            return Object.keys(this.$store.state.projects).some(el => el === letter);
        },
        generateAlphabet(letter) {
            if(!this.$store.state.projects[letter]) return;
            this.currentPage = 1;
            this.projectsAcc = Object.values(this.$store.state.projects[letter])
            this.buildPage();
        },
        buildPage() {
            this.projects = this.projectsAcc.slice(this.startPage, this.endPage);
        },
        populateProjectAcc() {
            if (this.projectsAcc.length === 0) {
                this.projectsAcc = Object.values(this.$store.state.projects)
                this.generateAlphabet(Object.keys(this.$store.state.projects)[0]);
            }
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
        checkClients() {
            if(this.$store.state.clients.length <= 0)
            this.$store.dispatch('getClients');
        },
        checkLeads() {
            if(this.$store.state.leads.length <= 0)
            this.$store.dispatch('getLeads');
        },
        async getProjects() {
            try {
                this.isLoaded = false
                const data = await axios.get(`/api/projects`);
                this.$store.commit('setProjects',data.data);
                this.generateAlphabet(Object.keys(this.$store.state.projects)[0]);
                this.isLoaded = true
            }catch(error) {

            }
        },
    }
}
</script>

<style>

</style>