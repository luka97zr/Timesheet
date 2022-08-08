<template>
    <div>
        <div class="center-text">
            <h3 class="text-justify">{{text}}</h3>
        </div>
        <Modal :class="{'modal--show' : showModal}">
            <h6>Enter your password</h6>
            <input type="password" placeholder="password" v-model="password">
            <input type="password" placeholder="retype password" v-model="retypePassword">
            <button type="submit" @click="createUser()">Submit</button>
        </Modal>
    </div>
</template>

<script>
export default {
    data() {
        return {
            text: 'You will be redirected soon...',
            showModal: false,
            password: null,
            retypePassword: null,
            userData: null
        }
    },
    created() {
        this.verifyToken();
    },
    methods: {
        getQueryParams(param) {
            return new URLSearchParams(window.location.search).get(param)
        },
        async verifyToken() {
            try {
                const userData = await axios.get(`/api/verify${window.location.search}`)
                this.userData = userData.data;
                this.text = '';
                this.showModal = true;
            } catch(error) {
                this.text = error.response.data.message
            }
        },
        async createUser() {
            try {
                if(this.password !== this.retypePassword) throw new Error('Passwords do not match')
                await axios.post(`/api/verify/user/create`, {
                    uuid: this.getQueryParams('uuid'),
                    token: this.getQueryParams('token'),
                    password: this.password
                })
                this.login()
            } catch(error) {
                alert(error.message)
            }
        },
        async login() {
			try {
				this.loading = true;
				this.errors = null;
				const data = await axios.post('/api/login',{
					email: this.userData.email,
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
    }
}
</script>

<style scoped>
.center-text {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}
</style>