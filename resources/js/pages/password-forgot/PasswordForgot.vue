<template>
    <div class="container">
		<header class="header">
			<div class="inner-wrap">
				<a href="/" class="logo">
				<img :src="Logo" alt="">
				</a>
			</div>
		</header>
		<div class="initial-form">
			<div class="wrapper">
				<div class="main-content">
					<h1 class="main-content__title">Forgot password</h1>
					<form>
						<ul class="info__form">
							<li class="info__list">
								<label class="info__label">Email:</label>
								<input type="text" class="in-text" v-model="email">
							</li>
						</ul>
						<div class="btn-wrap">
                            <v-btn
                                color="primary"
                                :disabled="isValid"
                                elevation="2"
                                @click.prevent="submit()"
                                :loading="loading"
                                >
                                Reset password
                            </v-btn>
						</div>
                        <div v-if="errors">
                            <ul>
                                <li v-for="(error, index) in errors.email" :key="index" class="error-item"><span class="invalid">{{error}}</span></li>
                            </ul>
                        </div>
					</form>
                    <alert v-if="success" :message="'Password reset link sent successfuly'"></alert>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import Logo from '../../../images/logo/logo-white.png'
import Alert from '../../components/vuetify/Alert.vue'
export default {
    components: {
        Alert
    },
    data() {
        return {
            Logo,
            email: null,
            errors: null,
            success: false,
            loading: false
        }
    },
    computed: {
        isValid() {
            return (!this.email)? true : false
        }
    },
    methods: {
        async submit() {
            try {
                this.errors = null;
                this.success = false;
                this.loading = true;
                await axios.post('/api/password/forgot', {
                    email: this.email
                });
                this.success=true;
                this.loading = false;
                this.email = null;
                setTimeout(() => {
                    this.success=false;
                }, 1500);
            }catch(error) {
                this.errors = error.response.data.errors
                this.loading = false;
            }
        }
    }
}
</script>

<style>

</style>