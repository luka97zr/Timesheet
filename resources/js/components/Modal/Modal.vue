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
    methods: {

    }

}
</script>

<style>

</style>