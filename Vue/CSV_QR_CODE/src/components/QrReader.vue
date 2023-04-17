<template>
    <div class="Bg">
        <div class="reader">
            <toggler></toggler>
            <form>
                <label for="img" class="insertImage" id="insertImg"><i class="fa-solid fa-qrcode" style="font-size: 20px;"></i> Enter your QR Code Image</label>
                <input type="file" class="d-none" name="image" @change="handleUpload($event.target.files)" id="img">
            </form>
            <div class="crop" id="ScannedQr">
                <img src="" alt="" id="QrCodeImg" class="qr">
                <div class='scanner d-none' id="QrScanner"></div>
                <i class="fa-solid fa-check checked d-none" id="checked" style="padding: 1.5vh; color: white; background-color: green; border-radius: 50%;"></i>
            </div>
            <span class="text-danger d-none m-auto m-2 h5 err" id="Error">No QR Code is detected please try another image</span>
            <span class="text-danger d-none m-auto m-2 h5 err" id="Error2">The QR Code doesn't contain csv data</span>
            <span class="text-danger d-none m-auto m-2 h6 err" id="Error3">The CSV data must contains 'First Name' , 'Last Name', 'SSN' , 'Grade'</span>
        </div>
        <div class="viewData d-none" id="viewParsedData">
            <span class="text-white bg-danger p-2 m-auto mb-4 h5 d-none" id="dataBaseError"></span>
        <table>
            <thead>
                <tr>
                    <th>Import</th>
                    <th v-for="(header, index) in headers.slice(0,3)" :key="index">{{ header }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row,rowIndex) in csvParsedData" :key="rowIndex">
                    <td><input type="checkbox" class="checkBox" v-model="selectedRows" id="checkBox" :value="row"></td>
                    <td v-for="(column,columnIndex) in Object.fromEntries(Object.entries(row).slice(0, 3))" :key="columnIndex">{{ column }}</td>
                </tr>
            </tbody>
        </table>
        <button class="saveButton" @click="sendSelectedRows">Save Data</button> 
        <span class="text-danger m-auto m-2 h5 err d-none" id="selectedRowsError">The Rows You have Selected has a missing required value from [First Name , Last Name , SSN , GRADE]</span>
        <span class="text-danger d-none m-auto m-2 h5 err" id="NoSelectedRowsError">Please Select a row first</span>
        <span class="text-white bg-success m-auto m-2 h6 success d-none" id="Success">Selected Rows Have Been Saved and updated Successfully<i class="fa-solid fa-check" style="padding: 1.5vh; color: white;"></i></span>
    </div>
</div>
</template>
<style scoped> 

.fadeOut{
    opacity: 0;
    animation: fadeO 0.3s;
}
@keyframes fadeO {
    0%{
        opacity: 1;
    }
    100%{
        opacity: 0;
    }
}
.fadeIn{
    opacity: 1;
    animation: fadeI 0.2s;
}
.saveButton{
    margin: 2vh auto;
    text-align: center;
    padding: 1.5vh 4vh;
    border: none;
    background-color: antiquewhite;
    color: black;
    border-radius: 4px;
}
.viewData{
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-bottom: 5vh;
}
@keyframes fadeI {
    0%{
        opacity: 0;
    }
    100%{
        opacity: 1;
    }
}
.crop{
    width: 300px;
    height: 300px;
    overflow: hidden;
    margin: auto;
  position:relative;
  text-align: center;
}
.checked{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.qr{
    width: 100% !important;
    margin-bottom: 1.5vh;
}
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
   margin-bottom: 20vh;
}
.reader{
    width: 28%;
    margin: 25vh auto 10vh;
    text-align: center;
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
.err{
    margin-top: 1.5vh;
    text-shadow: 0px 0px 2px black;
}
.scanner {
	width: 100%;
	height: 5px;
	background-color: red;
  opacity: 0.7;
  box-shadow: 0px 0px 8px 10px rgba(170, 11, 23, 0.49);
  position: absolute;
  z-index: 8;
  top:50%;
  animation-name: scan;
  animation-duration: 4s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
  animation-play-state: running;
}
.Detected{
    background-color: green !important;
  box-shadow: 0px 0px 8px 10px rgba(11, 190, 11, 0.49) !important;
}

@keyframes scan {
  0% {
    box-shadow: 0px 0px 8px 10px rgba(170, 11, 23, 0.49);
    top: 50%;
  }  
  25% {
    box-shadow: 0px 6px 8px 10px rgba(170, 11, 23, 0.49);
    top: 5px;
  }
  75% {
    box-shadow: 0px -6px 8px 10px rgba(170, 11, 23, 0.49);
    top: 98%;
  }
}
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
.checkBox{
    width: 5vh;
    height: 2vh;
}
.success{
    padding: 1.5vh 4vh;
    border-radius: 3px;

}
@media screen and (max-width: 700px){
    .reader{
        width: 60%;
    }    
}
</style>
<script>
import RouterToggler from './RouterToggle.vue'
import jsQR from 'jsqr'
import Papa from 'papaparse'
import axios from "axios";
import CryptoJS from 'crypto-js';

export default {
    components: {
    'toggler': RouterToggler, 
  },
data() {
return {
    user_id : '',
    token : '',
    csvParsedData : [],
    headers : [],
    selectedRows : [],
    ErrorSpan : null,
    QrCodeImg : null,
    QrScanner: null,
    ScannedQr : null,
    checked : null,
    ErrorSpan2 : null,
    CsvFormatError : null,
    TableData : null,
    selectedRowsError : null,
    NoSelectedRowsError : null,
    Success : null,
    missingValues : '',
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
},
mounted() {
    // ******* defining global elements ******
    this.ErrorSpan = document.getElementById('Error');
    this.ErrorSpan2 = document.getElementById('Error2');
    this.CsvFormatError = document.getElementById('Error3');
    this.QrCodeImg = document.getElementById('QrCodeImg');
    this.QrScanner = document.getElementById('QrScanner');
    this.ScannedQr = document.getElementById('ScannedQr');
    this.checked = document.getElementById('checked');
    this.TableData = document.getElementById('viewParsedData');
    this.selectedRowsError = document.getElementById('selectedRowsError');
    this.NoSelectedRowsError = document.getElementById('NoSelectedRowsError');
    this.Success = document.getElementById('Success');
},
methods: {
handleUpload(files){
 // ******this method handles uploading the qr code file and displaying the photo with the scanner animation ******  
    let insertImg = document.getElementById('insertImg');
    this.TableData.classList.add('d-none')
    this.QrCodeImg.src = URL.createObjectURL(files[0]);
    insertImg.innerHTML=`<i class="fa-solid fa-image mx-2"></i>Change Image`
    this.ScannedQr.classList.remove('d-none')
    this.ErrorSpan.classList.add('d-none')
    this.CsvFormatError.classList.add('d-none')
    this.ErrorSpan2.classList.add('d-none')
    this.QrScanner.classList.remove('d-none')
    setTimeout(() => {
        this.decodeQr(); // invoking the decodeQr method to detect if the inserted image is qr code or not and decode it
    }, 500);
},
decodeQr(){
    // this method is used to detect the qr code in the image submitted by the user and parse the csv data in the QrCode and view it 

    // ***** detecting the qr code and decoding ******
    const canvas = document.createElement('canvas');
    const canvasContext = canvas.getContext('2d');
    canvas.width = this.QrCodeImg.width
    canvas.height = this.QrCodeImg.height
    canvasContext.drawImage(this.QrCodeImg,0,0,this.QrCodeImg.width,this.QrCodeImg.height);
    canvas.toDataURL('image/jpeg')
    const imageData = canvasContext.getImageData(0,0,canvas.width,canvas.height);
    const code = jsQR(imageData.data,imageData.width,imageData.height);
    // ***** detecting finished ******

    // *****detecting errors if found and handling them*****

        if(code){ // ****** if there is a Qr code detected *******
            this.QrScanner.classList.add('Detected')
            const parsedData = Papa.parse(code.data,{header: true}) // detecting and parsing the csv data if found 
            if(parsedData.data.length > 0){ 
                // ****** if there is csv data found *****
                const expectedHeaders = ['FIRSTNAME','LASTNAME','SSN','GRADE'] // defining the expected headers that should be found in the csv data 
                this.csvParsedData = parsedData.data
                this.headers = Object.keys(parsedData.data[0])
                this.headers = this.headers.map(element => element.toUpperCase());
                let CsvHeaders = this.headers.map(element => element.replace(/\s/g, ''));
                let hasExpectedHeaders = expectedHeaders.every(header => CsvHeaders.includes(header)); 

                // validating the csv data if it has the expected headers or not (first name , last name , ssn , ...)

                if(hasExpectedHeaders){ // if it has the expected headers :
                    this.checked.classList.remove('d-none')
                    this.checked.classList.add('fadeIn')
                    setTimeout(() => {
                        this.TableData.classList.remove('d-none')  // show csv table data with the parsed csv data
                    }, 400);
                }
                else{ // otherwise, if it doesn't have the expected headers display error
                    this.CsvFormatError.classList.remove('d-none')
                }
            }
            setTimeout(() => {
                this.ScannedQr.classList.add('fadeOut')
                setTimeout(() => {
                    this.ScannedQr.classList.add('d-none')
                    this.ScannedQr.classList.remove('fadeOut')
                }, 280);
                this.checked.classList.add('d-none')
                this.checked.classList.remove('fadeIn')
                this.QrScanner.classList.remove('Detected')
                if(parsedData.data.length === 0){ // if there is no csv data detected in the qr code
                this.ErrorSpan2.classList.remove('d-none')
            }
           }, 1300);
        }
        else{ // ****** otherwise, if there is no Qr code detected *******
            this.ErrorSpan.classList.remove('d-none')
            ScannedQr.classList.add('d-none')
        }
},
sendSelectedRows(){
    if(this.selectedRows.length>0){ // if there is at least one row selected by the user ...
        this.NoSelectedRowsError.classList.add('d-none')
        let UpperCaseSelectedRows = this.convertToUpperCase(this.selectedRows);  // convert to upperCase
        let dataBaseError = document.getElementById('dataBaseError')
        dataBaseError.classList.add('d-none')
        // attach the user_id to every selected row
        let user_id = this.user_id; 
        UpperCaseSelectedRows.forEach(function(obj){
            obj['user_id'] = user_id;
        })
        // ********** Finally validate the selected rows before sending to the databse to make sure there is no empty values **********
        let hasRequiredHeaders = this.hasRequiredHeaders(UpperCaseSelectedRows);
        let hasEmptyValues = this.hasEmptyValues(UpperCaseSelectedRows);

        if(hasRequiredHeaders){ // if the selected rows has the required headers ...
            if(!hasEmptyValues){ // if the selected rows has no empty values send selected data ...
                this.selectedRowsError.classList.add('d-none');
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
                axios.post(`http://127.0.0.1:8000/api/saveData/${user_id}`,UpperCaseSelectedRows).then((response) => {
                    this.Success.classList.remove('d-none')
                    this.Success.classList.add('fadeIn')
                    setTimeout(() => {
                        this.Success.classList.remove('fadeIn')
                        this.Success.classList.add('fadeOut')
                        // remove the selected Rows from the table that contains all data
                        this.csvParsedData = this.removeSelectedRows(this.csvParsedData,this.selectedRows);
                        setTimeout(() => {
                            this.Success.classList.add('d-none')
                        }, 250);
                    }, 2000);

                }).catch(function(error) { // if the database responsed with an error display it 
                    dataBaseError.classList.remove('d-none')
                    dataBaseError.textContent = error.response.data.message
                });
            }
            else{ // otherwise the selected rows have empty values
                this.selectedRowsError.classList.remove('d-none'); // display error
            }
        }
        else{// otherwise the selected rows doesn't have the required headers
            this.selectedRowsError.classList.remove('d-none'); // display error
        }
    }
    else{ 
        this.NoSelectedRowsError.classList.remove('d-none') // display error if no selected rows
    }
},
convertToUpperCase(Obj){
     // this is used to convert the selected rows headers into uppercase headers to prevent unexpected errors due to the wrong writing formats 
   let UpperCaseObj = Obj.map(obj => Object.entries(obj).reduce((acc,[key,value]) => {
            acc[key.replace(/\s+/g,'').toUpperCase()] = value;
            return acc;
        },{}))
        return UpperCaseObj;
},
hasRequiredHeaders(Obj){
    // this function is used to check if the Object has the Required Headers or not and return a boolean value
    let hasHeaders = Obj.every(obj => obj.hasOwnProperty('GRADE') && obj.hasOwnProperty('FIRSTNAME') &&
        obj.hasOwnProperty('LASTNAME')&&obj.hasOwnProperty('SSN'));
    return hasHeaders;
},
hasEmptyValues(Obj){
    // this function is used to check if the Object has empty values or not and return a boolean value
    let hasEmptyValues = Obj.some(obj => obj['GRADE']=== '' || obj['FIRSTNAME']=== '' || 
        obj['LASTNAME']=== '' || obj['SSN']=== '');
        return hasEmptyValues;
},
removeSelectedRows(csvParsedData,selectedRows){
    let allData = this.convertToUpperCase(csvParsedData);
    let selectedData = this.convertToUpperCase(selectedRows);
    const filteredArray = allData.filter(item1 => !selectedData.some(item2 => item1.SSN === item2.SSN));
    return filteredArray;
}
},
    
  }

</script>