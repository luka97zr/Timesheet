<template>
    <tr class="">
        <calendar-day v-for="(day,index) in week" :key="'day'+index" :day="day"></calendar-day>
    </tr>
</template>

<script>
    import CalendarDay from './CalendarDay'
export default {
    props: ['week','firstDay','moment'],
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
            return moment(this.day).format('DD-MM-YYYY')
        }
    }
}
</script>

<style>

</style>