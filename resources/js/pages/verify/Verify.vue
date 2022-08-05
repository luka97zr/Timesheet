<template>
    <div class="center-text">
        <h3 class="text-justify">{{text}}</h3>
    </div>
</template>

<script>
export default {
    data() {
        return {
            text: 'You will be redirected soon...'
        }
    },
    created() {
        this.verifyToken();
    },
    methods: {
        async verifyToken() {
            try {
                await axios.get(`/api/verify${window.location.search}`)
            } catch(error) {
                this.text = error.response
            }
        }
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