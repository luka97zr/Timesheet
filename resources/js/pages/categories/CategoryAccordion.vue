<template>
    <div class="accordion" @click="openAccordion()">
        <div class="accordion__intro">
            <h4 class="accordion__title">{{category.name}}</h4>
        </div>
        <form class="accordion__content" action="javascript:;" :class="{'accorion-open' : isOpened}" @click="openAccordion()">
            <div>
                <div class="info__form">
                    <ul class="info__wrapper">
                        <li class="info__list">
                            <label class="info__label">Category name:</label>
                            <input type="text" class="in-text" v-model="categoryName">
                            <span v-if="errors && errors.name">{{errors.name[0]}}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn-wrap">
                <button type="submit" class="btn btn--green" @click="updateCategory()" :disabled="isValidated"><span>Save changes</span></button>
                <button type="button" class="btn btn--red" @click="deleteCategory()"><span>Delete</span></button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
props: ['category'],
    data() {
        return {
            isOpened: false,
            categoryName: null,
            errors: []
        }
    },
    computed: {
        isValidated() {
            return (this.categoryName)? false : true;
        }
    },
    methods: {
        openAccordion() {
            this.isOpened = !this.isOpened;
        },
        showName() {
            this.categoryName = this.category.name;
        },
        async updateCategory() {
            try {
                await axios.put(`/api/category/${this.category.id}`,{
                    name: this.categoryName,
                });
                this.$emit('resend');
                this.$emit('updated');
                this.openAccordion();
            }catch(error) {
                this.errors = error.response.data.error
            }
        },
        async deleteCategory() {
            try {
                await axios.delete(`/api/category/${this.category.id}`);
                this.$emit('resend');
            } catch(error) {
                this.errors = error.response.data.error
            }
        }
    },
    watch: {
        category: {
            handler() {
                this.showName();
            },
            immediate: true
        }
    }
}
</script>

<style>

</style>