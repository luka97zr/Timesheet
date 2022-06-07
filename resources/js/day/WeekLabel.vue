<template>
  <div class="day-table">
    <ul class="day-table__wrap">
        <li class="day-table__list" v-for="(day,index) in WholeWeek" :key="index" @click="addClass(index, $event)" :class="{ 'day-table__list--active' : isActive }">
            <router-link :to="'/date/'+getRoute(day)" class="day-table__link">
            <b class="day-table__month">{{getDayFormat(day)}}</b> <i class="day-table__day">0</i>
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
    props: ['WholeWeek','year'],
    data() {
            return {
                dayRoute: this.$route.params.day,
                isActive: false
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
            return moment(day).format('MM-DD-YYYY')
        },
        getDayFormat(day) {
            return moment(day).format('MMM DD')
        },
        addClass(e, item) {
			if (e.ctrlKey) {
                this.isActive = !this.isActive
            }else {
                this.WholeWeek.forEach(element => {
                    isActive = false
                });
                    isActive = true

            }
            }
    }

}
</script>

<style>

</style>