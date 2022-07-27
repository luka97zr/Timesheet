<template>
    <div class="accordion" @click.prevent="openAccordion()">
        <div class="accordion__intro">
            <h4 class="accordion__title">{{employee.name}}</h4>
        </div>
        <form class="accordion__content" action="javascript:;" :class="{'accorion-open' : isOpened}" @click="openAccordion()">
            <div class="info">
                <div class="info__form">
                    <ul class="info__wrapper">
                        <li class="info__list">
                            <label class="info__label">Name:</label>
                            <input type="text" class="in-text" v-model="employeeName">
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
                        <li class="info__list-title">
                            <h4 class="radio-button__title">Status:</h4>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" checked="" class="radio-input" name="radio-group-status">
                            <label for="rdo1" class="radio-label"> <span class="radio-border"></span>Active</label>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" class="radio-input" name="radio-group-status">
                            <label class="radio-label"> <span class="radio-border"></span>Inactive</label>
                        </li>
                        <li class="info__list-title">
                            <h4 class="radio-button__title">Role:</h4>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" checked="" class="radio-input" name="radio-group-role">
                            <label class="radio-label"> <span class="radio-border"></span>Admin</label>
                        </li>
                        <li class="info__list-radio-button">
                            <input type="radio" class="radio-input" name="radio-group-role">
                            <label class="radio-label"> <span class="radio-border"></span>Worker</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn-wrap">
                <button type="submit" class="btn btn--green"><span>Save changes</span></button>
                <button type="button" class="btn btn--red"><span>Delete</span></button>
                <button type="button" class="btn btn--orange"><span>Change passwword</span></button>
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
            employeeName: null,
            username: null,
            hoursPerWeek: null,
            email: null
        }
    },
    methods: {
        openAccordion() {
            this.isOpened = !this.isOpened;
        },
        showName() {
            this.employeeName = this.employee.name;
        },
    },
    watch: {
        employee: {
            handler() {
                this.showName();
            },
            immediate: true
        }
    }
}
</script>

<style>

</style>