<template>
        <td class="month-table__regular" :class="{'month-table__regular--disabled' : isDisabled, 'current-date' : isToday}">
            <div class="month-table__date">
                <span>{{dayNumber}}</span>
                <i></i>
            </div>
            <div class="month-table__hours">
                <router-link class=" month-table__day" :to="'/date/' + dayData"><span>Hours: </span><span>{{calculateHours}}</span></router-link>
            </div>
        </td>
</template>

<script>
import moment from 'moment'
export default {
    props: ['day','firstDay','lastDay','fullDate','logData','isToday'],
    data() {
        return {
            hours: 0
        }
    },
    computed: {
        dayNumber: function() {
            return moment(this.day).format('D')
        },
        isDisabled() {
            return moment(this.day).isBefore(this.firstDay) || moment(this.day).isAfter(this.lastDay)
        },
        calculateHours() {
            if(this.logData)
                return this.logData['hours'];
            else
            return 0
        },
        dayData() {
           return moment(this.day).format('YYYY-MM-DD')
        }
    },
}
</script>

<style scoped>
    .current-date {
        border: 2px solid green;
    }
</style>
