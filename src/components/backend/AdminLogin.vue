<template>
  <div class="login">
    <div class="loginHeader">Admin Login</div>

    <div class="loginContainer">
      <table>
        <tr>
          <td>Username</td>
          <td>:</td>
          <td>
            <input type="text" placeholder="Email"  v-model="user.email" />
          </td>
        </tr>
        <tr>
          <td>Password</td>
          <td>:</td>
          <td>
            <input type="Password" placeholder="Password" v-model="user.password" />
          </td>
        </tr>

        <tr>
          <td></td>
          <td></td>
          <td>
            <button class="addBtn" @click="loginnow()" >Login</button>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
  export default{
   name: "AdminLogin",
   data(){
    return {
      user: {email : "", password : "" }
    };
   },

   methods:{

    loginnow(){
      //console.log(this.user);
      var formData = this.toFormData(this.user);
      this.$axios.post("http://localhost/vue-ecom/src/assets/api/adminlogin_api.php?action=login", formData)
      .then(res =>{
        if (res.data.error) {

            this.$iziToast.error({
              title: 'Warnning',
              message: res.data.message
            });
        }else{

          this.user = {}
          this.$iziToast.success({
              title: 'Welcome',
              message: res.data.message
          });

          localStorage.setItem("token", res.data.token);
          this.$router.push({ name: "admin" });
        }
      });
    },


    toFormData: function(obj) {
      var form_data = new FormData();
      for (var key in obj) {
        form_data.append(key, obj[key]);
      }
      return form_data;
    }

   },

   mounted(){

      var token = localStorage.getItem("token");
      if (token) {
       this.$router.push({ name: "admin.dashboard" });
      }
   }
  }
</script>


