export default {
    methods: {
        nextPage(getRawData) {
            if (this.currentPage >= this.numOfPages) return
            this.currentPage++;
            getRawData;
        },
        prevPage(getRawData) {
            if (this.currentPage <= 1) return
            this.currentPage--;
            getRawData;
        },
        goToPage(page, getRawData) {
            this.currentPage = page;
            getRawData;
        },
    }
}