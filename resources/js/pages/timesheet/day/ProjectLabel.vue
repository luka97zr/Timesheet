<template>
    <tr>
        <td class="project-table__name">
            <select class="project-table__select" v-model="client">
                <option  :value=null >Choose client</option>
                <option  v-for="(client,index) in clientName" :key="index" >{{ client }}</option>
            </select>
        </td>
        <td class="project-table__name">
            <select class="project-table__select" v-model="project">
                <option :value=null>Choose project</option>
                <option  v-for="(project,index) in filteredProjects" :key="index" :value="project.id">{{ project.name }}</option>
            </select>
        </td>
        <td class="project-table__name">
            <select class="project-table__select" v-model="category">
                <option :value=null>Choose category</option>
                <option  v-for="(category,index) in filteredCategories" :key="index" :value="category.id" >{{ category.name }}</option>
            </select>
        </td>
        <td class="project-table__name">
            <input type="text"  class="in-text medium" v-model="description" >
        </td>
        <td class="project-table__name">
            <input type="text" class="in-text" v-model.number="hours">
        </td>
        <td class="project-table__name">
            <input type="text" class="in-text" v-model.number="overtime">
        </td>
    </tr>
</template>

<script>
export default {
    props: ['errors','userProjectData','log'],
    expose: ['description','hours','overtime','category','project','client'],
    data() {
        return {
            description: '',
            overtime: null,
            hours: null,
            clientName: '',
            client: null,
            project: null,
            category: null,
            day: null
        }
    },
    computed: {
        userId() {
			return this.$store.state.user.id;
		},
        filteredClients() {
            this.clientName = new Set(this.userProjectData.map(item => item.client.name))
            if(!this.client){
                this.project = null;
                this.category = null;
            }
        },
        filteredProjects() {
            if(!this.project) this.category=null
            const projects = []
             this.userProjectData.forEach(project => {
                    if(project.client.name === this.client)
                    projects.push(project)
            })
           return projects
        },
        filteredCategories() {
            const categories=[];
                this.userProjectData.forEach(project => {
                    if(project.id === this.project)
                        project.category_project.forEach(category => {
                        categories.push(category.category)
                        })
                })
           return categories
        },
        todayDate() {
           return this.$route.params.day
        },
    },
    methods: {
        logInputs() {
            if(!this.log)
                this.clearInput()
            else
                this.populateInput()
       },
       clearInput() {
            this.client = null
            this.project = null
            this.category = null
            this.hours = null
       },
       populateInput() {
            this.client = this.log.category.project.client.name
            this.project = this.log.category.project.id
            this.category = this.log.category.id
            this.hours = this.log.hours
       }
    },
    watch: {
        userProjectData: {
            handler() {
                this.filteredClients
            },
            immediate: true
        },
        log: {
            handler() {
                this.logInputs()
            },
            immediate: true
        }
    },
}
</script>

<style>

</style>