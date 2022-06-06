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
					<week-label :day="day"></week-label>
					<table class="project-table">
						<thead>
							<tr class="project-table__top">
								<th class="project-table__title">Client *</th>
								<th class="project-table__title">Project *</th>
								<th class="project-table__title">Category *</th>
								<th class="project-table__title project-table__title--large">Description</th>
								<th class="project-table__title project-table__title--small">Hours *</th>
								<th class="project-table__title project-table__title--small">Overtime</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="project-table__name">
									<select class="project-table__select">
										<option>Choose client</option>
										<option>Client name 1</option>
										<option>Client name 2</option>
										<option>Client name 3</option>
										<option>Client name 4</option>
									</select>
								</td>
								<td class="project-table__name">
									<select class="project-table__select">
										<option value="">Choose project</option>
										<option value="">Choose category</option>
									</select>
								</td>
								<td class="project-table__name">
									<select class="project-table__select">
										<option value="">Choose category</option>
										<option value="">Choose category</option>
									</select>
									<span class="validationMessage" style="display: none;"></span>
								</td>
								<td class="project-table__name">
									<input type="text" class="in-text medium">
								</td>
								<td class="project-table__name">
									<input type="text" class="in-text">
								</td>
								<td class="project-table__name">
									<input type="text" class="in-text">
								</td>
							</tr>
							<tr>
								<td class="project-table__name">
									<select class="project-table__select">
										<option>Choose client</option>
										<option>Client name 1</option>
										<option>Client name 2</option>
										<option>Client name 3</option>
										<option>Client name 4</option>
									</select>
								</td>
								<td class="project-table__name">
									<select class="project-table__select">
										<option value="">Choose project</option>
										<option value="">Choose category</option>
									</select>
								</td>
								<td class="project-table__name">
									<select class="project-table__select">
										<option value="">Choose category</option>
										<option value="">Choose category2</option>
									</select>
									<span class="validationMessage" style="display: none;"></span>
								</td>
								<td class="project-table__name">
									<input type="text" class="in-text medium">
								</td>
								<td class="project-table__name">
									<input type="text" class="in-text">
								</td>
								<td class="project-table__name">
									<input type="text" class="in-text">
								</td>
							</tr>
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
						<button type="submit" class="btn btn--green"><span>Save changes</span></button>
					</div>
				</form>
			</section>
		</div>
</template>

<script>
import moment from 'moment'
import WeekLabel from './WeekLabel.vue'
export default {
	data() {
		return {
			day: moment(this.$route.params.day).format('DD MMMM'),
			dayYearFormat: moment(this.$route.params.day)
		}
	},
	components: {
		WeekLabel
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
			return  moment(this.$route.params.day).format('DD MMM')
		}
	},
	created() {
		console.log(this.day)
	},
	methods: {
        nextWeek() {
            this.day = moment(this.day).add(1,'week').format('DD MMMM')
			this.dayYearFormat = moment(this.dayYearFormat).add(1,'week');
        },
		prevWeek() {
			this.day = moment(this.day).subtract(1,'week').format('DD MMMM')
			this.dayYearFormat = moment(this.dayYearFormat).subtract(1,'week');
		}
    }

}
</script>

<style>

</style>