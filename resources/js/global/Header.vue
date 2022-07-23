<template>
    <header class="header">
        <div class="inner-wrap">
            <router-link to="/" class="logo">
                <img src="images/logo/logo-white.png" alt="">
            </router-link>
            <nav class="navigation">
                <button id="navigation__link" type="button" class="navigation__link"><span id="navigation__text" class="nav-toggle"></span></button>
                <ul class="navigation__menu">
                    <li class="navigation__list">
                        <router-link to="/" class="btn navigation__button">Timesheet</router-link>
                    </li>
                    <li class="navigation__list">
                        <router-link to="/clients" class="btn navigation__button">Clients</router-link>
                    </li>
                    <li class="navigation__list">
                        <router-link to="/projects" class="btn navigation__button">Projects</router-link>
                    </li>
                    <li class="navigation__list">
                        <router-link to="/categories" class="btn navigation__button">Categories</router-link>
                    </li>
                    <li class="navigation__list">
                        <router-link to="/employees" class="btn navigation__button">Employees</router-link>
                    </li>
                    <li class="navigation__list">
                        <router-link to="/reports" class="btn navigation__button">Reports</router-link>
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
                        <router-link :to="{name: 'login'}" class="logout__link" @click.native.prevent="logout">Logout</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    computed: {
        userName() {
            return this.$store.state.user.name
        },
        userId() {
            return this.$store.state.user.id;
        }
        
    },
    methods: {
        async logout() {
            try {
                // axios.get('/api/logout');
                // this.$store.dispatch('logout')
            } catch(error) {

            }
        }
    }
}
</script>

<style>

</style>