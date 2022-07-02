<template>
  	<div class="wrapper">
		<section class="content">
			<form id="mainContent" class="main-content" action="javascript">
				<h2 class="main-content__title">Timesheet</h2>
				<div class="table-navigation">
					<router-link :to="prevDateRoute" class="table-navigation__prev" @click.native="prevWeek"><span>previous week</span></router-link>
					<span class="table-navigation__center">{{getDay}} - {{endDate}}, {{year}} ({{getWeek}} week)</span>
					<router-link :to="nextDateRoute" class="table-navigation__next" @click.native="nextWeek"><span>next week</span></router-link>
				</div>
				<week-label :day="dayRoute" :whole-week="weekdays" :year="year" :hour="total" ref="weeklabel"></week-label>
				<table class="project-table">
					<thead>
						<project-head></project-head>
					</thead>
					<tbody>
						<project-label v-for="(row,index) in numberOfRows" :key="index" :ref="'projectlabel'" :errors="errorData" :userProjectData="userProjectData" :log="logData[index]
						"></project-label>
					</tbody>
				</table>
				<div class="table-navigation">
					<router-link to="/" class="table-navigation__prev"><span>back to monthly view</span></router-link>
					<div class="table-navigation__next">
						<span class="table-navigation__text">Total:</span>
						<span>{{total}}</span>
					</div>
				</div>
				<div class="btn-wrap">
					<button type="submit" class="btn btn--green" @click.prevent="saveData()"><span>Save changes</span></button>
				</div>
			</form>
		</section>
		<div class="msg msg-success" v-if="success">Data Successfuly saved</div>
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
			dayYearFormat: moment(this.$route.params.day),
			weekdays: [],
			description: null,
			category_id:1,
			hours: null,
			success: null,
			errorData: null,
			log: null,
			numberOfRows: 10,
			projectObject: [],
			userProjectData: [],
			logData: [],
			total: 0
		}
	},
	components: {
		WeekLabel,
		ProjectLabel,
		ProjectHead
	},
	computed: {
		getWeek() {
			return moment(this.dayRoute).week()
		},
		endDate() {
			return  moment(this.dayRoute).add(1,'week').format('DD MMMM')
		},
		year() {
			return moment(this.dayRoute).year();
		},
		getDay() {
			return  moment(this.dayRoute).format('DD MMM')
		},
		userId() {
			return this.$store.state.user.id;
		},
		dayRoute() {
			return this.$route.params.day
		},
		nextDateRoute() {
			return moment(this.dayRoute).add(7,'days').format('YYYY-MM-DD')
		},
		prevDateRoute() {
			return moment(this.dayRoute).subtract(7,'days').format('YYYY-MM-DD')
		},
		firstDayOfWeek() {
			return this.weekdays[0];
		}
	},
	created() {
		this.getWholeWeek()
		this.checkCalendar()
	},
	methods: {
        nextWeek() {
			this.getWholeWeek();
			this.$refs.weeklabel.asignDate();
        },
		prevWeek() {
			this.getWholeWeek();
			this.$refs.weeklabel.asignDate();

		},
		getWholeWeek() {
            let now = moment(this.dayRoute).clone().startOf('isoWeek');
			let end = moment(this.dayRoute).clone().endOf('isoWeek')
            const dates = [];

				while( now.isSameOrBefore(end)) {
					dates.push(now.format('YYYY-MMMM-DD'));
					now.add(1,'days')
					this.weekdays = dates;
				}
            this.weekdays = dates;
        },
		saveData() {
			this.validateFields()
			this.success = null
			this.error = null
			if (this.projectObject)
				axios.post('/api/logs',{
					data: this.projectObject
				}).then(response=>{
					if(response.status === 200){
						this.success = true
						this.$router.push({name:'home'})
						setTimeout(()=> this.success = false, 2000)
					}
				}).catch(error => {
					this.errorData=error.response.data.message
				})
		},
		validateFields() {
			this.projectObject = [];
			for(let i = 1; i< this.numberOfRows; i++) {
				Object.values(this.$refs.projectlabel).forEach((row,index) => {
				if(row.project && row.category && row.client && row.hours)
					this.projectObject[index] = {
						date: this.$route.params.day,
						description: row.description,
						user_id: this.userId,
						category_id: row.category,
						hours: row.hours + row.overtime
					}

			});
			}
		},
		async getUserProjectData() {
		    const response = await axios.get(`/api/projects/${this.userId}`);
            this.userProjectData = response.data;
		},
		async getDayLog() {
			try {
				const response = await axios.get(`/api/logs/${moment(this.dayRoute).format('YYYY-MM-DD')}`)
				this.logData = response.data
				this.totalHours()
			} catch(err) {
				console.log(err)
			}
		},
		checkCalendar() {
			if (!this.$store.state.calendar || !moment(this.dayRoute).isBetween(this.$store.state.startDate, this.$store.state.endDate)) {
				console.log(this.weekdays)
				this.$store.commit('setStartDate',moment(this.weekdays[0]).format('YYYY-MM-DD'));
                this.$store.commit('setEndDate', moment(this.weekdays[6]).format('YYYY-MM-DD'));
            	this.$store.dispatch('calendarLogs');

			}
		},
		totalHours() {
			this.total = 0;
			this.logData?.forEach(log => {
				 this.total += log.hours;
			})
		},
    },
	watch: {
		userId: {
            handler() {
                this.getUserProjectData();
            },
            immediate:true
        },
		dayRoute: {
			handler() {
				this.getDayLog()
				this.checkCalendar()
			},
			immediate: true
		}
	}
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