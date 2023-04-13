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
            <RouterLink to="" class="link">View CSV Data</RouterLink>
            <RouterLink to="" class="link">Login</RouterLink>
        </div>
                        <!-- *****LINKS SECTION (LARGE SCREENS) END ****** -->

                        <!-- *****MENU BUTTON (SMALL AND MEDIUM SCREENS) ****** -->
        <div class="NavLinks d-flex d-lg-none">
            <h2><i class="fa-solid fa-bars" style="color: white;"></i></h2>
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
    .logo{
        margin-left: 1vh;
    }
    .logo img{
        width: 60%;
    }
}
</style>
<script>
export default {
    methods : {
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
    }    
}
</script>