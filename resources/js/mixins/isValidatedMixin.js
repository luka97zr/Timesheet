export default {
    computed: {
        isValidated() {
            return (this.countryId && this.clientName)? false : true;
        },
    },
}