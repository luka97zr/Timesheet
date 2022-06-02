<template>
    <div class="wrapper">
        <section class="main-content">
            <h2 class="main-content__title">Timesheet</h2>
            <div class="table-navigation">
                <a href="javascript:;" class="table-navigation__prev" @click="previousMonth"><span>previous month</span></a>
                    <span class="table-navigation__center">{{this.thisMonthWord}}</span>
                <a href="javascript:;" class="table-navigation__next" @click="nextMonth"><span>next month</span></a>
            </div>
            <div class="table-wrapper">
                <table class="month-table">
                    <calendar-week ></calendar-week>
                    <tbody>
                        <calendar-row v-for="(week, index) in calendar" :key="'week' + index" :week="week"></calendar-row>
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
    import CalendarWeek from './CalendarWeek'
    import CalendarMonth from './CalendarMonth'
    import CalendarRow from './CalendarRow'
    import calendar from './../_partials/_calendar'
    export default {
        data() {
            return {
                calendar: [],
                thisMonth: new Date().getMonth(),
                today:moment().format("D"),
                thisYear:moment().format("YYYY"),
                counter: 1,
                lastDay: parseInt(moment().endOf('month').format('D')),
                thisMonthWord: moment(this.thisMonth,'M').format("MMMM"),

            }
        },
        components: {
            CalendarWeek,
            CalendarMonth,
            CalendarRow,
        },
       created() {
            this.calendar = calendar.getDate(this.thisYear,this.thisMonth);
           this.thisMonthWord=moment(this.thisMonth,'M').format("MMMM")
       },
        methods: {
            previousMonth: function() {
            this.counter--
            this.thisMonth = moment().add(this.counter, 'months').format('M');
            this.lastDay =  parseInt(moment().add(this.counter, 'months').endOf('month').format('D'));
            this.thisYear = moment().add(this.counter, 'months').format("YYYY");
            this.calendar = calendar.getDate(this.thisYear,this.thisMonth);

                console.log(this.thisMonth)
            },
            nextMonth: function() {
            this.counter++
            this.thisMonth = moment().add(this.counter, 'months').format('MMMM');
            this.lastDay =  parseInt(moment().add(this.counter, 'months').endOf('month').format('D'));
            this.thisYear = moment().add(this.counter, 'months').format("YYYY");
            this.firstWeekDay= moment().add(this.counter, 'months').startOf('month').format("dddd");
            this.calendar = calendar.getDate(this.thisYear,this.thisMonth);

            }
        }

    }
   </script>

