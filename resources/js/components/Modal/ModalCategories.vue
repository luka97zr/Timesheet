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
                    </li>
                </ul>
                <div v-if="errors">
                    <ul>
                        <li v-for="(error, index) in errors" :key="index" class="error-item"><span class="invalid">{{error[0]}}</span></li>
                    </ul>
                </div>
                <div class="btn-wrap">
                    <button type="submit" class="btn btn--green" @click="createCategory()" :disabled="isValidated"><span>Save changes</span></button>
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
    computed: {
        isValidated() {
            return (this.categoryName)? false : true;
        },
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
            this.$emit('created');
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