export default {
    methods: {
        timeout(ms) {
            return new Promise((resolve)=> {
                clearTimeout(this.typingTimer);
                return this.typingTimer = setTimeout(()=> resolve(true), ms);
            })
        },
    },
}