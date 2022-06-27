<template>
    <tr class="">
        <calendar-day v-for="(day,index) in week" :key="'day'+index" :day="day" :first-day="firstDay" :last-day="lastDay" :log-data="dayHours(day)" :is-today="isToday(day)"></calendar-day>
    </tr>
</template>

<script>
    import CalendarDay from './CalendarDay'
    import moment from 'moment'
export default {
    props: ['week','moment','firstDay','lastDay','logData'],
    data() {
        return {
            date: this.startDate,
            isDate: true,
        }
    },
    components: {
        CalendarDay
    },
    methods: {
        dayHours(day) {
            return this.logData?.find(element => element['date'] === moment(day).format('YYYY-MM-DD'))
        },
        isToday(day) {
           return (moment(day).format('YYYY-MM-DD') === moment().format('YYYY-MM-DD'))? true : false
        }
    },
    mounted() {
        this.isToday()
    }
}
</script>