<template>
  <div class="wrapper">
        <section class="content">
            <div class="main-content">
                <h2 class="main-content__title">Employees</h2>
                <div class="table-navigation">
                    <a href="javascript:;" class="table-navigation__create btn-modal" @click.prevent="openModal()"><span>Create new employee</span></a>
                </div>
                <employee-accordion v-for="(employee, index) in $store.state.employees.data" :key="index" :employee="employee" @resend="getEmployees()" @updated="updatedSuccessfuly()" @changePwd="passwordUpdatedSuccessfuly()"></employee-accordion>
                <alert v-if="isSuccess" :message="'Employee updated'"></alert>
                <alert v-if="isPasswordUpdated" :message="'Password reset link is sent'"></alert>
            </div>
            <div class="pagination">
                <ul class="pagination__navigation" v-if="numOfPages">
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;"  @click.prevent="prevPage()">Previous</a>
                    </li>
                    <li class="pagination__list"  v-for="(page,index) in numOfPages" :key="index">
                        <a class="pagination__button pagination__button--active" href="javascript:;" @click.prevent="goToPage(page)">{{page}}</a>
                    </li>
                    <li class="pagination__list" >
                        <a class="pagination__button" href="javascript:;" @click.prevent="nextPage()">Next</a>
                    </li>
                </ul>
            </div>
        </section>
        <modal-employees
            :showModal="showNewModal"
            @closed="this.showNewModal = false"
            @created="createdSuccessfuly()"
            @closeModal="closeModal()">
        </modal-employees>
        <v-overlay value="overlay" v-if="!isLoaded" opacity=".85">
            <v-progress-circular
                indeterminate
                size="64"
            ></v-progress-circular>
        </v-overlay>
        <alert v-if="isCreated" :message="'Employee invitation sent'"></alert>
    </div>
</template>

<script>
import ModalEmployees from '../../components/Modal/ModalEmployees.vue'
import Alert from '../../components/vuetify/Alert.vue'
import EmployeeAccordion from './EmpolyeeAccordion.vue'
import successMessage from '../../mixins/successMessageMixin';
export default {
    components: {
        ModalEmployees,
        EmployeeAccordion,
        Alert
    },
    mixins: [successMessage],
    data() {
        return {
            showNewModal: false,
            employees: [],
            employeeAcc: [],
            isLoaded: true,
            currentPage: 1,
            isSuccess: false,
            isCreated: false,
            isPasswordUpdated: false,
            search: '',
            typingTimer: null
        }
    },
    created() {
        this.getEmployees();
        if(this.$store.state.roles.length <= 0) this.$store.dispatch('getRoles');
        if(this.$store.state.projects.length <= 0) this.$store.dispatch('getProjects');
    },
    computed: {
        numOfPages() {
            return this.$store.state.employees.meta?.last_page;
        },
        firstPages() {
            return [this.currentPage, this.currentPage+1, this.currentPage+2]
        },
        lastPages() {
            return [this.numOfPages-2,this.numOfPages-1, this.numOfPages]
        }
    },
    methods: {
        openModal() {
            this.showNewModal = true;
        },
        closeModal() {
            this.showNewModal = false
        },
         nextPage() {
            if (this.currentPage >= this.numOfPages) return
            this.currentPage++;
             this.getEmployees();
        },
        prevPage() {
            if (this.currentPage <= 1) return
            this.currentPage--;
             this.getEmployees();
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