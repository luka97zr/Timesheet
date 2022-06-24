<template>
        <td :class="(isDisabled)? 'month-table__regular--disabled' : '' + 'month-table__regular'">
            <div class="month-table__date">
                <span>{{dayNumber}}</span>
                <i></i>
            </div>
            <div class="month-table__hours">
                <router-link class=" month-table__day" :to="'/date/' + dayData"><span>Hours: </span><span>{{hours}}</span></router-link>
            </div>
        </td>
</template>

<script>
import moment from 'moment'
export default {
    props: ['day','firstDay','lastDay','fullDate','logData'],
    data() {
        return {
            dayData: moment(this.day).format('YYYY-MM-DD'),
            hours: 0
        }
    },
    computed: {
        dayNumber: function() {
            return moment(this.day).format('DD')
        },
        isDisabled() {
            return moment(this.day).isBefore(this.firstDay) || moment(this.day).isAfter(this.lastDay)
        },
        getHours() {
            if(!this.logData) return;
            this.logData.forEach(log => {
                console.log(log)
               this.hours=log['hours']
            });
        }
    },
    created() {
        this.getHours
    },
    watch: {
        logData: {
            handler() {
                this.getHours;
            },
            immediate:true
        }
    }
}
</script>
