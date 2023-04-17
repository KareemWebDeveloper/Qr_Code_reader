<template>
                           <!-- *****NavBar****** -->
    <div class="navBarr" v-on:scroll.passive='handleScroll(e)' id="navBar">

                        <!-- *****LOGO SECTION****** -->
        <div class="logo">
            <img src="../images/qrLogo3.png" alt="">
        </div>      
                        <!-- *****LOGO SECTION END****** -->

                        <!-- *****LINKS SECTION (LARGE SCREENS) START ****** -->
        <div class="NavLinks d-none d-lg-flex">
            <RouterLink to="/" class="link">Home</RouterLink>
            <RouterLink to="/reader" class="link">Read Qr Code</RouterLink>
            <RouterLink to="viewData" class="link">View CSV Data</RouterLink>
            <RouterLink to="/login" v-if="!this.authenticated" class="link">Login <i class="fa-solid fa-user"></i></RouterLink>
            <RouterLink to="/" v-if="this.authenticated" class="link" @click="Logout">Logout <i class="fa-solid fa-right-from-bracket mx-2"></i></RouterLink>
        </div>
        
        <!-- *****LINKS SECTION (LARGE SCREENS) END ****** -->
        
        <!-- *****MENU BUTTON (SMALL AND MEDIUM SCREENS) ****** -->
        <div class="NavLinks d-flex d-lg-none">
            <h2 @click="toggleNav"><i class="fa-solid fa-bars" style="color: white;"></i></h2>
        </div>
        <!-- *****  (SMALL AND MEDIUM SCREENS) ****** -->

        <div class="Responsive d-flex d-lg-none d-none" id="ResponsiveNav">
                <RouterLink to="/" class="link" @click="closeNav">Home</RouterLink>
                <RouterLink to="/reader" class="link" @click="closeNav">Read Qr Code</RouterLink>
                <RouterLink to="/viewData" class="link" @click="closeNav">View CSV Data</RouterLink>
                <RouterLink to="/login" v-if="!this.authenticated" class="link" @click="closeNav">Login <i class="fa-solid fa-user"></i></RouterLink>
                <RouterLink to="/" v-if="this.authenticated" class="link" @click="Logout">Logout <i class="fa-solid fa-right-from-bracket mx-2"></i></RouterLink>
        </div>
    </div>
</template>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=PT+Sans&display=swap');
.navBarr{
    z-index: 9;
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 1vh 3vh;
    align-items: center;
    position: fixed;
    top: 0;
}

.logo{
    margin-left: 2vh;
}
.logo img{
    width: 50%;
}
.NavLinks{
    font-family: 'PT Sans', sans-serif;
    margin-right: 4vh;
}
.link{
    text-decoration: none;
    color: white;
    margin: 0 2vh;
    font-size: 19px;
    transition-duration: 0.2s;
    z-index: '9';
}
.link::after{
    content: '';
    width: 1vh;
    height: 0.5vh;
    background-color: rgb(255, 255, 255);
}
.link:hover{
    color: rgba(0, 81, 255, 0.626);
}
.navBg{
    background-color: rgba(0, 0, 0, 0.608);
    animation: navBgChanger 0.2s ;
}

@keyframes navBgChanger {
    0%{
    background-color: rgba(0, 0, 0, 0) ;
    }
    100%{
    background-color: rgba(0, 0, 0, 0.678) !important;

    }
}
@media screen and (max-width:1000px){
    *{
        margin: 0;
        padding: 0;
    }
    .navBarr{
        background-color: black !important;
    }
    .logo{
        margin-left: 1vh;
    }
    .logo img{
        width: 60%;
    }
    .Responsive{
        background-color: rgb(0, 0, 0);
        width: 100%;
        overflow: hidden;
        position: absolute;
        top: 71px;
        left: 0;
        padding: 2vh 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        text-align: center;
        z-index: 7;
        margin: 0;
        align-items: center;
        justify-content: center;
        height: 14vh;
    }
    .link{
        margin: 1vh 3vh;
    }
    .NavBarOpen{
        height: 14vh;
        animation: navOpen 0.2s ;
    }
    @keyframes navOpen {
        0%{
            height: 0vh;
        }
        100%{
            height: 14vh;
        }
    }
    .NavBarClose{
        height: 0;
        animation: navClose 0.2s ;
    }
    @keyframes navClose {
        0%{
            height: 14vh;
        }
        100%{
            height: 0vh;
        }
    }
}
@media screen and (max-width : 420px){
    .Responsive{
        position: absolute;
        top: 49px;
        left: 0;
    }
}
</style>
<script>
import axios from "axios";
import CryptoJS from 'crypto-js';
export default {
    data() {
        return {
            authenticated : false,
            token : '',
            user_id : ''
        }
    },
    methods : {
        Logout(){
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            axios.post("http://127.0.0.1:8000/api/logout").then((response) => {
                localStorage.removeItem('userToken');
                location.reload();
          }).catch(function(error) {
            console.log(error.response.data.message);
          });
        },
        toggleNav(){
            let navbar = document.getElementById('ResponsiveNav');
            if(navbar.classList.contains('d-none')){
                navbar.classList.remove('d-none');
                navbar.classList.add('NavBarOpen');
                setTimeout(() => {
                    navbar.classList.remove('NavBarOpen');
                }, 200);
            }
            else{
                navbar.classList.add('NavBarClose');
                setTimeout(() => {
                    navbar.classList.add('d-none');
                    navbar.classList.remove('NavBarClose');
                }, 200);

            }
        },
        closeNav(){
            let navbar = document.getElementById('ResponsiveNav');
            navbar.classList.add('NavBarClose');
                setTimeout(() => {
                    navbar.classList.add('d-none');
                    navbar.classList.remove('NavBarClose');
                }, 200);
        }
    },
    mounted(){
        let navBar = document.getElementById('navBar')
        window.document.onscroll = () => {
            if(window.pageYOffset>80){
                navBar.classList.add('navBg')
            }
            else{
                navBar.classList.remove('navBg')
            }
        }
    },
    beforeMount(){
        let authenticated = localStorage.getItem('userToken')
        if(authenticated){
            this.authenticated = true;
            let user_data = JSON.parse(authenticated) ;
            let encrypted_token = user_data[0];
            this.user_id = user_data[1]
            let token = CryptoJS.AES.decrypt(encrypted_token , 'kimoKey_2207')
            this.token =  token.toString(CryptoJS.enc.Utf8)
        }
        else{
            this.authenticated = false;
        }
    }    
}
</script>