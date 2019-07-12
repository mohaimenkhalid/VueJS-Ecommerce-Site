<template>
  <div class="admin">
    <div id="header">
        <h1 class="fleft">Simple E-commerce</h1>
        <a href="" title="Logout" class="fright" @click="logoutnow()">Logout</a>
    </div>

    <div id="sidebar1">

      <ul class="nav">
        <li><router-link to="/admin/dashboard">Dashboard</router-link></li>
        <li><router-link to="/admin/category">Category</router-link></li>
        <li><router-link to="/admin/supplier">Supplier</router-link></li>
        <li><router-link to="/admin/product">Product</router-link></li>
        <li><router-link to="/shop">Shop</router-link></li>
      </ul>
      
    </div>
  
   

    <div id="main">
        
        <router-view />

    </div>  
    </div>
  </div>
</template>

<script>
  export default {
      name: 'Admin',

      data(){
        return{

        }
      },

      methods: {
        logoutnow(){
          localStorage.setItem("token", "");
          this.$router.push({name: "admin.login"});
        }
      },

      mounted(){
        var token = localStorage.getItem("token");

        if (!token) {
          this.$router.push({ name: "admin.login" });
        }
      }

  }
</script>