<template>
    <div id="Loading">
        <loading></loading>
    </div>
    <div class="RouterRoggler">
        <toggler></toggler>
    </div>
    <div class="Bg">   
        <h1 v-if="this.UserData.length == 0" class="text-white text-center m-auto">There is no saved data yet</h1>
        <table id="allData" v-if="this.UserData.length > 0">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>SSN</th>
                    <th>Final</th>
                    <th>Grade</th>
                    <th>View More</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row,rowIndex) in UserData" :key="rowIndex">
                    <td>{{ row.FIRSTNAME }}</td>
                    <td>{{ row.LASTNAME }}</td>
                    <td>{{ row.SSN }}</td>
                    <td>{{ row.FINAL }}</td>
                    <td>{{ row.GRADE }}</td>
                    <td><button class="viewMore" @click="ShowData(rowIndex)">View More Data</button></td>
                    <!-- <td v-for="(column,columnIndex) in Object.fromEntries(Object.entries(row).slice(0, 3))" :key="columnIndex">{{ column }}</td> -->
                </tr>
            </tbody>
        </table>
        <div class="d-none" id="MoreData">
            <table class="viewMoreData">
                <thead>
                    <tr>
                        <th v-for="header in Object.keys(Selected).slice(1,13)">{{ header }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td v-for="(column,columnIndex) in Object.fromEntries(Object.entries(Selected).slice(1, 13))" :key="columnIndex">{{ column }}</td>
                        <!-- <td v-for="(column,columnIndex) in Object.fromEntries(Object.entries(row).slice(0, 3))" :key="columnIndex">{{ column }}</td> -->
                    </tr>
                </tbody>
            </table>
           <div class="d-flex justify-content-center m-4"><button class="viewAll" @click="showAllTable">View All Data</button></div>
        </div>
    </div>
</template>
<style scoped>
.RouterRoggler{
    padding: 20vh 0 5vh;
    width: 60%;
    margin: auto;
}
.Bg{margin: 5vh auto 20vh;}

table{
    width: 85%;
    margin: auto;
    border-radius: 20px;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.54);
}
thead{
    background-color: black !important;
    color: rgba(255, 255, 255, 0.868);
    font-weight: bold;
    font-size: 22px;
    border-radius: 20px;
}
th{
    background-color: black !important;
    padding: 2vh;
    margin: 1vh;
    border: 1px solid white;
}
.viewMore{
    border: none;
    background-color: rgba(161, 161, 161, 0.708);
    padding: 1.5vh 2vh;
    border-radius: 5px;
    transition-duration: 0.2s;
}
.viewMore:hover{
    background-color: rgba(161, 161, 161, 0.468);

}

tr{
    margin: 2vh;
    background-color: white;
}
td{
    color: black;
    margin: 1vh;
    padding: 2vh;
    border: 2px solid black;
}
tr:nth-child(even){
    background-color: rgba(255, 250, 243, 0.907) !important;
}
.viewMoreData td,th{
    padding: 2.5vh 1.3vh;
}
.viewAll{
    border: none;
    background-color: white;
    padding: 2vh 3vh;
    border-radius: 6px;
    margin: auto;
    text-align: center;
}
.viewAll:hover{
    background-color: rgba(255, 255, 255, 0.834);
}
</style>
<script>
import RouterToggler from './RouterToggle.vue'
import Loading from './Loading.vue'
import jsQR from 'jsqr'
import Papa from 'papaparse'
import axios from "axios";
import CryptoJS from 'crypto-js';
export default {
    components: {
    'toggler': RouterToggler, 
    'loading': Loading, 
  },
    data() {
        return {
            user_id : '',
            token : '',
            UserData : [],
            Headers : [],
            Selected : [],
        }
    },
    beforeMount(){
        let authenticated = localStorage.getItem('userToken')
        if(authenticated){
            let user_data = JSON.parse(authenticated) ;
            let encrypted_token = user_data[0];
            this.user_id = user_data[1];
            let token = CryptoJS.AES.decrypt(encrypted_token , 'kimoKey_2207');
            this.token =  token.toString(CryptoJS.enc.Utf8);
        }
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
                axios.get(`http://127.0.0.1:8000/api/retrieve/${this.user_id}`).then((response) => {
                    this.UserData = response.data.UserData
                    this.Headers = Object.keys(response.data.UserData[0])
                }).catch(function(error) {
                    console.log(error.response.data.message);
                });
    },
    mounted() {
        let Loading = document.getElementById('Loading')
        setTimeout(() => {
            Loading.classList.add('d-none')
        }, 1200);
    },
    methods: {
        ShowData(index){
            this.Selected = this.UserData[index];
            let allData = document.getElementById('allData')
            let MoreData = document.getElementById('MoreData')
            allData.classList.add('d-none')
            MoreData.classList.remove('d-none')
        },
        showAllTable(){
            let allData = document.getElementById('allData')
            let MoreData = document.getElementById('MoreData')
            allData.classList.remove('d-none')
            MoreData.classList.add('d-none')
        }
    },
}
</script>
