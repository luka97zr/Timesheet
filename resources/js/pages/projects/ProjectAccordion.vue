<template>
    <div class="accordion" @click="openAccordion()">
        <div class="accordion__intro">
            <h4 class="accordion__title">{{project.name}}</h4>
        </div>
        <form class="accordion__content" action="javascript:;" :class="{'accorion-open' : isOpened}" @click="openAccordion()">
            <div>
                <div class="info__form">
                    <ul class="info__wrapper">
                        <li class="info__list">
                            <label class="info__label">Project name:</label>
                            <input type="text" class="in-text" v-model="projectName">
                            <span v-if="errors && errors.name">{{errors.name[0]}}</span>
                        </li>
                        <li class="info__list">
                            <label class="report__label">Description:</label>
                            <input type="text" class="in-text">
                        </li>
                        <li class="info__list">
                            <label class="report__label">Client:</label>
                            <select class="info__select" v-model="clientId">
                                <option :value="null">All</option>
                                <option :value="client.id" v-for="(client,index) in $store.state.clients" :key="index">{{client.name}}</option>
                            </select>
                            <span v-if="errors && errors.client_id">{{errors.client_id[0]}}</span>

                        </li>
                        <li class="info__list">
                            <label class="report__label">Lead:</label>
                            <select class="info__select" v-model="leadId">
                                <option :value="null">All</option>
                                <option :value="lead.id" v-for="(lead, index) in $store.state.leads" :key="index">{{lead.user.name}}</option>
                            </select>
                            <span v-if="errors && errors.lead_id">{{errors.lead_id[0]}}</span>
                        </li>
                        <li class="info__list-title"><h4 class="radio-button__title">Status:</h4></li>
                        <li class="info__list-radio-button">
                            <input type="radio" class="radio-input" name="radio-group" v-model="status" :value="1">
                            <label class="radio-label"> <span class="radio-border"></span>Active</label>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" checked="" class="radio-input" name="radio-group" v-model="status" :value="0">
                            <label class="radio-label"> <span class="radio-border"></span>Inactive</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn-wrap">
                <button type="submit" class="btn btn--green" @click.prevent="updateProject()" :disabled="isValidated"><span>Save changes</span></button>
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
            clientId: null,
            projectName: null,
            leadId: null,
            status: 1,
            errors: []
        }
    },
    computed: {
        isValidated() {
            return (this.projectName && this.leadId && this.clientId)? false : true;
        },
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
        showStatus() {
            this.status = this.project.status;
        },
        async updateProject() {
            try {
                await axios.put(`/api/project/${this.project.id}`,{
                    client_id: this.clientId,
                    name: this.projectName,
                    lead_id: this.leadId,
                    status: this.status
                });
                this.$emit('resend');
                this.$emit('updated');
                this.openAccordion();
            }catch(error) {
                this.errors = error.response.data.errors
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
                this.showStatus();
            },
            immediate: true
        }
    }
}
</script>

<style>

</style>