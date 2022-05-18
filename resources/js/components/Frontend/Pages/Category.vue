<template>
    <div class="u-s-p-y-60">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-46">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary u-s-m-b-12">FIND NEW {{ Category.name }}    <i :class='Category.icon +" fa-lg"'></i></h1>

                                    <span class="section__span u-c-silver">ALL OF NEW {{ Category.name }} Will BE HERE</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->


                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div v-for="product in Product" :key='product.index' class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
                                <div class="product-o product-o--hover-on u-h-100">
                                    <div class="product-o__wrap">

                                        <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">

                                            <img class="aspect__img" v-lazy="base_url +'/'+ product.thumbnail" alt=""></a>
                                        <div class="product-o__action-wrap">
                                            <ul class="product-o__action-list">
                                                <li>

                                                    <router-link :to='{name:"Product",params:{slug:product.slug}}' data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick View"><i class="fas fa-search-plus"></i></router-link></li>
                                                <li>

                                                    <a data-modal="modal" @click.prevent="addtocart(product.slug)" data-modal-id="#add-to-cart" data-tooltip="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-bag"></i></a></li>
                                                <li>

                                                    <a @click.prevent="addtowishlist(product.slug)" data-tooltip="tooltip" data-placement="top" title="Add to Wishlist"><i class="fas fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <span class="product-o__name">

                                        <router-link :to='{name:"Product",params:{slug:product.slug}}' >{{ product.name }}</router-link></span>
                                    <div class="product-o__rating gl-rating-style">
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

                                        <span class="product-o__review">({{product.reviewcount }})</span></div>

                                        <span v-if="product.discount == null" class="product-o__price">$ {{ product.price }}
                                        <span class="product-o__discount"></span></span>
                                        <span v-else class="product-o__price">${{ parseFloat(product.price - ((product.discount.discount*product.price)/100)).toFixed(0)}}
                                        <span class="product-o__discount">${{ product.price  }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
</template>
<script>
import Api from '../../../app/frontend/Api/Api'
export default {
    created(){
         this.Categorydata()
         
    },
    data(){
        return {
            Product:[],
            Category:[],
            base_url: window.location.origin 
        }
    },methods:{
     Categorydata(){
             let slug = this.$route.params.slug
     Api.get('CategoryComponent/'+slug)
          .then(res => {
              this.Category = res.data.data.category
              this.Product = res.data.data.product
          }).catch(() => {
             this.$router.push({ name: "Home"})
            this.$toasted.show('the Category you are looking for is no longer exist',{
            icon : 'exclamation-triangle',
            type:'error'
            })
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
            this.$toasted.show('You Need To Login First')
        }
        }  
    },

    

}
</script>