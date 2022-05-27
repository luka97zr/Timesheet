<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
						<tbody>
							<tr class="">
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span >30</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day"><span>Hours: </span><span>7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>31</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>1</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>2</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>3</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>4</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>5</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
							</tr>
							<tr>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>6</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>7</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>8</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>9</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>10</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>11</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>12</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
							</tr>
							<tr>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>13</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>14</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>15</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>16</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>17</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>18</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>19</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
							</tr>
							<tr>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>20</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>21</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>22</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>23</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>24</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>25</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>26</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
							</tr>
							<tr>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>27</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular">
									<div class="month-table__date">
										<span>28</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">7.5</span>
										</a>
									</div>
								</td>
								<td class="negative">
									<div class="month-table__date">
										<span>29</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">5</span>
										</a>
									</div>
								</td>
								<td class="current- month-table__day">
									<div class="month-table__date">
										<span>30</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>1</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>2</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>3</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
							</tr>
							<tr>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>4</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>5</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>6</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>7</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>8</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>9</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
								<td class="month-table__regular month-table__regular--disabled">
									<div class="month-table__date">
										<span>10</span>
										<i></i>
									</div>
									<div class="month-table__hours">
										<a href="./days.html" class=" month-table__day">
										<span>Hours: </span><span class="">0</span>
										</a>
									</div>
								</td>
							</tr>
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
