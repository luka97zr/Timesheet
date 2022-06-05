<template>
        <td  class="month-table__regular">
            <div class="month-table__date">
                <span>{{Day}}</span>
                <i></i>
            </div>
            <div class="month-table__hours">
                <router-link class=" month-table__day" :to="{name: 'day' , params: {fullDate}}"><span>Hours: </span><span>7.5</span></router-link>
            </div>
        </td>
</template>

<script>
import moment from 'moment'
export default {
    props: ['day','firstDay','endDate','fullDate'],
    data() {
        return {
            dayData: moment(this.day).format('DD-MM-YYYY')
        }
    },
    computed: {
        Day: function() {
            return moment(this.day).format('DD')
        },
    },
}
</script>

<style>

</style>