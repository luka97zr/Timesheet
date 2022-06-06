<template>
  <div class="wrapper">
			<section class="content">
				<form id="mainContent" class="main-content" action="javascript">
					<h2 class="main-content__title">Timesheet</h2>
					<div class="table-navigation">
						<a href="javascript:;" class="table-navigation__prev"><span>previous week</span></a>
						<span class="table-navigation__center">September 06 - September 12, 2021 (week 36)</span>
						<a href="javascript:;" class="table-navigation__next"><span>next week</span></a>
					</div>
					<week-label></week-label>
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
import WeekLabel from './WeekLabel.vue'
export default {
	components: {
		WeekLabel
	},
	created() {
		console.log(this.$route.params.day);
	}
}
</script>

<style>

</style>