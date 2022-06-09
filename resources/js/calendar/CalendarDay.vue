<template>
        <td :class="(isDisabled)? 'month-table__regular--disabled' : '' + 'month-table__regular'">
            <div class="month-table__date">
                <span>{{dayNumber}}</span>
                <i></i>
            </div>
            <div class="month-table__hours">
                <router-link class=" month-table__day" :to="'/date/' + dayData"><span>Hours: </span><span>7.5</span></router-link>
            </div>
        </td>
</template>

<script>
import moment from 'moment'
export default {
    props: ['day','firstDay','lastDay','fullDate'],
    data() {
        return {
            dayData: moment(this.day).format('YYYY-MM-DD')
        }
    },
    computed: {
        dayNumber: function() {
            return moment(this.day).format('DD')
        },
        isDisabled() {
            return moment(this.day).isBefore(this.firstDay) || moment(this.day).isAfter(this.lastDay)
        }
    },
}
</script>

<style>

</style>