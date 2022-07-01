<template>
  <div class="day-table">
    <ul class="day-table__wrap">
        <li class="day-table__list" v-for="(day,index) in WholeWeek" :key="index" :class="addClass(day)" @click="asignDate()">
            <router-link :to="'/date/'+getRoute(day)" class="day-table__link">
            <b class="day-table__month">{{getDayFormat(day)}}</b> <i class="day-table__day">{{asignDayHours(day)}}</i>
            <span class="day-table__span hide-on-mob">{{getDayName(day)}}</span>
            <span class="day-table__span show-on-mob">{{getDayNameMobile(day)}}</span>
            </router-link>
        </li>
    </ul>
</div>
</template>

<script>
import moment from 'moment'
export default {
    props: ['WholeWeek','year','hour'],
    data() {
            return {
                current: null
            }
        },
    methods: {
        getDayName(day) {
            return moment(day).format('dddd')
        },
        getDayNameMobile(day) {
            return moment(day).format('ddd')
        },
        getRoute(day) {
            return moment(day).format('YYYY-MM-DD')
        },
        getDayFormat(day) {
            return moment(day).format('MMM DD')
        },
        addClass(day) {
            return (this.current === moment(day).format('YYYY-MM-DD'))? 'day-table__list--active' : ''
        },
        asignDate() {
            this.current = this.dayRoute
        },
        asignDayHours(day) {
            return this.$store.state.calendar?.forEach(log => {
                return (log['date'] === day)? log['hours'] : 0
            });
        }
    },
    computed: {
        dayRoute() {
            return this.$route.params.day
        },
    },
    created() {
        this.asignDate()
        console.log(JSON.parse(JSON.stringify(this.$store.state.calendar)))
    }

}
</script>

<style>

</style>