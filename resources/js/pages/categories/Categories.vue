<template>
  <div class="wrapper">
        <section class="content">
            <div class="main-content">
                <h2 class="main-content__title">Category</h2>
                <div class="table-navigation">
                    <a href="javascript:;" class="table-navigation__create btn-modal"  @click="openModal()"><span>Create new category</span></a>
                    <form class="table-navigation__input-container" action="javascript:;">
                        <input type="text" class="table-navigation__search">
                        <button type="submit" class="icon__search"></button>
                    </form>
                </div>
                <div class="alphabet">
                    <ul class="alphabet__navigation">
                        <li class="alphabet__list" v-for="(letter,index) in getAlphabet" :key="index">
                            <a class="alphabet__button" href="javascript:;" :class="{'alphabet__button--disabled' : !checkCategoryName(letter)}" @click="getCategories(letter)">{{letter}}</a>
                        </li>
                    </ul>
                </div>
                <category-accordion v-for="(category, index) in categories" :key="index" :category="category" @resend="getCategoriesAlphabet()"></category-accordion>
            </div>
            <div class="pagination" v-if="categories.length>0">
                <ul class="pagination__navigation">
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;" @click="prevPage()">Previous</a>
                    </li>
                    <li class="pagination__list" v-for="(page, index) in numOfPages" :key="index">
                        <a class="pagination__button pagination__button--active" href="javascript:;" @click="goToPage(page)">{{page}}</a>
                    </li>
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;" @click="nextPage()">Next</a>
                    </li>
                </ul>
            </div>
        </section>
        <modal-categories
            :showModal="showNewModal"
            @closed="this.showNewModal = false"
            @closeModal="closeModal()"
            @resend="getCategoriesAlphabet()">
        </modal-categories>
    </div>
</template>

<script>
import ModalCategories from '../../components/Modal/ModalCategories.vue'
import CategoryAccordion from './CategoryAccordion.vue'
export default {
    components: {
        ModalCategories,
        CategoryAccordion
    },
    data() {
        return {
            showNewModal: false,
            categories: [],
            categoryKey: null,
            numOfPages: null,
            isLoaded: true,
            perPage: 3,
            currentPage: 1,
            isSuccess: false,
            search: '',
            typingTimer: null,
            categoriesAlphabet: null
        }
    },
    created() {
        if(this.$store.state.categories.length === 0)  this.getCategoriesAlphabet();
    },
     computed: {
        getAlphabet() {
           return [...Array(26)].map((_,i) => String.fromCharCode(i + 65))
        },
    },
    methods: {
        openModal() {
            this.showNewModal = true;
        },
        closeModal() {
            this.showNewModal = false
        },
        checkCategoryName(letter) {
            return (this.$store.state.categoriesAlphabet.includes(letter))? true : false;
        },
        nextPage() {
            if (this.currentPage >= this.numOfPages) return
            this.currentPage++;
        },
        prevPage() {
            if (this.currentPage <= 1) return
            this.currentPage--;
        },
        goToPage(page) {
            this.currentPage = page;
        },
        timeout(ms) {
            return new Promise((resolve)=> {
                clearTimeout(this.typingTimer);
                return this.typingTimer = setTimeout(()=> resolve(true), ms);
            })
        },
        async getCategoriesAlphabet() {
            try {
                this.isLoaded = false
                this.categoriesAlphabet = ( await axios.get(`/api/category`)).data;
                this.isLoaded = true
                this.$store.commit('setCategoriesAlphabet', this.categoriesAlphabet)
            }catch(error) {

            }
        },
        async getCategories(letter) {
            try {
                this.isLoaded = false
                this.categoryKey = letter;
                const data =( await axios.get(`/api/category/${letter}?page=${this.currentPage}`)).data;
                this.categories = data.data;
                this.numOfPages = data.meta.last_page;
                this.isLoaded = true
            }catch(error) {

            }
        },
        async searchCategory() {
            try {
                if (this.search.length>0) {
                    await this.timeout(500);
                    const data = await axios.get(`/api/project/search/${this.search}`);
                    this.categoryAcc = data.data.data;
                   this.buildPage()
                } else {
                    await this.timeout(200);
                    this.generateAlphabet(Object.keys(this.$store.state.categories)[0]);
                }
            }catch(error) {

            }
        }
    }
}
</script>

<style>

</style>