export default {
    methods: {
        updatedSuccessfuly() {
            this.isSuccess = true;
            setTimeout(() => {
                this.isSuccess = false;
            }, 2000);
        },
        createdSuccessfuly() {
            this.isCreated = true;
            setTimeout(() => {
                this.isCreated = false;
            }, 2000);
        },
    },
}