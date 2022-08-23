<template>
    <Modal :showModal="showModal">
        <div class="modal__content">
            <h2 class="heading">Create new employee</h2>
            <a href="#" class="modal__close" @click.prevent="$emit('closeModal')">
                <span class="modal__icon"></span>
            </a>
            <form class="info" action="javascript">
                <div class="info__form">
                    <ul class="info__wrapper">
                    <li class="info__list">
                        <label class="info__label">Name:</label>
                        <input type="text" class="in-text" v-model="name">
                    </li>
                    <li class="info__list">
                        <label class="report__label">Username:</label>
                        <input type="text" class="in-text" v-model="username">
                    </li>
                    <li class="info__list">
                        <label class="report__label">Hours per week:</label>
                        <input type="text" class="in-text" v-model="hoursPerWeek">
                    </li>
                    <li class="info__list">
                        <label class="report__label">Email:</label>
                        <input type="text" class="in-text" v-model="email">
                    </li>
                    <li class="radio-button__wrapper">
                        <ul class="info__list-wrapper">
                            <li class="info__list-title">
                                <h4 class="radio-button__title">Status:</h4>
                            </li>
                            <li class="info__list-radio-button">
                                <input type="radio" id="rdo1" class="radio-input" name="radio-group-status" v-model="status" :value="1">
                                <label for="rdo1" class="radio-label"> <span class="radio-border"></span>Active</label>
                            </li>
                            <li class="info__list-radio-button">
                                <input type="radio" class="radio-input" name="radio-group-status" v-model="status" :value="0">
                                <label for="rdo1" class="radio-label"> <span class="radio-border"></span>Inactive</label>
                            </li>
                        </ul>
                        <ul class="info__list-wrapper">
                            <li class="info__list-title">
                                <h4 class="radio-button__title">Role:</h4>
                            </li>
                            <li class="info__list-radio-button" v-for="(role, index) in $store.state.roles" :key="'role'+index">
                            <input type="radio"  class="radio-input" :value="role.id" name="role" v-model="userRole">
                            <label class="radio-label" :for="role.name"> <span class="radio-border"></span>{{role.name}}</label>
                        </li>
                        </ul>
                    </li>
                </ul>
                </div>
                <div v-if="errors">
                    <ul>
                        <li v-for="(error, index) in errors" :key="index" class="error-item"><span class="invalid">{{error[0]}}</span></li>
                    </ul>
                </div>
                <div class="btn-wrap">
                    <v-btn
                    color="primary"
                    :disabled="isValidated"
                    elevation="2"
                    @click.prevent="inviteEmployee()"
                    :loading="loading"
                    >
                    Invite an employee
                    </v-btn>
                </div>
            </form>
        </div>
    </Modal>
</template>

<script>
export default {
    props: ['showModal'],
    data() {
        return{
            name: null,
            username: null,
            hoursPerWeek: null,
            email: null,
            status: 0,
            userRole: 1,
            errors: [],
            loading: false,
        }
    },
    computed: {
        isValidated() {
            return (this.name && this.email)? false : true;
        }
    },
    methods: {
        closeModal() {
            this.$emit('closeModal')
        },
        async inviteEmployee() {
          try {
              this.errors = [];
              this.loading = true;
              await axios.post('/api/employee', {
                email: this.email,
                name: this.name,
                status: this.status,
                role_id: this.userRole
              })
              this.loading = false;
            this.$emit('closeModal')
            this.$emit('resend');
            this.$emit('created');
            this.clearForm();
          } catch(error) {
              this.loading = false;
              this.errors = error.response.data.errors
          }
        },
        clearForm() {
            this.clientName=this.countryId=null
        }
    }
}
</script>

<style>

</style>