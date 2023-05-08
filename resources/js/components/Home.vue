<template>
   <div  v-if="status
   ===true">
   <div class="row justify-content-center">
      <div class="col-md-4">
         <input type="text" class="form-control" placeholder="filter clients by their lastname" name="search"  v-on:keyup="search">
      </div>
   </div>
      <div class="row p-2">
         <div class="col-md-6 my-1" v-for="client in clients">
            <div class="card shadow-lg p-2">
               <div class="card-body shadow p-3">
                  <div class="d-flex">
                     <h2>Client Name: {{client.name}}</h2>
   
                     <img v-if="client.profile_image===null" src="profile/noimage.png" :alt="client.name" class="img img-rounded" style="height: 40px; margin-left:20px;width:60px">
   
                     <img v-else :src="client.profile_image" :alt="client.name" class="img img-rounded" style="height: auto; margin-left:20px;width:60px">
   
                     
                  </div>
                  <hr/>
                  <p>Case Details: <b>{{client.detail}}</b></p>
                  <small>Date profiled: <b>{{client.date_profiled}}</b> </small>
                  <hr/>
                  <router-link :to="{ name: 'profile', params: { id: client.id }}" class="nav-link">View</router-link>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div v-else class="row justify-content-center">
      <div class="col-md-10">
         <p class="text-center">
            No Client information found at the momemt. Please onboard a client using <router-link to="/onboard" class="nav-link">Onboard Client</router-link>
         </p>
      </div>
   </div>
 </template>
 
 
 <script>
 import  axios  from "axios"
 
  export default({
     name:"Home",
     data(){
       return {
        
         clients :[],
         message :null,
         status :false,
       }
     },
 
     methods:{
   
      async getClients(search=""){
         let url = `api/client?search=${search}`
         let response = await axios.get(url)
         this.clients = response.data.data
         this.status = response.data.status
       },

       async search(e){
          const search = e.target.value
          await this.getClients(search)
       }
     },
 
     mounted() {
       this.getClients()
     }
     
  })
 </script>