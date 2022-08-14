export default {
    computed: {
        getAlphabet() {
           return [...Array(26)].map((_,i) => String.fromCharCode(i + 65))
        },
    },
}