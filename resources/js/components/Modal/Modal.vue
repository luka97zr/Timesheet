<template>
    <div class="modal">
        <div class="modal__content">
            <h2 class="heading">Create new {{name}}</h2>
            <a href="javascript:;" class="modal__close">
            <span class="modal__icon"></span>
            </a>
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: ['name']
}
</script>

<style>

</style>