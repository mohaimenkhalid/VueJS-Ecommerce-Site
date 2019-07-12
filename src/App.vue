<template>

  <div id="app">
  	<div style=" 
  	width: 230px;
  	float: left;
  	position: fixed;
	z-index: 999999999;
	top: 0;
	bottom: 0;
	right: 0;
	background: rgba(255,255,255, 0.8);
	padding-top: calc(50vh - 158px);
  	" v-if="cartsidebar">
  	<div><button @click=" cartsidebar = false">Close</button></div>
			<table>
				<tr>
					<td>Name</td>
					<td>Quantity</td>
					<td>Price</td>
				</tr>
				<tr>
					<td>Name</td>
					<td>Quantity</td>
					<td>Price</td>
				</tr>
			</table>
	</div>
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App',
  data(){
  	return{
  		cartsidebar : false,
  	}
  }
}
</script>


