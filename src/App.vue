<template>

  <div id="app">
  	<Cartsidebar></Cartsidebar>
    <router-view/>
  </div>
</template>

<script>
	import Cartsidebar from  "../src/components/frontend/partials/Cartsidebar";
export default {
  name: 'App',
  data(){
  	return{
  		
  	}
  },

  components:{
  	Cartsidebar
  }
}
</script>


