<template>
  	<div class="wrapper">
		<section class="content">
			<form id="mainContent" class="main-content" action="javascript">
				<h2 class="main-content__title">Timesheet</h2>
				<div class="table-navigation">
					<a href="javascript:;" class="table-navigation__prev" @click.prevent="prevWeek"><span>previous week</span></a>
					<span class="table-navigation__center">{{getDay}} - {{endDate}}, {{year}} ({{getWeek}} week)</span>
					<a href="javascript:;" class="table-navigation__next" @click.prevent="nextWeek"><span>next week</span></a>
				</div>
				<week-label :day="day" :whole-week="weekdays" :year="year"></week-label>
				<table class="project-table">
					<thead>
						<project-head></project-head>
					</thead>
					<tbody>
						<project-label ref="projectlabel" :errors="errorData"></project-label>
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
					<button type="submit" class="btn btn--green" @click.prevent="saveData()"><span>Save changes</span></button>
				</div>
			</form>
		</section>
		<div class="msg msg-success" v-if="success">Data Successfuly saved</div>
		<div class="msg msg-error" v-if="error">Error occured</div>
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
			description: null,
			category_id:1,
			hours: null,
			success: null,
			error:null,
			errorData: null
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
	},
	created() {
		this.getWholeWeek();
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
            const now = moment(this.dayYearFormat.clone()).startOf('isoWeek');
			const end = moment(this.dayYearFormat.clone()).endOf('isoWeek')
            const dates = [];

				while( now.isSameOrBefore(end)) {
					dates.push(now.format('YYYY-MMMM-DD'));
					now.add(1,'days')
					this.weekdays = dates;
				}
            this.weekdays = dates;
        },
		clearInputFields() {
			this.$refs.projectlabel.description = this.$refs.projectlabel.hours = this.$refs.projectlabel.overtime = this.$refs.projectlabel.client = this.$refs.projectlabel.project = this.$refs.projectlabel.category = null

		},
		renderError(field) {
			(this.errorData)? this.errorData[field] : null;
		},
		saveData() {
			this.success = null
			this.error = null
			axios.post('/api/logs',{
				date: this.$route.params.day,
				description: this.$refs.projectlabel.description,
				user_id: this.userId,
				category_id:this.$refs.projectlabel.category,
				hours:this.$refs.projectlabel.hours+this.$refs.projectlabel.overtime,
			}).then(response=>{
				console.log()
				this.clearInputFields();
				if(response.status === 200){
					 this.success = true
					setTimeout(()=> this.success = false, 2000)
				}
			}).catch(error => {
				this.errorData=error.response.data.errors
				this.error=true
				setTimeout(()=> this.error = false, 2000)
			})

		},
    },

}
</script>

<style scoped>
	.msg {
		position: fixed;
		bottom: 5%;
		right: 0;
		font-size: 18px;
		padding: 10px;
		border-radius: 12px;
		color: white;
	}
	.msg-error {
		background: red;

	}
	.msg-success {
		background: green;

	}
	.is-disabled {
		opacity: .8;
		cursor: not-allowed;
	}
</style>