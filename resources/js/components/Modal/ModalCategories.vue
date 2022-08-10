<template>
    <Modal :showModal="showModal">
        <div class="modal__content">
            <h2 class="heading">Create new category</h2>
            <a href="#" class="modal__close" @click="closeModal()">
                <span class="modal__icon"></span>
            </a>
            <form class="info" action="javascript:;" >
                <ul class="info__form">
                    <li class="info__list">
                        <label class="info__label">Category name:</label>
                        <input type="text" class="in-text" v-model="categoryName">
                        <div v-if="errors.name" class="invalid-feedback">{{errors.name[0]}}</div>
                    </li>
                </ul>
                <div class="btn-wrap">
                    <button type="submit" class="btn btn--green" @click="createCategory()"><span>Save changes</span></button>
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
    data() {
        return {
            errors: [],
            categoryName: null,
        }
    },
    methods: {
        closeModal() {
            this.$emit('closeModal')
        },
        async createCategory() {
          try {
              this.errors = [];
              await axios.post('/api/category', {
                  name: this.categoryName
              })
            this.$emit('closeModal')
            this.$emit('resend');
            this.clearForm();
          } catch(error) {
              this.errors = error.response.data.errors
          }
        },
        clearForm() {
            this.categoryName=null
        }
    }
}
</script>

<style>

</style>