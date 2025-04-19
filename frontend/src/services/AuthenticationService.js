import net from './NetworkService'
import endpoints from '../constants/endpoints';
import message from './MessageService';
import { useRouter } from 'vue-router';

const sessionManager = {
    session: null,
    login: async (username, password_hash, router) => {
        try {
            const response = await net.get(`${endpoints.LOGIN}/?username=${username}&password_hash=${password_hash}`);

            if (response.data.length == 0) {
                localStorage.removeItem("token");
            } else {
                console.log("logged in");
                message.addMessage(`Welcome @${username}`, "success", "true");
                localStorage.setItem("token", Math.random());
                sessionManager.session = setInterval(() => {
                    sessionManager.isAuthenticated();
                }, 300);
                router.push("/app")
            }
        } catch (err) {
            console.error("Login failed", err);
        }
    },

    logout: (router) => {
        localStorage.removeItem("token");
        if (sessionManager.session) {
            clearInterval(sessionManager.session);
        }
        if (router) {
            router.replace("/login");
        } else {
            console.warn("Router instance not provided");
        }
    },
    

    signup: async (username, email, password_hash) => {
        try {
            const response = await net.post(`${endpoints.LOGIN}/`, {
                username,
                email,
                password_hash
            });
            console.log("Signup response", response);
        } catch (e) {
            console.error("Signup failed", e);
        }
    },

    isAuthenticated: (router) => {
        const user = localStorage.getItem("token");
        console.log("user", user);

        if (user != null) {
            return true;
        }
        sessionManager.logout(router);
        return false;
    },

    currentUser: (router) => {
        // ping server with token here
        sessionManager.logout(router);
    }
};

export default sessionManager;
