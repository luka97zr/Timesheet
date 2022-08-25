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
                            <select class="reports__select" v-model.number="week">
                                <option :value="week.key" v-for="(week, index) in selectWeek" :key="index">{{week.value}}</option>
                            </select>
                        </li>
                        <li class="reports__list">
                            <label class="report__label">Quick date:</label>
                            <select class="reports__select" v-model.number="month">
                                <option :value="month.key" v-for="(month, index) in selectMonth" :key="index">{{month.value}}</option>
                            </select>
                        </li>
                        <li class="reports__list">
                            <label class="report__label">Start date</label>
                            <input type="date" class="in-text" v-model="startDate">
                        </li>
                        <li class="reports__list">
                            <label class="report__label">End date</label>
                            <input type="date" class="in-text" v-model="endDate">
                        </li>
                        <div v-if="!isDateValid && this.startDate && this.endDate">
                            <span>End date has to be grater then the start date</span>
                        </div>
                    </ul>
                    <div class="reports__buttons">
                        <button type="submit" class="btn btn--green" @click="generateReport()">Search</button>
                        <button type="submit" class="btn btn--green">Search Overtime</button>
                        <button type="button" class="btn btn--green" @click="resetForm()">Reset</button>
                    </div>
                </form>
                <div class="table-wrapper" v-if="dataReport.length > 0">
                    <report-table :data="dataReport" :employee="employeeName"></report-table>
                </div>
                <div class="table-navigation">
                    <div class="table-navigation__next">
                        <span class="table-navigation__text">Reports Total:</span>
                        <span>{{ hours }}</span>
                    </div>
                </div>
                <div class="reports__buttons-bottom" v-if="dataReport.length > 0">
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
import moment from 'moment';
import GetWholeWeek from '../../mixins/getWholeWeekMixin'
export default {
    components: {
        ReportTable
    },
	mixins: [GetWholeWeek],
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
            endDate: null,
            weekdays: null,
            categoryProjects: null,
            dataReport: [],
            hours: 0,
            selectWeek: [
                {
                    key: null,
                    value: 'Select week'
                },
                {
                    key: 'next_week',
                    value: 'Next week'
                },
                {
                    key: 'this_week',
                    value: 'This week'
                },
                {
                    key: 'last_week',
                    value: 'Last week'
                }
            ],
            selectMonth: [
                {
                    key: null,
                    value: 'Select month'
                },
                {
                    key: 'next_month',
                    value: 'Next month'
                },
                {
                    key: 'this_month',
                    value: 'This month'
                },
                {
                    key: 'last_month',
                    value: 'Last month'
                }
            ]
        }
    },
    computed: {
        employeeName() {
            return JSON.parse(localStorage.getItem('user')).name
        },
        userId() {
            return JSON.parse(localStorage.getItem('user')).id
        },
        isDateValid() {
            return (moment(this.endDate).isSameOrAfter(this.startDate))? true : false;
        },
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
        quickWeek() {
            if (this.week === 'next_week') {
                this.startDate = moment().add(1, 'week').startOf('isoWeek').format('YYYY-MM-DD');
                this.endDate = moment().add(1, 'week').endOf('isoWeek').format('YYYY-MM-DD');
            } else if(this.week === 'this_week') {
                this.startDate = moment().startOf('isoWeek').format('YYYY-MM-DD');
                this.endDate = moment().endOf('isoWeek').format('YYYY-MM-DD');
            } else if(this.week === 'last_week') {
                this.startDate = moment().subtract(1, 'week').startOf('isoWeek').format('YYYY-MM-DD');
                this.endDate = moment().subtract(1, 'week').endOf('isoWeek').format('YYYY-MM-DD');
            }
        },
        quickMonth() {
            this.week = null;
            if (this.month === 'next_month') {
                this.startDate = moment().add(1, 'month').startOf('month').format('YYYY-MM-DD');
                this.endDate   = moment().add(1, 'month').endOf('month').format('YYYY-MM-DD');
            } else if(this.month === 'this_month') {
                this.startDate = moment().startOf('month').format('YYYY-MM-DD');
                this.endDate   = moment().endOf('month').format('YYYY-MM-DD');
            } else if(this.month === 'last_month') {
                this.startDate = moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD');
                this.endDate   = moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD');
            }
        },
        totalHours(data) {
            this.hours = 0;
            data.forEach(entry => {
                 this.hours += entry.hours
             })
        },
        resetForm() {
            this.clientId = this.projectId = this.categoryId = this.startDate = this.endDate = null;
            this.generateReport();
        },
        async getUsersData() {
            try {
                const data = (await axios.post('/api/report', {
                    user_id: this.employeeId
                })).data;
                this.allUsers = data.data;
            } catch(error) {
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
            } catch(error) {
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
        async getCategoryProject() {
            try {
                this.categoryProjects = (await axios.post(`/api/categoryProject`, {
                    client_id: this.clientId,
                    project_id: this.projectId,
                    category_id: this.categoryId
                })).data;
            } catch(error) {
                this.errors = error.response.data.errors
            }
        },
        async generateReport() {
            try {
                this.dataReport = (await axios.post('/api/report/generate', {
                    user_id: this.employeeId,
                    startDate: this.startDate,
                    endDate: this.endDate,
                    category_project: this.categoryProjects
                })).data;
                this.totalHours(this.dataReport);
            } catch(error) {
                this.errors = error.response.data.errors
            }
        }
    },
    watch: {
        employeeId: {
           handler() {
                this.getClientsData();
                this.dataReport = [];
           },
           immediate: true
        },
        clientId: {
            handler() {
                this.filteredProjects();
                this.getCategoryProject();
            }
        },
        projectId: {
            handler() {
                this.getCategories();
                this.getCategoryProject();
            }
        },
        categoryId: {
            handler() {
                this.getCategoryProject();
            }
        },
        week: {
            handler() {
                this.quickWeek()
            }
        },
        month: {
            handler() {
                this.quickMonth()
            }
        }
    }
}
</script>

<style>

</style>