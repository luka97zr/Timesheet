<template>
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
                                <a href="./index.html" class="btn navigation__button navigation__button--active">Timesheet</a>
                            </li>
                            <li class="navigation__list">
                                <a href="./clients.html" class="btn navigation__button">Clients</a>
                            </li>
                            <li class="navigation__list">
                                <a href="./projects.html" class="btn navigation__button">Projects</a>
                            </li>
                            <li class="navigation__list">
                                <a href="./categories.html" class="btn navigation__button">Categories</a>
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
                            <h2 class="user__name">{{userName}}</h2>
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
            <router-view></router-view>
            <footer>
            <div class="wrapper-narrow">
                <ul>
                    <li>
                        <span>©Vega IT Sourcing 2021. All rights reserved.</span>
                    </li>
                </ul>
            </div>
        </footer>
    </div>
</template>
<script>

export default {
    computed: {
        userName() {
            return this.$store.state.user.name
        }
    }
}
</script>
