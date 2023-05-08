<template>
  <div class="row p-2 justify-content-center" >
    <div class="col-md-10 my-1 " v-if="status
    ===true">
         <div class="card shadow-lg p-2">
            <div class="card-body shadow p-3">
              <div class="row">
                <div class="col-md-7">
                  <h2>Client Name: {{client.firstname + " " + client.lastname}}</h2> 
                </div>

                <div class="col-md-5 text-right">
                  <img v-if="client.profile_image===null" src="/profile/noimage.png" :alt="client.name" class="img img-rounded" style="height: 100px; margin-left:20px">
  
                    <img v-else :src="client.profile_image" :alt="client.name" class="img img-rounded" style="height: auto; margin-left:20px;width:60px">

                </div>

              </div>

              <hr/>
              <p>Case Details: <b>{{client.case_detail}}</b></p>
              <hr>
              <small>Date profiled: <b>{{client.date_profiled}}</b> </small>
              <hr>
              <small>Date of birth: <b>{{client.date_of_birth}}</b> </small>
              <hr>
              <span>Email: {{client.email}}</span>
              <hr>
              <span>Legal Counsel: {{client.counsel_name}}</span>
            </div>
         </div>
        </div>
  </div>
</template>
<script>
import { useRoute } from 'vue-router';

export default {
  name:"profile",
     data(){
       return {
        
         client :null,
         message :null,
         status :false
       }
     },
 
     methods:{
   
      async getClient(id){
         let url = `/api/client/detail/${id}`
         let response = await axios.get(url)
      
         this.client = response.data.data
         this.status = response.data.status
       }
     },
 
     mounted() {
      const route = useRoute()
      let id = route.params.id
      this.getClient(id)
   
     }
}
</script>
