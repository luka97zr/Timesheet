<template>
    <div class="accordion" @click="openAccordion()">
        <div class="accordion__intro">
            <h4 class="accordion__title">{{project.name}}</h4>
        </div>
        <form class="accordion__content" action="javascript:;" :class="{'accorion-open' : isOpened}" @click="openAccordion()">
            <div class="info">
                <div class="info__form">
                    <ul class="info__wrapper">
                        <li class="info__list">
                            <label class="info__label">Project name:</label>
                            <input type="text" class="in-text" v-model="projectName">
                        </li>
                        <li class="info__list">
                            <label class="report__label">Description:</label>
                            <input type="text" class="in-text">
                        </li>
                        <li class="info__list">
                            <label class="report__label">Client:</label>
                            <select class="info__select" v-model="clientId">
                                <option :value="null">All</option>
                            <option :value="client.id" v-for="(client,index) in getAllClients" :key="index">{{client.name}}</option>
                            </select>
                        </li>
                        <li class="info__list">
                            <label class="report__label">Lead:</label>
                            <select class="info__select" v-model="leadId">
                                <option :value="null">All</option>
                                <option :value="lead.id" v-for="(lead, index) in $store.state.leads" :key="index">{{lead.user.name}}</option>
                            </select>
                        </li>
                        <li class="info__list-title"><h4 class="radio-button__title">Status:</h4></li>
                        <li class="info__list-radio-button">
                            <input type="radio" class="radio-input" name="radio-group">
                            <label class="radio-label"> <span class="radio-border"></span>Active</label>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" checked="" class="radio-input" name="radio-group">
                            <label class="radio-label"> <span class="radio-border"></span>Inactive</label>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" class="radio-input" name="radio-group">
                            <label class="radio-label"> <span class="radio-border"></span>Archive</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn-wrap">
                <button type="submit" class="btn btn--green" @click.prevent="updateProject()"><span>Save changes</span></button>
                <button type="button" class="btn btn--red" @click.prevent="deleteProject()"><span>Delete</span></button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['project'],
    data() {
        return {
            isOpened: false,
            projectId: '',
            clientId: '',
            projectName: '',
            leadId: null
        }
    },
    computed: {
        getAllClients() {
            return Object.values(this.$store.state.clients).flat()
        }
    },
    methods: {
        openAccordion() {
            this.isOpened = !this.isOpened;
        },
        showName() {
            this.projectName = this.project.name;
        },
        showClient() {
            this.clientId = this.project.client.id;
        },
        async updateProject() {
            try {
                await axios.put(`/api/project/${this.project.id}`,{
                    client_id: this.clientId,
                    name: this.projectName,
                    lead_id: this.leadId
                });
                this.$emit('resend');
                this.$emit('updated');
                this.openAccordion();
            }catch(error) {
                console.log(error)
            }
        },
        async deleteProject() {
            try {
                await axios.delete(`/api/project/${this.project.id}`);
                this.$emit('resend');
            } catch(error) {
                console.log(error)
            }
        }
    },
    watch: {
        project: {
            handler() {
                this.showName();
                this.showClient();
            },
            immediate: true
        }
    }
}
</script>

<style>

</style>