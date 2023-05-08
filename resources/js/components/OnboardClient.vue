<template>
  <div class="row  justify-content-center">
    <div class="col-md-10">
          <form action="" @submit.prevent="add">
            <div class="card shadow p-5">
                <div class="card-body shadow-lg">
                 
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" ref="firstname" name="firstname" placeholder="firstname" v-model="formValue.firstname" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" ref="lastname" name="lastname" placeholder="lastname" v-model="formValue.lastname" class="form-control">
                      </div>
                    </div>
                  </div>
                 
                  <div class="row justify-content-center mt-2">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" ref="email" name="email" placeholder="email" v-model="formValue.email" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="primary_legal_counsel">Legal Counsel</label>
                        <select name="primary_legal_counsel"
                         v-model="formValue.primary_legal_counsel" ref="primary_legal_counsel"
                         class="form-control"
                        >
                         <option value="">select counsel</option>
                           <option v-for="counsel in legalCounsels" :value="counsel.id ">{{counsel.counsel_name}}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="date_of_birth">Date Of Birth</label>
                        <input type="date" ref="date_of_birth" placeholder="date of birth" name="date_of_birth" v-model="formValue.date_of_birth" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="date_profiled">Date Profiled</label>
                        <input type="date" placeholder="date profiled" name="date_profiled" v-model="formValue.date_profiled"  class="form-control">
                       
                      </div>
                    </div>
                  </div>

                  <div class="row justify-content-center mt-2">

                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="case_detail">Case Detail</label>
                        <textarea name="case_detail" placeholder="case detail" cols="30" rows="6" ref="case_detail" class="form-control" v-model="formValue.case_detail"></textarea>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" placeholder="profile image" name="profile_image" v-on:change="onChange" class="form-control">
                      </div>
                    </div>

                  </div>

                  <!-- Error marker -->
                  <ul :if="validationFailed">
                    <li v-for="message in errorMessage" class="text-danger list-style-none mt-2">{{ message }}</li>
                 </ul>

                 <small v-if="successMessage" class="alert alert-success">{{ successMessage }}</small>
                  
                  <!-- Error marker -->

                  <div class="row justify-content-center mt-4">
                    <div class="col-md-12">
                      <div class="form-group">
                       <button type="submit" class="btn btn-info btn-sm">submit</button>
                      </div>
                    </div>
                  </div>

                  

                </div>
            </div>
          </form>
        </div>
    </div>
</template>


<script>
import  axios  from "axios"
import router from '../routes/index';
 export default({
    name:"OnboardClient",
    data(){
      return {
        formValue:{
          firstname:"",
          lastname:"",
          email:"",
          case_detail:"",
          date_profiled:"",
          date_of_birth:"",
          primary_legal_counsel:"",
        },
        file:"",
        legalCounsels :[],
        errorMessage:[],
        successMessage:null,
        validationFailed:false,
        errorField :null
      }
    },

    methods:{
     async add(){
        let url = "/api/client"
        this.errorMessage = []
        this.successMessage = null

        const config = {
          headers: {
              'content-type': 'multipart/form-data'
          }
        }
        
        let fd = new FormData
        // fd.append("profile_image",this.file)
        const {lastname,firstname,email,case_detail,date_of_birth,date_profiled,primary_legal_counsel} = this.formValue
        const data = {lastname,firstname,email,case_detail,date_profiled,date_of_birth,primary_legal_counsel,profile_image:this.file}
  
        let response = await axios.post(url,data,config)
        let status =response.data.status

        if(status===false){
          let message = response.data.response
          let errorField = message[0].field
          for(let i =0; i < message.length;i++){
            this.errorMessage.push(message[i].message)
            this.validationFailed=true
          }
          
        }else if(status===true){
          this.successMessage= response.data.message
          setTimeout(() => {
            router.push({ name: 'Home' })
          }, 1000);
        }

      
      },

      onChange(e) 
      {
          this.file = e.target.files[0];
      },

     async getLegalCounsel(){
        let url = "/api/counsels"
        let response = await axios.get(url)
        this.legalCounsels = response.data.data
      }
    },

    mounted() {
      this.getLegalCounsel()
      this.successMessage=null
    }
    
 })
</script>