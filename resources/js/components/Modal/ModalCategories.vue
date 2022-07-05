<template>
    <Modal :showModal="showModal">
        <div class="modal__content">
            <h2 class="heading">Create new category</h2>
            <a href="#" class="modal__close" @click.prevent="closeModal()">
                <span class="modal__icon"></span>
            </a>
            <form class="info" action="javascript:;" >
                <ul class="info__form">
                    <li class="info__list">
                        <label class="info__label">Category name:</label>
                        <input type="text" class="in-text">
                    </li>
                </ul>
                <div class="btn-wrap">
                    <button type="submit" class="btn btn--green"><span>Save changes</span></button>
                    <button type="button" class="btn btn--red"><span>Delete</span></button>
                </div>
            </form>
        </div>
    </Modal>
</template>

<script>
import Modal from './Modal.vue'
export default {
  components: { Modal },
    props: ['showModal'],
    methods: {
        closeModal() {
            this.$emit('closeModal')
        }
    }
}
</script>

<style>

</style>