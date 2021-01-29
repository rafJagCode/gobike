<template>
    <v-layout align-center justify-center>
        <div v-if="showProduct">
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
                        <renting-form :product="product"></renting-form>
                    </div>
                    <v-img class="ma-2" width="300px" height="300px" contain :src="require('@/assets/img/'+product.img+'.jpg')"></v-img>
                </div>
            </v-card>
        </div>
        <v-layout justify-center align-center v-else>
            <basic-button text="Wróć" routeName="products" icon="mdi-arrow-left"></basic-button>
            <div class="mainOrange--text text-h3 ml-3">
                Produkt chwilowo niedostępny
            </div>
        </v-layout>
    </v-layout>
</template>
<script>
import RentingForm from '@/components/utils/RentingForm';
export default {
    data(){
        return{
            product: null,
        }
    },
    computed:{
        showProduct(){
            if(this.product){
                if(this.product.availability) return true;
                return false;
            };
            return false;
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