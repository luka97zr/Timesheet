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
import errorHandle from './../shared/mixins/errorHandle'
export default {
    props: ['errors','userProjectData'],
    mixins: [errorHandle],
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
                    if(this.project)
                        project.category.forEach(category => {
                        categories.push(category)
                        })
                })
           return categories
        },
    },
    watch: {
        userProjectData: {
            handler() {
                this.filteredClients
            },
            immediate: true
        },
    },
}
</script>

<style>

</style>