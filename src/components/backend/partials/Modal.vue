<template>
	<transition name="scale">
		<div class="modal" v-if="showingModal">
			<div class="modalContainer" >
				<div class="modalHeader">
					<p class="fleft"> {{ modalHeading }} </p>
					<p class="fright modalClose" @click="$emit('modalClose' )">x</p>
					<div class="clear"></div>
				</div>
				
				<div class="modalContent">
					<slot></slot>
				</div>
				<div class="modalFooter">
					<button class="fright btnClose" @click="$emit('modalClose' )">Close</button>
					<div class="clear"></div>
					
				</div>
			</div>
		</div>
	</transition>
</template> 


<script type="text/javascript">
	export default {
		name: "model",

		data(){
			return{

				
			}
		},

		computed: {
			showingModal(){
				return this.cond;
			}
		},

		props: ["cond", "modalHeading"]
		
	}
</script>