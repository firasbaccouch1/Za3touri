<template>
    <div >              
      
                   <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                                        <span v-if="errors != null" class="text-danger">{{ errors }}</span><br>
                            <span class="color-gray">Chose Discount What u want to do Discount it </span>
                            <select @change="onchange($event)"  class="form-control form-control-user text-center selectionstyle" multiple >
                              <option value="Category" > Category </option>
                              <option value="Product" > Product </option>
                          </select>
                            <br>
                          </div>
                        </div>
                        <div v-if="Categories != null" class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">Chose Category </span>
                            <select name="category" class="form-control text-center">
                                <option v-for="Category in Categories" :key="Category.length" :value="Category.id"> {{ Category.name }} </option>
                              </select>
                            <br>
                          </div>
                        </div>
                        <div v-if="Products != null" class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">Chose Product </span>
                            <select name="product" class="form-control text-center">
                                <option v-for="Product in Products" :key="Product.length" :value="Product.id"> {{ Product.name }} </option>
                              </select>
                            <br>
                          </div>
                        </div>
    </div>
</template>

<script>
    export default {
        name:'Discount',
        data(){
            return{
                Categories:null,
                Products:null,
                errors:null,
   
            }
           
        },
        methods:{
            onchange(event){
               if (event.target.value == 'Category') {
                      axios.get('/admin/categories/discount')
                        .then(res => {
                        this.Categories=res.data;
                           this.Products = null; 
                           this.errors = null;
                        })
                        .catch(error=>{
                            this.Products = null; 
                             this.Categories = null; 
                            this.errors=null,
                            this.errors ='All the Category has Discount No more Category to put Discount on';
                        })
               }if (event.target.value == 'Product') {  
                     axios.get('/admin/products/discount')
                        .then(res =>{
                            this.Products=res.data;
                           this.Categories = null; 
                           this.errors = null;
                        })
                        .catch(error=>{
                             this.Products = null; 
                             this.Categories = null; 
                            this.errors=null,
                            this.errors ='All the product has Discount No more Product to put Discount on';
                        })
               }
            }
        }
     
    }
</script>
<style>
#selectionstyle{
    border-radius: 50px;height: 90px
}
    select option:checked{
   background: #1aab8e -webkit-linear-gradient(bottom, #1aab8e 0%, #1aab8e 100%);
 }
</style>
