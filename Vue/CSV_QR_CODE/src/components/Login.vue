<template>
    <div class="LoginPage">
        <div v-if="this.authenticated" class="authenticated">
            <img src="../images/QrLogo3.png" alt="">
            <h1>Already logged in</h1>
            <RouterLink to="/" class="home"><i class="fa-solid fa-house"></i> Home Page</RouterLink>
        </div>
        <form class="" v-if="!this.authenticated" @submit.prevent="submitLogin">
            <img src="../images/QrLogo3.png" alt="">
            <span class="databaseError d-none" id="databaseError"></span>
            <label for="mail">Email Address <i class="fa-solid fa-envelope"></i></label>
            <input type="email" name="email" id="mail" placeholder="Enter your Email address .." v-model="this.FormData.email">
            <label for="pw">Password <i class="fa-solid fa-key"></i></label>
            <input type="password" name="password" id="pw" placeholder="Enter your password .." v-model="this.FormData.password">
            <input type="submit" class="submit" value="Login">
            <span class="d-none" id="error"><i class="fa-solid fa-exclamation errorIcon"></i> Please enter the empty field</span>
            <RouterLink to="/register" class="registerLink">Don't have an account? Create one</RouterLink>
        </form>        
    </div>
</template>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=PT+Sans&display=swap');
.LoginPage{
    background: #1a1b20 url(../images/macos-monterey-stock-black-dark-mode-layers-5k-3840x2160-5889.jpg) fixed;
    background-size: cover;
    font-family: 'PT Sans', sans-serif;
    padding: 20vh 0;
}
.authenticated{
    margin: auto;
    text-align: center;
    width: 70%;
}
.authenticated img{
    width: 35%;
    border-bottom: 2px solid black;
}
.authenticated h1{
    color: white;
    margin: 2vh auto;
}
.authenticated .home{
    font-size: 20px;
    text-decoration: none;
}
.databaseError{
    padding: 1vh 2vh;
    background-color: red;
    color: white;
    width: 65%;
    margin: 2vh auto;
}
form{
    width: 33%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 5vh 3vh 8vh;
    border-radius: 20px;
    background-color: rgba(240, 248, 255, 0.374);
    text-align: center;
    margin: auto;
}
form img{
    width: 40%;
    margin: 0vh auto 3vh;
    border-bottom: 2px solid black;
}
input{
    width: 65%;
    margin: 2vh auto;
    text-align: center;
    padding: 1.8vh;
    border: none;
    border-bottom: 2px solid black;
    border-radius: 4px;
    background-color: rgba(255, 255, 255, 0.675);
}
label{
    font-size: 17px;
}
.header{
    margin-bottom: 5vh !important;
}
.registerLink{
    text-decoration: none;
    color: black;
    transition-duration: 0.2s;
}
.submit{
    background-color: black;
    color: white;
    font-size: 17px;
    border: none;
    padding: 1vh;
    border-radius: 20px;
    transition-duration: 0.2s;
}
.submit:hover{
    background-color: rgba(0, 0, 0, 0.812);
}
.registerLink:hover{
    color: blue;
}
.error{
    border: none;
    border: 2px solid red !important;
}

.errorIcon{
    background-color: red;
    padding: 0.8vh 1.7vh;
    border-radius: 50%;
    color: white;
}
span{
    color: rgb(182, 8, 8);
    text-shadow: 0px 0px 1px rgba(0, 0, 0, 0.636);
    font-size: 17px;
    margin: 1.5vh;
}

@media screen and (max-width: 1000px){
    form{
        width: 65%;
    }
    input{
        width: 80%;
    }

}
@media screen and (max-width: 650px){
    form{
        width: 80%;
    }
    input{
        width: 90%;
    }

}
</style>
<script>
import axios from "axios";
import CryptoJS from 'crypto-js';
export default {
    data() {
        return {
            FormData:{
                email: '',
                password: '',
            },
            authenticated: false
        }
    },
    methods: {
        submitLogin(){
            let error = document.getElementById('error')
            let email = document.getElementById('mail')
            let password = document.getElementById('pw')
            // check if the input values are empty are not
         if(!this.FormData.email || !this.FormData.password){
             error.classList.remove('d-none')
            if(!this.FormData.email){
                email.classList.add('error')
            }
            if(!this.FormData.password){
                password.classList.add('error')
            }
         }  
        //  send entered login data to the api to check and authenticate user 
         else{
            let res = axios.post("http://127.0.0.1:8000/api/login",this.FormData).then((response) => {
                let token = response.data.Token;
                let user_id =  response.data.user.id;
                let encryptedToken = CryptoJS.AES.encrypt(token , 'kimoKey_2207').toString()
                let token_userId = JSON.stringify([encryptedToken,user_id])
                localStorage.setItem('userToken',token_userId)
                this.$router.push('/reader')
          }).catch(function(error) {
            let databaseError = document.getElementById('databaseError');
            databaseError.textContent = error.response.data.message;
            databaseError.classList.remove('d-none')
          });
         } 
        }
    },
    beforeMount(){
        let authenticated = localStorage.getItem('userToken')
        if(authenticated){
            this.authenticated = true;
        }
        else{
            this.authenticated = false;
        }
    },
    updated() {
        let email = document.getElementById('mail')
        let password = document.getElementById('pw')
        let error = document.getElementById('error')
        if(this.FormData.email){
            email.classList.remove('error')
        }
        if(this.FormData.password){
            password.classList.remove('error')
        }
        if(this.FormData.email && this.FormData.password){
        error.classList.add('d-none')
        }
    },
}
</script>