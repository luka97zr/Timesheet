<template>
  <div class="wrapper">
        <section class="content">
            <div class="main-content">
                <h2 class="main-content__title">Category</h2>
                <div class="table-navigation">
                    <a href="javascript:;" class="table-navigation__create btn-modal"  @click.prevent="openModal()"><span>Create new category</span></a>
                    <form class="table-navigation__input-container" action="javascript:;">
                        <input type="text" class="table-navigation__search">
                        <button type="submit" class="icon__search"></button>
                    </form>
                </div>
                <div class="alphabet">
                    <ul class="alphabet__navigation">
                        <li class="alphabet__list" v-for="(letter,index) in getAlphabet" :key="index">
                            <a class="alphabet__button" href="javascript:;" :class="{'alphabet__button--disabled' : !checkCategoryName(letter)}" @click.prevent="generateAlphabet(letter)">{{letter}}</a>
                        </li>
                    </ul>
                </div>
                <category-accordion v-for="(category, index) in categories" :key="index" :category="category" @resend="getProjects()"></category-accordion>
            </div>
            <div class="pagination" v-if="categoryAcc.length>0">
                <ul class="pagination__navigation">
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;" @click.prevent="prevPage()">Previous</a>
                    </li>
                    <li class="pagination__list" v-for="(page, index) in numOfPages" :key="index">
                        <a class="pagination__button pagination__button--active" href="javascript:;" @click.prevent="goToPage(page)">{{page}}</a>
                    </li>
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;" @click.prevent="nextPage()">Next</a>
                    </li>
                </ul>
            </div>
        </section>
        <modal-categories
            :showModal="showNewModal"
            @closed="this.showNewModal = false"
            @closeModal="closeModal()"
            @resend="getCategories()">

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
            categoryAcc: [],
            isLoaded: true,
            perPage: 3,
            currentPage: 1,
            isSuccess: false,
            search: '',
            typingTimer: null
        }
    },
    created() {
        if(this.$store.state.categories.length === 0)  this.getCategories();
        this.populateCategoryAcc()
    },
     computed: {
        getAlphabet() {
           return [...Array(26)].map((_,i) => String.fromCharCode(i + 65))
        },
        numOfPages() {
            return Math.ceil(this.categoryAcc.length / this.perPage);
        },
        startPage() {
            return (this.currentPage - 1) * this.perPage;
        },
        endPage() {
            return this.startPage + this.perPage;
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
            return Object.keys(this.$store.state.categories).some(el => el === letter);
        },
        generateAlphabet(letter) {
            if(!this.$store.state.categories[letter]) return;
            this.currentPage = 1;
            this.categoryAcc = Object.values(this.$store.state.categories[letter])
            this.buildPage();
        },
        buildPage() {
            this.categories = this.categoryAcc.slice(this.startPage, this.endPage);
        },
        populateCategoryAcc() {
            if (this.categoryAcc.length === 0) {
                this.categoryAcc = Object.values(this.$store.state.categories)
                this.generateAlphabet(Object.keys(this.$store.state.categories)[0]);
            }
        },
        nextPage() {
            if (this.currentPage >= this.numOfPages) return
            this.currentPage++;
            this.buildPage()
        },
        prevPage() {
            if (this.currentPage <= 1) return
            this.currentPage--;
            this.buildPage()
        },
        goToPage(page) {
            this.currentPage = page;
            this.buildPage();
        },
        timeout(ms) {
            return new Promise((resolve)=> {
                clearTimeout(this.typingTimer);
                return this.typingTimer = setTimeout(()=> resolve(true), ms);
            })
        },
        async getCategories() {
            try {
                this.isLoaded = false
                const data = await axios.get(`/api/category`);
                this.$store.commit('setCategories',data.data);
                this.generateAlphabet(Object.keys(this.$store.state.categories)[0]);
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