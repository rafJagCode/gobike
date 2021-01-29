<template>
<v-container>
    <v-layout column justify-start>
        <v-layout align-center>
            <basic-button v-if="reservations.length" class="mb-2" text="wstecz" icon="mdi-arrow-left" routeName="options"></basic-button>
        </v-layout>
        <div class="reservations" v-if="reservations.length">
            <v-card color="secondary" class="mainOrange--text text-overline" v-for="(reservation,index) in reservations" :key="index">
                <v-alert outlined color="mainOrange">
                    <v-card-title>Zamówienie nr: {{reservation.id}}</v-card-title>
                    <v-layout row>
                        <v-icon color="mainOrange" size="80" class="ma-2">mdi-calendar</v-icon>
                        <v-layout column justify-center class="reservation__info ma-2">
                            <div class="text-center">Data rozpoczęcia rezerwacji:</div>
                            <div class="text-center">{{reservation.dateFrom}}</div>
                        </v-layout>
                        <v-divider dark vertical></v-divider>
                        <v-layout column justify-center class="reservation__info ma-2">
                            <div class="text-center">Data zakończnia rezerwacji:</div>
                            <div class="text-center">{{reservation.dateTo}}</div>
                        </v-layout>
                        <v-divider dark vertical></v-divider>
                        <v-layout  column justify-center class="reservation__info ma-2">
                            <div class="text-center">Produkt</div>
                            <div class="text-center">{{reservation.product.name}}</div>
                        </v-layout>
                        <v-divider dark vertical></v-divider>
                        <v-layout  column justify-center class="reservation__info ma-2">
                            <div class="text-center">Koszt</div>
                            <div class="text-center">{{cost(reservation.dateFrom, reservation.dateTo, reservation.product.price)}}</div>
                        </v-layout>
                        <v-avatar size="100" tile class="reservation__info mx-2">
                            <v-img width="100" height="100" contain :src="require('@/assets/img/'+reservation.product.img+'.jpg')"></v-img>
                        </v-avatar>
                    </v-layout>
                    <v-divider dark></v-divider>
                    <v-layout>
                        <v-spacer></v-spacer>
                        <v-btn class="mt-4 ma-1" @click="deleteReservation(index, reservation.id)" color="mainRed">Anuluj rezerwacje</v-btn>
                    </v-layout>
                </v-alert>
            </v-card>
        </div>
        <loader v-if="loading"></loader>
        <v-container v-if="noReservations" flex>
            <v-alert class="text-center text-h5" height="70" width="100%" color="secondary">
                <basic-button icon="mdi-arrow-left" text="Wróć" routeName="options" class="mr-5"></basic-button>
                <span class="mainOrange--text">
                    Aktualnie brak rezerwacji
                </span> 
            </v-alert>
        </v-container>
    </v-layout>
    </v-container>
</template>
<script>
export default {
    data:()=>({
        reservations: [],
        loading: true,
        user: null
    }),
    watch:{
        '$store.getters.user': function(user){
            if(this.$store.getters.user!=null){
                this.user = this.$store.getters.user;
                this.getReservations(this.user.id);
            }
        }
    },
    mounted(){
        if(this.$store.getters.user!=null){
            this.user = this.$store.getters.user;
            this.getReservations(this.user.id);
        }
    },
    computed:{
        noReservations(){
            if(!this.loading){
                if(!this.reservations.length) return true;
            };
            return false;
        }
    },
    methods:{
        getReservations(userId){
            Vue.axios.post('/api/reservations', {userId:userId}).then((res)=>{
                this.reservations = res.data;
                this.loading = false;
            });
        },
        deleteReservation(index, id){
            Vue.axios.post('/api/deleteReservation', {id: id} ).then((res)=>{
                this.reservations.splice(index, 1);
            });
        },
        cost(dateFrom, dateTo, price){
            dateFrom = new Date(dateFrom);
            dateTo = new Date(dateTo);
            let days = (dateTo.getTime() - dateFrom.getTime())/(1000*60*60*24);
            return days*price + 'zł';
        }
    }
}
</script>
<style scoped>
    .reservation__info{
        width: 200px;
    }
</style>