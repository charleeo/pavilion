<template>
   
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <router-link to="/" class="navbar-brand" >Home</router-link>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
            
            </ul>
            <ul class="navbar-nav ">
                
                <li class="nav-item">
                    <router-link to="/onboard" class="nav-link">Onboard Client</router-link>
                </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="container">
        <router-view></router-view>
    </div>
   
</template>