<template>
    <div class="wrapper">
        <section class="main-content">
            <h2 class="main-content__title">Timesheet</h2>
            <div class="table-navigation">
                <a href="javascript:;" class="table-navigation__prev" @click="previousMonth"><span>previous month</span></a>
                    <span class="table-navigation__center">{{month}},{{year}}</span>
                <a href="javascript:;" class="table-navigation__next" @click="nextMonth"><span>next month</span></a>
            </div>
            <div class="table-wrapper">
                <table class="month-table">
                    <calendar-weekdays ></calendar-weekdays>
                    <tbody>
                        <calendar-row v-for="(date, index) in getDate" :key="'week' + index" :week="date"></calendar-row>
                    </tbody>
                </table>
            </div>
            <div class="table-navigation">
                <div class="table-navigation__next">
                    <span class="table-navigation__text">Total:</span>
                    <span>155</span>
                </div>
            </div>
        </section>
    </div>

</template>
<script>
    import moment from "moment"
    import CalendarWeekdays from './CalendarWeekdays'
    import CalendarMonth from './CalendarMonth'
    import CalendarRow from './CalendarRow'
    export default {
        data() {
            return {
                firstDay: this.daysInMonth,
                today: moment(),
                dateContext: moment(),
            }
        },
        components: {
            CalendarWeekdays,
            CalendarMonth,
            CalendarRow,
        },
        computed: {
            year: function () {
                return this.dateContext.format('YYYY');
            },
            month: function () {
                return this.dateContext.format('MMMM');
            },
            daysInMonth: function () {
                return this.dateContext.daysInMonth();
            },
            currentDate: function () {
                return this.dateContext.get('date');
            },
            firstDayOfMonth: function () {
                return moment([this.dateContext.format('Y'),this.dateContext.format('M')-1]).clone().startOf('month').startOf('isoWeek').format('D');
            },
            lastDayOfMonth: function() {
                return moment([this.dateContext.format('Y'),this.dateContext.format('M')-1]).clone().endOf('month').endOf('week');
            },
            getDate: function() {
            const calendarArr = []
            const startDate = moment([this.dateContext.format('Y'),this.dateContext.format('M')-1])
            .clone()
            .startOf('month')
            .startOf('isoWeek');
            const endDate = moment([this.dateContext.format('Y'),this.dateContext.format('M')-1]).clone().endOf('month').endOf('week');
            const day = startDate.clone().subtract(1,'days')
            while(day.isBefore(endDate,"day")) {
                calendarArr.push(
                    Array(7)
                    .fill(0)
                    .map(()=>day.add(1,"day").clone())
                );
            }
            if(calendarArr.length < 6) {
                for(let i=0; i< 6-calendarArr.length; i++) {
                    calendarArr.push(
                    Array(7)
                    .fill(0)
                    .map(()=>day.add(1,"day").clone()))
                }
            }
            return calendarArr
        },
        //Previous Code Above
        initialDate: function () {
            return this.today.get('date');
        },
        initialMonth: function () {
            return this.today.format('MMMM');
        },
        initialYear: function () {
            return this.today.format('YYYY');
        }
    },
    methods: {
        previousMonth: function() {
            this.dateContext = moment(this.dateContext).subtract(1, 'month');
        },
        nextMonth: function() {
            this.dateContext = moment(this.dateContext).add(1, 'month');
        console.log(this.getDate)
        }
    }

}
</script>

