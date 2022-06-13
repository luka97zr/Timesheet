export function isLoggedIn() {
    return localStorage.getItem('isLoggedIn');
}


export function logOut() {
    localStorage.setItem('isLoggedIn', false)
}