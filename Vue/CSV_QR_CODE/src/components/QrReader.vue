<template>
    <div class="Bg">
        <!-- <img src="../images/macos-monterey-stock-black-dark-mode-layers-5k-3840x2160-5889.jpg" alt=""> -->
        <div class="reader">
            <toggler></toggler>
            <form>
                <label for="img" class="insertImage" id="insertImg"><i class="fa-solid fa-qrcode" style="font-size: 20px;"></i> Enter your QR Code Image</label>
                <input type="file" class="d-none" name="image" @change="handleUpload($event.target.files)" id="img">
                <input type="submit" class="submitButton" id="submit">
            </form>
        </div>
    </div>
</template>
<style scoped> 
.insertImage{
    margin: 2vh auto 3vh;
    background-color: #d6d6d6;
    padding: 2vh 3vh;
    border-radius: 5px;
    cursor: pointer;
    transition-duration: 0.2s;
}
.insertImage:hover{
    background-color: #b5b4b4;
}
.Bg{
    position: relative;
}
.Bg img{
    width: 100%;
}
.reader{
    /*position: absolute;
    top: 28%;
    left: 50%;
    transform: translate(-50%, -50%);*/
    width: 28%;
    margin: 20vh auto;
}
form{
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-top: 2vh;
}
label {
    margin: auto;
}
.submitButton{
    padding: 1.2vh 3vh;
    background-color: blue;
    border-radius: 5px;
    border: none;
    color: white;
    transition-duration: 0.2s;
}
.submitButton:hover{
    background-color: rgba(0, 0, 255, 0.679);
    box-shadow: 0px 0px 5px black;
}
</style>
<script>
import RouterToggler from './RouterToggle.vue'
export default {
    components: {
    'toggler': RouterToggler, 
  }
}
</script>