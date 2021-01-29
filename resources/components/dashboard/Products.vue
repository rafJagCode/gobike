<template>
    <v-container fill-height class="products_container" style="width:700px">
        <basic-button class="mb-5" block text="wstecz" icon="mdi-arrow-left" routeName="options"></basic-button>
        <v-row v-for="(product, index) in products" :key="index">
            <v-card
              color="secondary"
              dark
              width="800px"
              class="mb-2"
            >
              <div class="d-flex flex-no-wrap justify-space-between">
                <div class="products__info">
                  <v-card-title
                    class="headline"
                    v-text="product.name"
                  ></v-card-title>
  
                  <v-card-subtitle v-text="product.description"></v-card-subtitle>
  
                  <v-card-actions>
  
                    <v-btn
                      class="ml-2 mt-5"
                      outlined
                      rounded
                      small
                      @click="goTo(product.id)"
                      v-if="product.availability"
                    >
                      WYPOŻYCZ
                    </v-btn>
                    <v-card-text v-else>Produkt auktualnie niedostępny</v-card-text>
                  </v-card-actions>
                </div>
                <div>
                    <v-card-subtitle>Cena: {{product.price}}/h</v-card-subtitle>
                </div>
                <div>
                    <v-card-subtitle>
                        Dostępność: 
                        <v-icon color="green" v-if="product.availability">mdi-checkbox-marked-circle-outline</v-icon>
                        <v-icon color="red" v-else>mdi-alpha-x-circle-outline</v-icon>
                    </v-card-subtitle>
                </div>
                <v-avatar
                  class="ma-3"
                  size="125"
                  tile
                  
                >
                  <v-img size="125" cover :src="require('@/assets/img/'+product.img+'.jpg')"></v-img>
                </v-avatar>
              </div>
            </v-card>
        </v-row>
    </v-container>
</template>
<script>
export default{
  data(){
      return{
          products: []
      }
  },
  mounted(){
      Vue.axios.get('/api/products').then((res)=>{
          this.products = res.data;
      })
  },
  methods:{
    goTo(id){
      this.$router.push({name: 'product', params: {id}});
    }
  }
}
</script>
<style scoped>
.products__info{
    width: 200px;
}
</style>