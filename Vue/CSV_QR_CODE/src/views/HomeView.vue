<script setup>
import animation from '../components/animation.vue';
</script>
<template>
                           <!-- *****Home Page***** -->

  <div class="Home">   <!--  container div -->
    <!-- backGround Image -->
    <img src="../images/macos-monterey-stock-black-dark-mode-layers-5k-3840x2160-5889.jpg" class="LargeScreens" alt="">
    <img src="../images/responsiveBG.png" class="smallScreens" alt="">
    <div class="intro">
      <div class="text">
        <h1>WANNA EXTRACT CSV DATA FROM YOUR QR CODE?</h1>
        <p>Use our QR READER features to extract your csv data and save it after registering so you can access them at any time .. Join Us Now and enjoy our services</p>
        <div class="Register"><RouterLink to="" class="LoginButton" style="margin: auto;">Register Now</RouterLink></div>
      </div>
      <div class="csvImg">
        <img src="../images/csv.png" alt="">
        <!-- using animation component -->
        <RouterLink to=""><animation></animation></RouterLink>
      </div>
    </div>
    <div class="Try"><RouterLink to="" class="TryButton" style="margin: auto;">Try it For Free</RouterLink></div>
  </div>

                           <!-- *****Home Page End***** -->

</template>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=PT+Sans&display=swap');

.Home{
  position: relative;
}
.animation{
  position: absolute;
  top: 20%;
  left: 50%;
}
.Home .intro{
  font-family: 'PT Sans', sans-serif;
  position: absolute;
  top: 45%;
  left: 50%;
  z-index: 7;
  color: white;
  text-shadow: 0px 0px 5px black;
  transform: translate(-50%, -50%);
  width: 80%;
  display: flex;
  justify-content: center;
  align-items: center;

}
.Try{
  position: absolute;
  top: 80%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 7;
}
img{
width: 100%;
}
.intro .text h1{
  font-size: 26px;
  margin: 2vh 0;
}
.intro .text p{
  width: 85%;
  margin: 1vh 0 5vh;
}
.Register{
  margin-top: 3vh;
}
.LoginButton{
  padding: 1.5vh 5vh;
  background-color: blue;
  text-decoration: none;
  color: white;
  text-align: center;
  border-radius: 5px;
  transition-duration: 0.3s;
}
.TryButton{
  padding: 1.5vh 5vh;
  background-color: white;
  text-decoration: none;
  color: black;
  text-align: center;
  border-radius: 5px;
  transition-duration: 0.2s;
}
.LoginButton:hover{
  background-color: white;
  color: blue;
}
.TryButton:hover{
  background-color: rgba(255, 255, 255, 0.801);
  color: blue;
  box-shadow: 0px -1px 7px black;
}

.csvImg{
  z-index: 1;
  margin-top: 4vh;
  display: flex;
  flex-direction: column;
  justify-content:  center;
}
.csvImg img{
  width: 80%;
  margin-left: 4vh;
}

@media screen and (max-width: 850px){
.LargeScreens{
  display: none !important;
}
.Home .intro{
  position: absolute;
  top: 35%;
  display: flex;
  flex-direction: column;
  text-align: center;
}
.text p{
  text-align: center;
  width: 100% !important;
  margin: auto;
}
.Register{
  display: flex;
  justify-content: center;
  margin-bottom: 4vh;
}
.Try{
  position: absolute;
  top: 70%;
  left: 50%;
}
}
@media screen and (max-width: 650px){
.LargeScreens{
  display: none !important;
}
.Home .intro{
  position: absolute;
  top: 52%;
  display: flex;
  flex-direction: column;
  text-align: center;
}
.text p{
  text-align: center;
  width: 100% !important;
  margin: auto;
}
.Register{
  display: flex;
  justify-content: center;
  margin-bottom: 4vh;
}
.Try{
  position: absolute;
  top: 95%;
  left: 50%;
}
}
@media screen and (min-width: 851px){
.LargeScreens{
  display: flex !important;
}
.smallScreens{
  display: none !important;
}
}
</style>
