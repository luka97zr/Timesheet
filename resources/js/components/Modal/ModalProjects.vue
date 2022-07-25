<template>
    <Modal :showModal="showModal">
        <div class="modal__content">
            <h2 class="heading">Create new project</h2>
            <a href="#" class="modal__close" @click.prevent="closeModal()">
                <span class="modal__icon"></span>
            </a>
            <form class="info" action="javascript:;">
                <ul class="info__form">
                    <li class="info__list">
                        <label class="info__label">Project name:</label>
                        <input type="text" class="in-text" v-model="projectName">
                        <div v-if="errors.name" class="invalid-feedback">{{errors.name[0]}}</div>
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
                        <div v-if="errors.client_id" class="invalid-feedback">{{errors.client_id[0]}}</div>
                    </li>
                    <li class="info__list">
                        <label class="report__label">Lead:</label>
                        <select class="info__select" v-model="leadId">
                            <option :value="null">All</option>
                                <option :value="lead.id" v-for="(lead, index) in $store.state.leads" :key="index">{{lead.user.name}}</option>
                        </select>
                        <div v-if="errors.lead_id" class="invalid-feedback">{{errors.lead_id[0]}}</div>
                    </li>
                </ul>
                <div class="btn-wrap">
                    <button type="submit" class="btn btn--green" @click.prevent="createProject()"><span>Save changes</span></button>
                    <button type="button" class="btn btn--red" @click.prevent="clearForm()"><span>Delete</span></button>
                </div>
            </form>
        </div>
    </Modal>
</template>

<script>
export default {
    props: ['showModal'],
    data() {
        return {
            errors: [],
            projectName: null,
            clientId: null,
            leadId: null
        }
    },
    computed: {
        getAllClients() {
            return Object.values(this.$store.state.clients).flat()
        }
    },
    methods: {
        closeModal() {
            this.$emit('closeModal')
        },
        async createProject() {
          try {
              this.errors = [];
              await axios.post('/api/projects', {
                  name: this.projectName,
                  client_id: this.clientId,
                  lead_id: this.leadId
              })
            this.$emit('closeModal')
            this.$emit('resend');
            this.clearForm();
          } catch(error) {
              this.errors = error.response.data.errors
          }
        },
        clearForm() {
            this.projectName=this.clientId=this.lead=null
        }
    },
}
</script>

<style>

</style>