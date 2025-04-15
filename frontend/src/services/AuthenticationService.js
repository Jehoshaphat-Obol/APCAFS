import net from './NetworkService'
import endpoints from '../constants/endpoints';

const session = null;

export const login = (username, password) => {
    // TODO: implement login logic
    response = net.get(`${endpoints.LOGIN}/?username=${username}&password=${password}`);

    if(response.data.length == 0){
        localStorage.removeItem("token");
    }else{
        localStorage.setItem("token", Math.random())
        //on success, to be scheduled as per expiration
        session = setInterval(()=>{isAuthenticated()}, 300000)
    }
}


export const logout = () => {
    // TODO: implement logout logic
    localStorage.removeItem("token");
    //on success
    clearInterval(session)

    // TODO: navigate to the logout url
}


export const signup = (username, email,password) => {
    // TODO: implement user registration logic
    try {
        response = net.post(`${endpoints.LOGIN}/`, {username, email, password});
    }catch(e){

    }
}


export const isAuthenticated = () => {
    // TODO: get token and ping the server to validate, if invalid clear session
    user = localStorage.getItem("token")
    // if expired refresh else logout
    logout()

}


export const currentUser = () => {
    // TODO: implement ping server to get the owner of the token
    // if not found logout
    logout()

}
