<template >
<div class="u-s-p-y-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="shop-p">
                                <div class="shop-p__toolbar u-s-m-b-30">
                                    <div class="shop-p__tool-style">
                                        <div class="tool-style__group u-s-m-b-8">

                                            <span @click="showgrid()" :class="grid == true ? 'js-shop-grid-target is-active' :'js-shop-grid-target' ">Grid</span>

                                            <span @click="showlist()" :class="grid == false ? 'js-shop-list-target is-active' :'js-shop-grid-target'  ">List</span></div>
                                     <fieldset :disabled="loading">
                                        <form>
                                            <div class="tool-style__form-wrap">

                                                <div class="u-s-m-b-8">
                                                    <select @change="show()" v-model="showdata" class="select-box select-box--transparent-b-2">
                                                        <option value="10" selected="">Show: 10</option>
                                                        <option value="15" >Show: 15</option>
                                                        <option value="25">Show: 25</option>
                                                        <option value="50">Show: 50</option>
                                                    </select>
                                                </div>
                                                <div class="u-s-m-b-8">
                                                    <select @change="show()"  v-model="showby" class="select-box select-box--transparent-b-2">
                                                        <option value="Newest" selected="">Sort By: Newest Items</option>
                                                        <option value="Latest" >Sort By: Latest Items</option>
                                                        <option value="LowestPrice">Sort By: Lowest Price</option>
                                                        <option value="HighestPrice">Sort By: Highest Price</option>
                                                    </select>
                                                </div>
                                                <div class="u-s-m-b-8">
                                                    <select @change="show()" v-model="showbycategory" class="select-box select-box--transparent-b-2">
                                                        <option selected="">ALL</option>
                                                        <option v-for="category in Category" :key='category.index' :value="category.id" >{{ category.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                        </fieldset>
                                    </div>
                                </div>

                                    
                                <div  class="shop-p__collection">
                                    <div  :class="grid==true?'row is-grid-active':'row is-list-active'">
                                         <div class="fliterloader" v-if="loading">
                               
                                                </div>
                                        <div v-else  v-for="product in Product" :key='product.index' class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product-m">
                                                <div class="product-m__thumb">

                                                    <router-link :to='{name:"Product",params:{slug:product.slug}}' class="aspect aspect--bg-grey aspect--square u-d-block" >

                                                        <img class="aspect__img" v-lazy="product.thumbnail" alt=""></router-link>
                                                    
                                                    <div class="product-m__add-cart">

                                                        <a class="btn--e-brand" @click="addtocart(product.slug)" data-modal="modal" data-modal-id="#add-to-cart">Add to Cart</a></div>
                                                </div>
                                                <div class="product-m__content">
                                                    <div class="product-m__category">
                                                        <router-link :to='{name:"Category",params:{slug:product.category.slug}}'><i :class='product.category.icon + " fa-lg"'> </i> {{ product.category.name }}</router-link>
                                                    </div>
                                                    <div  class="product-m__name">
                                                    <router-link  :to='{name:"Product",params:{slug:product.slug}}'> {{ product.name }} </router-link>
                                                    </div>
                                                    <div class="product-m__rating gl-rating-style">
                                                            <i v-if="product.reviewStar >=1" class="fas fa-star"></i>
                                                            <i v-if="product.reviewStar >1 && product.reviewStar<2" class="fas fa-star-half-alt"></i>
                                                            <i v-if="product.reviewStar >=2" class="fas fa-star"></i>
                                                            <i v-if="product.reviewStar >2 && product.reviewStar<3" class="fas fa-star-half-alt"></i>
                                                            <i v-if="product.reviewStar >=3" class="fas fa-star"></i>
                                                            <i v-if="product.reviewStar >3 && product.reviewStar<4" class="fas fa-star-half-alt"></i>
                                                            <i v-if="product.reviewStar >=4" class="fas fa-star"></i>
                                                            <i v-if="product.reviewStar >4 && product.reviewStar<5" class="fas fa-star-half-alt"></i>
                                                            <i v-if="product.reviewStar >=5" class="fas fa-star"></i>
                                                            <i v-if="product.reviewStar == 0">
                                                                <i class="fas fa-star colorstar"></i>
                                                                <i class="fas fa-star colorstar"></i>
                                                                <i class="fas fa-star colorstar"></i>
                                                                <i class="fas fa-star colorstar"></i>
                                                                <i class="fas fa-star colorstar"></i>
                                                            </i>

                                                        <span class="product-m__review">({{ product.reviewcount }})</span></div>
                                                    <div class="product-m__price">

                                                            <span v-if="product.discount == null" class="product-o__price">$ {{ product.price }}
                                                            <span class="product-o__discount"></span></span>
                                                            <span v-else class="product-o__price">${{ parseFloat(product.price - ((product.discount.discount*product.price)/100)).toFixed(0)}}
                                                            <span class="product-o__discount">${{ product.price  }}</span></span>
                                        
                                                        </div>
                                                    <div class="product-m__hover">
                                                        <div class="product-m__preview-description">

                                                            <span>{{ product.discription }}</span></div>
                                                        <div class="product-m__wishlist">

                                                            <a class="far fa-heart" @click='addtowishlist(product.slug)' title="add to wishlist"></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="u-s-p-y-60">

                                    <!--====== Pagination ======-->
                                        <ul class="lipaginate">
                                        <li v-for="link in Links" :key='link.index' >
                                            <a :class="link.active == true ?'active':''"  @click.prevent="pages(link.url)" v-html="link.label" ></a>
                                        </li>
                                        </ul>
                                    <!--====== End - Pagination ======-->
                                </div>
                               </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                
</template>
<script>
import Api from '../../../app/frontend/Api/Api'
export default {
    name:'FilterProduct',
    data(){
        return {
            Product:[],
            Category:[],
            loading: false,
            Links:[],
            showdata:10,
            showbycategory:'ALL',
            showby:"Newest",
            grid:true,

        }
    },created(){
        this.loading = true
        Api.get('/FilterProductsComponent').then(res => {
            this.Links = res.data.data.product.meta.links
            this.Product = res.data.data.product.data
            this.Category = res.data.data.category
        }).catch(err=>{
            this.loading = true 
        }).finally(()=>{
            this.loading = false 
        })
    },methods:{
        show(){
            this.loading = true 
            Api.get('/FilterProducts/'+this.showdata+'/'+this.showby+'/'+this.showbycategory).then(res => {
            this.Links = res.data.data.product.meta.links
            this.Product = res.data.data.product.data
            }).catch(err => {
             this.loading = true 
            }).finally(()=>{
            this.loading = false 
            })
        },addtowishlist(slug){
                if (this.$store.state.authenticated == true) {
         Api.get('/add-itemtowishlist/'+slug).then(res => {
             this.$toasted.show(res.data.msg)
             this.$store.dispatch('SET_WISHLIST_COUNT','plus')
            }).catch(err => {
                this.$toasted.show(err.response.data.msg,{
                    type : 'info',
                    icon : 'exclamation'
               }) 
            })
                }else{
                this.$toasted.show('You Need To Login First',{
                    type : 'warning',
                    icon : 'smile-beam'
               }) 
                }
            },pages(url){
            if (url != null) {
                 this.loading = true
                Api.get(url).then(res => {
            this.Links = res.data.data.product.meta.links
            this.Product = res.data.data.product.data
                }).catch(err => {
                this.loading = true 
                }).finally(()=>{
                this.loading = false 
                })
            }

        },showgrid(){
            if(this.grid == false){
                this.grid = true
            }
        },showlist(){
            if(this.grid == true){
                this.grid = false
            }
        },addtocart(slug){
        if (this.$store.state.authenticated == true) {
          Api.post('/add-itemtocart/'+slug).then(res =>{
                this.$store.commit('SET_CART',res.data.data)
                this.$toasted.show(res.data.msg,{
                    type : 'success',
                    icon : 'cart-plus'
               }) 
             }).catch(err => {
                this.$toasted.show(err.response.data.msg,{
                    type : 'info',
                    icon : 'exclamation'
               }) 
             })
                }else{
            this.$toasted.show('You Need To Login First',{
                    type : 'warning',
                    icon : 'smile-beam'
               }) 
        }
        }
        
    }
}

</script>
<style scoped>
fieldset {
    border: none;

}

.active{
    color: #ff4500 !important;
}
.fliterloader{

/* Loader Div Class */
  z-index: 100000000000000 !important;;
    width: 100%;
    height:500px;
    background-color:#e9e9e9;
    background-image: url('../../../../../public/frontend/images/loding/loding.gif');
    background-size: 200px;
    background-repeat:no-repeat;
    background-position:center;
}
.lipaginate > li > a { 
    line-height: 42px;
    display: block;
    font-weight: 600;

    color: #333333;
}
.lipaginate > li  { 
    margin-right: 15px;
}
.lipaginate{
        margin: 12px;
    padding: 0;
    list-style: none;
    -ms-flex-pack: center;
    justify-content: center;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}
.colorstar{
    color: #cfcfcfd5;
}
</style>
