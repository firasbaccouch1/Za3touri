<template>
        <div>
            <div v-if="data.length >=1" class="u-s-p-y-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="shop-p">    
                                <div  class="shop-p__collection">
                                    <div  class="row is-list-active">
                                        <div  v-for="product in data" :key='product.index' class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product-m">
                                                <div class="product-m__thumb">

                                                    <router-link :to='{name:"Product",params:{slug:product.slug}}' class="aspect aspect--bg-grey aspect--square u-d-block" >

                                                        <img class="aspect__img" v-lazy="baseUrl+'/'+product.thumbnail" alt=""></router-link>
                                                    
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
            <div v-else class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 u-s-m-b-30">
                                <div class="empty">
                                    <div class="empty__wrap">

                                        <span class="empty__big-text">SORRY</span>

                                        <span class="empty__text-1">Your search, did not match any products. A partial match of your keywords is listed below.</span>
                                        <form class="empty__search-form">

                                            <label for="search-label"></label>

                                            <input v-model="search" class="input-text input-text--primary-style" type="text" id="search-label" placeholder="Search Keywords">

                                            <button @click.prevent="searchbtn()" class="btn btn--icon fas fa-search" type="submit"></button></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
        </div>
                                
</template>
<script>
import Api from '../../../app/frontend/Api/Api'
export default {
    data(){
        return {
            data:[],
            Links:[],
            search:null,
            baseUrl:window.location.origin,
        }
    },created(){
      var name = this.$route.params.name
        Api.get('/Search/'+name).then(res => {
            this.data = res.data.data.data
            this.Links = res.data.data.meta.links
        }).catch(err => {
        this.data = []
        })
    },methods:{
        addtocart(slug){
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
        },pages(url){
            if (url != null) {
                 this.loading = true
                Api.get(url).then(res => {
            this.Links = res.data.data.meta.links
            this.data = res.data.data.data
            })
            }
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
            },searchbtn(){
            if (this.search != null && this.search != '') {
              this.$router.push({name: "Search",params:{ name:this.search}})
            }
        } 
    }
}
</script>
<style scoped>
.active{
    color: #ff4500 !important;
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