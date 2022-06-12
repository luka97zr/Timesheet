export function isLoggedIn() {
    return localStorage.getItem('isLoggedIn') === 'true';
}

export function logIn(user) {
    localStorage.setItem('isLoggedin', true)
    localStorage.setItem('user',JSON.stringify(user))
}

export function logOut() {
    localStorage.setItem('isLoggedin', false)
}