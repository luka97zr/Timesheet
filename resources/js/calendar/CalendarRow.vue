<template>
    <tr class="">
        <calendar-day v-for="(day,index) in week" :key="'day'+index" :day="day" :first-day="firstDay" :last-day="lastDay" :logData="logData"></calendar-day>
    </tr>
</template>

<script>
    import CalendarDay from './CalendarDay'
export default {
    props: ['week','moment','firstDay','lastDay','logData'],
    data() {
        return {
            date: this.startDate
        }
    },
    components: {
        CalendarDay
    },
    computed: {
        fullDate: function() {
            return moment(this.day).format('YYYY-MM_DD')
        }
    },
}
</script>