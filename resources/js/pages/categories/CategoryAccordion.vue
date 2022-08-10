<template>
    <div class="accordion" @click="openAccordion()">
        <div class="accordion__intro">
            <h4 class="accordion__title">{{category.name}}</h4>
        </div>
        <form class="accordion__content" action="javascript:;" :class="{'accorion-open' : isOpened}" @click="openAccordion()">
            <div class="info">
                <div class="info__form">
                    <ul class="info__wrapper">
                        <li class="info__list">
                            <label class="info__label">Category name:</label>
                            <input type="text" class="in-text" v-model="categoryName">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn-wrap">
                <button type="submit" class="btn btn--green" @click="updateCategory()"><span>Save changes</span></button>
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
            categoryName: '',
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
                console.log(error)
            }
        },
        async deleteCategory() {
            try {
                await axios.delete(`/api/category/${this.category.id}`);
                this.$emit('resend');
            } catch(error) {
                console.log(error)
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