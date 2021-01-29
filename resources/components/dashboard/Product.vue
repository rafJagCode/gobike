<template>
    <v-layout align-center justify-center>
        <div v-if="product">
            <v-card width="800px" color="secondary" dark>
                <v-card-title>
                    {{product.name}}
                    <v-spacer></v-spacer>
                    <basic-button text="wstecz" icon="mdi-arrow-left" routeName="products"></basic-button>
                </v-card-title>
                <div class="d-flex flex-no-wrap justify-space-between">
                    <div>
                        <v-card-text>{{product.description}}</v-card-text>
                        <v-card-subtitle>Cena: {{product.price}}/h</v-card-subtitle>
                        <v-card-subtitle>
                            Dostępność: 
                            <v-icon color="green" v-if="product.availability">mdi-checkbox-marked-circle-outline</v-icon>
                            <v-icon color="red" v-else>mdi-alpha-x-circle-outline</v-icon>
                        </v-card-subtitle>
                        <v-divider class="ma-2"></v-divider>
                        <renting-form :productId="product.id"></renting-form>
                    </div>
                    <v-img class="ma-2" width="300px" height="300px" contain :src="require('@/assets/img/'+product.img+'.jpg')"></v-img>
                </div>
            </v-card>
        </div>
    </v-layout>
</template>
<script>
import RentingForm from '@/components/utils/RentingForm';
export default {
    data(){
        return{
            product: null
        }
    },
    mounted(){
        Vue.axios.get('/api/product/'+this.$route.params.id).then((res)=>{
            this.product = res.data;
        }).catch(()=>{
            this.$router.push({name:'options'});
        });
    },
    components:{
        RentingForm
    }
}
</script>