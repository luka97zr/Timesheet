<template>
    <div class="wrapper">
        <section class="main-content">
            <h2 class="main-content__title">Timesheet</h2>
            <div class="table-navigation">
                <a href="javascript:;" class="table-navigation__prev" @click.prevent="previousMonth"><span>previous month</span></a>
                    <span class="table-navigation__center">{{month}},{{year}}</span>
                <a href="javascript:;" class="table-navigation__next" @click.prevent="nextMonth"><span>next month</span></a>
            </div>
            <div class="table-wrapper">
                <table class="month-table">
                    <calendar-weekdays ></calendar-weekdays>
                    <tbody>
                        <calendar-row v-for="(date, index) in getDate" :key="'week' + index" :week="date" :first-day="firstDayOfMonth" :last-day="lastDayOfMonth" :log-data="$store.state.calendar"></calendar-row>
                    </tbody>
                </table>
            </div>
            <div class="table-navigation">
                <div class="table-navigation__next">
                    <span class="table-navigation__text">Total:</span>
                    <span>{{$store.state.totalHours}}</span>
                </div>
            </div>
        </section>
    </div>

</template>
<script>
    import moment from "moment"
    import CalendarWeekdays from './CalendarWeekdays'
    import CalendarRow from './CalendarRow'
    export default {
        data() {
            return {
                firstDay: this.daysInMonth,
                today: moment(),
                dateContext: moment(),
                getDate: [],
                startDate: null,
                endDate: null,
                lastDay: null,
            }
        },
        components: {
            CalendarWeekdays,
            CalendarRow,
        },
        computed: {
            year() {
			return moment(this.day).format('YYYY');
		    },
            month() {
                return this.dateContext.format('MMMM');
            },
            daysInMonth() {
                return this.dateContext.daysInMonth();
            },
            currentDate() {
                return this.dateContext.get('date');
            },
            firstDayOfMonth() {
                return moment([this.dateContext.format('Y'),this.dateContext.format('M')-1]).clone().startOf('month');
            },
            lastDayOfMonth() {
                return moment([this.dateContext.format('Y'),this.dateContext.format('M')-1]).clone().endOf('month');
            },
            initialDate() {
                return this.today.get('date');
            },
            initialMonth() {
                return this.today.format('MMMM');
            },
            initialYear() {
                return this.today.format('YYYY');
            },
        },
        created() {
            this.calculateCalendar();
        },
        methods: {
            previousMonth: function() {
                this.dateContext = moment(this.dateContext).subtract(1, 'month');
                this.calculateCalendar();
            },
            nextMonth: function() {
                this.dateContext = moment(this.dateContext).add(1, 'month');
                this.calculateCalendar();
            },
            calculateCalendar: function() {
                const calendarArr = []
                this.startDate = moment([this.dateContext.format('Y'),this.dateContext.format('M')-1])
                .clone()
                .startOf('month')
                .startOf('isoWeek');
                this.endDate = moment([this.dateContext.format('Y'),this.dateContext.format('M')-1]).clone().endOf('month').endOf('week');
                const day = this.startDate.clone().subtract(1,'days')
                while(day.isBefore(this.endDate,"day")) {
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
                this.getDate = calendarArr;
                this.lastDay = calendarArr[5][6]
                this.$store.commit('setStartDate',this.startDate)
                this.$store.commit('setEndDate',this.lastDay)
            },
        },
        watch: {
            startDate: {
                handler(){
                    if(this.startDate) {
                        this.$store.dispatch('calendarLogs')
                    }
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>
