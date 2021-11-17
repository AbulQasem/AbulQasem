import decode from 'jwt-decode'
import axios from 'axios'

const REST_ENDPOINT = 'http://127.0.0.1/'
const AUTH_TOKEN_KEY = 'authToken'

export function loginUser(email, password) {
    console.log("HOLA");
    return new Promise(async (resolve, reject) => {
        try {
            let res = await axios({
                url: `http://127.0.0.1:8000/api/auth/login`,
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    grant_type: 'password'
                }
            })

            setAuthToken(res.data.token)
            resolve()
        } catch (err) {
            console.error('Caught an error during login:', err)
            reject(err)
        }
    })
}

export function logoutUser() {
    clearAuthToken()
}

export function setAuthToken(token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
    localStorage.setItem(AUTH_TOKEN_KEY, token)
}

export function getAuthToken() {
    return localStorage.getItem(AUTH_TOKEN_KEY)
}

export function clearAuthToken() {
    axios.defaults.headers.common['Authorization'] = ''
    localStorage.removeItem(AUTH_TOKEN_KEY)
}

export function isLoggedIn() {
    let authToken = getAuthToken()
    return !!authToken && !isTokenExpired(authToken)
}

export function getUserInfo() {
    if (isLoggedIn()) {
        return decode(getAuthToken())
    }
}

function getTokenExpirationDate(encodedToken) {
    let token = decode(encodedToken)
    if (!token.exp) {
        return null
    }

    let date = new Date(0)
    date.setUTCSeconds(token.exp)

    return date
}

function isTokenExpired(token) {
    let expirationDate = getTokenExpirationDate(token)
    return expirationDate < new Date()
}