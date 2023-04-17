<template>
    <div class="LoginPage">
        <form @submit.prevent="validate">
            <img src="../images/QrLogo3.png" alt="">
            <!-- <h1 class="header">Login</h1> -->
            <span class="databaseError d-none" id="databaseError"></span>
            <label for="name">Full Name <i class="fa-solid fa-user"></i></label>
            <input type="text" name="FullName" id="name" placeholder="Enter your Fullname .." v-model="this.FormData.FullName">
            <label for="mail">Email Address <i class="fa-solid fa-envelope"></i></label>
            <input type="email" name="email" id="mail" placeholder="Enter your Email address .." v-model="this.FormData.email">
            <span class="d-none" id="MailError">Please enter a valid email</span>
            <label for="pw">Password <i class="fa-solid fa-key"></i></label>
            <input type="password" name="password" id="pw" placeholder="Enter your password .." v-model="this.FormData.password">
            <span class="d-none" id="PasswordError">Please enter a password of min 8 characters which at least contains one digit</span>
            <label for="pw_2">Confirm Password <i class="fa-solid fa-key"></i></label>
            <input type="password" name="password_confirmation" id="pw_2" placeholder="Confirm your password .." v-model="this.FormData.password_confirmation">
            <span class="d-none" id="pwConfrimError">passwords are not matching</span>
            <input type="submit" class="submit" value="Register">
            <span class="d-none" id="error"><i class="fa-solid fa-exclamation errorIcon"></i> Please enter the empty field</span>
            <RouterLink to="/login" class="registerLink">already have an account? login from here</RouterLink>
        </form>        
    </div>
</template>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=PT+Sans&display=swap');
.LoginPage{
    background: #1a1b20 url(../images/macos-monterey-stock-black-dark-mode-layers-5k-3840x2160-5889.jpg) fixed;
    background-size: cover;
    font-family: 'PT Sans', sans-serif;
    padding: 15vh 0;
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
.databaseError{
    padding: 1vh 2vh;
    background-color: red;
    color: white;
}
span{
    width: 65%;
    text-align: center;
    color: rgb(182, 8, 8);
    text-shadow: 0px 0px 1px rgba(0, 0, 0, 0.326);
    font-size: 15px;
    margin: 1vh auto 2vh;
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
                FullName: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            validation : false
        }
    },
    methods: {
        validate(){
            let error = document.getElementById('error')
            let email = document.getElementById('mail')
            let password = document.getElementById('pw')
            let MailError = document.getElementById('MailError')
            let PasswordError = document.getElementById('PasswordError')
            let name = document.getElementById('name')
            let ConfrimPassword = document.getElementById('pw_2')
            let pwConfrimError = document.getElementById('pwConfrimError')
            
            // check if the input values are empty are not
            if(!this.FormData.FullName){
                name.classList.add('error')
                error.classList.remove('d-none')
                return this.validation = false
            }
            else if(!this.FormData.email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)){
                MailError.classList.remove('d-none')
                email.classList.add('error')
                return this.validation = false
            }
            else if(!this.FormData.password.match(/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9]{8,}$/)){
                password.classList.add('error')
                ConfrimPassword.classList.add('error')
                PasswordError.classList.remove('d-none')
                return this.validation = false
            }
            else if(this.FormData.password !== this.FormData.password_confirmation){
                pwConfrimError.classList.remove('d-none')
                ConfrimPassword.classList.add('error')
                return this.validation = false
            }
            // invoke 'Register' function to send entered data to the register api to store data
            else{
                this.Register();
                return this.validation = true
            }
        },
        Register(){
            let res = axios.post("http://127.0.0.1:8000/api/register",this.FormData).then((response) => {
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
        },
    updated() {
        let email = document.getElementById('mail')
        let name = document.getElementById('name')
        let password = document.getElementById('pw')
        let ConfrimPassword = document.getElementById('pw_2')
        let error = document.getElementById('error')
        let PasswordError = document.getElementById('PasswordError')
        let MailError = document.getElementById('MailError')
        let pwConfrimError = document.getElementById('pwConfrimError')
        if(this.FormData.FullName){
                name.classList.remove('error')
                error.classList.add('d-none')
        }
        if(this.FormData.email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)){
            MailError.classList.add('d-none')
            email.classList.remove('error')
        }
        if(this.FormData.password.match(/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9]{8,}$/)){
            password.classList.remove('error')
            ConfrimPassword.classList.remove('error')
            PasswordError.classList.add('d-none')
        }
        if(this.FormData.password == this.FormData.password_confirmation){
            pwConfrimError.classList.add('d-none')
            ConfrimPassword.classList.remove('error')
        }
    },
}
</script>

