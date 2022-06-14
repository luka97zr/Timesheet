<template>
  	<div class="wrapper">
		<section class="content">
			<form id="mainContent" class="main-content" action="javascript">
				<h2 class="main-content__title">Timesheet</h2>
				<div class="table-navigation">
					<a href="javascript:;" class="table-navigation__prev" @click="prevWeek"><span>previous week</span></a>
					<span class="table-navigation__center">{{getDay}} - {{endDate}}, {{year}} ({{getWeek}} week)</span>
					<a href="javascript:;" class="table-navigation__next" @click="nextWeek"><span>next week</span></a>
				</div>
				<week-label :day="day" :whole-week="weekdays" :year="year"></week-label>
				<table class="project-table">
					<thead>
						<project-head></project-head>
					</thead>
					<tbody>
						<project-label ref="projectlabel"></project-label>
					</tbody>
				</table>
				<div class="table-navigation">
					<router-link to="/" class="table-navigation__prev"><span>back to monthly view</span></router-link>
					<div class="table-navigation__next">
						<span class="table-navigation__text">Total:</span>
						<span>7.5</span>
					</div>
				</div>
				<div class="btn-wrap">
					<button href="javascript:;" class="btn btn--green" @click.prevent="saveData()"><span>Save changes</span></button>
				</div>
			</form>
		</section>
	</div>
</template>

<script>
import moment from 'moment'
import WeekLabel from './WeekLabel.vue'
import ProjectLabel from './ProjectLabel.vue'
import ProjectHead from './ProjectHead.vue'
export default {
	data() {
		return {
			day: moment(this.$route.params.day).format('DD MMMM'),
			dayYearFormat: moment(this.$route.params.day),
			endDay: moment(this.$route.params.day).add(7,'days'),
			weekdays: [],
			category: 1,
			description: null,
			user_id: 1,
			category_id:1,
			hours: null,
		}
	},
	components: {
		WeekLabel,
		ProjectLabel,
		ProjectHead
	},
	computed: {
		getWeek() {
			return moment(this.day).week()
		},
		endDate() {
			return  moment(this.day).add(1,'week').format('DD MMMM')
		},
		year() {
			return moment(this.dayYearFormat).year();
		},
		getDay() {
			return  moment(this.day).format('DD MMM')
		},
		userId() {
			return this.$store.state.user.id;
		},
		test() {
			console.log(localStorage.getItem('isLoggedIn'))
		}

	},
	created() {
		this.getWholeWeek();
		this.projectsData();
	},
	methods: {
        nextWeek() {
            this.day = moment(this.day).add(1,'week').format('DD MMMM')
			this.dayYearFormat = moment(this.dayYearFormat).add(1,'week');
			this.endDay =  moment(this.dayYearFormat).add(7,'day');
			this.getWholeWeek();
        },
		prevWeek() {
			this.day = moment(this.day).subtract(1,'week').format('DD MMMM')
			this.dayYearFormat = moment(this.dayYearFormat).subtract(1,'week');
			this.endDay =  moment(this.dayYearFormat).add(1,'week');
			this.getWholeWeek();
		},
		getWholeWeek() {
            const now = this.dayYearFormat.clone();
            const dates = [];

				while( now.isSameOrBefore(this.endDay)) {
					dates.push(now.format('YYYY-MMMM-DD'));
					now.add(1,'days')
					this.weekdays = dates;
				}
            this.weekdays = dates;
        },
		saveData() {
			console.log(this.$refs.projectlabel.description),
			console.log( this.$route.params.day)
			axios.post('/api/logs',{
				date: this.$route.params.day,
				description: this.$refs.projectlabel.description,
				user_id: this.userId,
				category_id:1,
				hours:this.$refs.projectlabel.hours+this.$refs.projectlabel.overtime,
			}).then(response=>{
				this.$refs.projectlabel.description = this.$refs.projectlabel.hours = this.$refs.projectlabel.overtime = null
				console.log(response)
			})
		},
		projectsData() {
			axios.get(`/api/usersprojects/1`).then(response => console.log(response));
		}

    }

}
</script>

<style>

</style>