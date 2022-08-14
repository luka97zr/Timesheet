<template>
    <div class="modal" :class="{'modal--show':showModal}" >
        <div class="modal__content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: ['showModal'],
    created() {
        this.checkCountries();
    },
    methods: {
        checkCountries() {
            if (this.$store.state.countries.length <= 0 && this.$route.path !== '/verify') this.$store.dispatch('getCountries');
        }
    },

}
</script>

<style>
.invalid {
    color: red;
}

</style>