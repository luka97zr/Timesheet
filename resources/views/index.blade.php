<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body class="antialiased">
        <x-layout>
        <div class="wrapper">
			<section class="main-content">
				<h2 class="main-content__title">Timesheet</h2>
				<x-table.table-navigation />
				<div class="table-wrapper">
					<table class="month-table">
						<thead>
							<tr>
								<th class="month-table__days">Monday</th>
								<th class="month-table__days">Tuesday</th>
								<th class="month-table__days">Wednesday</th>
								<th class="month-table__days">Thursday</th>
								<th class="month-table__days">Friday</th>
								<th class="month-table__days">Saturday</th>
								<th class="month-table__days">Sunday</th>
							</tr>
						</thead>
						<tbody class="table-body">
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
	</div>
        </x-layout>
    </body>
</html>
