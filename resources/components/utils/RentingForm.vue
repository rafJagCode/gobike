<template>
    <v-form class="ma-3">
        <v-menu
            ref="menu"
            v-model="menu"
            :close-on-content-click="false"
            :return-value.sync="dateFrom"
            transition="scale-transition"
            offset-y
            min-width="auto"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                v-model="dateFrom"
                label="Data odebrania roweru:"
                prepend-icon="mdi-calendar"
                v-bind="attrs"
                v-on="on"
                ></v-text-field>
            </template>
            <v-date-picker
                v-model="dateFrom"
                no-title
                scrollable
                locale="pl"
                :show-current="false"
            >
                <v-spacer></v-spacer>
                <v-btn
                text
                color="primary"
                @click="menu = false"
                >
                Cancel
                </v-btn>
                <v-btn
                text
                color="primary"
                @click="$refs.menu.save(dateFrom)"
                >
                OK
                </v-btn>
            </v-date-picker>
            </v-menu>
            <v-menu
            ref="menu2"
            v-model="menu2"
            :close-on-content-click="false"
            :return-value.sync="dateTo"
            transition="scale-transition"
            offset-y
            min-width="auto"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                v-model="dateTo"
                label="Data zwrotu roweru:"
                prepend-icon="mdi-calendar"
                v-bind="attrs"
                v-on="on"
                ></v-text-field>
            </template>
            <v-date-picker
                v-model="dateTo"
                no-title
                scrollable
                locale="pl"
                :show-current="false"
            >
                <v-spacer></v-spacer>
                <v-btn
                text
                color="primary"
                @click="menu2 = false"
                >
                Cancel
                </v-btn>
                <v-btn
                text
                color="primary"
                @click="$refs.menu2.save(dateTo)"
                >
                OK
                </v-btn>
            </v-date-picker>
        </v-menu>
        <v-alert width="200" v-if="showAlert" color="secondary" class="py-0 my-0 mainRed--text">{{alertMessage}}</v-alert>
        <v-btn 
        class="signup-btn mainOrange--text mt-1"
        type="submit"
        outlined
        rounded
        block
        dark
        @click.prevent="handleSubmit()">
            WYPOŻYCZ
        </v-btn>
        <v-dialog width="fit-content" v-model="dialog">
            <v-card width="fit-content" color="secondary" class="mainOrange--text">
                <v-card-title>Potwierdzenie rezerwacji</v-card-title>
                <v-divider dark></v-divider>
                <v-layout justify-center align-center class="reservation__confirmation">
                    <div>
                        <v-card-text class="py-1">Data odebrania</v-card-text>
                        <v-card-text class="py-1">{{dateFrom}}</v-card-text>
                    </div>
                    <v-divider vertical dark></v-divider>
                    <div>
                        <v-card-text class="py-1">Data zwrotu</v-card-text>
                        <v-card-text class="py-1">{{dateTo}}</v-card-text>
                    </div>
                    <v-divider vertical dark></v-divider>
                    <div>
                        <v-card-text class="py-1">Produkt</v-card-text>
                        <v-card-text class="py-1">{{product.name}}</v-card-text>
                    </div>
                    <v-divider vertical dark></v-divider>
                    <div>
                        <v-card-text class="py-1">Koszt</v-card-text>
                        <v-card-text class="py-1">{{cost(dateFrom, dateTo, product.price)}}</v-card-text>
                    </div>
                </v-layout>
                <v-divider dark></v-divider>
                <v-layout justify-end align-center class="pa-2">
                    <v-btn class="mr-2" color="success" @click="makeReservation()">Potwierdź</v-btn>
                    <v-btn color="error" @click="dialog = false">Cancel</v-btn>
                </v-layout>
                <v-alert type="error" height="20" class="flex-row align-center justify-center">
                    <div>
                        Produkt jest już niedostępny
                    </div>
                </v-alert>
            </v-card>
        </v-dialog>
    </v-form>
</template>
<script>
export default {
    data: () => ({
        dateFrom: new Date().toISOString().substr(0, 10),
        dateTo: new Date(Date.now()+1000*60*60*24).toISOString().substr(0, 10),
        menu: false,
        menu2: false,
        modal: false,
        showAlert: false,
        alertMessage: '',
        dialog: false,
        reservationFailed: false,
    }),
    props:{
        product: null
    },
    methods:{
        handleSubmit(){
            if(!this.isDateFromCorrect()){
                this.alertMessage = 'Data odebrania nie może być wcześniejsza niż dzisiejsza';
                this.showAlert = true;
                return;
            }
            if(!this.isPeriodCorrect()) {
                this.alertMessage = 'Data zwrotu musi być datą późniejszą niż data odebrania';
                this.showAlert = true;
                return;
            }
            this.dialog = true;
        },
        isPeriodCorrect(){
            let dateFrom = new Date(this.dateFrom);
            let dateTo = new Date(this.dateTo);
            if(dateFrom.getTime()>=dateTo.getTime()) return false;
            return true;
        },
        isDateFromCorrect(){
            let dateFrom = new Date(this.dateFrom);
            let now = new Date(new Date().toISOString().substr(0, 10));
            if(dateFrom.getTime()<now.getTime()) return false;
            return true;
        },
        cost(dateFrom, dateTo, price){
            dateFrom = new Date(dateFrom);
            dateTo = new Date(dateTo);
            let days = (dateTo.getTime() - dateFrom.getTime())/(1000*60*60*24);
            return days*price + 'zł';
        },
        makeReservation(){
            Vue.axios.post('/api/makeReservation',
            {
                'dateFrom':this.dateFrom,
                'dateTo':this.dateTo,
                'status':1,
                'userId':this.$store.getters.user.id,
                'productId':this.product.id,
            })
            .then(()=>{
                this.$router.push({name: 'reservationConfirmation'});
            })
            .catch((error)=>{
                console.log(error.message);
            });
        }
    },
}
</script>
