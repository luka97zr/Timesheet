<template>
  <div class="wrapper">
        <section class="content">
            <div class="main-content">
                <h2 class="main-content__title">Reports</h2>
                <form class="reports" action="javascript:;">
                    <ul class="reports__form">
                        <li class="reports__list">
                            <label class="report__label">Client</label>
                            <select class="reports__select" v-model="clientId">
                                <option :value="null" selected>All</option>
                                <option :value="client.id" v-for="(client, index) in allClients" :key="index">{{ client.name }}</option>
                            </select>
                        </li>
                        <li class="reports__list">
                            <label class="report__label">Project</label>
                            <select class="reports__select" v-model="projectId">
                                <option :value="null" selected>All</option>
                                <option :value="project.project.id" v-for="(project, index) in selectedProjects" :key="index">{{project.project.name}}</option>
                            </select>
                        </li>
                        <li class="reports__list">
                            <label class="report__label">Category:</label>
                            <select class="reports__select" v-model="categoryId">
                                <option :value="null">All</option>
                                <option :value="category.id" v-for="(category, index) in allCategories" :key="index">{{category.name}}</option>
                            </select>
                        </li>
                    </ul>
                    <ul class="reports__form">
                        <li class="reports__list">
                            <label class="report__label">Employee</label>
                            <select class="reports__select" v-model="employeeId">
                                <option :value="userId" selected>{{employeeName}}</option>
                                <option :value="user.id" v-for="(user, index) in allUsers" :key="'user:'+index">{{user.name}}</option>
                            </select>
                        </li>
                    </ul>
                    <ul class="reports__form">
                        <li class="reports__list">
                            <label class="report__label">Quick date:</label>
                            <select class="reports__select" v-model="week">
                                <option :value="null">Select week</option>
                                <option value="1">Next week</option>
                                <option value="2">This week</option>
                                <option value="3">Last week</option>
                            </select>
                        </li>
                        <li class="reports__list">
                            <label class="report__label">Quick date:</label>
                            <select class="reports__select">
                                <option value="">Select month</option>
                                <option value="1">Next month</option>
                                <option value="2">This month</option>
                                <option value="3">Last month</option>
                            </select>
                        </li>
                        <li class="reports__list">
                            <label class="report__label">Start date</label>
                            <input type="date" class="in-text">
                        </li>
                        <li class="reports__list">
                            <label class="report__label">End date</label>
                            <input type="date" class="in-text">
                        </li>
                    </ul>
                    <div class="reports__buttons">
                        <button type="submit" class="btn btn--green">Search</button>
                        <button type="submit" class="btn btn--green">Search Overtime</button>
                        <button type="button" class="btn btn--green">Reset</button>
                    </div>
                </form>
                <div class="table-wrapper">
                    <report-table></report-table>
                </div>
                <div class="table-navigation">
                    <div class="table-navigation__next">
                        <span class="table-navigation__text">Reports Total:</span>
                        <span>352.0</span>
                    </div>
                </div>
                <div class="reports__buttons-bottom">
                    <a href="javascript:;" class="btn btn--transparent">Print Report</a>
                    <a href="javascript:;" class="btn btn--transparent">Create PDF</a>
                    <a href="javascript:;" class="btn btn--transparent">Export to excel</a>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import ReportTable from './ReportTable.vue'
export default {
    components: {
        ReportTable
    },
    data() {
        return {
            employeeId: JSON.parse(localStorage.getItem('user')).id,
            allUsers: [],
            allClients: [],
            allClientsProjects: [],
            allProjects: [],
            selectedProjects: [],
            allCategories: [],
            clientId: null,
            projectId: null,
            categoryId: null,
            errors: [],
            week: null,
            month: null,
            startDate: null,
            endDate: null
        }
    },
    computed: {
        employeeName() {
            return JSON.parse(localStorage.getItem('user')).name
        },
        userId() {
            return JSON.parse(localStorage.getItem('user')).id
        }
    },
    created() {
        this.getUsersData();
    },
    methods: {
        filteredClients(data) {
            this.clientId = null;
            this.allClients = [...new Map(data.map(item =>
                [item.project.client['name'], item.project.client])).values()];
        },
        filteredProjects() {
            if(!this.clientId) {
                this.projectId = this.categoryId = null
            }
            this.selectedProjects = [];
             this.allClientsProjects.forEach(project => {
                if(project.project.client.id === this.clientId)
                    this.selectedProjects.push(project);
            })
        },
        async getUsersData() {
            try {
                const data = (await axios.post('/api/report', {
                    user_id: this.employeeId
                })).data;
                this.allUsers = data.data;
            }catch(error) {
                this.errors = error.response
            }
        },
        async getClientsData() {
            try {
                const data = (await axios.post(`/api/report/clients`, {
                    user_id: this.employeeId
                })).data;
                this.allClientsProjects = data.data;
                this.filteredClients(data.data);
            }catch(error) {
                this.errors = error.response.data.errors

            }
        },
         async getCategories() {
            try {
                const data = (await axios.post(`/api/report/category`, {
                    project_id: this.projectId
                })).data;
                this.allCategories = data.data;
            }catch(error) {
                this.errors = error.response.data.error
            }
        },
    },
    watch: {
        employeeId: {
           handler() {
                this.getClientsData();
           },
           immediate: true
        },
        clientId: {
            handler() {
                this.filteredProjects();
            }
        },
        projectId: {
            handler() {
                this.getCategories();
            }
        }
    }
}
</script>

<style>

</style>