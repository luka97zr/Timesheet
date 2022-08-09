<template>
    <div class="accordion" @click="openAccordion()">
        <div class="accordion__intro">
            <h4 class="accordion__title">{{employee.name}}</h4>
        </div>
        <form class="accordion__content" action="javascript:;" :class="{'accorion-open' : isOpened}" @click="openAccordion()">
            <div class="info">
                <div class="info__form">
                    <ul class="info__wrapper">
                        <li class="info__list">
                            <label class="info__label">Name:</label>
                            <input type="text" class="in-text" v-model="userName">
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
                        <li class="info__list">
                            <label class="report__label">Projects</label>
                            <button type="button" class="report_button in-text" @click="toggleDropdown()">Select Projects</button>
                            <ul class="report__container" :class="{'active' : projectSelect}">
                                <li class="report__select" v-for="(project, index) in Object.values($store.state.projects).flat()" :key="index"><input type="checkbox" class="in-text">{{project.name}}</li>
                            </ul>
                        </li>
                        <li class="info__list-title">
                            <h4 class="radio-button__title">Status:</h4>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" checked="" class="radio-input" :value="1" name="radio-group-status" v-model="status">
                            <label for="rdo1" class="radio-label"> <span class="radio-border"></span>Active</label>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" class="radio-input" :value="0" name="radio-group-status" v-model="status">
                            <label class="radio-label"> <span class="radio-border"></span>Inactive</label>
                        </li>
                        <li class="info__list-title">
                            <h4 class="radio-button__title">Role:</h4>
                        </li>
                        <li class="info__list-radio-button" v-for="(role, index) in $store.state.roles" :key="'role'+index">
                            <input type="radio"  class="radio-input" :value="role.id" name="role" v-model="userRole">
                            <label class="radio-label" :for="role.name"> <span class="radio-border"></span>{{role.name}}</label>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="btn-wrap">
                <button type="submit" class="btn btn--green" @click="updateEmployee()"><span>Save changes</span></button>
                <button type="button" class="btn btn--red" @click="deleteEmployee()"><span>Delete</span></button>
                <button type="button" class="btn btn--orange" @click="changePassword()"><span>Change passwword</span></button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['employee'],
    data() {
        return {
            isOpened: false,
            userName: null,
            username: null,
            hoursPerWeek: null,
            email: null,
            userRole : null,
            status: null,
            projectSelect: false
        }
    },
    created() {
        if(this.$store.state.projects.length <= 0) this.$store.dispatch('getProjects');
    },
    methods: {
        openAccordion() {
            this.isOpened = !this.isOpened;
        },
        showName() {
            this.userName = this.employee.name;
        },
        showEmail() {
            this.email = this.employee.email;
        },
        showStatus() {
            this.status = this.employee.status;
        },
        showRole() {
            this.userRole = this.employee.role.id;
        },
        selectRole(id) {
            this.userRole = id;
        },
        setUserId() {
            this.userId = this.employee.id;
        },
        toggleDropdown() {
            this.projectSelect = !this.projectSelect
        },
        async deleteEmployee() {
            try {
                await axios.delete(`/api/employee/${this.employee.id}`);
                this.$emit('resend');
            } catch(error) {
                console.log(error)
            }
        },
        async updateEmployee() {
            try {
                await axios.patch(`/api/employee/${this.employee.id}`, {
                    name: this.userName,
                    email: this.email,
                    status: this.status,
                    role_id: this.userRole
                });
                this.$emit('resend');
            } catch(error) {
                console.log(error)
            }
        },
        async changePassword() {
            try {
                axios.post('/api/password/change', {
                    user_id: this.userId
                })
            }catch(error) {

            }
        }
    },
    watch: {
        employee: {
            handler() {
                this.showName();
                this.showEmail();
                this.showStatus();
                this.showRole();
                this.setUserId();
            },
            immediate: true
        }
    }
}
</script>

<style scoped>
.report__container {
    overflow: auto;
    height: 100px;
    display: none;
}
.report__container.active {
    display: block;
}
.report__select {
    display: grid;
   grid-template-columns: 1fr 1fr;
   grid-template-rows: 1fr;
   align-items: center;
   gap: 10px;
}
.report_button {
    background-color: #f1592a;
    color: white;
}
</style>