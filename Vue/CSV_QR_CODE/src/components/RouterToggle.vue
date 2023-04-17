<template>
    <div class="Buttons">
        <RouterLink to="/reader" class="LinkButton" @click="ReadactiveRouter" id="read">Read QR Code</RouterLink>        
        <RouterLink to="/viewData" class="LinkButton" @click="ViewactiveRouter" id="view">View Saved Data</RouterLink>        
    </div>
    <hr style="background-color: white; color: white;">
</template>
<style scoped>
    .Buttons{
        display: flex;
        justify-content: center;
        margin: 5vh auto;
    }
    .hr{
        width: 50%;
        margin: auto;
        height: 4vh;
    }
    .LinkButton{
        padding: 1.2vh 4vh;
        border-radius: 5px;
        box-shadow: 0px 0px 8px black;
        background-color: white;
        color: black;
        text-decoration: none;
        margin: 0 1.5vh;
        text-align: center;
        transition-duration: 0.2s;
    }
    .LinkButton:hover{
        padding: 1.5vh 4.5vh;
        font-size: 20px;
        background-color: rgba(255, 255, 255, 0.77);
    }
    .active{
        background-color: rgba(255, 255, 255, 0.668) !important;
    }
    @media screen and (max-width : 700px){
        .LinkButton{
            width: 100%;
            margin: 2vh;
            text-align: center;
        }
        .Buttons{
            width: 100%;
            margin: auto;
            text-align: center;

        }
        
    }
</style>
<script>
export default {
  name: 'RouterToggle',
  methods: {
    ReadactiveRouter(){
        let view = document.getElementById('view')
        let read = document.getElementById('read')
        view.classList.remove('active')
        read.classList.add('active')
    },
    ViewactiveRouter(){
        let view = document.getElementById('view')
        let read = document.getElementById('read')
        view.classList.add('active')
        read.classList.remove('active')
    }

  },
}
</script>