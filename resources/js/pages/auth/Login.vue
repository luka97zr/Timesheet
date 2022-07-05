<template>
  <div class="container">
		<div class="initial-form">
			<div class="wrapper">
				<div class="main-content">
					<h1 class="main-content__title">Login</h1>
					<form class="info" action="index.html">
						<ul class="info__form">
							<li class="info__list">
								<label class="info__label">Email:</label>
								<input type="text" class="in-text" v-model="email">
							</li>
							<li class="info__list">
								<label class="report__label">Password:</label>
								<input type="password" class="in-text" v-model="password">
							</li>
						</ul>
						<div class="invalid-feedback" v-if="errors">{{errors}}</div>
						<div class="btn-wrap">
							<label class="initial-form__checkbox"><input type="checkbox" name="remember-me">Remember me</label>
							<a href="./forgot-password.html" class="btn btn--transparent"><span>Forgot password</span></a>
							<button type="submit" class="btn btn--green" :disabled="loading" @click.prevent="login"><span>Login</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    data() {
        return {
            email: null,
            password: null,
            loading: false,
            errors: null
        }
    },
    methods: {
        async login() {
            this.loading = true;
            this.errors = null;

            try {
                await axios.get('/sanctum/csrf-cookie');
                 await axios.post('/login',{
                    email: this.email,
                    password: this.password
                });
            	localStorage.setItem('isLoggedIn', true)
				await this.$store.dispatch('loadUser');
				this.$router.push({name: 'home'});

            } catch(error) {
                    this.errors = error.response?.data.message
            }

            this.loading = false
        }
    }
}
</script>

<style scoped>
 .invalid-feedback {
	color: red;
 }
</style>