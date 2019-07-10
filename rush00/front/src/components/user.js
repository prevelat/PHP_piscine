// import axios from 'axios';

export default {
    auth: function() {
        return {
            currentUser: localStorage.getItem("user"),
            signIn: data => {
                localStorage.setItem("user", JSON.stringify(data));
            }
        };
    }
};
