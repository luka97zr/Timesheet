<template>
  <div class="container">
		<div class="initial-form">
			<div class="wrapper">
				<div class="main-content">
					<h1 class="main-content__title">Login</h1>
					<form action="index.html">
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
				this.loading = true;
				this.errors = null;
				const data = await axios.post('/api/login',{
					email: this.email,
                    password: this.password
                });
				localStorage.setItem('user', JSON.stringify(data.data.user));
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
		},
		getCookie(name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for(var i=0;i < ca.length;i++) {
				var c = ca[i];
				while (c.charAt(0)==' ') c = c.substring(1,c.length);
				if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			}
			return null;
		}

    }
}
</script>

<style scoped>
 .invalid {
	color: red;
 }
</style>