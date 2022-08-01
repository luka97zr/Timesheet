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
						<div class="invalid" v-if="errors">{{errors}}</div>
						<div class="btn-wrap">
							<label class="initial-form__checkbox"><input type="checkbox" name="remember-me">Remember me</label>
							<a href="./forgot-password.html" class="btn btn--transparent"><span>Forgot password</span></a>
							<button type="submit" class="btn btn--green" :disabled="loading" @click="login()"><span>Login</span></button>
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
            errors: null,
			pending: false
        }
    },
    methods: {
        async login() {
			try {
				this.$store.commit('setGettingToken', true)
				this.loading = true;
				this.errors = null;
				const data = await axios.post('/api/login',{
					email: this.email,
                    password: this.password
                });
				console.log(this.parseJwt(data.data.token));
				localStorage.setItem('jwt', data.data.token);
            	axios.defaults.headers.common['Authorization'] = `Bearer ${data.data.token}`;
				// await this.$store.dispatch('loadUser');
				this.$store.commit('setLoggedIn', true);
				await this.$router.push({name: 'home'})
            } catch(error) {
                this.errors = error.response?.data.message
            }
            this.loading = false
        },
		parseJwt(token) {
			if (!token) {
			return;
			}
			const base64Url = token.split(".")[1];
			const base64 = base64Url.replace("-", "+").replace("_", "/");
			const {email, name, role} = JSON.parse(window.atob(base64));
			const user = {
				email : email,
				role: role,
				name: name
			}
			localStorage.setItem('user', JSON.stringify(user));
		}

    }
}
</script>

<style scoped>
 .invalid {
	color: red;
 }
</style>