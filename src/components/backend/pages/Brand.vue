<template>
	<div>
      <!-- Add Modal -->
      <modal  :cond="showingAddModal" modalHeading="Add New Brand" @modalClose="showingAddModal = false">
        <table >
            <tr>
              <td>Brand Name</td>
              <td><input type="text" id="newbrandname" v-model="newbrand.name"  placeholder="Brand Name">
                
              </td>
            </tr>

            <tr>
              <td>Description</td>
              <td>
                <textarea rows="4" type="text" id="newbrandname" v-model="newbrand.description"   placeholder="Write a short Description">
                  
                </textarea>
              </td>
            </tr>

            <tr>
              <td></td>
              <td>
                <button class="btnSave" @click="addNewBrand()" >Save</button>
              </td>
            </tr>
        </table>
      </modal>

      <!-- Edit Model -->

    <modal :cond ="showingEditModal" modalHeading="Edit This Brand" @modalClose="showingEditModal = false">
      <table >
            <tr>
              <td>Brand Name</td>
              <td><input type="text" id="newcatname" v-model="clickedbrand.bname"  placeholder="Category Name">
                
              </td>
            </tr>

            <tr>
              <td>Description</td>
              <td>
                <textarea rows="4" type="text" id="newcatname" v-model="clickedbrand.description"  placeholder="Write a short Description">
                  
                </textarea>
              </td>
            </tr>

            <tr>
              <td></td>
              <td>
                <button class="btnSave" @click="updateBrand()" >Save</button>
              </td>
            </tr>
        </table>
    </modal>


    <!-- Delete Model -->

      <modal modalHeading="Delete This Brand" :cond="showingDeleteModal" @modalClose="showingDeleteModal = false">
          <table >
        
          <tr>
              <td><h3>Are You sure to Delete this Category "{{ clickedbrand.bname }}" ?</h3></td>

              
            </tr>

            <tr>
              
              <td>
                <button class="btnSave" @click="deleteBrand()" >Yes</button>
                <button class="btnClose" @click="showingDeleteModal = false" >No</button>
              </td>
              
                
             
            </tr>
          </table>
      </modal>


       <h2 class="fleft ">Brands</h2>
       <button class="fright addBtn" @click= "showingAddModal = true">Add New</button>
      <div class="clear"></div>
      <hr>

      
      <table class="nice-table" >
          
          <tr >
            <th>S/L</th>
            <th>Name</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          

          <tr v-for="(brand, i)  in brands">
            <td>{{ i+1 }}</td>
            <td> {{ brand.bname }} </td>
            <td> {{ brand.description }} </td>
            <td><button class="edit" @click="clickedBrand(brand); showingEditModal = true" >Edit</button></td>
            <td><button class="delete"  @click="clickedBrand(brand); showingDeleteModal = true">Delete</button></td>
          </tr>
      </table>

	</div>
</template>

<script>
  export default{
    name: 'brand',
    data(){
      return{
        showingAddModal : false,
        showingEditModal : false,
        showingDeleteModal : false,
        newbrand: { name: "", description: ""},
        brands : [],
        clickedbrand: {}
      }
    },

    mounted(){

      this.init();
    },


    methods: {

      init(){

          this.$axios.get("http://localhost/vue-ecom/src/assets/api/brand_api.php?action=read")
          .then(res=>{
              this.brands = res.data.brand;
          });
      },

      addNewBrand(){

        var formData = this.toFormData(this.newbrand);
        this.$axios.post("http://localhost/vue-ecom/src/assets/api/brand_api.php?action=create", formData)
        .then(res=>{
          
          if (res.data.error) {

                 this.$iziToast.error({
                    title: 'Warnning',
                    message: res.data.message
                  });
              }else{

                this.newcategory = {}
                this.$iziToast.success({
                     title: 'Success',
                     message: res.data.message
                  }); 
                   this.init();
                  this.showingAddModal = false;  

              }
        });
      },

      updateBrand(){

        var formData = this.toFormData(this.clickedbrand);
        this.$axios.post("http://localhost/vue-ecom/src/assets/api/brand_api.php?action=update", formData)
        .then(res=>{
          
          if (res.data.error) {

                 this.$iziToast.error({
                    title: 'Warnning',
                    message: res.data.message
                  });
              }else{

                this.newcategory = {}
                this.$iziToast.success({
                     title: 'Success',
                     message: res.data.message
                  }); 
                   this.init();
                  this.showingEditModal = false;  

              }
        });

      },

      deleteBrand(){

          var formData = this.toFormData(this.clickedbrand);
        this.$axios.post("http://localhost/vue-ecom/src/assets/api/brand_api.php?action=delete", formData)
        .then(res=>{

          if (res.data.error) {

                 this.$iziToast.error({
                    title: 'Warnning',
                    message: res.data.message
                  });
              }else{

                this.newcategory = {}
                this.$iziToast.success({
                     title: 'Success',
                     message: res.data.message
                  }); 
                   this.init();
                  this.showingDeleteModal = false;  

              }

        });
      },

      clickedBrand(brand){
          this.clickedbrand = brand;
      },

      toFormData: function(obj){
            var form_data = new FormData();
              for ( var key in obj ) {
                 form_data.append(key, obj[key]);
              } 
              return form_data;
           }

    }
  }
</script>