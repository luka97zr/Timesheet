<template>
  <div class="wrapper">
        <section class="content">
            <div class="main-content">
                <h2 class="main-content__title">Employees</h2>
                <div class="table-navigation">
                    <a href="javascript:;" class="table-navigation__create btn-modal" @click.prevent="openModal()"><span>Create new employee</span></a>
                </div>
                <employee-accordion v-for="(employee, index) in $store.state.employees.data" :key="index" :employee="employee" @resend="getEmployees()"></employee-accordion>
            </div>
            <div class="pagination">
                <ul class="pagination__navigation" v-if="numOfPages">
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;">Previous</a>
                    </li>
                    <li class="pagination__list"  v-for="(page,index) in numOfPages" :key="index">
                        <a class="pagination__button pagination__button--active" href="javascript:;" @click.prevent="goToPage(page)">{{page}}</a>
                    </li>
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;">Next</a>
                    </li>
                </ul>
            </div>
        </section>
        <modal-employees
            :showModal="showNewModal"
            @closed="this.showNewModal = false"
            @closeModal="closeModal()">
        </modal-employees>
        <v-overlay value="overlay" v-if="!isLoaded">
            <v-progress-circular
                indeterminate
                size="64"
            ></v-progress-circular>
        </v-overlay>
    </div>
</template>

<script>
import ModalEmployees from '../../components/Modal/ModalEmployees.vue'
import EmployeeAccordion from './EmpolyeeAccordion.vue'
export default {
    components: {
        ModalEmployees,
        EmployeeAccordion
    },
    data() {
        return {
            showNewModal: false,
            employees: [],
            employeeAcc: [],
            isLoaded: true,
            currentPage: 1,
            isSuccess: false,
            search: '',
            typingTimer: null
        }
    },
    created() {
        if(this.$store.state.employees.length <= 0) this.getEmployees();
        if(this.$store.state.roles.length <= 0) this.$store.dispatch('getRoles');
        if(this.$store.state.projects.length <= 0) this.$store.dispatch('getProjects');
    },
    computed: {
        numOfPages() {
            return this.$store.state.employees.meta?.last_page;
        }
    },
    methods: {
        openModal() {
            this.showNewModal = true;
        },
        closeModal() {
            this.showNewModal = false
        },
         goToPage(page) {
            this.currentPage = page;
            this.getEmployees();
        },
        async getEmployees() {
            try {
                this.isLoaded = false;
                const data = await axios.get(`/api/employee/?page=${this.currentPage}`);
                this.$store.commit('setEmployees', data.data)
                this.employees = data.data.data
                this.isLoaded = true;
            }catch(error) {

            }
        }
    }
}
</script>

<style >

</style>