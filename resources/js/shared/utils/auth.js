export function isLoggedIn() {
    return localStorage.getItem('isLoggedIn');
}

export function logIn() {
    localStorage.setItem('isLoggedIn', true)
}

export function logOut() {
    localStorage.setItem('isLoggedIn', false)
}