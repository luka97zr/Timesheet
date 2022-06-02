<template>
    <tr class="">
        <calendar-day v-for="(day,index) in week" :key="'day'+index" :day="day"></calendar-day>
    </tr>
</template>

<script>
    import CalendarDay from './CalendarDay'
export default {
    components: {
        CalendarDay
    },
    created() {
        console.log(this.week)
    },
    props: {
        'week': Array,
    }
}
</script>

<style>

</style>