<template>

</template>

<script>
export default {
    methods: {
        async logOut() {
            try {
                await axios.get('/api/logout');
                localStorage.removeItem('user');
                this.$router.push({name: 'login'});
                this.$store.commit('setLoggedIn', false);
            }catch(error) {
                console.log(error);
            }
        }
    },
    created() {
        this.logOut();
    }
}
</script>

<style>

</style>