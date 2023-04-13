<template>
    <footer>
        <div class="UpperSection">
            <div class="logo d-none d-lg-flex">
                <img src="../images/QrLogo3.png" alt="">
                <p style="font-size: 14px;">QR READER IS A SERVICE THAT YOU CAN USE TO EXTRACT YOUR CSV DATA FROM QR CODES AND SAVE</p>
            </div>
            <div class="Links">
                <h1>About</h1>
                <h5>Our team</h5>
                <h5>Contact Us</h5>
                <h5>Help & FAQs</h5>
            </div>
            <div class="Links">
                <h1>Quick Links</h1>
                <h5>Home</h5>
                <h5>Read Qr Code</h5>
                <h5>View Saved Csv Data</h5>
            </div>
            <div class="Links">
                <h1>Follow us</h1>
                <div class="icons">
                    <i class="fa-brands fa-facebook icon"></i>
                    <i class="fa-brands fa-instagram icon"></i>
                    <i class="fa-brands fa-twitter icon"></i>
                </div>
            </div>
        </div>
        <div class="lowerSec">
            <p>&#169; All Rights Reserved. QR CSV READER Software by Kareem Ayman.</p>
        </div>
    </footer>
</template>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=PT+Sans&display=swap');

footer{
    display: flex;
    flex-direction: column;
    background-color: #7c7c7c;
    font-family: 'PT Sans', sans-serif;
}
.UpperSection{
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 3vh 5vh;
}
.logo{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    width: 25%;
}
.logo img{
    width: 70%;
}
.Links{
    margin: 1vh 10vh;
    text-align: center;
}
.Links h1{
    margin: 2vh 0;
    color: white;
    text-shadow: 0px 0px 5px black;
    width: 100%;
}
.Links h5{
    color: white;
    width: 100%;
    font-size: 17px;
    margin: 1vh 0;
    cursor: pointer;
    transition-duration: 0.2s;
}
.Links h5:hover{
    color: black;
}
.icon{
    margin: 0 1vh;
    font-size: 24px;
    color: white;
    cursor: pointer;
    transition-duration: 0.2s;
}
.icon:hover{
    color: black;
}
.lowerSec{
    width: 100% ;
    background-color: #0f0f0fc4;
    text-align: center;
    color: white;
}
.lowerSec p{
    padding: 0;
    margin: 0;
    padding: 1.5vh;
}
@media screen and (max-width: 800px){
    .UpperSection{
        display: flex;
        flex-direction: column;
    }
}
</style>