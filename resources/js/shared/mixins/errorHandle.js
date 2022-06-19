export default {
    data() {
        return {
            errorData: null
        };
    },
    methods: {
        errorFor(field) {
            return null !== this.errorData && this.errorData[field]
                ? this.errorData[field]
                : null;
        }
    }
};