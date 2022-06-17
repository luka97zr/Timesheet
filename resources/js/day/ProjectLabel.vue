<template>
    <tr>
        <td class="project-table__name">
            <select class="project-table__select" v-model="client">
                <option  value="">Choose client</option>
                <option  v-for="(client,index) in clientName" :key="index" >{{ client}}</option>
            </select>
        </td>
        <td class="project-table__name">
            <select class="project-table__select" v-model="project"  ref="project">
                <option value="">Choose project</option>
                <option  v-for="(project,index) in filterProjects" :key="index" :value="project.id">{{project.name}}</option>
            </select>
        </td>
        <td class="project-table__name">
            <select class="project-table__select" v-model="category">
                <option value="">Choose category</option>
                <option  v-for="(category,index) in filterCategories" :key="index" :value="category.id" >{{category.name}}</option>
            </select>
            <span class="validationMessage" style="display: none;"></span>
        </td>
        <td class="project-table__name">
            <input type="text"  class="in-text medium" v-model="description" ref="description">
        </td>
        <td class="project-table__name">
            <input type="text" class="in-text" v-model.number="hours" ref="hours" required>
        </td>
        <td class="project-table__name">
            <input type="text" class="in-text" v-model.number="overtime" ref="overtime">
        </td>
    </tr>
</template>

<script>
export default {
    props: ['clients'],
    expose: ['description','hours','overtime','category','project','client'],
    data() {
        return {
            description: '',
            overtime: null,
            hours: null,
            userProjectData: [],
            clientName: '',
            client: [],
            project: null,
            category: null,
        }
    },
    computed: {
        userId() {
			return this.$store.state.user.id;
		},
        filterClients() {
            this.clientName = new Set(this.userProjectData.map(item => item.client.name))
            if(!this.client){
                this.project = null;
                this.category = null;
            }
        },
        filterProjects() {
            if(!this.project) this.category=null
            const projects = []
             this.userProjectData.forEach(project => {
                    if(project.client.name === this.client)
                    projects.push(project)
            })
           return projects
        },
        filterCategories() {
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
        userId: {
            handler() {
                this.getUserProjectData();
            },
            immediate:true
        },
        userProjectData: {
            handler() {
                this.filterClients
            },
            immediate: true
        },
    },
    methods: {
      async getUserProjectData() {
		    const response = await axios.get(`/api/projects/${this.userId}`);
            this.userProjectData = response.data;
		},
    },
}
</script>

<style>

</style>