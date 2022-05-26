<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="format-detection" content="telephone=no">
		<meta charset="utf-8">
		<meta name="description" content="">
		<link href="/favicon.ico" rel="icon" />
		<!-- main css file -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="{{ URL::asset('dist/style.css') }}">
		<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<!-- global js file -->
		<script defer src="{{ URL::asset('dist/global.js') }}"></script>
		<title>Timesheet</title>
		<link href="favicon.ico" rel="icon" />
	</head>
	<body>
		<div class="container">
			<header class="header">
				<div class="inner-wrap">
					<a href="./index.html" class="logo">
					<img src="images/logo/logo-white.png" alt="">
					</a>
					<nav class="navigation">
						<button id="navigation__link" type="button" class="navigation__link"><span id="navigation__text" class="nav-toggle"></span></button>
						<ul class="navigation__menu">
							<li class="navigation__list">
								<a href="./index.html" class="btn navigation__button">Timesheet</a>
							</li>
							<li class="navigation__list">
								<a href="./clients.html" class="btn navigation__button">Clients</a>
							</li>
							<li class="navigation__list">
								<a href="./projects.html" class="btn navigation__button">Projects</a>
							</li>
							<li class="navigation__list">
								<a href="./categories.html" class="btn navigation__button navigation__button--active">Categories</a>
							</li>
							<li class="navigation__list">
								<a href="./employees.html" class="btn navigation__button">Employees</a>
							</li>
							<li class="navigation__list">
								<a href="./reports.html" class="btn navigation__button">Reports</a>
							</li>
						</ul>
					</nav>
					<div class="user">
						<div class="user__nav">
							<h2 class="user__name">Ognjen Adamović</h2>
							<ul class="user__dropdown">
								<li class="user__list"><a class="user__link" href="javascript:;">Change password</a></li>
								<li class="user__list"><a class="user__link" href="javascript:;">Settings</a></li>
								<li class="user__list"><a class="user__link" href="javascript:;">Export all data</a></li>
							</ul>
						</div>
						<ul>
							<li class="logout">
								<a class="logout__link" href="javascript:;">Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</header>
            {{$slot}}

            <footer>
                <div class="wrapper-narrow">
                    <ul>
                        <li>
                            <span>©Vega IT Sourcing 2021. All rights reserved.</span>
                        </li>
                    </ul>
                </div>
            </footer>
        </body>
    </html>